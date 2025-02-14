
export default {
    modelName : 'sezione_layout',
    search: {
        type: 'v-search',
        modelName : 'sezione_layout',
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
        modelName : 'sezione_layout',
        actions : [
            'action-edit',
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
        modelName : 'sezione_layout',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'codice',
			'nome',
			'tipo',
			'testo_it',

        ],
        fieldsConfig: {
			'codice' : {
                type : "w-hidden",
                htmlAttributes: {},
			},
			'nome' : {
                type : "w-text",
                label: '',
			},
			'tipo' : {
                type : "w-hidden",
                htmlAttributes: {},
			},
			'testo_it' : {
                type : "w-editor",
                label: '',
                layout: {
                    colClass : 'col-12'
                }
			},

        }

    },
}
