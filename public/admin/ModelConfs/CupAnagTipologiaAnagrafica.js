var ModelCupAnagTipologiaAnagrafica = {
    modelName: 'cup_anag_tipologia_anagrafica',
    search: {
        modelName: 'cup_anag_tipologia_anagrafica',
        //langContext : 'user',
        fields: ['nome_it'],
    },
    // view : {
    //     modelName : 'cup_anag_tipologia_anagrafica',
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
        cType: 'list',
        modelName: 'cup_anag_tipologia_anagrafica',
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
        modelName: 'cup_anag_tipologia_anagrafica',
        actions: ['action-save', 'action-back'],
        fields: ['codice', 'nome_it',
            //'comuni'
        ],
    },

}
