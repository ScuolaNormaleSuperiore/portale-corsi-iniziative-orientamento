
var ModelCupContProgressivo = {
    modelName : 'cup_cont_progressivo',
    search: {
        modelName : 'cup_cont_progressivo',
        fields: [
			'tipo',
			'organizzazione_id',
			'anno',
			'tipodocumento_id',

        ],
        fieldsConfig: {
			'tipo' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'organizzazione_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'anno' : {
                type : "w-input",
                inputType: "number",
			},
			'tipodocumento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}

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
        modelName : 'cup_cont_progressivo',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'tipo',
			'anno',
			'ultimo_numero',
			'ultimo_progressivo_invio',
			'organizzazione',
			'sede',
			'tipodocumento',

        ],
        fieldsConfig: {
			'tipo' : {
                type : "w-text",
			},
			'anno' : {
                type : "w-text",
			},
			'ultimo_numero' : {
                type : "w-text",
			},
			'ultimo_progressivo_invio' : {
                type : "w-text",
			},
			'organizzazione' : {
                type : "w-belongsto",
                fields : [
                    'id',
                ],
			},
			'sede' : {
                type : "w-belongsto",
                fields : [
                    'codice',
                ],
			},
			'tipodocumento' : {
                type : "w-belongsto",
                fields : [
                    'codice',
                ],
			},

        },
        orderFields : {
			'tipo' : 'tipo',
			'anno' : 'anno',
			'ultimo_numero' : 'ultimo_numero',
			'ultimo_progressivo_invio' : 'ultimo_progressivo_invio',

        }

    },
    edit: {
        modelName : 'cup_cont_progressivo',
        actions : ['action-save','action-back'],
        fields: [
			'tipo',
			'organizzazione_id',
			'sedeoperativa_id',
			'anno',
			'tipodocumento_id',
			'ultimo_numero',
			'ultimo_progressivo_invio',

        ],
        fieldsConfig: {
			'tipo' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'organizzazione_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'sedeoperativa_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'anno' : {
                type : "w-input",
                inputType: "number",
			},
			'tipodocumento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'ultimo_numero' : {
                type : "w-input",
			},
			'ultimo_progressivo_invio' : {
                type : "w-input",
			},

        }

    },
}
