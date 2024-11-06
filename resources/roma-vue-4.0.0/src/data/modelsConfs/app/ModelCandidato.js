import cs from 'cupparis-primevue';
import _ from "lodash";

export default {
    modelName: 'candidato',
    search: {
        searchType: 'advanced',
        searchLabel: false,

        type: 'v-search',
        modelName: 'candidato',
        fields: [
            'anno',
            'nome',
            'cognome',
            'provincia_id',
            // 'scuola_id',
            // 'tipo',

        ],
        fieldsConfig: {
            'anno': {
                type: "w-input",
                inputType: "number",
            },
            'nome': {
                type: "w-input",
            },
            'cognome': {
                type: "w-input",
            },
            'provincia_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'scuola_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'tipo': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },

        },
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
        modelName: 'candidato',
        actions: [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
            'anno',
            'nome',
            'cognome',
            'media',
            'tipo',
            'scuola',

        ],
        fieldsConfig: {
            'anno': {
                type: "w-text",
            },
            'nome': {
                type: "w-text",
            },
            'cognome': {
                type: "w-text",
            },
            'media': {
                type: "w-text",
            },
            'tipo': {
                type: "w-text",
            },
            'scuola': {
                type: "w-custom",
                ready() {
                    this.value = this.value.denominazione + ' - ' + this.value.comune + ' ('
                        + this.value.provincia_sigla + ')';
                }


            },

        },
        orderFields: {
            'anno': 'anno',
            'nome': 'nome',
            'cognome': 'cognome',
            'media': 'media',
            'tipo': 'tipo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName: 'candidato',
        afterDraw() {
            this.getWidget('iniziativa_id').change();
        },
        actions: ['action-save', 'action-back'],
        fields: [
            'iniziativa_id',

            'corsi',

            'nome',
            'cognome',
            'sesso',
            'luogo_nascita',
            'data_nascita',
            'indirizzo',
            'comune',
            'cap',
            'provincia_id',
            'emails',
            'telefono',

            'scuola_id',
            'classe',


            'gen1_titolo_studio_id',
            'gen2_titolo_studio_id',
            'gen1_professione_id',
            'gen2_professione_id',
            'gen1_professione_altro',
            'gen2_professione_altro',

            'inglese_livello_linguistico_id',
            'francese_livello_linguistico_id',
            'tedesco_livello_linguistico_id',
            'spagnolo_livello_linguistico_id',
            'cinese_livello_linguistico_id',
            'altre_competenze_linguistiche',

            'partecipazione_concorsi',
            'esperienze_estere',
            'settore_professionale',
            'motivazioni',

            'modalita_conoscenza_sns_id',
            'note',
            'informativa',
            'media',
            'tipo',
            'user_id',

            'voti',

        ],
        fieldsConfig: {
            'iniziativa_id': {
                type: 'w-select',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Scegli l\'iniziativa',
                // dividerDescription : 'In caso di stato estero, la provincia è automaticamente EE',
                // rules: 'required',
                hidden: true,
                label: '',
                change() {
                    var that = this;
                    if (this.getValue() === -1) {
                        that.view.hideWidget('corsi');
                        that.view.metadata.corsi.domainValues = {};
                        that.view.metadata.corsi.domainValuesOrder = [];

                        return;
                    }
                    cs.Server.get('/api/iniziativa-corsi/' + that.getValue(), {
                        //id: id,
                    }, function (json) {
                        //let tt = this;
                        if (json.error) {
                            cs.CrudCore.alertError(json.msg);
                            return;
                        }

                        that.view.showWidget('corsi');

                        var dv = json.result.options;
                        var dvo = json.result.options_order
                        console.log("CHANGE CROSI", dv, dvo);
                        that.view.metadata.corsi.domainValues = dv;
                        that.view.metadata.corsi.domainValuesOrder = dvo;

                    })
                    return;
                }
            },
            'corsi': {
                type: 'w-checkbox',
                layout: {
                    colClass: 'w-12',
                },
                label: ''
            },
            'nome': {
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Dati anagrafici e di contatto',
                type: "w-input",
            },
            'cognome': {
                type: "w-input",
            },
            'emails': {
                type: "w-input",
            },
            'sesso': {
                type: "w-select",
            },
            'luogo_nascita': {
                type: "w-input",
            },
            'data_nascita': {
                type: "w-input",
                inputType: "data",
            },
            'indirizzo': {
                type: "w-input",
            },
            'comune': {
                type: "w-input",
            },
            'cap': {
                type: "w-input",
            },
            'provincia_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'telefono': {
                type: "w-input",
            },
            'scuola_id': {
                type: "w-autocomplete",
                foormName: 'candidato',
                viewType: 'edit',
                labelFields: [
                    'id',
                    'denominazione',
                    'denominazione_istituto_riferimento',
                    'codice',
                    'comune',
                    'provincia|sigla',
                ],
                clearButton: true,
                extraBind: {
                    'placeholder': "Digita le iniziali di una scuola...",
                    'dropdown': true,
                    'option-label': function (obj) {
                        if (!obj.denominazione) {
                            return null;
                        }
                        return obj.denominazione + ' - Cod: ' + obj.codice + ' - ' + obj.comune + ' (' + obj["provincia|sigla"] + ') ';
                    },
                    'option-value': 'id',
                },
                label: 'Scuola',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Scuola di provenienza',
            },
            'classe': {
                type: "w-input",
            },
            'gen1_titolo_studio_id': {
                type: "w-select",
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Dati aggiuntivi della famiglia',
                //type : "w-input",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen2_titolo_studio_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen1_professione_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen2_professione_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen1_professione_altro': {
                type: "w-input",
            },
            'gen2_professione_altro': {
                type: "w-input",
            },
            'note': {
                type: "w-textarea",
            },
            'partecipazione_concorsi': {
                type: "w-textarea",
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Esperienze e motivazioni',
            },
            'inglese_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Competenze linguistiche',
            },
            'francese_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'tedesco_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'spagnolo_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'cinese_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'altre_competenze_linguistiche': {
                type: "w-input",
            },
            'esperienze_estere': {
                type: "w-textarea",
            },
            'settore_professionale': {
                type: "w-textarea",
            },
            'motivazioni': {
                type: "w-textarea",
            },
            'modalita_conoscenza_sns_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Altre info',

            },
            'informativa': {
                type: "w-hidden",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'media': {
                type: "w-hidden",
            },
            'tipo': {
                type: "w-hidden",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'user_id': {
                type: "w-hidden",
                //domainValues : [],
                //domainValuesOrder : [],
            },

            'voti': {
                type: 'w-hasmany',
                layout: {
                    'colClass': 'col-12',
                },
                label: '',
                divider: 'before',
                dividerClass: 'text-blue-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Voti',


                // template: {
                //     name: "tpl-record",
                //     layoutType: "full",
                //     labelType: "none"
                // },
                hasmanyType: 'list',
                hasmanyConf: {
                    actions: ['action-insert', 'action-delete', 'action-delete-selected'],
                    modelName: 'candidato_voti',
                    fields: [
                        'id',
                        // 'nome_it',
                        'materia_id',
                        'voto_anno_1',
                        'voto_anno_2',
                        'voto_primo_quadrimestre',
                    ],
                    fieldsConfig: {
                        id: 'w-hidden',
                        materia_id: 'w-select',
                        voto_anno_1: {
                            type: 'w-input',
                            inputType: 'number',
                        },
                        voto_anno_2: {
                            type: 'w-input',
                            inputType: 'number',
                        },
                        voto_primo_quadrimestre: {
                            type: 'w-input',
                            inputType: 'number',
                        },
                    }
                }
            },

        }

    },
}
