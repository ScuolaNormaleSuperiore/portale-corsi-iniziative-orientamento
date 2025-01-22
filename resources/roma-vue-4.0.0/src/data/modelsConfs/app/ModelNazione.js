
export default {
    modelName : 'nazione',
    search: {
        type: 'v-search',
        modelName : 'nazione',
        fields: [
			'codice_istat',
			'codice_catastale',
			'codice_iso_2',
			'codice_iso_3',
			'nome',
			'attivo',

        ],
        fieldsConfig: {
			'codice_istat' : { 
                type : "w-input",
			}, 
			'codice_catastale' : { 
                type : "w-input",
			}, 
			'codice_iso_2' : { 
                type : "w-input",
			}, 
			'codice_iso_3' : { 
                type : "w-input",
			}, 
			'nome' : { 
                type : "w-input",
			}, 
			'attivo' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        },
        // groups: {
        //     'g0': {
        //         fields: [
        //
        //         ],
        //     },
        //     'g1': {
        //         fields: [
        //
        //         ],
        //     }
        // },

    },
    list: {
        type: 'v-list',
        modelName : 'nazione',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'codice_istat',
			'codice_catastale',
			'codice_iso_2',
			'codice_iso_3',
			'nome',
			'attivo',

        ],
        fieldsConfig: {
			'codice_istat' : { 
                type : "w-text",
			}, 
			'codice_catastale' : { 
                type : "w-text",
			}, 
			'codice_iso_2' : { 
                type : "w-text",
			}, 
			'codice_iso_3' : { 
                type : "w-text",
			}, 
			'nome' : { 
                type : "w-text",
			}, 
			'attivo' : { 
                type : "w-swap",
                modelName : '{{$modelName}}',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			}, 

        },
        orderFields : {
			'codice_istat' : 'codice_istat',
			'codice_catastale' : 'codice_catastale',
			'codice_iso_2' : 'codice_iso_2',
			'codice_iso_3' : 'codice_iso_3',
			'nome' : 'nome',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'nazione',
        actions : ['action-save','action-back'],
        fields: [
			'codice_istat',
			'codice_catastale',
			'codice_iso_2',
			'codice_iso_3',
			'nome',
			'attivo',

        ],
        fieldsConfig: {
			'codice_istat' : { 
                type : "w-input",
			}, 
			'codice_catastale' : { 
                type : "w-input",
			}, 
			'codice_iso_2' : { 
                type : "w-input",
			}, 
			'codice_iso_3' : { 
                type : "w-input",
			}, 
			'nome' : { 
                type : "w-input",
			}, 
			'attivo' : { 
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        }

    },
}
