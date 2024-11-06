var ModelCupContFormaPagamento = {
    modelName: 'cup_cont_forma_pagamento',
    search: {
        modelName: 'cup_cont_forma_pagamento',
        //langContext : 'user',
        fields: ['nome','codice'],
    },
    // view : {
    //     modelName : 'cup_cont_forma_pagamento',
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
        modelName: 'cup_cont_forma_pagamento',
        cType: 'list',
        fields: [
            'codice',
            'nome',
            'immediato',
            'modalita_fatt_el',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            'action-export-csv'
        ],
        orderFields: {
            'codice': 'codice',
            'nome': 'nome'
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
        modelName: 'cup_cont_forma_pagamento',
        actions: ['action-save', 'action-back'],
        fields: [
            'codice',
            'nome',
            'immediato',
            'modalita_fatt_el',
            //'comuni'
        ],
        fieldsConfig: {
            'immediato' : {
                type : 'w-select'
            },
            'modalita_fatt_el' : {
                type : 'w-select'
            },
        },
    },

}
