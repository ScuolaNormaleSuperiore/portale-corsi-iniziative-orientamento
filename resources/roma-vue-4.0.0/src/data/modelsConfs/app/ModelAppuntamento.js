
export default {
    modelName : 'appuntamento',
    search: {
        type: 'v-search',
        modelName : 'appuntamento',
        fields: [
			'nome',
			'cognome',

        ],
        fieldsConfig: {
			'nome' : {
                type : "w-input",
			},
			'cognome' : {
                type : "w-input",
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
        searchType: 'basic',
        searchLabel: false,

    },
    list: {
        type: 'v-list',
        modelName : 'appuntamento',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            //'action-delete-selected',
        ],
        fields: [
			'nome',
			'cognome',
			'settore',
			'attivo',

        ],
        fieldsConfig: {
			'settore' : {
                type : "w-belongsto",
                fields : [
                    'nome'
                ],
			},
			'nome' : {
                type : "w-text",
			},
			'cognome' : {
                type : "w-text",
			},
			'attivo' : {
                type : "w-swap",
                modelName : 'appuntamento',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},

        },
        orderFields : {
			'nome' : 'nome',
			'cognome' : 'cognome',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'appuntamento',
        actions : ['action-save','action-back'],
        fields: [
			'nome',
			'cognome',
			'settore_id',
			'link',
			'descrizione',
			//'attivo',

        ],
        fieldsConfig: {
			'settore_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'nome' : {
                type : "w-input",
			},
			'cognome' : {
                type : "w-input",
			},
			'descrizione' : {
                type : "w-texthtml",
                layout: {
                    colClass : 'w-12',
                }
			},
			'link' : {
                type : "w-input",
                label: 'Link a Eventbrite'
			},
			'attivo' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},

        }

    },
}
