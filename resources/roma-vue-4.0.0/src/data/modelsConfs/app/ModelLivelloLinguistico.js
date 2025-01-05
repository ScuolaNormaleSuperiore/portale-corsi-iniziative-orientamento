
export default {
    modelName : 'livello_linguistico',
    search: {
        type: 'v-search',
        modelName : 'livello_linguistico',
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
        modelName : 'livello_linguistico',
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
        modelName : 'livello_linguistico',
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
