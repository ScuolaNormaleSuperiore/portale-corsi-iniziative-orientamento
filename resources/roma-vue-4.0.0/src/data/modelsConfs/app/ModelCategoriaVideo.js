
export default {
    modelName : 'categoria_video',
    search: {
        type: 'v-search',
        modelName : 'categoria_video',
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
        modelName : 'categoria_video',
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
        modelName : 'categoria_video',
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
