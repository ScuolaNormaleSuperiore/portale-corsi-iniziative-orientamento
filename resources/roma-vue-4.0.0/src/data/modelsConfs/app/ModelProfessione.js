
export default {
    modelName : 'professione',
    search: {
        type: 'v-search',
        modelName : 'professione',
        fields: [
			'nome',

        ],
        fieldsConfig: {
			'nome' : {
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
        modelName : 'professione',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
			'nome',

        ],
        fieldsConfig: {
			'nome' : {
                type : "w-text",
			},

        },
        orderFields : {
			'nome' : 'nome',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'professione',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'nome',

        ],
        fieldsConfig: {
			'nome' : {
                type : "w-input",
			},

        }

    },
}
