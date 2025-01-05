export default {
    modelName: 'materia',
    search: {
        type: 'v-search',
        modelName: 'materia',
        fields: [
            'nome',

        ],
        fieldsConfig: {
            'nome': {
                type: 'w-input',
            },

        },
        searchType: 'basic',
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
        modelName: 'materia',
        actions: [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
            'nome',
            'moltiplicatore',

        ],
        fieldsConfig: {
            'nome': {
                type: 'w-text',
            },
            'moltiplicatore': {
                type: 'w-text',
            },

        },
        orderFields: {
            'nome': 'nome',
            'moltiplicatore': 'moltiplicatore',

        }

    },
    edit: {
        type: 'v-edit',
        modelName: 'materia',
        actions: ['action-save', 'action-back'],
        fields: [
            'nome',
            'moltiplicatore',

        ],
        fieldsConfig: {
            'nome': {
                type: 'w-input',
            },
            'moltiplicatore': {
                type: 'w-input',
                inputType: 'number',
                htmlAttributes: {},
            },

        }

    },
}
