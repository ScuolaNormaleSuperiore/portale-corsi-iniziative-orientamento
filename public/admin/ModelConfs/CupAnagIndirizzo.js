var ModelCupAnagIndirizzo = {
    modelName: 'cup_anag_indirizzo',
    listEdit : {
        modelName: 'cup_anag_indirizzo',

    },
    search: {
        modelName: 'cup_anag_indirizzo',

    },
    // view : {
    //     modelName : 'cup_anag_indirizzo',
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
        modelName: 'cup_anag_indirizzo',
        fields: [
            'id',

            'tipo',

            'value',
            'label',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            // 'action-export-csv'
        ],
        orderFields: {
            'tipo': 'tipo',
            'label': 'label'
        }
        ,
        fieldsConfig: {

        },
        customActions: {
            // 'action-export-csv': {
            //     text: 'Csv',
            // }
        }
    },
    edit: {
        modelName: 'cup_anag_indirizzo',
        actions: ['action-save', 'action-back'],
        fields: [
            'id',
            // 'anagrafica_id',
            'tipologia_id',
            'indirizzo',
            'cap',
            'comune_id',

            'localita',
            'numero_civico',

            'persona_contatto',
            'note',

//'comuni'
        ],
        fieldsConfig : {

            'tipologia_id': {
                type: 'w-select',
            },

            'comune_id': {
                type: "w-b2-select2",
                defaultValue: {
                    id: -1,
                    text: 'Seleziona...'
                },
                theme: 'bootstrap4',
                allowClear: true,
                foormName: 'cup_anag_indirizzo',
                fieldName : 'comune_id',
                viewType: 'edit',
                labelFields: [
                    'nome_it',
                    'sigla_provincia',
                    'nazione_iso3'
                ],
                // referredDataField : 'comune',
                methods: {
                    getLabel: function (value) {
                        var that = this;
                        console.log('getLabel value',value);
                        if (!value || Object.keys(value).length == 0) {
                            return 'Seleziona...';
                        }
                        return value['nome_it']
                            + " (" + value['sigla_provincia'] + ")"
                            + " - " + value['nazione_iso3'];
                    },


                },
            },

        }
    }
    ,

}
