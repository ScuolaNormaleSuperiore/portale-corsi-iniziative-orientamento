
export default {
    modelName : 'titolo_studio',
    search: {
        type: 'v-search',
        modelName : 'titolo_studio',
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
        modelName : 'titolo_studio',
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
        modelName : 'titolo_studio',
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
