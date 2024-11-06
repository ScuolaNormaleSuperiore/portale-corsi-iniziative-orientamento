
var ModelCupContRegistrazione = {
	modelName : 'cup_cont_registrazione',
    search: {
        modelName : 'cup_cont_registrazione',
        fields: [
			'organizzazione_id',
			'anno',
			'progressivo',
			'dare_avere',
			'data',
			'importo',
			'macrotipo',
			'descrizione',
			'sedeoperativa_id',

        ],
        fieldsConfig: {
			'organizzazione_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'anno' : {
                type : "w-input",
                inputType: "number",
			},
			'progressivo' : {
                type : "w-input",
                inputType: "number",
			},
			'dare_avere' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'macrotipo' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'descrizione' : {
                type : "w-input",
			},
			'sedeoperativa_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
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
        modelName : 'cup_cont_registrazione',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'organizzazione_id',
			'anno',
			'progressivo',
			'dare_avere',
			'data',
			'importo',
			'macrotipo',
			'descrizione',
			'sedeoperativa_id',
			'organizzazione',
			'sede',

        ],
        fieldsConfig: {
			'anno' : {
                type : "w-text",
			},
			'progressivo' : {
                type : "w-text",
			},
			'dare_avere' : {
                type : "w-text",
			},
			'data' : {
                type : "w-text",
			},
			'importo' : {
                type : "w-text",
			},
			'macrotipo' : {
                type : "w-text",
			},
			'descrizione' : {
                type : "w-text",
			},
			'organizzazione' : {
                type : "w-belongsto",
                fields : [],
			},
			'sede' : {
                type : "w-belongsto",
                fields : [],
			},

        },
        orderFields : {
			'anno' : 'anno',
			'progressivo' : 'progressivo',
			'dare_avere' : 'dare_avere',
			'data' : 'data',
			'importo' : 'importo',
			'macrotipo' : 'macrotipo',
			'descrizione' : 'descrizione',

        }

    },
    edit: {
        modelName : 'cup_cont_registrazione',
        actions : ['action-save','action-back'],
        fields: [
			'organizzazione_id',
			'anno',
			'progressivo',
			'dare_avere',
			'data',
			'importo',
			'macrotipo',
			'descrizione',
			'sedeoperativa_id',
			'organizzazione',
			'sede',

        ],
        fieldsConfig: {
			'organizzazione_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'anno' : {
                type : "w-input",
                inputType: "number",
			},
			'progressivo' : {
                type : "w-input",
                inputType: "number",
			},
			'dare_avere' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'data' : {
                type : "date_select",
                format : "numeric",
                active : [
                   "day",
                   "month",
                   "year"
                ],
                startYear : null,
                endYear : null,
                htmlAttributes: {},
			},
			'importo' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'macrotipo' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'descrizione' : {
                type : "w-input",
			},
			'sedeoperativa_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},

        }

    },
}
