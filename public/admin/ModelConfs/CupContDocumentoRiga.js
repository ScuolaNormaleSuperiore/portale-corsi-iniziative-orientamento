
var ModelCupContDocumentoRiga = {
	modelName : 'cup_cont_documento_riga',
    search: {
        modelName : 'cup_cont_documento_riga',
        fields: [
			'documento_id',
			'progressivo',
			'imponibile',
			'iva_id',
			'natura_fatt_el',
			'importo_iva',
			'importo_totale',
			'prestazione_id',

        ],
        fieldsConfig: {
			'documento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'progressivo' : {
                type : "w-input",
                inputType: "number",
			},
			'iva_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'natura_fatt_el' : {
                type : "w-input",
			},
			'prestazione_id' : {
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
        modelName : 'cup_cont_documento_riga',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'documento_id',
			'progressivo',
			'imponibile',
			'iva_id',
			'natura_fatt_el',
			'importo_iva',
			'importo_totale',
			'prestazione_id',
			'documento',
			'iva',
			'prestazione',

        ],
        fieldsConfig: {
			'progressivo' : {
                type : "w-text",
			},
			'imponibile' : {
                type : "w-text",
			},
			'natura_fatt_el' : {
                type : "w-text",
			},
			'importo_iva' : {
                type : "w-text",
			},
			'importo_totale' : {
                type : "w-text",
			},
			'documento' : {
                type : "w-belongsto",
                fields : [],
			},
			'iva' : {
                type : "w-belongsto",
                fields : [],
			},
			'prestazione' : {
                type : "w-belongsto",
                fields : [],
			},

        },
        orderFields : {
			'progressivo' : 'progressivo',
			'imponibile' : 'imponibile',
			'natura_fatt_el' : 'natura_fatt_el',
			'importo_iva' : 'importo_iva',
			'importo_totale' : 'importo_totale',

        }

    },
    edit: {
        modelName : 'cup_cont_documento_riga',
        actions : ['action-save','action-back'],
        fields: [
			'documento_id',
			'progressivo',
			'imponibile',
			'iva_id',
			'natura_fatt_el',
			'importo_iva',
			'importo_totale',
			'prestazione_id',
			'documento',
			'iva',
			'prestazione',

        ],
        fieldsConfig: {
			'documento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'progressivo' : {
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
			'natura_fatt_el' : {
                type : "w-input",
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
			'prestazione_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},

        }

    },
}
