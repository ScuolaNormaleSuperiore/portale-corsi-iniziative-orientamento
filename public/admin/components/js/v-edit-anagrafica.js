crud.components.vEditAnagrafica = Vue.component('v-edit-anagrafica', {
    extends: crud.components.views.vEdit,
    template: "#v-edit-anagrafica-template",
    data: function () {
        var that = this;
        var d = {
            fisicaGiuridicaValue: 'F',
            contattiList: {
                cRef: 'contattilist',
                routeName: null,
                value: [],

            }
        };
        return d;
    },
    methods: {
        getFisicaGiuridicaFields: function (type) {
            var that = this;
            switch (type) {
                case 'F':
                    return [
                        'cognome',
                        'nome',
                        'sesso',
                        'professione_id',
                        'stato_civile_id',
                    ]
                case 'G':
                    return [
                        'denominazione',
                        'alias',
                        'naturagiuridica_id',
                        'rapplegale_id',
                    ];
                default :
                    return [];
            }
        },
        getFisicaGiuridicaWidgets: function (type) {
            var that = this;
            switch (type) {
                case 'F':
                case 'G':
                    var widgets = {};
                    var fields = that.getFisicaGiuridicaFields(type);
                    for (var i in that.widgets) {
                        if (fields.indexOf(i) >= 0) {
                            widgets[i] = that.widgets[i];
                        }
                    }
                    console.log('WIDGETS:::', widgets);
                    return widgets;
                default :
                    return {};
            }
        },
        completed: function () {
            var that = this;
            //console.log('telefonata insert',this._uid);
            that.fisicaGiuridicaValue = that.value.fisicagiuridica;

            // that.$crud.cRefs.contattilist.value = that.value.contatti;
            // that.$crud.cRefs.contattilist.reload();

        }
        // getFisicaGiuridicaValue : function () {
        //     var that = this;
        //
        //     if (!that.getWidget) {
        //         return 'F';
        //     }
        //     var widget = that.getWidget('fisicagiuridica');
        //
        //     console.log('PROVA1',that.getWidget('fisicagiuridica'));
        //     if (!widget)
        //         return 'F';
        //
        //     console.log('PROVA',widget);
        //     return widget.getValue();
        // }

    }
})

crud.components.vInsertAnagrafica = Vue.component('v-insert-anagrafica', {
    extends: crud.components.vEditAnagrafica,
    template: "#v-insert-anagrafica-template",

    methods: {

        completed: function () {
            var that = this;
            //console.log('telefonata insert',this._uid);
            that.fisicaGiuridicaValue = that.value.fisicagiuridica;

            // that.$crud.cRefs.contattilist.value = that.value.contatti;
            // that.$crud.cRefs.contattilist.reload();

        }

    }
})

var ManageCupAnagAnagrafica = {
    modelName: 'cup_anag_anagrafica',
    editComponentName: 'v-edit-anagrafica',
    insertComponentName: 'v-insert-anagrafica',
}
