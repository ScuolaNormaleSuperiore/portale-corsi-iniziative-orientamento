
export default {
    modelName : 'provincia',
    search: {
        type: 'v-search',
        modelName : 'provincia',
        fields: [
			'nome',
			'sigla',
			'regione_id',

        ],
        fieldsConfig: {
			'nome' : { 
                type : "w-input",
			}, 
			'sigla' : { 
                type : "w-input",
			}, 
			'regione_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        },
        searchType: 'basic',
        searchLabel: false,
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
        modelName : 'provincia',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'nome',
			'sigla',
			'codice',
			'attivo',
			'regione',

        ],
        fieldsConfig: {
			'nome' : { 
                type : "w-text",
			}, 
			'sigla' : { 
                type : "w-text",
			}, 
			'codice' : { 
                type : "w-text",
			}, 
			'attivo' : { 
                type : "w-swap",
                modelName : '{{$modelName}}',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			}, 
			'regione' : { 
                type : "w-belongsto",
                fields : [],
			}, 

        },
        orderFields : {
			'nome' : 'nome',
			'sigla' : 'sigla',
			'codice' : 'codice',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'provincia',
        actions : ['action-save','action-back'],
        fields: [
			'nome',
			'sigla',
			'codice',
			'attivo',
			'regione_id',

        ],
        fieldsConfig: {
			'nome' : { 
                type : "w-input",
			}, 
			'sigla' : { 
                type : "w-input",
			}, 
			'codice' : { 
                type : "w-input",
			}, 
			'attivo' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'regione_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        }

    },
}
