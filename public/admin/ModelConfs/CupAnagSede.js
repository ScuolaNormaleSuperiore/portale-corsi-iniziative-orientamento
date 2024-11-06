var ModelCupAnagSede = {
    modelName: 'cup_anag_sede',
    listEdit : {
        modelName: 'cup_anag_sede',

    },
    search: {
        modelName: 'cup_anag_sede',

    },
    // view : {
    //     modelName : 'cup_anag_sede',
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
        modelName: 'cup_anag_sede',
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
        modelName: 'cup_anag_sede',
        actions: ['action-save', 'action-back'],
        fields: [
            'id',
            'organizzazione_id',
            'codice',
            'nome_it',
            'principale',
            'indirizzo_anagrafica',
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

            'organizzazione_id': {
                type: 'w-select',
            },
            'indirizzo_anagrafica': {
                type: 'w-select',
            },
            'principale': {
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
                foormName: 'cup_anag_sede',
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
