var ModelCupAnagNaturaGiuridica = {
    modelName: 'cup_anag_natura_giuridica',
    search: {
        modelName: 'cup_anag_natura_giuridica',
        //langContext : 'user',
        fields: ['nome_it'],
    },
    // view : {
    //     modelName : 'cup_anag_natura_giuridica',
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
        modelName: 'cup_anag_natura_giuridica',
        cType: 'list',
        fields: ['codice', 'nome_it', 'soggetti_residenti'],
        actions: ['action-edit', 'action-delete', 'action-insert',
            'action-export-csv'
        ],
        orderFields: {
            'codice': 'codice',
            'nome_it': 'nome_it'
        },
        fieldsConfig: {
            'soggetti_residenti': {
                type: 'w-swap',
                modelName: 'cup_anag_natura_giuridica'
            }
        },
        customActions: {
            'action-export-csv': {
                text: 'Csv',
            }
        }
    },
    edit: {
        modelName: 'cup_anag_natura_giuridica',
        actions: ['action-save', 'action-back'],
        fields: ['codice', 'nome_it',
            //'comuni'
        ],
    },

}
