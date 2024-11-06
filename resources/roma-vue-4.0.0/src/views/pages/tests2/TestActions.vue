<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>Actions</h5>
                <div>
                    <template v-for="(conf,wName) in actionsConf" :key="wName">
                        <a class="p-button m-1 p-1 p-button-outlined" href="javascript:void(0)" @click="aSelected=wName">{{ wName }}</a>
                    </template>
                </div>
                <!-- <div class="grid w-full">
                    <div class="col-2 " v-for="(conf,wName) in actionsConf" :key="wName" >
                        <Button class="w-full p-button-outlined"  type="button" v-on:click="aSelected=wName" :label="wName"></Button>

                    </div>

                </div> -->
                <hr />
                <div >
                    <div >
                        <template v-if="['w-hasmany','w-hasmany-list'].indexOf(aSelected) >= 0">
                            <div><Button icon="fa fa-plus" @click="addHasmany" label="setValue dall'esterno"></Button></div>
                        </template>

                        <Fieldset legend="Area Widget">
                            <template class="col-12" v-for="(conf,wName) in actionsConf" :key="wName">
                                <c-action class="w-full" :ref="wName" v-if="aSelected==wName && !reload" :conf="conf" :layout="actionLayout"></c-action>
                            </template>
                        </Fieldset>
                        <Button class="p-button w-4 mt-1" label="Run" @click="updateCode"></Button>
                        <hr />
                        <div class="grid">
                            <div class="col-6">
                                <h6>Configurazione Action {{ widgetType }}</h6>
                                <div class="font-italic">Iniziare il codice sempre con var conf = </div>
                                <div id='example' class="h-20rem w-full">

                                </div>
                            </div>
<!--                            <div class="col-6">-->
<!--                                <h6>Configurazione di default {{ widgetType }}</h6>-->
<!--                                <div id="defaultCode" class="h-20rem w-full">-->

<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>


//import cuppariSakai from "cupparis-sakai";
import JsToCode from "@/service/JsToCode";
import cupparisPrimevue from 'cupparis-primevue';
const jsc = new JsToCode();
//const Widget = cuppariSakai.c
export default {
    name: "TestActions",
    extends : cupparisPrimevue.CrudComponent,
    //components: {cWidget},
    inject: ['store'],
    data() {
        window.TW = this;
        return {
            aSelected : null,
            actionLayout : 'simple',
            actionsConf : {
                'Action Singola' : this.actionSingola(),
                'Action default e Ridefinita' : this.actionDefaultDoppia(),
                'Action custom' : this.actionCustom()
            },
            fIndex : 0,
            dynamicCode : '',
            defaultCode : '',
            reload : false,
            editor : null,
            editorDefault : null,
            widgetType : '',
        }
    },
    mounted() {
        let that = this;
        setTimeout(function() {
            jsc.loadVisLib(function () {
                console.debug('OK',document.getElementById('example'));
                that.editor = ace.edit("example", {
                    theme: "ace/theme/textmate",
                    mode: "ace/mode/javascript",
                    value: 'var conf = {}',
                });
                // that.editorDefault = ace.edit("defaultCode", {
                //     theme: "ace/theme/textmate",
                //     mode: "ace/mode/javascript",
                //     value: 'var conf = {}',
                // });
            })
        },200)

    },
    watch: {
        aSelected() {
            let that = this;
            let actionSelected =  this.actionsConf[that.aSelected];
            for (let a in actionSelected.actions) {
                let conf = Object.assign({},(actionSelected.actions[a]?actionSelected.actions[a]:{}));
                actionSelected.actions[a] = cupparisPrimevue.CrudCore.getActionConf(a, conf);
            }

            console.debug('action conf',that.aSelected,actionSelected)
            this.dynamicCode =  jsc.getSourceCode(actionSelected); //this.actionsConf[this.aSelected];
            if (this.editor) {
                this.editor.setValue('var conf = ' + this.dynamicCode);
            }
            // that.defaultCode = jsc.getSourceCode(actionSelected);
            // if (this.editorDefault) {
            //     that.editorDefault.setValue('var conf = ' + defaultCode)
            // }
        }
    },
    methods:{
        // getConf(wname) {
        //     return this.actionsConf[wname];
        // },
        actionSingola() {
            return {
                actions: {
                    'action-save' :  {
                        text : 'ok'
                    }
                }
            }
        },
        actionDefaultDoppia() {
            return {
                actions: {
                    'action-save' : null,
                    'action-save2' : {
                        actionParent : 'action-save',
                        text : 'Save 2'
                    }
                }
            }
        },
        actionCustom() {
            return {
                actions: {
                    'action-mia' : {

                        text : 'Mia',
                        execute() {
                            alert('mia')
                        }
                    },
                    'action-save2' : {
                        actionParent : 'action-save',
                        text : 'Save 2'
                    }
                }
            }
        },
        updateCode() {
            let that = this;
            let s = that.editor.getValue();
            let fName = jsc.updateCode(s);
            that.reload = true;
            setTimeout(function () {
                try {
                    that.actionsConf[that.aSelected] = window[fName]();
                    that.reload = false;
                } catch(e) {
                    that.errorDialog(e);
                    throw e;
                }

            },20)


        },



        wChipConf() {
            return {
                type : 'w-chip',
                name : 'field1',
                value: ["testone"],
                change() {
                    console.log('chip value',this.getValue())
                }
            }
        },
        wHiddenConf() {
            return {
                type : 'w-hidden',
                name : 'field1',
                value: "testone",
            }
        },
        wTextConf() {
            return {
                type : "w-text",
                name : 'field1',
                value: "testone",
            }
        },
        wInputConf() {
            return {
                inputType: 'text',
                value: "220",
                change(event) {
                    let that = this;
                    console.log('value',that.getValue(),'that',that,'event',event);
                }
            }
        },
        wSelectConf() {
          return {
              value: 20,
              name: 'field1',
              type : 'w-select',
              domainValues: {
                  10: "Dieci",
                  20: "Venti",
                  30: "Trenta",
              },
              change() {
                  console.log('value', this.value);
              }
          };
        },
        wAutocompleteConf() {
            return {
                type : 'w-autocomplete',
                name: 'email',
                labelFields: ['email'],
                value: 2,
                foormName: 'user',
                viewType: 'edit',
                referredData: {
                    id: 2,
                    email: 'ciullo@gmail.com',
                    name : 'Pier Paolo Ciullo',
                },
                clearButton : true,
                extraBind : {
                    "option-label" : "name",
                },
            };
        },
        wCheckboxConf() {
            return {
                type : 'w-checkbox',
                value : ["1","4"],
                domainValues : {
                    1 : 'Uno',
                    2 : 'Due',
                    3 : 'Tre',
                    4 : 'Quattro',
                    5 : 'Cinque'
                },
                change() {
                    console.log(this.value);
                }
            };
        },
        wRadioConf() {
            return {
                type : 'w-radio',
                value: '1',
                name: 'field1',
                domainValues: {
                    0: 'Zero',
                    1: 'Uno',
                    2: 'Due',
                    3: 'Tre'
                },
                domainValuesOrder: [3, 2, 1, 0],
                change() {
                    console.log('change ', this.getValue())
                }
            }

        },
        wHasmany(hasmanyType) {
            let wh =  {
                name: 'field1',
                label : 'Hasmany',
                type : 'w-hasmany',
                hasmanyType : hasmanyType,
                hasmanyConf: {
                    //modelName : 'user',
                    fields: ['id', 'nome', 'descrizione', 'resource'],
                    defaultWidgetType : 'w-input',
                    //selectionMode : false,
                    fieldsConfig: {
                        id : {
                          type : 'w-hidden'
                        },
                        nome : {
                            type : 'w-input'
                        },
                        resource: {
                            type : 'w-input',
                            // template: 'tpl-base',
                            // type: 'w-upload-ajax',
                            // extensions: ['jpg', 'png'],
                            // maxFileSize: '2M',
                            // ajaxFields: {
                            //     resource_type: 'foto',
                            //     field: 'resource'
                            // },
                            // modelName: 'user'
                        }
                    }
                },
                value: [
                    {
                        id: 35,
                        nome : 'nome uno',
                        descrizione : 'descrizione presente',
                        resource : 'de ma de'
                    }
                ],
                limit: 3,

                change() {
                    console.log('change ' , this.getValue())
                }

            }
            if (hasmanyType == 'list') {
                wh.hasmanyConf.actions = ['action-insert','action-delete-selected'];
            }
            return wh;
        },
        wBelongstoConf() {
            return {
                name: 'user',
                type : 'w-belongsto',
                cRef: 'wTest',
                separator : '--',
                labelFields : ['email'],
                value : {
                    "id": 3,
                    "email": "amministratore@amministratore.it",
                },
            }
        },
        wCustomConf() {
            return {
                type : 'w-custom',
                value : "ciao <b>tutti</b>",
            }
        },
        wColorPickerConf() {
            return {
                type : 'w-color-picker',
                value : "#FF00FF",
            }
        },
        wDatePickerConf() {
            return {
                value : '2020-12-20',
                buttonClear : true,
                type : 'w-date-picker',
                change() {
                    console.log('date-picker',this.value)
                }
                // buttonClear: false,
            };
        },
        wDateTextConf() {
            return {
                type : 'w-date-text',
                value : '2021-12-09',
                displayFormat : 'LLL'
            }
        },
        wDateTextConf2() {
            return {
                type : 'w-date-text',
                value: '2021-12-18',
                displayFormat: 'giorno DD anno YYYY mese MM'
            }
        },
        wTextareaConf() {
            return  {
                type : 'w-textarea',
                value : 'text area prvoa',
                change() {
                    console.log('textarea value ', this.getValue());
                }
            }
        },
        wMultiSelectConf() {
            return {
                value: [20,30],
                name: 'field1',
                type : 'w-multi-select',
                domainValues: {
                    10: "Dieci",
                    20: "Venti",
                    30: "Trenta",
                    40: 'Quaranta'
                },
                change() {
                    console.log('change ' , this.getValue())
                }
            };
        },
        wSwapConf() {
            return {
                type : 'w-swap',
                value: 0,
                name: 'banned',
                onIcon : 'fa fa-circle',
                modelData: {
                    id: 4
                },
                modelName: 'user',
                routeName : 'set',
                change () {
                    console.log('change ',this.getValue())
                }
            }
        },
        wStatusConf() {
            return {
                value : 7,
                statusType: 'icon',
                type : 'w-status',
                domainValues: {
                    5: 'fa fa-times text-red-600',
                    6: 'fa fa-gear text-green-600',
                    7: 'fa fa-question text-yellow-600'
                },
            };
        },
        wStatusTextConf() {
            return {
                value : 5,
                statusType: 'text',
                type : 'w-status',
                domainValues: {
                    5: 'Ciao bello',
                    6: 'Prova',
                    7: 'Sette'
                },
            };
        },
        wTexthtmlConf() {
            return {
                value : 'text area prvoa',
                type : 'w-texthtml',
                change() {
                    let that = this;
                    console.log('change',that.getValue())
                }
            };
        },

        wUploadConf() {
            return {
                name: 'field1',
                type : 'w-upload',
                maxFileSize: "2M",
                extensions: ['pdf', 'xls', 'png'],
                modelName : 'user',
                value : {
                    "id": "files/allegati/allegato_1_1643619308.pdf",
                    "url": "downloadmediable/attachment/1",
                    "mimetype": "application/pdf"
                },
                // campi da inviare nella richiesta ajax di upload file
                ajaxFields: {
                    //upload_type : 'attachment',
                    resource_type: 'attachment',
                    field:'name',
                },
                methods: {
                    change: function () {
                        console.log('my change', this.getValue())
                    },
                }
            };
        },
        wUploadAjaxConf() {
            return {
                name: 'field1',
                type : 'w-upload-ajax',
                maxFileSize: "2M",
                extensions: ['pdf', 'xls', 'png'],
                modelName : 'user',
                value : {
                    "id": "files/allegati/allegato_1_1643619308.pdf",
                    "url": "downloadmediable/attachment/1",
                    "mimetype": "application/pdf"
                },
                // campi da inviare nella richiesta ajax di upload file
                ajaxFields: {
                    //upload_type : 'attachment',
                    resource_type: 'attachment',
                    field:'name',
                },
                methods: {
                    change: function () {
                        console.log('my change', this.getValue())
                    },
                }
            };
        },
    }
}
</script>

<style scoped>
textarea {
    width: 100%;
    height: 100%;
    background: #1f1f1f;
    color : #FFFFFF;
    padding: 10px 20px;
    border : 0;
    outline: 0;
    font-size: 12px;
}
</style>
