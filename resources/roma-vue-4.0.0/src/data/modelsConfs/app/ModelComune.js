
export default {
    modelName : 'comune',
    search: {
        type: 'v-search',
        modelName : 'comune',
        fields: [
			'nome',
			'provincia_id',
			'regione_id',
			'cap',
        ],
        fieldsConfig: {
			'nome' : { 
                type : "w-input",
			}, 
			'codice_istat' : { 
                type : "w-input",
			}, 
			'codice_catastale' : { 
                type : "w-input",
			}, 
			'provincia_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'sigla_provincia' : { 
                type : "w-input",
			}, 
			'regione_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'nazione_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'cap' : { 
                type : "w-input",
			}, 
			'prefisso' : { 
                type : "w-input",
			}, 
			'attivo' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        },
		searchType: 'advanced',
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
        modelName : 'comune',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
			'nome',
			'codice_istat',
			'codice_catastale',
			'sigla_provincia',
			'cap',
			// 'attivo',
			'provincia',
			'regione',
        ],
        fieldsConfig: {
			'nome' : { 
                type : "w-text",
			}, 
			'codice_istat' : { 
                type : "w-text",
			}, 
			'codice_catastale' : { 
                type : "w-text",
			}, 
			'cap' : {
                type : "w-text",
			}, 
			'prefisso' : { 
                type : "w-text",
			}, 
			'attivo' : { 
                type : "w-swap",
                modelName : '{{$modelName}}',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			}, 
			'provincia' : { 
                type : "w-custom",
                ready() {
					this.value = this.modelData.provincia ?
						this.modelData.provincia.nome + ' (' + this.modelData.sigla_provincia+ ')' :
						"--";
				}
			}, 
			'regione' : { 
                type : "w-belongsto",
                labelFields : [
					"nome",
				],
			}, 
			'nazione' : { 
                type : "w-belongsto",
                fields : [],
			}, 

        },
        orderFields : {
			'nome' : 'nome',
			'codice_istat' : 'codice_istat',
			'codice_catastale' : 'codice_catastale',
			'sigla_provincia' : 'sigla_provincia',
			'cap' : 'cap',
			'prefisso' : 'prefisso',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'comune',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'nome',
			'codice_istat',
			'codice_catastale',
			'provincia_id',
			// 'sigla_provincia',
			// 'regione_id',
			// 'nazione_id',
			'cap',
			'prefisso',
			// 'attivo',


        ],
        fieldsConfig: {
			'nome' : { 
                type : "w-input",
			}, 
			'codice_istat' : { 
                type : "w-input",
			}, 
			'codice_catastale' : { 
                type : "w-input",
			}, 
			'provincia_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'sigla_provincia' : { 
                type : "w-input",
			}, 
			'regione_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'nazione_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'cap' : { 
                type : "w-input",
			}, 
			'prefisso' : { 
                type : "w-input",
			}, 
			'attivo' : { 
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 

        }

    },
}
