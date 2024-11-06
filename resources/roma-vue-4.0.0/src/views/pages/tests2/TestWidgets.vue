<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>Widgets</h5>
                <div>
                    <template v-for="(conf,wName) in widgetsConf" :key="wName">
<!--                        <a class="p-button m-1 p-1 p-button-outlined" href="javascript:void(0)" @click="wSelected=wName">{{ wName }}</a>-->
                        <a class="p-button m-1 p-2" :class="widgetSelected===wName?'':'p-button-outlined'" :href="'#/test2-widgets/'+wName" >{{ wName }}</a>
                    </template>
                </div>
                <!-- <div class="grid w-full">
                    <div class="col-2 " v-for="(conf,wName) in widgetsConf" :key="wName" >
                        <Button class="w-full p-button-outlined"  type="button" v-on:click="wSelected=wName" :label="wName"></Button>

                    </div>

                </div> -->
                <hr />
                <div >
                    <div >
                        <template v-if="['w-hasmany','w-hasmany-list'].indexOf(widgetSelected) >= 0">
                            <div><Button icon="fa fa-plus" @click="addHasmany" label="setValue dall'esterno"></Button></div>
                        </template>

                        <Fieldset legend="Area Widget">
                            <template v-for="(conf,wName) in widgetsConf" :key="wName">
                                <c-widget class="w-full" :ref="wName" v-if="widgetSelected==wName && !reload" :conf="conf"></c-widget>
                            </template>
                        </Fieldset>
                        <Button class="p-button w-4 mt-1" label="Run" @click="updateCode"></Button>
                        <hr />
                        <div class="grid">
                            <div class="col-6">
                                <h6>Configurazione Widget {{ widgetType }}</h6>
                                <div class="font-italic">Iniziare il codice sempre con var conf = </div>
                                <div id='example' class="h-20rem w-full">

                                </div>
                            </div>
                            <div class="col-6">
                                <h6>Configurazione di default {{ widgetType }}</h6>
                                <div id="defaultCode" class="h-20rem w-full">

                                </div>
                            </div>
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
    name: "TestWidgets",
    extends : cupparisPrimevue.CrudComponent,
    //components: {cWidget},
    inject: ['store'],
    data() {
        window.TW = this;
        let wSel = this.$route.params?(this.$route.params.case || null):null;
        if (wSel) {
            wSel = decodeURI(wSel)
        }
        return {
            widgetSelected : wSel,
            widgetsConf : {
                'w-hidden' :            this.wHiddenConf(),
                'w-text' :              this.wTextConf(),
                'w-input' :             this.wInputConf(),
                'w-select' :            this.wSelectConf(),
                'w-autocomplete' :      this.wAutocompleteConf(),
                'w-checkbox' :          this.wCheckboxConf(),
                'w-radio' :             this.wRadioConf(),
                'w-hasmany' :           this.wHasmany('record'),
                'w-hasmany-list' :      this.wHasmany('list'),
                'w-belongsto':          this.wBelongstoConf(),
                'w-custom':             this.wCustomConf(),
                'w-color-picker':       this.wColorPickerConf(),
                'w-date-picker':        this.wDatePickerConf(),
                'w-date-text':          this.wDateTextConf(),
                'w-date-text2':         this.wDateTextConf2(),
                'w-textarea':           this.wTextareaConf(),
                'w-multi-select':       this.wMultiSelectConf(),
                'w-swap':               this.wSwapConf(),
                'w-status con icon':    this.wStatusConf(),
                'w-status con testo':   this.wStatusTextConf(),
                'w-texthtml':           this.wTexthtmlConf(),
                'w-upload' :            this.wUploadConf(),
                'w-upload-ajax' :       this.wUploadAjaxConf(),
                'w-chip' :              this.wChipConf(),
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
                that.editorDefault = ace.edit("defaultCode", {
                    theme: "ace/theme/textmate",
                    mode: "ace/mode/javascript",
                    value: 'var conf = {}',
                });
                if (that.widgetSelected) {
                    that.setCode();
                }
            })

        },200)

    },
    watch: {
        widgetSelected() {
            this.setCode();
        }
    },
    methods:{
        // getConf(wname) {
        //     return this.widgetsConf[wname];
        // },
        setCode() {
            let that = this;
            let conf = this.widgetsConf[this.widgetSelected];
            this.dynamicCode =  jsc.getSourceCode(conf); //this.widgetsConf[this.widgetSelected];
            if (this.editor) {
                this.editor.setValue('var conf = ' + this.dynamicCode);
            }

            this.widgetType = that.widgetsConf[that.widgetSelected].type;
            let defaultConf = jsc.getWidgetDefaultConf(this.widgetType);
            that.defaultCode = jsc.getSourceCode(defaultConf);
            if (this.editorDefault) {
                that.editorDefault.setValue('var conf = ' + that.defaultCode)
            }
        },
        updateCode() {
            let that = this;
            let s = that.editor.getValue();
            let fName = jsc.updateCode(s);
            that.reload = true;
            setTimeout(function () {
                try {
                    that.widgetsConf[that.widgetSelected] = window[fName]();
                    that.reload = false;
                } catch(e) {
                    console.debug('funzione chiamata',fName,window[fName]);
                    that.errorDialog(e);
                    throw e;
                }

            },20)



        },
        getWidget(wname) {
            return this.$refs[wname][0].instance();
        },
        // getCodeJs() {
        //     try {
        //         let code = this.widgetsConf[this.wSelected];

        //         document.getElementById('ta-code').value = jsc.getSourceCode(code);
        //         return jsc.getSourceCode(code);
        //     } catch (e) {
        //         return e;
        //     }

        // },

        makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        },
        aggiornaText() {
            //this.widgetsConf['w-text'].value = this.makeid(10);
            this.widgetsConf['w-text'].value = this.makeid(10);
            //tt.value = this.makeid(10);
            //this.$refs['w-text'].value = this.makeid(10);
            //this.$refs['w-text'].$set('conf',tt);
            //this.$refs['w-text'].setValue(this.makeid(10));
            //console.log('aaa',this.widgetsConf['w-text'])
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
                        //id: 35,
                        nome : 'nome uno',
                        descrizione : 'descrizione presente',
                        resource : 'de ma de'
                    },
                    {
                        //id: 37,
                        nome : 'nome u432',
                        descrizione : 'descrizione presensssste',
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

        addHasmany() {
            let that = this;
            let widget = that.$refs[that.widgetSelected][0];
            let nitem = 1 + parseInt(Math.floor(Math.random() * 10)) % 2;
            console.log('nitem',nitem);

            that.$refs[that.widgetSelected][0].setValue([
                {
                    //id : 3,
                    nome : that.makeid(7),
                    descrizione : that.makeid(23),
                    resource : that.makeid(10)
                },
                {
                    ///id : 4,
                    nome : that.makeid(7),
                    descrizione : that.makeid(23),
                    resource : that.makeid(10)
                },
                {
                    //id : 5,
                    nome : that.makeid(7),
                    descrizione : that.makeid(23),
                    resource : that.makeid(10)
                }
            ])
        },
        // wHasmanyListedConf : {
        //     name: 'field1',
        //     hasmanyConf: {
        //         fields: ['nome', 'descrizione','pippo'], // 'resource'],
        //         //modelName : 'nomeModello',
        //         //routeName : null,
        //         //actions: ['action-insert'],
        //         //defaultWidgetType  : 'w-input',
        //         fieldsConfig: {
        //             pippo: {
        //                 type : 'w-select',
        //                 domainValues: {
        //                     1: 'Uno',
        //                     2: 'Due',
        //                     3: 'Tre'
        //                 },
        //                 value: 1
        //             }
        //             // resource: {
        //             //     template : 'tpl-no',
        //             //     type: 'w-upload-ajax',
        //             //     extensions: ['jpg', 'png'],
        //             //     maxFileSize: '2M',
        //             //     ajaxFields: {
        //             //         resource_type: 'foto',
        //             //         field: 'resource'
        //             //     },
        //             //     modelName: 'user'
        //             // }
        //         },
        //     },
        //     value: [
        //         {
        //             nome: 'nome1',
        //             descrizione : 'descrizione1'
        //         }
        //     ],
        //     limit: 2,
        //     methods: {
        //         change: function () {
        //             console.log('change ' , this.getValue())
        //         }
        //     },
        // },


        // wTextConf : {
        //     value : 'text di prvoa'
        // },



        // wPreviewConf : {
        //     value : {
        //         "id": "files/allegati/allegato_1_1643619308.pdf",
        //         "url": "downloadmediable/attachment/1",
        //         "mimetype": "application/pdf"
        //     },
        // },


        // wMapConf : {
        //     cRef: 'wTest',
        //     apiKey : null, //window.app.$crud.googleKey,
        //     lat: 42.46302,
        //     lng: 14.21174,
        //     zoom:16,
        //     mapStyles : [
        //         {
        //             "featureType": "poi",
        //             "elementType": "all",
        //             "stylers": [
        //                 {
        //                     "visibility": "off"
        //                 }
        //             ]
        //         },
        //     ]
        // },
        // wMapViewConf : {
        //     apiKey : null, //window.app.$crud.googleKey,
        //     cRef: 'wTest',
        //     lat: 42.36001285975785,
        //     lng: 14.139391132915549
        // },
        // wInputHelpedConf : {
        //     value : '',
        //     customValue : true,
        //     domainValues : {
        //         1 : 'Uno',
        //         2 : 'Due',
        //         3 : 'Tre',
        //         4 : 'Quattro'
        //     }
        // },
        // wImageConf : {
        //     value : '/image/ciccio.png'
        // },
        // wDateTextConf : {
        //     value : '2020-12-20'
        // },

        // wDateSelectConf : {
        //     value : '2020-12-20',
        //     methods: {
        //         change() {
        //             console.log('change',this.getValue());
        //         }
        //     }
        // },


        // hasoneConf : {
        //     cRef: 'wTest',
        //     //label : 'pbo',
        //     viewConf: {
        //         //fields : ['status'],
        //         modelName: 'setting',
        //         langContext: 'pippo',
        //     },
        //     value: {
        //         status: 'updated',
        //         name: 'prova'
        //     }
        // },
        // wB2Select2ConfStatic : {
        //     cRef: 'wTest',
        //     modelName: 'user',
        //     routeName: null,
        //     labelFields: ['nome', 'cognome'],
        //     value: 3,
        //     theme: 'bootstrap4',
        //     methods: {
        //         change: function () {
        //             console.log('change mia', this.getValue());
        //         }
        //     },
        //     data: [
        //         {
        //             id: 1,
        //             nome: 'ancona',
        //             cognome: 'ancona'
        //         },
        //         {
        //             id: 2,
        //             nome: 'bologna',
        //             cognome: 'bologna'
        //         },
        //         {
        //             id: 3,
        //             nome: 'denuncia',
        //             cognome: 'denuncia'
        //         },
        //         {
        //             id: 4,
        //             nome: 'formato',
        //             cognome: 'formato'
        //         },
        //         {
        //             id: 5,
        //             nome: 'maremma',
        //             cognome: 'maremma'
        //         },
        //         {
        //             id: 6,
        //             nome: 'nocerino',
        //             cognome: 'nocerino'
        //         }
        //     ]
        //     //labelFields : ['email'],
        // },
        // wB2MSelect2Conf : {
        //     name: 'email',
        //     foormName: 'user',
        //     viewType: 'edit',
        //     cRef: 'wTest',
        //     theme: 'bootstrap4',
        //     data: [
        //         {
        //             id: 3,
        //             email: 'amministratore@amministratore.it',
        //         },
        //         {
        //             id: 4,
        //             email: 'pinkopallo@amministratore.it',
        //         }
        //     ]
        // },
        // wB2mSelect2ConfStatic : {
        //     cRef: 'wTest',
        //     value: [3, 4],
        //     labelFields: ['nome', 'cognome'],
        //     theme: 'bootstrap4',
        //     // methods: {
        //     //   ready() {
        //     //       var container = this.jQe().parent();
        //     //       console.log('lll',window.jQuery(container).html());
        //     //       console.log('lll',window.jQuery(container).find('.select2-container').length);
        //     //       window.jQuery(container).find('.select2-container').addClass('form-control p-1 pl-2 w-100');
        //     //       window.jQuery(container).find('.select2-container').css('overflow', 'auto');
        //     //   }
        //     // },
        //     data: [
        //         {
        //             id: 1,
        //             nome: 'ancona',
        //             cognome: 'ancona'
        //         },
        //         {
        //             id: 2,
        //             nome: 'bologna',
        //             cognome: 'bologna'
        //         },
        //         {
        //             id: 3,
        //             nome: 'denuncia',
        //             cognome: 'denuncia'
        //         },
        //         {
        //             id: 4,
        //             nome: 'formato',
        //             cognome: 'formato'
        //         },
        //         {
        //             id: 5,
        //             nome: 'maremma',
        //             cognome: 'maremma'
        //         },
        //         {
        //             id: 6,
        //             nome: 'nocerino',
        //             cognome: 'nocerino'
        //         }
        //     ]
        // },

        // wUploadConf : {
        // },
        // uploadAjaxConf : {
        //     name: 'name',
        //     modelName: 'user',
        //     ajaxFields: {
        //         field: 'name',
        //         resource_type: 'foto'
        //     },
        // },
        // dateTextConf : {
        //     name: 'datename',
        //     cRef: 'wTest',
        //     value: '2020-02-28'
        // },
        // wInputColor : {
        //     inputType : 'color',
        //     value: "#25b900"
        // },
        // wDateRangePickerConf : {
        //     name: 'field1',
        //     value:  [
        //         '2021-09-01','2021-09-10'
        //     ],
        //     dateFormat : 'YYYY-MM-DD',
        //     displayFormat: 'DD/MM/YYYY',
        // },
        // wDateRangePickerConf : {
        //     name: 'field1',
        //     value:  [
        //         '2021-09-01 23:50:00','2021-09-10 23:50:00'
        //     ],
        //     dateFormat : 'YYYY-MM-DD HH:mm:ss',
        //     displayFormat: 'DD/MM/YYYY HH:mm:ss',
        //     pluginOptions: {
        //         timePicker: true,
        //         "timePicker24Hour": true,
        //         locale: {
        //             format : 'DD/MM/YYYY HH:mm:ss'
        //         }
        //
        //
        //     }
        // },

        // wRangeSeparatedConf : {
        //     separateValue: true,
        //     endFieldName: 'end',
        //     value: '2021-09-01 23:50:00',
        //     modelData:  {
        //         end: '2021-09-10 23:50:00'
        //     },
        //     dateFormat : 'YYYY-MM-DD HH:mm:ss',
        //     pluginOptions: {
        //         timePicker: true,
        //         "timePicker24Hour": true,
        //         locale: {
        //             format : 'DD/MM/YYYY HH:mm:ss'
        //         }
        //
        //
        //     }
        // }

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
