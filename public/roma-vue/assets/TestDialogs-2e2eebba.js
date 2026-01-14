import{_ as _export_sfc,p as cs,r as resolveComponent,o as openBlock,c as createElementBlock,a as createBaseVNode,F as Fragment,d as renderList,b as createVNode,t as toDisplayString,J as JsToCode}from"./index-e35bfe49.js";const CrudCore=cs.CrudCore,jsc=new JsToCode,_sfc_main={name:"TestDialogs",extends:cs.CrudComponent,inject:["store"],mounted(){let e=this;setTimeout(function(){jsc.loadVisLib(function(){console.debug("OK",document.getElementById("example")),e.editor=ace.edit("example",{theme:"ace/theme/textmate",mode:"ace/mode/javascript",value:""})})},200)},data(){return{display:!0,dialogs:["messageDialog","errorDialog","warningDialog","confirmDialog","customDialog",["customDialog","buttons"],["customDialog","fcustom"],["customDialog","vlist"],["customDialog","vinsert"],["customDialog","vview"],"infoAlert","warningAlert","errorAlert","successAlert",["successAlert","acustom"]],dialogType:""}},methods:{doCmd:function(e){var t=this;console.log("command",e);var o="";Array.isArray(e)?o=e[1]:o=CrudCore.camelCase(e)+"Func",console.debug("call",o),t[o]()},getHref:function(){return window.location.hash},updateCode(){let that=this,s=that.editor.getValue();jsc.updateCode(s),setTimeout(function(){try{eval(jsc.getCodeString(s))}catch(e){throw that.errorDialog(e),e}},20),console.debug("updateCode")},messageDialogFunc(){let e=this,t=`
CrudCore.messageDialog('Dialog generale per messaggi',null,{
    ok : function() {
        this.hide();
        CrudCore.messageDialog('Dialog generale per messaggioosss',{title:'titolo custom'})
    }
})
            `;console.debug("messageDialogFunc",e.editorDefault,t),e.editor.setValue(t),e.dialogType="messageDialog",e.updateCode()},errorDialogFunc(){let e=this,t=`
CrudCore.errorDialog('Dialog generale di errori',null,{
    ok : function() {
        this.hide();
        CrudCore.errorDialog('Dialog generale di errori',{title:'titolo custom'})
    }
})
`;e.editor.setValue(t),e.dialogType="errorDialog",e.updateCode()},warningDialogFunc(){let e=this,t=`
CrudCore.warningDialog('Dialog generale di warning')
`;e.editor.setValue(t),e.dialogType="warningDialog",e.updateCode()},confirmDialogFunc(){let e=this,t=`
CrudCore.confirmDialog('Dialog generale di conferma',{},{
    ok : function() {
        alert('ok')
    },
    cancel: function() {
        alert('cancel');
    }
});
`;e.editor.setValue(t),e.dialogType="confirmDialog",e.updateCode()},customDialogFunc(){let e=this,t=`
CrudCore.customDialog('Dialog custom con bottoni',{},{
    button1 : function() {
        alert('button1')
    },
    button2: function() {
        alert('button2');
    },
    button3: function() {
        alert('button3');
    }
});
`;e.editor.setValue(t),e.dialogType="customDialog Con bottoni",e.updateCode()},fcustom(){let e=this,t=`
CrudCore.customDialog('Dialog custom senza bottoni');
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},buttons(){let e=this,t=`
CrudCore.customDialog('Dialog con bottoni customizzabili',{
    buttons : [
        {
            label : 'Bottone1',
            icon : 'pi pi-bitcoin',
            callback : function() {
                alert('yeah')
            },
            css : 'bg-bluegray-600 hover:bg-bluegray-400 border-bluegray-700'
        },
        {
            callback() {
                alert('bt2');
                this.hide();
            }
        }
    ]
});
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},vlist(){let e=this,t=`
let cConf = {
    modelName:'user',
    actions:[],
    fields: ['email'],
    type : 'v-list',
}
CrudCore.componentDialog('c-view',cConf);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},vinsert(){let e=this,t=`
let cConf = {
    modelName:'user',
    actions:['action-save'],
    fields: ['email','name'],
    fieldsConfig : {
        email : {
            rules : 'required'
        }
    },
    type : 'v-insert',
}
CrudCore.componentDialog('c-view',cConf);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},vview(){let e=this,t=`
let cConf = {
    modelName:'user',
    actions:['action-save'],
    fields: ['email','name'],
    pk : 1,
    type : 'v-view',
}
CrudCore.componentDialog('c-view',cConf);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},acustom(){let e=this,t=`
CrudCore.alertSuccess('Alert Succes permanente',0);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},infoAlertFunc(){let e=this,t=`
CrudCore.alertInfo('Alert',2000);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},warningAlertFunc(){let e=this,t=`
CrudCore.alertWarning('Alert warning',2000);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},errorAlertFunc(){let e=this,t=`
CrudCore.alertError('Alert error',2000);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()},successAlertFunc(){let e=this,t=`
CrudCore.alertSuccess('Alert Succes',2000);
`;e.editor.setValue(t),e.dialogType="customDialog no bottoni",e.updateCode()}}},_hoisted_1={class:"grid"},_hoisted_2={class:"col-12"},_hoisted_3={class:"card"},_hoisted_4=["onClick"],_hoisted_5={class:"grid"},_hoisted_6={class:"col-12"};function _sfc_render(e,t,o,u,a,l){const i=resolveComponent("Button");return openBlock(),createElementBlock("div",_hoisted_1,[createBaseVNode("div",_hoisted_2,[createBaseVNode("div",_hoisted_3,[t[2]||(t[2]=createBaseVNode("h5",null,"Dialogs",-1)),(openBlock(!0),createElementBlock(Fragment,null,renderList(a.dialogs,(n,r)=>(openBlock(),createElementBlock("a",{key:r,class:"p-button p-button-secondary p-2 m-1 p-button-outlined",type:"button",onClick:c=>l.doCmd(n)},toDisplayString(Array.isArray(n)?n[0]+" con "+n[1]:n),9,_hoisted_4))),128)),t[3]||(t[3]=createBaseVNode("hr",null,null,-1)),createVNode(i,{class:"p-button w-4 mt-1",label:"Run",onClick:l.updateCode},null,8,["onClick"]),t[4]||(t[4]=createBaseVNode("hr",null,null,-1)),createBaseVNode("div",_hoisted_5,[createBaseVNode("div",_hoisted_6,[createBaseVNode("h6",null,"Configurazione Dialog "+toDisplayString(a.dialogType),1),t[0]||(t[0]=createBaseVNode("div",{class:"font-italic"},"Modifica il codice ed esegui",-1)),t[1]||(t[1]=createBaseVNode("div",{id:"example",class:"h-20rem w-full"},null,-1))])])])])])}const TestDialogs=_export_sfc(_sfc_main,[["render",_sfc_render]]);export{TestDialogs as default};
