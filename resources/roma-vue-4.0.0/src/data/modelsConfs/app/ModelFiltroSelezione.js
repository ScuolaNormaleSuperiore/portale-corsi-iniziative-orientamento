
export default {
    modelName : 'filtro_selezione',
    search: {
        type: 'v-search',
        modelName : 'filtro_selezione',
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
        modelName : 'filtro_selezione',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'nome',
			'descrizione',

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
        modelName : 'filtro_selezione',
        actions : ['action-save','action-back'],
        fields: [
			'nome',
			'descrizione',

        ],
        fieldsConfig: {
			'nome' : { 
                type : "w-input",
			}, 
			'descrizione' : { 
                type : "texthtml",
                htmlAttributes: {},
			}, 

        }

    },
}
