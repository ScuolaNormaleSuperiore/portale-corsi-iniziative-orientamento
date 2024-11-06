var ModelCupGeoContinente = {
    modelName : 'cup_geo_continente',
    search: {
        modelName : 'cup_geo_continente',
        //langContext : 'user',
        fields : ['nome_it'],
    },
    // view : {
    //     modelName : 'cup_geo_continente',
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
        modelName : 'cup_geo_continente',
        fields : ['codice','nome_it'],
        actions : [
            'action-edit','action-delete','action-insert',
            'action-export-csv'
        ],
        orderFields : {
            'codice':'codice',
            'nome_it':'nome_it'
        },
        actionsConfig : {
            'action-export-csv' : {
                text: 'Csv',
            }
        }
    },
    edit: {
        modelName : 'cup_geo_continente',
        actions : ['action-save','action-back'],
        fields : ['codice','nome_it',
            //'comuni'
        ],
    },
}
