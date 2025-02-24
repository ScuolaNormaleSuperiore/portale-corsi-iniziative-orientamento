
export default {
    modelName : 'copertina',
    search: {
        type: 'v-search',
        modelName : 'copertina',
        fields: [
			'titolo_it',

        ],
        fieldsConfig: {
			'titolo_it' : {
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
        type: 'v-list',
        modelName : 'copertina',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
			'titolo_it',
			'sottotitolo_it',
			'link',
			'homepage',
			'ordine',
			'attivo',

        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-text",
			},
			'sottotitolo_it' : {
                type : "w-text",
			},
			'link' : {
                type : "w-text",
			},
			'homepage' : {
                type : "w-swap",
                modelName : '{{$modelName}}',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},
			'ordine' : {
                type : "w-text",
			},
			'attivo' : {
                type : "w-swap",
                modelName : '{{$modelName}}',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},

        },
        orderFields : {
			'titolo_it' : 'titolo_it',
			'sottotitolo_it' : 'sottotitolo_it',
			'link' : 'link',
			'homepage' : 'homepage',
			'ordine' : 'ordine',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'copertina',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'titolo_it',
			'call_to_action',
			'link',
            'fotos'
			// 'homepage',
			// 'ordine',
			// 'attivo',

        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-input",
			},
			'sottotitolo_it' : {
                type : "w-input",
			},
			'link' : {
                type : "w-input",
			},
			'homepage' : {
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'ordine' : {
                type : "w-input",
                inputType: "number",
			},
			'attivo' : {
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			},
            fotos: {
                type: 'w-hasmany',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Foto',
                hasmanyConf: {
                    langContext : 'fotos.fields',
                    fields: [
                        'id', 'nome', 'resource', 'status'
                    ],
                    fieldsConfig: {
                        resource: {
                            type: 'w-upload-ajax',
                            extensions: ['jpg', 'png'],
                            //extensions : ['csv','xls'],
                            maxFileSize: '2M',
                            ajaxFields: {
                                field: 'fotos|resource',
                                resource_type: 'foto'
                            },
                            modelName: 'copertina',
                            previewConf: {
                                iconSize: 'fa-3x'
                            },
                            label: 'File',
                        },
                        status: 'w-hidden',
                        id: 'w-hidden',
                        nome : {
                            type: 'w-input',
                            label: 'Alt text'
                        }
                    }

                },
                layout: {
                    colClass: 'w-12'
                },
                limit: 1,

            },

        }

    },
}
