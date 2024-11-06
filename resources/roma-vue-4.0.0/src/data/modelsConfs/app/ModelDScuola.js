import cs from "cupparis-primevue";

export default {
    modelName: 'dscuola',
    providerName: 'dscuola',
    importTitolo : 'Importazione scuole pubbliche',
    importDesc : 'app.import-desc-scuola-pubblica',
    importFile : 'Seleziona il file excel recuperato dal web',
    importLoading : 'Importazione e analisi delle scuole',
    importSaving : 'Salvataggio delle scuole importate',
    importLinkExample : '/pippo/3',
    //importLinkDesc : 'qui puoi trovare come deve essere il file excel',
    confUpload: {
        value: null,
        name: "resource",
        maxFileSize: "10M",
        modelName: 'dscuola',
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
            'CODICEISTITUTORIFERIMENTO',
            'DENOMINAZIONEISTITUTORIFERIMENTO',
            'CODICESCUOLA',
            'DENOMINAZIONESCUOLA',
            'INDIRIZZOSCUOLA',
            'CAPSCUOLA',
            'CODICECOMUNESCUOLA',
            'DESCRIZIONECOMUNE',
            'DESCRIZIONECARATTERISTICASCUOLA',
            'DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA',
            'INDICAZIONESEDEDIRETTIVO',
            'INDICAZIONESEDEOMNICOMPRENSIVO',
            'INDIRIZZOEMAILSCUOLA',
            'INDIRIZZOPECSCUOLA',
            'SITOWEBSCUOLA',
            'SEDESCOLASTICA',

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
