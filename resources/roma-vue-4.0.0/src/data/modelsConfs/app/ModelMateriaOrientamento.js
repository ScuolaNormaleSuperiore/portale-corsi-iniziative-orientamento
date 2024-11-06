
export default {
    modelName : 'materia_orientamento',
    search: {
        type: 'v-search',
        modelName : 'materia_orientamento',
        fields: [
			'nome_it',
			'classe_id',

        ],
        fieldsConfig: {
			'nome_it' : { 
                type : "w-input",
			}, 
			'classe_id' : { 
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
        modelName : 'materia_orientamento',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'nome_it',
			'classe',

        ],
        fieldsConfig: {
			'nome_it' : { 
                type : "w-text",
			}, 
			'classe' : { 
                type : "w-belongsto",
                labelFields : [
                    'nome_it',
                ],
			}, 

        },
        orderFields : {
			'nome_it' : 'nome_it',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'materia_orientamento',
        actions : ['action-save','action-back'],
        fields: [
			'nome_it',
			'classe_id',

        ],
        fieldsConfig: {
			'nome_it' : { 
                type : "w-input",
			}, 
			'classe_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        }

    },
}
