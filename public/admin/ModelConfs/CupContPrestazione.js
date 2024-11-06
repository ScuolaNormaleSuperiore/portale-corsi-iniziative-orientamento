
var ModelCupContPrestazione = {
	modelName : 'cup_cont_prestazione',
    search: {
        modelName : 'cup_cont_prestazione',
        fields: [
			'organizzazione_id',
			'sedeoperativa_id',
			'anno',
			'numero',
			'data',
			'tipologia_id',
			'anagrafica_id',
			'descrizione',
			'note',
			'valore_unitario',
			'quantita',
			'imponibile',
			'iva_id',
			'importo_iva',
			'importo_totale',
			'prog_fatturato',
			'documenti',
			'importo_scontato',
			'chiuso',

        ],
        fieldsConfig: {
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
			'numero' : {
                type : "w-input",
                inputType: "number",
			},
			'tipologia_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'anagrafica_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'descrizione' : {
                type : "w-input",
			},
			'quantita' : {
                type : "w-input",
                inputType: "number",
			},
			'iva_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'chiuso' : {
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
        modelName : 'cup_cont_prestazione',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'organizzazione_id',
			'sedeoperativa_id',
			'anno',
			'numero',
			'data',
			'tipologia_id',
			'anagrafica_id',
			'descrizione',
			'note',
			'valore_unitario',
			'quantita',
			'imponibile',
			'iva_id',
			'importo_iva',
			'importo_totale',
			'prog_fatturato',
			'documenti',
			'importo_scontato',
			'chiuso',
			'organizzazione',
			'anagrafica',
			'sede',
			'tipologia',
			'iva',

        ],
        fieldsConfig: {
			'anno' : {
                type : "w-text",
			},
			'numero' : {
                type : "w-text",
			},
			'data' : {
                type : "w-text",
			},
			'descrizione' : {
                type : "w-text",
			},
			'valore_unitario' : {
                type : "w-text",
			},
			'quantita' : {
                type : "w-text",
			},
			'imponibile' : {
                type : "w-text",
			},
			'importo_iva' : {
                type : "w-text",
			},
			'importo_totale' : {
                type : "w-text",
			},
			'prog_fatturato' : {
                type : "w-text",
			},
			'importo_scontato' : {
                type : "w-text",
			},
			'chiuso' : {
                type : "w-swap2",
                modelName : '{{$modelName}}',
                //domainValues : {
                //    1 : 'fa fa-circle text-danger',
                //    0 : 'fa fa-circle text-success'
                //}
			},
			'organizzazione' : {
                type : "w-belongsto",
                fields : [],
			},
			'anagrafica' : {
                type : "w-belongsto",
                fields : [],
			},
			'sede' : {
                type : "w-belongsto",
                fields : [],
			},
			'tipologia' : {
                type : "w-belongsto",
                fields : [],
			},
			'iva' : {
                type : "w-belongsto",
                fields : [],
			},

        },
        orderFields : {
			'anno' : 'anno',
			'numero' : 'numero',
			'data' : 'data',
			'descrizione' : 'descrizione',
			'valore_unitario' : 'valore_unitario',
			'quantita' : 'quantita',
			'imponibile' : 'imponibile',
			'importo_iva' : 'importo_iva',
			'importo_totale' : 'importo_totale',
			'prog_fatturato' : 'prog_fatturato',
			'importo_scontato' : 'importo_scontato',
			'chiuso' : 'chiuso',

        }

    },
    edit: {
        modelName : 'cup_cont_prestazione',
        actions : ['action-save','action-back'],
        fields: [
			'organizzazione_id',
			'sedeoperativa_id',
			'anno',
			'numero',
			'data',
			'tipologia_id',
			'anagrafica_id',
			'descrizione',
			'note',
			'valore_unitario',
			'quantita',
			'imponibile',
			'iva_id',
			'importo_iva',
			'importo_totale',
			'prog_fatturato',
			'documenti',
			'importo_scontato',
			'chiuso',
			'organizzazione',
			'anagrafica',
			'sede',
			'tipologia',
			'iva',

        ],
        fieldsConfig: {
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
			'numero' : {
                type : "w-input",
                inputType: "number",
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
			'tipologia_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'anagrafica_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'descrizione' : {
                type : "w-input",
			},
			'note' : {
                type : "texthtml",
                htmlAttributes: {},
			},
			'valore_unitario' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'quantita' : {
                type : "w-input",
                inputType: "number",
			},
			'imponibile' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'iva_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'importo_iva' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'importo_totale' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'prog_fatturato' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'documenti' : {
                type : "texthtml",
                htmlAttributes: {},
			},
			'importo_scontato' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'chiuso' : {
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			},

        }

    },
}
