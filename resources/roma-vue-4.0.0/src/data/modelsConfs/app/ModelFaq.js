
export default {
    modelName : 'faq',
    search: {
        type: 'v-search',
        modelName : 'faq',
        fields: [
			'domanda',
			'categoria_id',

        ],
        fieldsConfig: {
			'domanda' : { 
                type : "w-input",
			}, 
			'categoria_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        },
        searchType: 'advanced',
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
        modelName : 'faq',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'domanda',
			'categoria',

        ],
        fieldsConfig: {
			'domanda' : { 
                type : "w-text",
			}, 
			'categoria' : { 
                type : "w-belongsto",
                labelFields : [
                    'nome',
                ],
			}, 

        },
        orderFields : {
			'domanda' : 'domanda',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'faq',
        actions : ['action-save-back','action-back'],
        fields: [
			'domanda',
			'categoria_id',
			'risposta',

        ],
        fieldsConfig: {
			'domanda' : { 
                type : "w-input",
			}, 
			'categoria_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'risposta' : {
                type : "w-texthtml",
                layout: {
                    colClass : 'col-12'
                }
			}, 

        }

    },
}
