
export default {
    modelName : 'sezione_contenuto',
    search: {
        type: 'v-search',
        modelName : 'sezione_contenuto',
        fields: [
			'titolo_it',
			'contenuto_it',
			'slug_it',
			'ordine',

        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-input",
			},
			'contenuto_it' : {
                type : "w-input",
			},
			'slug_it' : {
                type : "w-input",
			},
			'ordine' : {
                type : "w-input",
                inputType: "number",
			},

        },
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
        modelName : 'sezione_contenuto',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
			'titolo_it',
			'contenuto_it',
			'slug_it',
			'ordine',

        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-text",
			},
			'contenuto_it' : {
                type : "w-text",
			},
			'slug_it' : {
                type : "w-text",
			},
			'ordine' : {
                type : "w-text",
			},

        },
        orderFields : {
			'titolo_it' : 'titolo_it',
			'contenuto_it' : 'contenuto_it',
			'slug_it' : 'slug_it',
			'ordine' : 'ordine',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'sezione_contenuto',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'titolo_it',
			'contenuto_it',
			'slug_it',
			'ordine',

        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-input",
			},
			'contenuto_it' : {
                type : "w-input",
			},
			'slug_it' : {
                type : "w-input",
			},
			'ordine' : {
                type : "w-input",
                inputType: "number",
			},

        }

    },
}
