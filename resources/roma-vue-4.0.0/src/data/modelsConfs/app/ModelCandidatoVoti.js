
export default {
    modelName : 'candidato_voti',
    search: {
        type: 'v-search',
        modelName : 'candidato_voti',
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
        modelName : 'candidato_voti',
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
        modelName : 'candidato_voti',
        actions : ['action-save','action-back'],
        fields: [
			'candidato_id',
			'materia_id',
			'voto_anno_2',
			'voto_anno_1',
			'voto_primo_quadrimestre',

        ],
        fieldsConfig: {
			'candidato_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'materia_id' : { 
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			}, 
			'voto_anno_2' : { 
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			}, 
			'voto_anno_1' : { 
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			}, 
			'voto_primo_quadrimestre' : { 
                type : "decimal",
                digits : 2,
                symbol : null,
                symbol_position : "left",
                htmlAttributes: {},
			}, 

        }

    },
}
