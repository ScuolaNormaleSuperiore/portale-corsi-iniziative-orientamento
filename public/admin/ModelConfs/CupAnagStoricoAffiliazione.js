var ModelCupAnagStoricoAffiliazione = {
    modelName: 'cup_anag_storico_affiliazione',
    listEdit: {
        modelName: 'cup_anag_storico_affiliazione',
    },
    search: {
        modelName: 'cup_anag_storico_affiliazione',
        //langContext : 'user',
        fields: [
            'id',
        ],
    },
    // view : {
    //     modelName : 'cup_anag_storico_affiliazione',
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
        modelName: 'cup_anag_storico_affiliazione',
        fields: [
            'id',

            'organizzazione',

            'affiliata',
            'tipologia',
            'sede',


            'inizio',
            'fine',
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

}
