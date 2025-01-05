
export default {
    modelName : 'scuola',
    search: {
        type: 'v-search',
        modelName : 'scuola',
        fields: [
			// 'anno',
			'regione_id',
			'provincia_id',
			'codice',
			'denominazione',
			'comune',
			'email_riferimento',

        ],
        fieldsConfig: {
			'anno' : {
                type : "w-input",
                inputType: "number",
			},
			'regione_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'provincia_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'codice' : {
                type : "w-input",
			},
			'denominazione' : {
                type : "w-input",
			},
			'comune' : {
                type : "w-input",
			},
			'email_riferimento' : {
                type : "w-input",
			},

        },
		searchType : 'advanced',
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
        modelName : 'scuola',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
			// 'anno',
			'codice',
			'denominazione',
			'indirizzo',
			'comune',
			'email_riferimento',
			'provincia',

        ],
        fieldsConfig: {
			'anno' : {
                type : "w-text",
			},
			'codice' : {
                type : "w-text",
			},
			'denominazione' : {
                type : "w-text",
			},
			'indirizzo' : {
                type : "w-text",
			},
			'comune' : {
                type : "w-text",
			},
			'email_riferimento' : {
                type : "w-text",
			},
			'provincia' : {
                type : "w-belongsto",
                labelFields : [
					'sigla'
				],
			},

        },
        orderFields : {
			'anno' : 'anno',
			'codice' : 'codice',
			'denominazione' : 'denominazione',
			'indirizzo' : 'indirizzo',
			'comune' : 'comune',
			'email_riferimento' : 'email_riferimento',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'scuola',
        actions : ['action-save','action-back'],
        fields: [
			'anno',
			'area_geografica',
			'provincia_id',
			'codice_istituto_riferimento',
			'denominazione_istituto_riferimento',
			'codice',
			'denominazione',
			'indirizzo',
			'cap',
			'catastale_comune',
			'comune',
			'caratteristica',
			'tipologia_grado_istruzione',
			'indicazione_sede_direttivo',
			'indicazione_sede_omnicomprensivo',
			'email',
			'pec',
			'web',
			'sede_scolastica',
			'email_riferimento',
			'user',

        ],
        fieldsConfig: {
			'anno' : {
                type : "w-input",
                inputType: "number",
			},
			'area_geografica' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'provincia_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'codice_istituto_riferimento' : {
                type : "w-input",
			},
			'denominazione_istituto_riferimento' : {
                type : "w-input",
			},
			'codice' : {
                type : "w-input",
			},
			'denominazione' : {
                type : "w-input",
			},
			'indirizzo' : {
                type : "w-input",
			},
			'cap' : {
                type : "w-input",
			},
			'catastale_comune' : {
                type : "w-input",
			},
			'comune' : {
                type : "w-input",
			},
			'caratteristica' : {
                type : "w-input",
			},
			'tipologia_grado_istruzione' : {
                type : "w-input",
			},
			'indicazione_sede_direttivo' : {
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'indicazione_sede_omnicomprensivo' : {
                type : "w-input",
			},
			'email' : {
                type : "w-input",
			},
			'pec' : {
                type : "w-input",
			},
			'web' : {
                type : "w-input",
			},
			'sede_scolastica' : {
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'email_riferimento' : {
                type : "w-input",
			},
			'user' : {
                type : "w-text",
			},

        }

    },
}
