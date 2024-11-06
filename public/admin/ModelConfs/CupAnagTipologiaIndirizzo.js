var ModelCupAnagTipologiaIndirizzo = {
    modelName: 'cup_anag_tipologia_indirizzo',
    search: {
        modelName: 'cup_anag_tipologia_indirizzo',
        // modelName: 'cup_anag_tipologia_indirizzo',
        // //langContext : 'user',
        // fields: ['nome_it'],
    },
    // view : {
    //     modelName : 'cup_anag_tipologia_indirizzo',
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
        modelName: 'cup_anag_tipologia_indirizzo',
        cType: 'list',
        fields: ['nome_it'],
        actions: ['action-edit', 'action-delete', 'action-insert',
            'action-export-csv'
        ],
        orderFields: {
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
        modelName: 'cup_anag_tipologia_indirizzo',
        actions: ['action-save', 'action-back'],
        fields: [
            'nome_it',
            //'comuni'
        ],
    },

}
