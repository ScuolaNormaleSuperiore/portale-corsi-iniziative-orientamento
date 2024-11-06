var ModelCupContTipologiaDocumento = {
    modelName: 'cup_cont_tipologia_documento',
    search: {
        modelName: 'cup_cont_tipologia_documento',
        //langContext : 'user',
        fields: ['nome','codice'],
    },
    // view : {
    //     modelName : 'cup_cont_tipologia_documento',
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
        modelName: 'cup_cont_tipologia_documento',
        cType: 'list',
        fields: [
            'codice',
            'nome',
            'macrotipo',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            'action-export-csv'
        ],
        orderFields: {
            'codice': 'codice',
            'nome': 'nome',
            'macrotipo': 'macrotipo',
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
        modelName: 'cup_cont_tipologia_documento',
        actions: ['action-save', 'action-back'],
        fields: [
            'codice',
            'nome',
            'macrotipo',
            'tipo_fatt_el',
            //'comuni'
        ],
        fieldsConfig: {
            'macrotipo' : {
                type : 'w-select'
            },
            'tipo_fatt_el' : {
                type : 'w-select'
            },
        },
    },

}

