
var ModelCupContDocumento = {
	modelName : 'cup_cont_documento',
    search: {
        modelName : 'cup_cont_documento',
        fields: [
			'organizzazione_id',
			'sedeoperativa_id',
			'anno',
			'numero',
			'data',
			'tipologia_id',
			'tipo_fatt_el',
			'anagrafica_id',
			'note',
			'formapagamento_id',
			'modalita_fatt_el',
			'iban',
			'imponibile',
			'importo_iva',
			'importo_totale',
			'prog_pagato',
			'pagamenti',
			'notacredito_id',
			'chiuso',
			'dati',
			'xml_at',
			'xml_progressivo_invio',

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
			},
			'tipologia_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'tipo_fatt_el' : {
                type : "w-input",
			},
			'anagrafica_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'formapagamento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'modalita_fatt_el' : {
                type : "w-input",
			},
			'iban' : {
                type : "w-input",
			},
			'notacredito_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'chiuso' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'xml_progressivo_invio' : {
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

    },
    list: {
        modelName : 'cup_cont_documento',
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
			'tipo_fatt_el',
			'anagrafica_id',
			'note',
			'formapagamento_id',
			'modalita_fatt_el',
			'iban',
			'imponibile',
			'importo_iva',
			'importo_totale',
			'prog_pagato',
			'pagamenti',
			'notacredito_id',
			'chiuso',
			'dati',
			'xml_at',
			'xml_progressivo_invio',
			'organizzazione',
			'anagrafica',
			'sede',
			'formapagamento',
			'tipologia',

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
			'tipo_fatt_el' : {
                type : "w-text",
			},
			'modalita_fatt_el' : {
                type : "w-text",
			},
			'iban' : {
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
			'prog_pagato' : {
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
			'xml_at' : {
                type : "w-text",
			},
			'xml_progressivo_invio' : {
                type : "w-text",
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
			'formapagamento' : {
                type : "w-belongsto",
                fields : [],
			},
			'tipologia' : {
                type : "w-belongsto",
                fields : [],
			},

        },
        orderFields : {
			'anno' : 'anno',
			'numero' : 'numero',
			'data' : 'data',
			'tipo_fatt_el' : 'tipo_fatt_el',
			'modalita_fatt_el' : 'modalita_fatt_el',
			'iban' : 'iban',
			'imponibile' : 'imponibile',
			'importo_iva' : 'importo_iva',
			'importo_totale' : 'importo_totale',
			'prog_pagato' : 'prog_pagato',
			'chiuso' : 'chiuso',
			'xml_at' : 'xml_at',
			'xml_progressivo_invio' : 'xml_progressivo_invio',

        }

    },
    edit: {
        modelName : 'cup_cont_documento',
        actions : ['action-save','action-back'],
        fields: [
			'organizzazione_id',
			'sedeoperativa_id',
			'anno',
			'numero',
			'data',
			'tipologia_id',
			'tipo_fatt_el',
			'anagrafica_id',
			'note',
			'formapagamento_id',
			'modalita_fatt_el',
			'iban',
			'imponibile',
			'importo_iva',
			'importo_totale',
			'prog_pagato',
			'pagamenti',
			'notacredito_id',
			'chiuso',
			'dati',
			'xml_at',
			'xml_progressivo_invio',
			'organizzazione',
			'anagrafica',
			'sede',
			'formapagamento',
			'tipologia',

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
			'tipo_fatt_el' : {
                type : "w-input",
			},
			'anagrafica_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'note' : {
                type : "texthtml",
                htmlAttributes: {},
			},
			'formapagamento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'modalita_fatt_el' : {
                type : "w-input",
			},
			'iban' : {
                type : "w-input",
			},
			'imponibile' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
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
			'prog_pagato' : {
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			},
			'pagamenti' : {
                type : "texthtml",
                htmlAttributes: {},
			},
			'notacredito_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'chiuso' : {
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'dati' : {
                type : "texthtml",
                htmlAttributes: {},
			},
			'xml_at' : {
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
			'xml_progressivo_invio' : {
                type : "w-input",
			},

        }

    },
}
