
export default {
    modelName : 'scuola_richiesta',
    search: {
        type: 'v-search',
        modelName : 'scuola_richiesta',
        fields: [
			'email',
			'scuola_id',

        ],
        fieldsConfig: {
			'email' : { 
                type : "w-input",
			}, 
			'scuola_id' : { 
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
        type: 'v-list',
        modelName : 'scuola_richiesta',
        actions : [
            // 'action-insert',
            // 'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
			'scuola',
			'email',
			// 'nome',
			// 'cognome',
			// 'telefono',
			'note',
			'approvata',

        ],
        fieldsConfig: {
			'email' : { 
                type : "w-text",
			}, 
			'nome' : { 
                type : "w-text",
			}, 
			'cognome' : { 
                type : "w-text",
			}, 
			'telefono' : { 
                type : "w-text",
			}, 
			'approvata' : { 
                type : "w-swap",
                modelName : '{{$modelName}}',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			}, 
			'scuola' : { 
                type : "w-custom",
                ready() {
                    this.value = this.modelData.scuola.denominazione + ' - Cod: ' + this.modelData.scuola.codice;
                    this.value += '<br/>';
                    this.value += "Email attuale: " + this.modelData.scuola.email_riferimento;
                },
			}, 

        },
        orderFields : {
			'email' : 'email',
			'nome' : 'nome',
			'cognome' : 'cognome',
			'telefono' : 'telefono',
			'approvata' : 'approvata',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'scuola_richiesta',
        actions : ['action-save','action-back'],
        fields: [

        ],
        fieldsConfig: {

        }

    },
}
