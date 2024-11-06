var ModelCupAnagAnagrafica = {
    modelName: 'cup_anag_anagrafica',
    listEdit: {
        modelName: 'cup_anag_anagrafica',
    },
    search: {
        modelName: 'cup_anag_anagrafica',
        //langContext : 'user',
        fields: [
            'id',
            'denominazione'
        ],
    },
    // view : {
    //     modelName : 'cup_anag_anagrafica',
    //     //fields : ['name','email','password','password_confirmation','banned','mainrole','fotos','attachments'],
    //     actions : [],
    //     fieldsConfig : {
    //         mainrole : {
    //             type : 'w-belongsto',
    //             fields : ['name']
    //         }
    //     }
    // },
    list: {
        modelName: 'cup_anag_anagrafica',
        fields: [
            'id',

            'denominazione',

            'fisicagiuridica',
            'codicefiscale',
            'partitaiva',


            'indirizzo',
            'numero_civico',
            'cap',


            'email',
            'tel',

            'attivo',

            'comuneresidenza'

            // 'nome_it',
            // 'sigla_provincia',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            // 'action-export-csv'
        ],
        orderFields: {
            'id': 'id',
            'denominazione': 'denominazione'
        }
        ,
        fieldsConfig: {

            'comuneresidenza': {
                type: 'w-belongsto',
                labelFields: [
                    'nome_it',
                    'sigla_provincia'
                ],
            },
            'attivo': {
                type: 'w-swap',
                modelName: 'cup_anag_anagrafica'
            }
        }
        ,
        customActions: {
            // 'action-export-csv': {
            //     text: 'Csv',
            // }
        }
    },
    edit: {
        cRef: 'vEditAnag',
        modelName: 'cup_anag_anagrafica',
        actions: ['action-save', 'action-back'],
        fields: [
            'id',
            'fisicagiuridica',

            'denominazione',
            'cognome',
            'nome',

            'alias',

            'codicefiscale',
            'partitaiva',

            'datanascita',

            'comunenascita_id',

            'nazionalita_id',

//PERSONA GIURIDICA
            'naturagiuridica_id',
            'rapplegale_id',
            'id',
            'cognome',
            'nome',
            'codice_fiscale',

//PERSONA FISICA
            'sesso',
            'professione_id',
            'stato_civile_id',

            'indirizzo',
            'cap',
            'comuneresidenza_id',

            'localita',
            'numero_civico',


            'cell',
            'tel',
            'fax',
            'email',
            'pec',
            'url',

            'iban',

            'note',
//ALTRE INFO UTILI A UNA CERTA APP (JSON)
//             'app_info',

            // 'organizzazione',

            'attivo',
//'comuni'
            'contatti',
            'indirizzi',
            'raggruppamenti',
        ],
        fieldsConfig: {

            'fisicagiuridica': {
                type: 'w-radio',
                // template: "tpl-record2",
                domainValues: {
                    'F': "<i class='fa fa-user'></i> F",
                    'G': '<i class="fa fa-briefcase"></i> G'
                },
                methods: {
                    change: function () {
                        var that = this;
                        that.$crud.cRefs.vEditAnag.fisicaGiuridicaValue = that.getValue();
                    }
                }
                //inputType: 'date',
            },
            'nazionalita_id': {
                type: 'w-select',
                css: 'fisica',
            },
            'naturagiuridica_id': {
                type: 'w-select',
                css: 'giuridica',
            },
            'professione_id': {
                type: 'w-select',
                css: 'fisica',
            },
            'stato_civile_id': {
                type: 'w-select',
                css: 'fisica',
            },
            'sesso': {
                type: 'w-select',
                css: 'fisica',
            },
            // 'organizzazione' : {
            //     type: 'w-select',
            // },
            'attivo': {
                type: 'w-radio',
            },
            'note': {
                type: 'w-textarea',
            },
            'datanascita': {
                type: 'w-input',
                inputType : 'date',
            },

            'comunenascita_id': {
                type: "w-b2-select2",
                defaultValue: {
                    id: -1,
                    text: 'Seleziona...'
                },
                theme: 'bootstrap4',
                allowClear: true,
                foormName: 'cup_anag_anagrafica',
                viewType: 'edit',
                labelFields: [
                    'nome_it',
                    'sigla_provincia',
                    'nazione_iso3'
                ],
                //url : null,
                methods: {
                    getLabel: function (value) {
                        var that = this;
                        //console.log('getLabel value',value);
                        if (!value || Object.keys(value).length == 0) {
                            return 'Seleziona...';
                        }
                        return value['nome_it']
                            + " (" + value['sigla_provincia'] + ")"
                            + " - " + value['nazione_iso3'];
                        // codice originale
                        // var label = "";
                        // for (var i in that.fields) {
                        //     label += value[that.fields[i]] + " ";
                        // }
                        // return label;
                    },


                },
            },
            'comuneresidenza_id': {
                type: "w-b2-select2",
                defaultValue: {
                    id: -1,
                    text: 'Seleziona...'
                },
                theme: 'bootstrap4',
                allowClear: true,
                foormName: 'cup_anag_anagrafica',
                viewType: 'edit',
                labelFields: [
                    'nome_it',
                    'sigla_provincia',
                    'nazione_iso3'
                ],
                methods: {
                    getLabel: function (value) {
                        var that = this;
                        //console.log('getLabel value',value);
                        if (!value || Object.keys(value).length == 0) {
                            return 'Seleziona...';
                        }
                        return value['nome_it']
                            + " (" + value['sigla_provincia'] + ")"
                            + " - " + value['nazione_iso3'];
                    },


                },
            },
            'rapplegale_id': {
                type: "w-b2-select2",
                defaultValue: {
                    id: -1,
                    text: 'Seleziona...'
                },
                theme: 'bootstrap4',
                allowClear: true,
                foormName: 'cup_anag_anagrafica',
                viewType: 'edit',
                labelFields: [
                    'id',
                    'cognome',
                    'nome',
                    'codice_fiscale',
                ],
                // methods: {
                //     getLabel: function (value) {
                //         var that = this;
                //         //console.log('getLabel value',value);
                //         if (!value || Object.keys(value).length == 0) {
                //             return 'Seleziona...';
                //         }
                //         return value['nome_it']
                //             + " (" + value['sigla_provincia'] + ")"
                //             + " - " + value['nazione_iso3'];
                //     },
                //
                //
                // },
            },

            'raggruppamenti' : {
                type : "w-checkbox",
            },

            'contatti' : {
                type : 'w-hasmany-listed',
                hasManyListConf: {
                    hasManyName : 'contatti',
                    langContext: 'cup_anag_anagrafica.fields.contatti',
                    fields: [
                        'id',
                        'tipo',
                        'value',
                        'label',
                        'status'
                    ],
                    fieldsConfig: {
                        'id': {
                            type : 'w-hidden',
                        },
                        'status': {
                            type : 'w-hidden'
                        },

                        'value': {
                            type: 'w-input',
                            labelGroup : false,
                            template: "tpl-list"
                        },
                        'label': {
                            type: 'w-input',
                            template: "tpl-list"
                        },
                        'tipo': {
                            type: 'w-select',
                            template: "tpl-list"
                        },
                    },
                    fieldsDefaults : {
                        'status': 'new',
                        'id' : null,
                        'value': null,
                        'label': null,
                        'tipo': 'email',
                    },
                    hasFooter: false,
                },
                template: "tpl-full-no",
            },

            'indirizzi' : {
                type : 'w-hasmany-listed-squared-constraint',
                hasManyListConf: {
                    modelName : 'cup_anag_indirizzo',
                    constraintKey : 'anagrafica_id',
                    hasManyName : 'indirizzi',
                    langContext: 'cup_anag_anagrafica.fields.indirizzi',
                    fields: [
                        'header',
                        // 'tipologia',
                        'dati',
                    ],
                    fieldsConfig: {
                        'header': {
                            type: 'w-custom',
                            mounted : function() {
                                var that = this;
                                that.value = that.modelData.tipologia.nome_it;
                            },
                            template: "tpl-list"
                        },
                        'dati': {
                            type: 'w-custom',
                            mounted : function () {
                                var that = this;
                                var html = '';

                                html += '<span>' +
                                    that.modelData.indirizzo + ' ' + that.modelData.numero_civico +
                                    '<br/>' +
                                    that.modelData.localita +
                                    '<br/>' +
                                    that.modelData.cap + ' ' + that.modelData.comune.nome_it
                                '</span>';

                                that.value = html;
                            },
                            template: "tpl-list"
                        },
                    },
                    // fields: [
                    //     'tipologia_id',
                    //     'indirizzo',
                    //     'cap',
                    //     'comune_id',
                    //
                    //     'localita',
                    //     'numero_civico',
                    //
                    //     'persona_contatto',
                    //     'note',
                    // ],
                    // fieldsConfig: {
                    //     'status': 'w-hidden',
                    //
                    //     'indirizzo': {
                    //         type: 'w-input',
                    //         labelGroup : false,
                    //         template: "tpl-list"
                    //     },
                    //     'tipologia_id': {
                    //         type: 'w-select',
                    //         template: "tpl-list"
                    //     },
                    //     'cap': {
                    //         type: 'w-input',
                    //         template: "tpl-list"
                    //     },
                    //     'comune_id': {
                    //         type: "w-b2-select2",
                    //         defaultValue: {
                    //             id: -1,
                    //             text: 'Seleziona...'
                    //         },
                    //         theme: 'bootstrap4',
                    //         allowClear: true,
                    //         foormName: 'cup_anag_anagrafica',
                    //         fieldName : 'indirizzi|comune_id',
                    //         viewType: 'edit',
                    //         labelFields: [
                    //             'nome_it',
                    //             'sigla_provincia',
                    //             'nazione_iso3'
                    //         ],
                    //         referredDataField : 'comune',
                    //         methods: {
                    //             getLabel: function (value) {
                    //                 var that = this;
                    //                 console.log('getLabel value',value);
                    //                 if (!value || Object.keys(value).length == 0) {
                    //                     return 'Seleziona...';
                    //                 }
                    //                 return value['nome_it']
                    //                     + " (" + value['sigla_provincia'] + ")"
                    //                     + " - " + value['nazione_iso3'];
                    //             },
                    //
                    //
                    //         },
                    //     },
                    //     'localita': {
                    //         type: 'w-input',
                    //         template: "tpl-list"
                    //     },
                    //     'numero_civico': {
                    //         type: 'w-input',
                    //         template: "tpl-list"
                    //     },
                    //     'persona_contatto': {
                    //         type: 'w-input',
                    //         template: "tpl-list"
                    //     },
                    //     'note': {
                    //         type: 'w-textarea',
                    //         template: "tpl-list"
                    //     },
                    // },
                    fieldsDefaults : {
                        'status': 'new',
                        'id' : null,
                        'indirizzo' : null,
                        'cap' : null,
                        'comuneresidenza_id' : null,

                        'localita' : null,
                        'numero_civico' : null,

                        'persona_contatto' : null,
                        'note' : null,
                    },
                    mounted : function () {
                        var that = this;
                    },
                    hasFooter: false,
                },
                template: "tpl-full-no",
            },
            'indirizziLIST' : {
                type : 'w-hasmany',
                hasmanyConf: {
                    hasManyName : 'indirizzi',
                    langContext: 'cup_anag_anagrafica.fields.indirizzi',
                    fields: [
                        'tipologia_id',
                        'indirizzo',
                        'cap',
                        'comune_id',

                        'localita',
                        'numero_civico',

                        'persona_contatto',
                        'note',
                    ],
                    fieldsConfig: {
                        'status': 'w-hidden',

                        'indirizzo': {
                            type: 'w-input',
                            labelGroup : false,
                        },
                        'tipologia_id': {
                            type: 'w-select',
                        },
                        'cap': {
                            type: 'w-input',
                        },
                        'comune_id': {
                            type: "w-b2-select2",
                            defaultValue: {
                                id: -1,
                                text: 'Seleziona...'
                            },
                            theme: 'bootstrap4',
                            allowClear: true,
                            foormName: 'cup_anag_anagrafica',
                            fieldName : 'indirizzi|comune_id',
                            viewType: 'edit',
                            labelFields: [
                                'nome_it',
                                'sigla_provincia',
                                'nazione_iso3'
                            ],
                            referredDataField : 'comune',
                            methods: {
                                getLabel: function (value) {
                                    var that = this;
                                    //console.log('getLabel value',value);
                                    if (!value || Object.keys(value).length == 0) {
                                        return 'Seleziona...';
                                    }
                                    return value['nome_it']
                                        + " (" + value['sigla_provincia'] + ")"
                                        + " - " + value['nazione_iso3'];
                                },


                            },
                        },
                        'localita': {
                            type: 'w-input',
                        },
                        'numero_civico': {
                            type: 'w-input',
                        },
                        'persona_contatto': {
                            type: 'w-input',
                        },
                        'note': {
                            type: 'w-textarea',
                        },
                    },
                },
                template: "tpl-full-no",
            }
        }
    }
    ,

}
