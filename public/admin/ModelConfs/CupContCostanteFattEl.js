var ModelCupContCostanteFattEl = {
    modelName: 'cup_cont_costante_fatt_el',
    search: {
        modelName: 'cup_cont_costante_fatt_el',
        //langContext : 'user',
        fields: [
            'tipo',
            'codice',
            'descrizione',
        ],
        fieldsConfig: {
            tipo: {
                type: 'w-select'
            }
        },
    },
    // view : {
    //     modelName : 'cup_cont_costante_fatt_el',
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
        modelName: 'cup_cont_costante_fatt_el',
        cType: 'list',
        fields: [
            'codice',
            'descrizione',
            'tipo',
            'versione',
            'note',
            'attivo',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            'action-export-csv'
        ],
        orderFields: {
            'codice': 'codice',
            'descrizione': 'descrizione',
            'tipo': 'tipo',
        },
        fieldsConfig: {},
        customActions: {
            'action-export-csv': {
                text: 'Csv',
            }
        }
    },
    edit: {
        modelName: 'cup_cont_costante_fatt_el',
        actions: ['action-save', 'action-back'],
        fields: [
            'codice',
            'descrizione',
            'tipo',
            'note',
            'versione',
            'attivo',
            //'comuni'
        ],
        fieldsConfig: {
            'attivo': {
                type: 'w-select'
            },
            'tipo': {
                type: 'w-select'
            },
            'versione': {
                type: 'w-select'
            },
        },
    },

}

