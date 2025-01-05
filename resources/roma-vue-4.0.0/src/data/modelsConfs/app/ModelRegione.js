
export default {
    modelName : 'regione',
    search: {
        type: 'v-search',
        modelName : 'regione',
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
        modelName : 'regione',
        actions : [
            // 'action-insert',
            // 'action-edit',
            // 'action-delete',
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
        modelName : 'regione',
        actions : ['action-save','action-back'],
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
