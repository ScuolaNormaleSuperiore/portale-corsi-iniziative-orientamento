var ModelCupAnagTipologiaAffiliazione = {
    modelName: 'cup_anag_tipologia_affiliazione',
    search: {
        modelName: 'cup_anag_tipologia_affiliazione',
        //langContext : 'user',
        fields: ['nome_it'],
    },
    // view : {
    //     modelName : 'cup_anag_tipologia_affiliazione',
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
        modelName: 'cup_anag_tipologia_affiliazione',
        cType: 'list',
        fields: ['codice', 'nome_it'],
        actions: ['action-edit', 'action-delete', 'action-insert',
            'action-export-csv'
        ],
        orderFields: {
            'codice': 'codice',
            'nome_it': 'nome_it'
        },
        fieldsConfig: {

        },
        customActions: {
            'action-export-csv': {
                text: 'Csv',
            }
        }
    },
    edit: {
        modelName: 'cup_anag_tipologia_affiliazione',
        actions: ['action-save', 'action-back'],
        fields: ['codice', 'nome_it',
            //'comuni'
        ],
    },

}
