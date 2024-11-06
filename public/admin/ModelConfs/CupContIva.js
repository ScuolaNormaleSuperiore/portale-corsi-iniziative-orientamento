var ModelCupContIva = {
    modelName: 'cup_cont_iva',
    search: {
        modelName: 'cup_cont_iva',
        //langContext : 'user',
        fields: [
            'nome',
            'codice'
        ],
    },
    // view : {
    //     modelName : 'cup_cont_iva',
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
        modelName: 'cup_cont_iva',
        cType: 'list',
        fields: [
            'codice',
            'nome',
            'esenzione',
            'aliquota',
            'descrizione_esenzione',
            'natura_fatt_el',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            'action-export-csv'
        ],
        orderFields: {
            'codice': 'codice',
            'nome': 'nome',
            'aliquota': 'aliquota',
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
        modelName: 'cup_cont_iva',
        actions: ['action-save', 'action-back'],
        fields: [
            'codice',
            'nome',
            'esenzione',
            'aliquota',
            'descrizione_esenzione',
            'natura_fatt_el',
            //'comuni'
        ],
        fieldsConfig: {
            'esenzione' : {
                type : 'w-select'
            },
            'natura_fatt_el' : {
                type : 'w-select'
            },
        },
    },

}

