<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>Dialogs</h5>

                <template v-for="(wname,index) in dialogs" :key="index">
                    <a class="p-button p-button-secondary p-2 m-1 p-button-outlined" type="button" v-on:click="doCmd(wname)">{{ Array.isArray(wname)?wname[0] + ' con ' + wname[1]:wname }}</a>
                </template>
                <hr />
                <Button class="p-button w-4 mt-1" label="Run" @click="updateCode"></Button>
                <hr />
                <div class="grid">
                    <div class="col-12">
                        <h6>Configurazione Dialog {{ dialogType }}</h6>
                        <div class="font-italic">Modifica il codice ed esegui</div>
                        <div id='example' class="h-20rem w-full">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import crudSakai from 'crud-vue-sakai'
//import CrudComponent from "@/cupparis/CrudComponent.vue";

import cs from "cupparis-primevue";
const CrudCore = cs.CrudCore;
import JsToCode from "@/service/JsToCode";
const jsc = new JsToCode();





export default {
    name: "TestDialogs",
    extends:cs.CrudComponent,
    //mixins : [crudSakai.coreMixin,crudSakai.dialogsMixin],
    inject: ['store'],
    mounted() {
        let that = this;
        setTimeout(function() {
            jsc.loadVisLib(function () {
                console.debug('OK',document.getElementById('example'));
                that.editor = ace.edit("example", {
                    theme: "ace/theme/textmate",
                    mode: "ace/mode/javascript",
                    value: '',
                });
            })
        },200)
    },
    data() {
        return {
            display : true,
            dialogs: [
                'messageDialog',
                'errorDialog',
                'warningDialog',
                'confirmDialog',
                'customDialog',
                ['customDialog','buttons'],
                ['customDialog','fcustom'],
                ['customDialog','vlist'],
                ['customDialog','vinsert'],
                ['customDialog','vview'],
                'infoAlert',
                'warningAlert',
                'errorAlert',
                'successAlert',
                ['successAlert','acustom']
            ],
            dialogType : '',
        }
    },
    methods: {
        doCmd: function (command) {
            var that = this;
            //let store = this.store;
            console.log('command', command);
            var wConf = '';
            if (Array.isArray(command)) {
                wConf = command[1];
            } else {
                wConf =  CrudCore.camelCase(command) + 'Func';
            }
            console.debug('call',wConf)
            //window.jQuery('#confArea').html('<pre>' + JSON.stringify(that[wConf].toString(), null, '\t') + '</pre>')
            that[wConf]();
        },
        getHref: function () {
            return window.location.hash;
        },
        updateCode() {
            let that = this;
            let s = that.editor.getValue();
            let fName = jsc.updateCode(s);
            setTimeout(function () {
                try {
                    eval(jsc.getCodeString(s))
                    //window[fName]().call(that,CrudCore);
                } catch(e) {
                    that.errorDialog(e);
                    throw e;
                }

            },20)
            console.debug('updateCode')
        },
        messageDialogFunc() {
            //CrudCore.errorDialog('aaa');
            let that = this;
            //that.defaultCode = jsc.getSourceCode(this.messageDialog.toString());
            //let jsFunc = that.messageDialogCall.toString();
            let jsFunc = "\n\
CrudCore.messageDialog('Dialog generale per messaggi',null,{\n\
    ok : function() {\n\
        this.hide();\n\
        CrudCore.messageDialog('Dialog generale per messaggioosss',{title:'titolo custom'})\n\
    }\n\
})\n\
            "

            console.debug('messageDialogFunc',that.editorDefault,jsFunc)
            that.editor.setValue(jsFunc);
            that.dialogType = "messageDialog"
            that.updateCode();

            //this.messageDialog('Dialog generale per messaggi').show();
        },
        errorDialogFunc() {
            let that = this;
let jsFunc = "\n\
CrudCore.errorDialog('Dialog generale di errori',null,{\n\
    ok : function() {\n\
        this.hide();\n\
        CrudCore.errorDialog('Dialog generale di errori',{title:'titolo custom'})\n\
    }\n\
})\n\
";
            that.editor.setValue(jsFunc);
            that.dialogType = "errorDialog";
            that.updateCode();
            //this.errorDialog('Dialog generale di errori');
        },
        warningDialogFunc() {
            let that = this;
            let jsFunc = "\n\
CrudCore.warningDialog('Dialog generale di warning')\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "warningDialog";
            that.updateCode();
        },
        confirmDialogFunc() {
            let that = this;
            let jsFunc = "\n\
CrudCore.confirmDialog('Dialog generale di conferma',{},{\n\
    ok : function() {\n\
        alert('ok')\n\
    },\n\
    cancel: function() {\n\
        alert('cancel');\n\
    }\n\
});\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "confirmDialog";
            that.updateCode();
        },
        customDialogFunc() {
            let that = this;
            let jsFunc = "\n\
CrudCore.customDialog('Dialog custom con bottoni',{},{\n\
    button1 : function() {\n\
        alert('button1')\n\
    },\n\
    button2: function() {\n\
        alert('button2');\n\
    },\n\
    button3: function() {\n\
        alert('button3');\n\
    }\n\
});\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog Con bottoni";
            that.updateCode();
        },

        fcustom() {
            let that = this;
            let jsFunc = "\n\
CrudCore.customDialog('Dialog custom senza bottoni');\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },

        buttons() {
            let that = this;
            let jsFunc = "\n\
CrudCore.customDialog('Dialog con bottoni customizzabili',{\n\
    buttons : [\n\
        {\n\
            label : 'Bottone1',\n\
            icon : 'pi pi-bitcoin',\n\
            callback : function() {\n\
                alert('yeah')\n\
            },\n\
            css : 'bg-bluegray-600 hover:bg-bluegray-400 border-bluegray-700'\n\
        },\n\
        {\n\
            callback() {\n\
                alert('bt2');\n\
                this.hide();\n\
            }\n\
        }\n\
    ]\n\
});\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },

        vlist() {
            let that = this;
            let jsFunc = "\n\
let cConf = {\n\
    modelName:'user',\n\
    actions:[],\n\
    fields: ['email'],\n\
    type : 'v-list',\n\
}\n\
CrudCore.componentDialog('c-view',cConf);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },
        vinsert() {
            let that = this;
            let jsFunc = "\n\
let cConf = {\n\
    modelName:'user',\n\
    actions:['action-save'],\n\
    fields: ['email','name'],\n\
    fieldsConfig : {\n\
        email : {\n\
            rules : 'required'\n\
        }\n\
    },\n\
    type : 'v-insert',\n\
}\n\
CrudCore.componentDialog('c-view',cConf);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },
        vview() {
            let that = this;
            let jsFunc = "\n\
let cConf = {\n\
    modelName:'user',\n\
    actions:['action-save'],\n\
    fields: ['email','name'],\n\
    pk : 1,\n\
    type : 'v-view',\n\
}\n\
CrudCore.componentDialog('c-view',cConf);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },
        acustom() {
            let that = this;
            let jsFunc = "\n\
CrudCore.alertSuccess('Alert Succes permanente',0);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },

        infoAlertFunc() {
            let that = this;
            let jsFunc = "\n\
CrudCore.alertInfo('Alert',2000);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },
        warningAlertFunc() {
            let that = this;
            let jsFunc = "\n\
CrudCore.alertWarning('Alert warning',2000);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },
        errorAlertFunc() {
            let that = this;
            let jsFunc = "\n\
CrudCore.alertError('Alert error',2000);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        },
        successAlertFunc() {
            let that = this;
            let jsFunc = "\n\
CrudCore.alertSuccess('Alert Succes',2000);\n\
";          that.editor.setValue(jsFunc);
            that.dialogType = "customDialog no bottoni";
            that.updateCode();
        }
    },
}
</script>

<style scoped>

</style>
