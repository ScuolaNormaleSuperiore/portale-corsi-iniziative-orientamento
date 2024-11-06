
export default {
    modelName : 'candidato_corso',
    search: {
        type: 'v-search',
        modelName : 'candidato_corso',
        fields: [

        ],
        fieldsConfig: {

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
        modelName : 'candidato_corso',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [

        ],
        fieldsConfig: {

        },
        orderFields : {

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'candidato_corso',
        actions : ['action-save','action-back'],
        fields: [
			'candidato_id',
			'corso_id',
			'ordine',

        ],
        fieldsConfig: {
			'candidato_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'corso_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'ordine' : { 
                type : "w-input",
                inputType: "number",
			}, 

        }

    },
}
