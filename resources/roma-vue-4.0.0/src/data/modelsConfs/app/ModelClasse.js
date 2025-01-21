
export default {
    modelName : 'classe',
    search: {
        type: 'v-search',
        modelName : 'classe',
        fields: [
			'nome_it',

        ],
        fieldsConfig: {
			'nome_it' : {
                type : "w-input",
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
        modelName : 'classe',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            //'action-delete-selected',
        ],
        fields: [
			'nome_it',

        ],
        fieldsConfig: {
			'nome_it' : {
                type : "w-text",
			},

        },
        orderFields : {
			'nome_it' : 'nome_it',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'classe',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'nome_it',

        ],
        fieldsConfig: {
			'nome_it' : {
                type : "w-input",
			},

        }

    },
}
