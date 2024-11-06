
export default {
    modelName : 'corso',
    search: {
        type: 'v-search',
        modelName : 'corso',
        fields: [
			'titolo',
			'iniziativa_id',

        ],
        fieldsConfig: {
			'titolo' : { 
                type : "w-input",
			}, 
			'iniziativa_id' : { 
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
        modelName : 'corso',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'titolo',
			// 'descrizione',
			'data_inizio',
			'data_fine',
			'note',
			'luogo',
			'indirizzo',
			'attivo',
			'provincia',
			'iniziativa',

        ],
        fieldsConfig: {
			'titolo' : { 
                type : "w-text",
			}, 
			'data_inizio' : { 
                type : "w-text",
			}, 
			'data_fine' : { 
                type : "w-text",
			}, 
			'luogo' : { 
                type : "w-text",
			}, 
			'indirizzo' : { 
                type : "w-text",
			}, 
			'attivo' : { 
                type : "w-swap",
                modelName : 'corso',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			}, 
			'provincia' : { 
                type : "w-belongsto",
                labelFields : [
					'sigla'
				],
			}, 
			'iniziativa' : { 
                type : "w-belongsto",
                labelFields : [
					'titolo',
				],
			}, 

        },
        orderFields : {
			'titolo' : 'titolo',
			'data_inizio' : 'data_inizio',
			'data_fine' : 'data_fine',
			'luogo' : 'luogo',
			'indirizzo' : 'indirizzo',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'corso',
        actions : ['action-save','action-back'],
        fields: [
			'titolo',
			'iniziativa_id',
			'data_inizio',
			'data_fine',
			'descrizione',
			'luogo',
			'indirizzo',
			'provincia_id',
			'note',
			// 'attivo',

        ],
        fieldsConfig: {
			'titolo' : { 
                type : "w-input",
			}, 
			'descrizione' : { 
                type : "w-texthtml",
                htmlAttributes: {},
			}, 
			'data_inizio' : { 
                type : "w-input",
                inputType: 'date',
			}, 
			'data_fine' : {
                type : "w-input",
                inputType: 'date',
			}, 
			'note' : { 
                type : "w-textarea",
                htmlAttributes: {},
			}, 
			'iniziativa_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'luogo' : { 
                type : "w-input",
			}, 
			'indirizzo' : { 
                type : "w-input",
			}, 
			'provincia_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'attivo' : { 
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        }

    },
}
