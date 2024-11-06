
var ModelCupContDocumentoRigaIva = {
	modelName : 'cup_cont_documento_riga_iva',
    search: {
        modelName : 'cup_cont_documento_riga_iva',
        fields: [
			'documento_id',
			'numero_righe',
			'imponibile',
			'iva_id',
			'natura_fatt_el',
			'importo_iva',
			'importo_totale',

        ],
        fieldsConfig: {
			'documento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'numero_righe' : {
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
        modelName : 'cup_cont_documento_riga_iva',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'documento_id',
			'numero_righe',
			'imponibile',
			'iva_id',
			'natura_fatt_el',
			'importo_iva',
			'importo_totale',
			'documento',
			'iva',

        ],
        fieldsConfig: {
			'numero_righe' : {
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

        },
        orderFields : {
			'numero_righe' : 'numero_righe',
			'imponibile' : 'imponibile',
			'natura_fatt_el' : 'natura_fatt_el',
			'importo_iva' : 'importo_iva',
			'importo_totale' : 'importo_totale',

        }

    },
    edit: {
        modelName : 'cup_cont_documento_riga_iva',
        actions : ['action-save','action-back'],
        fields: [
			'documento_id',
			'numero_righe',
			'imponibile',
			'iva_id',
			'natura_fatt_el',
			'importo_iva',
			'importo_totale',
			'documento',
			'iva',

        ],
        fieldsConfig: {
			'documento_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'numero_righe' : {
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

        }

    },
}
