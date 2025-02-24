import cs from "cupparis-primevue";

export default {
    modelName : 'pagina',
    search: {
        type: 'v-search',
        modelName : 'pagina',
        fields: [
			'titolo_it',

        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-input",
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
        modelName : 'pagina',
        actions : [
            'action-edit',
        ],
        fields: [
			'titolo_it',
			// 'sottotitolo_it',
        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-text",
			},
			'sottotitolo_it' : {
                type : "w-text",
			},

            'attivo' : {
                type : "w-swap",
                modelName : 'pagina',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},
            'homepage' : {
                type : "w-swap",
                modelName : 'pagina',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
            },

        },
        orderFields : {
			'titolo_it' : 'titolo_it',
			'sottotitolo_it' : 'sottotitolo_it',
			'ordine' : 'ordine',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'pagina',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'titolo_it',
			//'sottotitolo_it',
            'sezioni',
            'fotos',
            'attachments',

        ],
        fieldsConfig: {
            'attivo' : {
                type : "w-radio",
            },
            'homepage' : {
                type : "w-radio",
            },
			'titolo_it' : {
                type : "w-text",
                layout : {
                    colClass : 'w-12',
                }
			},
			'sottotitolo_it' : {
                type : "w-input",
			},
			'ordine' : {
                type : "w-select",
			},



            attachments : {
                type :'w-hasmany',
                langContext : 'attachments.fields',

                hasmanyConf : {
                    fields : [
                        'id','nome','resource','status'
                    ],
                    fieldsConfig : {
                        resource : {
                            type : 'w-upload-ajax',
                            extensions : ['pdf','doc','docx'],
                            //extensions : ['csv','xls'],
                            maxFileSize : '2M',
                            ajaxFields : {
                                field : 'attachments|resource',
                                resource_type : 'attachment'
                            },
                            modelName : 'pagina',
                            previewConf:{
                                iconSize:'fa-3x'
                            },
                            label: 'File',
                        },
                        status : 'w-hidden',
                        id : 'w-hidden',
                    }
                }

            },
            fotos : {
                type :'w-hasmany',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Foto e allegati',
                hasmanyConf : {
                    langContext : 'fotos.fields',
                    fields : [
                        'id','nome','resource','status'
                    ],
                    fieldsConfig : {
                        resource : {
                            type : 'w-upload-ajax',
                            extensions : ['jpg','png'],
                            //extensions : ['csv','xls'],
                            maxFileSize : '2M',
                            ajaxFields : {
                                field : 'fotos|resource',
                                resource_type : 'foto'
                            },
                            modelName : 'pagina',
                            previewConf:{
                                iconSize:'fa-3x'
                            },
                            label: 'File',
                        },
                        status : 'w-hidden',
                        id : 'w-hidden',
                        nome : {
                            type: 'w-input',
                            label: 'Alt text'
                        }
                    }
                },
                limit: 1
            },
            sezioni : {
                label: '',
                type :'w-hasmany',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Le sezioni della pagina',
                hasmanyConf : {
                    // name : 'sezioni',
                    // modelName: 'sezione_contenuto',
                    langContext : 'sezione_contenuto.fields',
                    fields : [
                        'id','nome_it','contenuto_it','status'
                    ],
                    fieldsConfig : {
                        "contenuto_it" : {
                            type : 'w-editor',
                            layout : {
                                colClass : 'w-12',
                            }
                        },
                        status : 'w-hidden',
                        id : 'w-hidden',
                    }
                },
                layout : {
                    colClass : 'w-12',
                }
            },
        }

    },
}
