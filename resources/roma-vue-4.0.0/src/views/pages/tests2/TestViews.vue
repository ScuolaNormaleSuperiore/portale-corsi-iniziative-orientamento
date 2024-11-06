<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>Views</h5>
                <div class="w-full">
                    <template  v-for="(conf,wName) in viewsConf" :key="wName">
                        <!-- <button class="p-button w-full m-1" type="button" v-on:click="wSelected=wName">{{wName}}</button> -->
<!--                        <a class="p-button m-1 p-2" :class="wSelected===wName?'':'p-button-outlined'" href="javascript:void(0)" @click="wSelected=wName">{{ wName }}</a>-->
                        <a class="p-button m-1 p-2" :class="wSelected===wName?'':'p-button-outlined'" :href="'#/test2-views/'+wName" >{{ wName }}</a>
                    </template>
                </div>
                <div class="grid overflow-auto">
                    <div class="col-12 ">
                        <Fieldset class=""  legend="Area View">
                            <div class="w-full">
                                <template v-for="(conf,wName) in viewsConf" :key="wName">
                                    <div class="">
                                        <c-view class="w-full" v-if="wSelected==wName && !reload" :conf="conf"></c-view>
                                    </div>
                                </template>
                            </div>
                        </Fieldset>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-12">
                        <Button class="p-button w-4 mt-1 p-button-success" label="Run" @click="updateCode"></Button>
                        <hr />
                        <div class="grid">
                            <div class="col-6">
                                <h6>Configurazione View {{ wSelected }}</h6>
                                <div class="font-italic">Iniziare il codice sempre con var conf = </div>
                                <div id='example' class="h-20rem w-full">

                                </div>
                            </div>
                            <div class="col-6">
                                <h6>Configurazione di default {{ viewType }}</h6>
                                <div id="defaultCode" class="h-20rem w-full">

                                </div>
                            </div>
                        </div>
                        <div v-if="wSelected" class="grid mt-5">
                            <h5>codice</h5>
                            <pre v-html="getCodeJs()"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import cupparisPrimevue from "cupparis-primevue";
import JsToCode from "@/service/JsToCode";
const cView = cupparisPrimevue.cView;
const jsc = new JsToCode();

///window.history.pushState({}, '', '/tasks/' + na);
export default {
    name: "TestViews",
    components: {cView},
    inject: ['store'],
    data() {
        window.TV = this;
        console.debug('route params',this.$route.params)
        let wSel = this.$route.params?(this.$route.params.case || null):null;
        if (wSel) {
            wSel = decodeURI(wSel)
        }
        return {
            wSelected:wSel,
            viewsConf : {
                'lista statica' : this.staticList(),
                'record statico' : this.staticRecord(),
                'user list' : this.userList(),
                'list edit' : this.listEdit(),
                'user view' : this.userView(),
                'user edit' : this.userEdit(),
                'user edit validate js' : this.userEditValidate(),
                'user search' : this.userSearch(),
                'lista con panel' : this.userListPanel(),
                'lista hide column' : this.userListHideColumn(),
                'lista action select' : this.userListActionSelect(),
                'lista con azione doppia' : this.userListTwoAction(),
            },
            viewType : '',
            reload : false,
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
            })
        },200)

    },
    watch: {
        wSelected() {
            let that = this;
            let conf = this.viewsConf[this.wSelected];
            this.dynamicCode =  jsc.getSourceCode(conf); //this.viewsConf[this.wSelected];
            if (this.editor) {
                this.editor.setValue('var conf = ' + this.dynamicCode);
            }

            this.viewType = that.viewsConf[that.wSelected].type;
            let defaultConf = jsc.getViewDefaultConf(this.viewType);
            that.defaultCode = jsc.getSourceCode(defaultConf);
            if (this.editorDefault) {
                that.editorDefault.setValue('var conf = ' + that.defaultCode)
            }
        }
    },
    methods:{
        getCodeJs() {
            let code = this.viewsConf[this.wSelected];
            return jsc.getSourceCode(code);
        },
        updateCode() {
            let that = this;
            let s = that.editor.getValue();
            let fName = jsc.updateCode(s);
            that.reload = true;
            setTimeout(function () {
                try {
                    that.viewsConf[that.wSelected] = window[fName]();
                    that.reload = false;
                } catch(e) {
                    that.errorDialog(e);
                    throw e;
                }

            },20)

        },

        staticList() {
            return  {
                modelName : 'nome_modello',
                type : 'v-list',
                langContext : null,
                cRef : 'cTest',
                routeName : null,
                orderFields: {'nome':'nome'},
                actions:[],
                viewType : null,
                //actions: ['action-insert'],
                metadata : {
                    order : {
                        direction : 'ASC',
                        field : 'nome'
                    },
                },
                pagination: {
                    per_page : 2
                },
                fieldsConfig : {
                  nome: {
                      type : 'w-input',
                  }
                },
                value : [
                    {
                        id : 1,
                        nome : 'aa',
                        cognome : 'aa'
                    },
                    {
                        id : 2,
                        nome : 'bb',
                        cognome : 'bb'
                    },
                    {
                        id : 3,
                        nome : 'dd',
                        cognome : 'dd'
                    },
                    {
                        id : 4,
                        nome : 'ff',
                        cognome : 'ff'
                    },
                    {
                        id : 5,
                        nome : 'mm',
                        cognome : 'mm'
                    },
                    {
                        id : 6,
                        nome : 'nn',
                        cognome : 'nn'
                    }
                ]
            };
        },
        staticRecord() {
          return {
              type : 'v-record',
              langContext : null,
              routeName : null,
              fields : ['name','relazione','mycheck'],
              value : {
                mycheck: ['1'],
                relazione : 'prova',
                  name : 'nome'
              },
              fieldsConfig:  {
                  mycheck : {
                      type : 'w-checkbox',
                      domainValues : {
                          0 : 'bo',
                          1 : 'uno',
                          2 : 'due',
                          3 : 'tre'
                      }
                  },
                  // relazione : {
                  //     type : 'w-b2m-select2',
                  //     routeName : null,
                  //     primaryKey : 'nome',
                  //     //value : [3],
                  //     //labelFields : ['nome'],
                  //     data : [
                  //         {
                  //             id : 1,
                  //             nome : 'aa',
                  //             cognome : 'aa'
                  //         },
                  //         {
                  //             id : 2,
                  //             nome : 'bb',
                  //             cognome : 'bb'
                  //         },
                  //         {
                  //             id : 3,
                  //             nome : 'dd',
                  //             cognome : 'dd'
                  //         },
                  //         {
                  //             id : 4,
                  //             nome : 'ff',
                  //             cognome : 'ff'
                  //         },
                  //         {
                  //             id : 5,
                  //             nome : 'mm',
                  //             cognome : 'mm'
                  //         },
                  //         {
                  //             id : 6,
                  //             nome : 'nn',
                  //             cognome : 'nn'
                  //         }
                  //     ]
                  // }
              }
          };
        },
        userList() {
            return {
                modelName : 'user',
                type : 'v-list',
                actions:['action-view'],
                // actionsConfig:{
                //     "action-view": {
                //         execute() {
                //             let ta = this;
                //             this.componentDialog('c-view',{
                //                 modelName : 'user',
                //                 type : 'v-view',
                //                 pk : ta.modelData.id,
                //                 fieldsConfig: {
                //                     mainrole: {
                //                         type : 'w-belongsto',
                //                         labelFields:['name']
                //                     }
                //                 }
                //             })
                //         }
                //     }
                // },
                orderFields : {
                    'email':'email',
                    'name' : 'name'
                },
                fieldsConfig: {
                    email: {
                        label: 'emailina',
                        type: 'w-text',
                        template: {
                            name: 'tpl-list',
                            columnClass: 'col-12'
                        }
                    }
                }
            }
        },
        userListPanel() {
          let conf = this.userList();
          conf.recordActionsPosition = 'start';
          conf.actions.push('show-panel');
          conf.actionsConfig = {};
          conf.actionsConfig['show-panel'] = {
              text : 'sp',
              type : 'record',
              toggle : false,
              execute(event) {
                  let that = this;
                  console.log('event',event);
                  if (!this.toggle) {
                      this.view.showPanel(event,{
                          componentName : 'c-view',
                          panelClass : 'w-7',
                          componentConf : {
                              type : 'v-edit',
                              pk : that.modelData.id,
                              modelName : 'user',
                              actions : ['action-save'],
                          },
                          hide() {
                            console.log('HIIIIII',that.toggle);
                            that.toggle = false;
                          }
                      });
                  } else {
                      this.view.hidePanel();
                  }
                  this.toggle = ! this.toggle;
              }
          }
          return conf;
        },
        userView() {
            return {
                type : 'v-view',
                modelName: 'user',
                pk:3,
                fields: ['id', 'email'],
                layout: {
                    labelPosition: 'bottom'
                }
                //actions: ['action-view']
                // fieldsConfig: {}
            };
        },
        userEdit() {
            return {
                pk : 4,
                type : 'v-edit',
                fields : ['name','email','mainrole'], //,"mainrole1"], //,'pippo'],
                actions: ['action-save','action-back','action-custom'],
                modelName: 'user',
                mounted() {
                    var that = this;
                    that.waitWidget('email',function() {
                        console.log('wait ok',that.getWidget('email').getValue());
                    })
                },
                fieldsConfig : {

                    name : {
                        type:'w-input',
                        rules : 'required',
                        //type : 'w-texthtml',
                        //template : 'tpl-record-view',
                        required:true,
                    },
                    email : {
                        type : 'w-texthtml',
                        template :  {
                            name : 'tpl-record',
                            labelType :'none',
                        }
                    },
                    pippo : {
                        type : 'w-custom',
                        template : 'tpl-divider',
                        mounted() {
                            this.value = 'ciao'
                        }
                    },
                    fotos : {
                        type : 'w-hasmany',
                        hasmanyConf: {
                            fields: ['nome', 'descrizione', 'resource'],
                            //widgetTemplate : 'tpl-record',
                            fieldsConfig: {
                                resource: {
                                    type: 'w-upload-ajax',
                                    extensions: ['jpg', 'png'],
                                    maxFileSize: '2M',
                                    ajaxFields: {
                                        //resource_type: 'foto',
                                        field: 'resource'
                                    },
                                    modelName: 'user'
                                }
                            }
                        },
                        value: [],
                        limit: 3,
                    },
                    attachments : {
                        type : 'w-hasmany',
                        hasmanyConf: {
                            fields: ['nome', 'descrizione', 'resource'],
                            fieldsConfig: {
                                resource: {
                                    type: 'w-upload-ajax',
                                    extensions: ['xls', 'csv'],
                                    maxFileSize: '2M',
                                    ajaxFields: {
                                        resource_type: 'attachment',
                                        field: 'resource'
                                    },
                                    modelName: 'user'
                                }
                            }
                        },
                        value: [],
                        limit: 3,
                    },
                    mainrole1: {
                        type : "w-multi-select",
                        value : [1,2],
                        domainValues: {
                            0: 'Niente',
                            1: 'boh',
                            2 : 'Due'
                        }
                    },
                    mainrole : {
                        type :'w-select',
                        mounted() {
                            let that = this;
                            setTimeout(function () {
                                console.log('aaa',that.domainValues,that.domainValuesOrder,that.value);
                            },3000)
                        }
                    },
                    attivo : 'w-radio',
                    password : {
                        type :'w-input',
                        inputType : 'password',
                    },
                    password_confirmation : {
                        type :'w-input',
                        inputType : 'password',
                    }
                },
                actionsConfig: {
                    'action-custom': {
                        text: 'Custom',
                        execute() {
                            let tA = this;
                            let en = tA.view.getAction('action-save').enabled;
                            console.log('custom action',tA.view.getAction('action-save'));
                            tA.view.getAction('action-save').setEnabled(!en);
                            tA.messageDialog('azione custom, ora la save è ' + (!en?'ABILITATA':'DISABILITATA'));
                            return true;
                        }
                    },
                    'action-save':{
                        afterExecute() {
                            this.alertSuccess('ora tohhhhh')
                        }
                    }
                }
            }
        },
        userEditValidate() {
            return {
                pk : 4,
                type : 'v-edit',
                fields : ['name','email','mainrole'], //,"mainrole1"], //,'pippo'],
                actions: ['action-save','action-back','action-custom'],
                modelName: 'user',
                mounted() {
                    var that = this;
                    that.waitWidget('email',function() {
                        console.log('wait ok',that.getWidget('email').getValue());
                    })
                },
                fieldsConfig : {

                    name : {
                        type:'w-input',
                        rules : 'required',
                        required:true,
                    },
                    email : {
                        type : 'w-input',
                        rules : 'required',
                        template :  {
                            name : 'tpl-record',
                            labelType :'none',
                        }
                    },
                    pippo : {
                        type : 'w-custom',
                        template : 'tpl-divider',
                        mounted() {
                            this.value = 'ciao'
                        }
                    },
                    fotos : {
                        type : 'w-hasmany',
                        hasmanyConf: {
                            fields: ['nome', 'descrizione', 'resource'],
                            //widgetTemplate : 'tpl-record',
                            fieldsConfig: {
                                resource: {
                                    type: 'w-upload-ajax',
                                    extensions: ['jpg', 'png'],
                                    maxFileSize: '2M',
                                    ajaxFields: {
                                        //resource_type: 'foto',
                                        field: 'resource'
                                    },
                                    modelName: 'user'
                                }
                            }
                        },
                        value: [],
                        limit: 3,
                    },
                    attachments : {
                        type : 'w-hasmany',
                        hasmanyConf: {
                            fields: ['nome', 'descrizione', 'resource'],
                            fieldsConfig: {
                                resource: {
                                    type: 'w-upload-ajax',
                                    extensions: ['xls', 'csv'],
                                    maxFileSize: '2M',
                                    ajaxFields: {
                                        resource_type: 'attachment',
                                        field: 'resource'
                                    },
                                    modelName: 'user'
                                }
                            }
                        },
                        value: [],
                        limit: 3,
                    },
                    mainrole1: {
                        type : "w-multi-select",
                        value : [1,2],
                        rules : 'required',
                        domainValues: {
                            0: 'Niente',
                            1: 'boh',
                            2 : 'Due'
                        }
                    },
                    mainrole : {
                        type :'w-select',
                        mounted() {
                            let that = this;
                            setTimeout(function () {
                                console.log('aaa',that.domainValues,that.domainValuesOrder,that.value);
                            },3000)
                        }
                    },
                    attivo : 'w-radio',
                    password : {
                        type :'w-input',
                        inputType : 'password',
                    },
                    password_confirmation : {
                        type :'w-input',
                        inputType : 'password',
                    }
                },
                actionsConfig: {
                    'action-custom': {
                        text: 'Custom',
                        execute() {
                            let tA = this;
                            let en = tA.view.getAction('action-save').enabled;
                            console.log('custom action',tA.view.getAction('action-save'));
                            tA.view.getAction('action-save').setEnabled(!en);
                        }
                    }
                }
            }
        },
        userSearch() {
            return {
                modelName: 'user',
                type : 'v-search',
                layout: {
                    cols : 4
                },
                actions:['action-search','action-search-basic'],
                actionsConfig: {
                    'action-search': {
                        // execute() {
                        //     var that = this;
                        //     window.FF = that.view.getViewData();
                        //     console.log('view data', that.view.getViewData())
                        // },
                        afterExecute() {
                            console.debug('view search params',this.view.json);
                            this.messageDialog('Ho ricevuto ');
                        }
                    },
                    'action-search-basic':{
                        afterExecute() {
                            console.debug('view search params',this.view.json);
                            this.messageDialog('Ho ricevuto222 ');
                        }
                    }
                },
                fields: ['user_id', 'email', 'stato', 'stato_check'],
                advancedFields: ['cognome', 'nome'],
                fieldsConfig: {
                    stato: {
                        type: 'w-multi-select',
                        value: [1],
                        domainValues: {
                            1: 'Stato1',
                            2: 'Stato2',
                            3: 'Stato3',
                            4: 'Stato4',
                        },
                        methods: {
                            change() {
                                console.log('Value', this.getValue())
                            }
                        }
                    },
                    stato_check: {
                        type: 'w-checkbox',
                        value: [1],
                        domainValues: {
                            1: 'Stato1',
                            2: 'Stato2',
                            3: 'Stato3',
                            4: 'Stato4',
                        }
                    },
                }
            }
        },
        listEdit() {
            return {
                modelName : 'user',
                fields: ['name','email'],
                type : 'v-list-edit',
                fieldsConfig: {
                    email: {
                        label: 'aaaa'
                    }
                },
                fieldsEditConfig:{
                    email: {
                        type : 'w-text'
                    }
                }
            }
        },
        userListHideColumn() {
            return {
                modelName : 'user',
                type : 'v-list',
                actions:['action-hide-column','action-show-column'],
                actionsConfig:{
                    "action-hide-column": {
                        text : 'Hide Column',
                        execute() {
                            let ta = this;
                            let fieldName = prompt('inserire nome campo da rimuovere. campi disponibili ( ' + this.view.fields.join(',') + ')');
                            this.view.hideColumn(fieldName);

                        }
                    },
                    "action-show-column": {
                        text : 'Show Column',
                        execute() {
                            let ta = this;
                            let fieldName = prompt('inserire nome campo da visualizzare. campi disponibili ( ' + ta.view.hiddenColumns.join(',') + ')');
                            ta.view.showColumn(fieldName);
                        }
                    }
                },
                orderFields : {
                    'email':'email',
                    'name' : 'name'
                },
                fieldsConfig: {
                    email: {
                        label: 'emailina',
                        type: 'w-text',
                        template: {
                            name: 'tpl-list',
                            columnClass: 'col-12'
                        }
                    }
                }
            }
        },
        userListActionSelect() {
            return {
                modelName : 'user',
                type : 'v-list',
                actions:['ActionSelect'],
                actionsConfig : {
                    ActionSelect : {
                        text : 'mod inst',
                        domainValues : {
                            0 : 'Nessuna azione',
                            1 : 'Pippo',
                            2 : 'Pluto'
                        },
                        execute() {
                            alert('value ' + this.value);
                        }
                    }
                },
                orderFields : {
                },
                fieldsConfig: {

                }
            }
        },

        userListTwoAction() {
            return {
                modelName : 'user',
                type : 'v-list',
                actions:['action-view','action-view-1','action-view-2'],
                fields : ['username','email'],
                actionsConfig : {
                    'action-view-1' : {
                        text : 'view 1',
                        actionParent : 'action-view',
                        beforeExecute() {
                            alert('prima di execute');
                            return true;
                        },
                    },
                    'action-view-2' : {
                        actionParent : 'action-view',
                        text : 'view 2',
                        afterExecute() {
                            alert('dopo execute')
                        },
                    }
                },
                orderFields : {
                },
                fieldsConfig: {

                }
            }
        }
    }
}
</script>

<style scoped>

</style>
