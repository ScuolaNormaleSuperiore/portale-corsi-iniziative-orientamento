
export default {
    modelName : 'faq_categoria',
    search: {
        type: 'v-search',
        modelName : 'faq_categoria',
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
        modelName : 'faq_categoria',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
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
        modelName : 'faq_categoria',
        actions : ['action-save-back','action-back'],
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
