var ModelCupAnagContatto = {
    modelName: 'cup_anag_contatto',
    listEdit : {
        modelName: 'cup_anag_contatto',

    },
    search: {
        modelName: 'cup_anag_contatto',

    },
    // view : {
    //     modelName : 'cup_anag_contatto',
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
        modelName: 'cup_anag_contatto',
        fields: [
            'id',

            'tipo',

            'value',
            'label',
        ],
        actions: ['action-edit', 'action-delete', 'action-insert',
            // 'action-export-csv'
        ],
        orderFields: {
            'tipo': 'tipo',
            'label': 'label'
        }
        ,
        fieldsConfig: {

        },
        customActions: {
            // 'action-export-csv': {
            //     text: 'Csv',
            // }
        }
    },
    edit: {
        modelName: 'cup_anag_contatto',
        actions: ['action-save', 'action-back'],
        fields: [
            'id',
            // 'anagrafica_id',
            'tipo',

            'value',
            'label',

//'comuni'
        ],
        fieldsConfig : {

            'tipo': {
                type: 'w-select',
            },

        }
    }
    ,

}
