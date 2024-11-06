var ModelCupAnagAffiliazione = {
    modelName: 'cup_anag_affiliazione',
    listEdit: {
        modelName: 'cup_anag_affiliazione',
    },
    search: {
        modelName: 'cup_anag_affiliazione',
        //langContext : 'user',
        fields: [
            'id',
        ],
    },
    // view : {
    //     modelName : 'cup_anag_affiliazione',
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
        modelName: 'cup_anag_affiliazione',
        fields: [
            'id',

            'organizzazione',

            'affiliata',
            'tipologia',
            'sede',


            'inizio',
            'note',


            // 'nome_it',
            // 'sigla_provincia',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            // 'action-export-csv'
        ],
        orderFields: {
            'id': 'id',
        }
        ,
        fieldsConfig: {

            'organizzazione': {
                type: 'w-belongsto',
                labelFields: [
                    'denominazione',
                ],
            },
            'affiliata': {
                type: 'w-belongsto',
                labelFields: [
                    'denominazione',
                ],
            },
            'sede': {
                type: 'w-belongsto',
                labelFields: [
                    'codice',
                    'nome_it',
                ],
            },
            'tipologia': {
                type: 'w-belongsto',
                labelFields: [
                    'nome_it',
                ],
            },

        }
        ,
        customActions: {
            // 'action-export-csv': {
            //     text: 'Csv',
            // }
        }
    },
    edit: {
        // cRef: 'vEditAffiliazione',
        modelName: 'cup_anag_affiliazione',
        actions: ['action-save', 'action-back'],
        fields: [
            'id',
            'organizzazione_id',
            'sede_id',
            'affiliata_id',
            'tipologia_id',
            'inizio',
            'note',
            // 'app_info',

        ],
        fieldsConfig: {

            'affiliata_id': {
                type: "w-b2-select2",
                defaultValue: {
                    id: -1,
                    text: 'Seleziona...'
                },
                theme: 'bootstrap4',
                allowClear: true,
                foormName: 'cup_anag_affiliazione',
                viewType: 'edit',
                labelFields: [
                    'id',
                    'denominazione',
                    'codice_fiscale',
                    'partita_iva',
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

            'note' : {
                type : "w-textarea"
            }


        }
    }
    ,

}
