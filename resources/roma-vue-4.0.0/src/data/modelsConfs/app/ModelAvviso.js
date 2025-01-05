
export default {
    modelName : 'avviso',
    search: {
        type: 'v-search',
        modelName : 'avviso',
        fields: [
			'descrizione',

        ],
        fieldsConfig: {

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
        modelName : 'avviso',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            //'action-delete-selected',
        ],
        fields: [
            'created_at',
			'descrizione',
            'tipo_text',
			'attivo',

        ],
        fieldsConfig: {
            'created_at' : {
                type: 'w-date-text',
                label: 'Creato il'
            },
			'attivo' : {
                type : "w-swap",
                modelName : 'avviso',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},

        },
        orderFields : {
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'avviso',
        actions : ['action-save','action-back'],
        fields: [
			'descrizione',
            'tipo',
			'attivo',

        ],
        fieldsConfig: {
            'tipo' : {
                type : "w-select",
            },
			'descrizione' : {
                type : "w-textarea",
                layout: {
                    colClass: 'col-12'
                }
			},
			'attivo' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},

        }

    },
}
