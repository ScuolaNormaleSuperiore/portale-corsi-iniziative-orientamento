
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
            'user',
			// 'email_riferimento',
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
            'user' : {
                type : "w-custom",
                ready() {
                    var html = "<div>";

                    if (this.modelData.user && this.modelData.user.email) {
                        html += this.modelData.user.email;
                        html += '<br/>';
                        if (this.modelData.user.nome) {
                            html += this.modelData.user.nome + ' ' + this.modelData.user.cognome;
                        } else {

                        }
                    } else {
                        html += "Nessun utente associato";
                    }
                    html += "</div>";
                    this.value = html;
                },
                label: 'Utente associato',
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
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			// 'anno',
			'denominazione',
			'codice',
            'tipo',
			'tipologia_grado_istruzione',
			'caratteristica',

			'denominazione_istituto_riferimento',
			'codice_istituto_riferimento',
			'sede_scolastica',

            'comune_id',
			'area_geografica',
			// 'provincia_id',
			'indirizzo',
			'cap',
			'catastale_comune',
			// 'comune',
			// 'indicazione_sede_direttivo',
			// 'indicazione_sede_omnicomprensivo',
			'email',
			'pec',
			'web',
			//'email_riferimento',
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
                extraBind: {
                    'disabled' : true,
                }
			},
			'comune' : {
                type : "w-input",
			},
			'caratteristica' : {
                type : "w-select",
			},
			'tipologia_grado_istruzione' : {
                type : "w-select",
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
                label: "Email (MIUR)",
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
                type : "w-custom",
                ready() {
                    var html = "<div>";

                        if (this.modelData.user) {
                            html += this.modelData.user.nome + ' ' + this.modelData.user.cognome;
                            html += '<br/>';
                            html += this.modelData.user.email;
                        } else {
                            html += "Nessun utente associato";
                        }
                        html += "</div>";
                        this.value = html;
                },
                label: 'Utente associato',
			},
            'tipo' : {
                type : "w-select",
            },
            'comune_id': {
                type: "w-autocomplete",
                foormName: 'scuola',
                viewType: 'edit',
                labelFields: [
                    'id',
                    'nome',
                    'sigla_provincia',
                    'codice_catastale',
                ],
                clearButton: true,
                extraBind: {
                    'placeholder': "Digita le iniziali di un comune...",
                    'dropdown': true,
                    'option-label': function (obj) {
                        if (!obj.nome) {
                            return null;
                        }
                        return obj.nome + ' (' + obj.sigla_provincia + ')';
                    },
                    'option-value': 'id',
                },
                label: 'Comune',
                change() {
                    var self = this;
                    self.view.getWidget('catastale_comune').setValue(this.autocompleteValue.codice_catastale);
                }
            },


        }

    },
}
