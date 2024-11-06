var ModelCupAnagStatoCivile = {
    modelName: 'cup_anag_stato_civile',
    search: {
        modelName: 'cup_anag_stato_civile',
        //langContext : 'user',
        fields: ['nome_it'],
    },
    // view : {
    //     modelName : 'cup_anag_stato_civile',
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
        modelName: 'cup_anag_stato_civile',
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
        modelName: 'cup_anag_stato_civile',
        actions: ['action-save', 'action-back'],
        fields: ['codice', 'nome_it',
            //'comuni'
        ],
    },

}
