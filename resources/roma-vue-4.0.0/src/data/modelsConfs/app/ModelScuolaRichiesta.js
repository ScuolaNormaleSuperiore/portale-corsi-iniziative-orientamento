import Server from "cupparis-primevue/src/lib/Server";
import cs from "cupparis-primevue";
export default {
    modelName: 'scuola_richiesta',
    search: {
        type: 'v-search',
        modelName: 'scuola_richiesta',
        fields: [
            'email',
            'scuola_id',

        ],
        fieldsConfig: {
            'email': {
                type: "w-input",
            },
            'scuola_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },

        },
        searchType: 'basic',
        searchLabel: false,
        // groups: {
        //     'g0': {
        //         fields: [
        //
        //         ],
        //     },
        //     'g1': {
        //         fields: [
        //
        //         ],
        //     }
        // },

    },
    list: {
        type: 'v-list',
        modelName: 'scuola_richiesta',
        actions: [
            // 'action-insert',
            // 'action-edit',
            'action-delete',
            'action-approva',
            // 'action-delete-selected',
        ],
        actionsConfig: {
            'action-approva': {
                visible: function () {
                    return true;
                    return parseInt(this.modelData.approvata) === 0;
                },
                //enabled : false,
                text: 'Approva email',
                icon: 'fa fa-thumbs-up',
                type: 'record',
                execute() {
                    var that = this;
                    // that.modelData.approvata = 0;
                    // return;

                    var msg = "Approvando il cambio email, verrà aggiornata la email di riferimento della scuola.\n" +
                        "Il destinatario riceverà un messaggio di verifica per poter procedere con il login della scuola."
                    cs.CrudCore.confirmDialog(msg,
                        {title: 'Chiudi le presenze'}, {
                            ok: function () {
                                var params = {
                                    'id': that.modelData.id,
                                    'field': 'approvata',
                                    'value': 1,
                                };
                                cs.CrudCore.waitStart();
                                Server.post('/api/foormaction/set/scuola_richiesta/list', params,
                                    function (json) {
                                        cs.CrudCore.waitEnd();
                                        if (json.error) {
                                            cs.CrudCore.alertError(json.msg);
                                            return
                                        }
                                        that.view.reload();
                                        //
                                        // that.modelData.approvata = 1;
                                    });
                            }
                        })
                }
            },
        },
        fields: [
            'scuola',
            'email',
            // 'nome',
            // 'cognome',
            // 'telefono',
            'note',
            // 'approvata',

        ],
        fieldsConfig: {
            'email': {
                type: "w-text",
                label: 'Nuova e-mail'
            },
            'nome': {
                type: "w-text",
            },
            'cognome': {
                type: "w-text",
            },
            'telefono': {
                type: "w-text",
            },
            'approvata': {
                type: "w-swap",
                // modelName : '{{$modelName}}',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
            },
            'scuola': {
                type: "w-custom",
                ready() {
                    this.value = this.modelData.scuola.denominazione + ' (' + this.modelData.scuola.provincia_sigla +')';
                    this.value += '<br/>Cod: ' + this.modelData.scuola.codice;
                    this.value += '<br/>';
                    this.value += "Email attuale: <strong>" + this.modelData.scuola.email_riferimento + '</strong>';
                },
            },

        },
        orderFields: {
            'email': 'email',
            'nome': 'nome',
            'cognome': 'cognome',
            'telefono': 'telefono',
            'approvata': 'approvata',

        }

    },
    edit: {
        type: 'v-edit',
        modelName: 'scuola_richiesta',
        actions: ['action-save', 'action-back'],
        fields: [],
        fieldsConfig: {}

    },
}
