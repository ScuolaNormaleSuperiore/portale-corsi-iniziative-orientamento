export default {
    modelName: '[modelName]',
    providerName: '[providerName]',
    // configurazione upload del file
    confUpload: {
        value: null,
        name: "resource",
        maxFileSize: "2M",
        modelName: 'dcomune',
        extensions: [
            "csv","doc"
        ],
        ajaxFields: {
            resource_type: "attachment",
            field: 'resource',
        },
    },
    // configurazione della view di upload per parametri extra oltre al filename
    viewUpload: {
        fields: [
            // 'field1',
        ],
        fieldsConfig: {
            // field1: {
            //     type: 'w-select',
            // },
        }
    },
    viewList: {
        fields: [
            'datafile_sheet',
            'row',


            'codice_regione',
            'codice_provincia_nuovo',
            'codice_provincia',
            'progressivo_comune',
            'codice_istat',
            'nome_all',
            'nome_it',
            'nome_altra_lingua',
            'codice_area',
            'area',
            'regione',
            'provincia',
            'tipo_provincia',
            'capoluogo',
            'sigla_provincia',
            'codice_istat_numerico',
            'codice_istat_numerico_110',
            'codice_istat_numerico_107',
            'codice_istat_numerico_103',
            'codice_catastale',
            'codice_nuts_1',
            'codice_nuts_2',
            'codice_nuts_3',


        ],
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
}
