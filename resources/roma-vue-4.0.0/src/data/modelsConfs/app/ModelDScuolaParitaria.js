import cs from "cupparis-primevue";

export default {
    modelName: 'dscuolaparitaria',
    providerName: 'dscuolaparitaria',
    confUpload: {
        value: null,
        name: "resource",
        maxFileSize: "10M",
        modelName: 'dscuolaparitaria',
        extensions: [
            "csv",
        ],
        ajaxFields: {
            resource_type: "attachment",
            field: 'resource',
        },

    },

    viewUpload: {
        fields: [
            // 'vettore_id',
            // 'giorni',

        ],
        fieldsConfig: {
            vettore_id: {
                type: 'w-select',
            },
            giorni: {
                type: 'w-checkbox',
            }
        }
    },
    viewList: {
        fields: [
            //'datafile_sheet',
            'row',

            'ANNOSCOLASTICO',
            'AREAGEOGRAFICA',
            'REGIONE',
            'PROVINCIA',

            'CODICESCUOLA',
            'DENOMINAZIONESCUOLA',
            'INDIRIZZOSCUOLA',
            'CAPSCUOLA',
            'CODICECOMUNESCUOLA',
            'DESCRIZIONECOMUNE',

            'DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA',

            'INDIRIZZOEMAILSCUOLA',
            'INDIRIZZOPECSCUOLA',
            'SITOWEBSCUOLA',


        ],
        routeName : 'list-constraint',
        constraintKey : 'datafile_id',
    },

    viewSave: {
        routeName: null,
        // fields: [
        //     'vettore_id',
        //     'giorni',
        //
        // ],
        // fieldsConfig: {
        //     vettore_id: {
        //         type: 'w-select',
        //     },
        //     giorni: {
        //         type: 'w-checkbox',
        //     }
        // }
    },
    listData: {

        fields: [
            // 'prezzario_id'
        ],
        fieldsConfig: {
            // prezzario_id: {
            //     type: 'w-select',
            // }
        }
    }
    // listData: {
    //
    //     // fields: [
    //     //     'vettore_id'
    //     // ],
    //     // fieldsConfig: {
    //     //     vettore_id: {
    //     //         type: 'w-select',
    //     //     }
    //     // }
    // }
}
