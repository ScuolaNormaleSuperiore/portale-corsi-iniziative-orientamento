import cs from "cupparis-primevue";

export default {
    modelName : 'pagina_orientamento',
    search: {
        type: 'v-search',
        modelName : 'pagina_orientamento',
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
        modelName : 'pagina_orientamento',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
			'titolo_it',
			// 'sottotitolo_it',
			'ordine',
            'homepage',
			'attivo',

        ],
        fieldsConfig: {
			'titolo_it' : {
                type : "w-text",
			},
			'sottotitolo_it' : {
                type : "w-text",
			},
            ordine: {
                type: 'w-select',
                modelName: 'pagina_orientamento',
                oldValue: null,
                ready() {
                    this.oldValue = this.value;
                },
                change() {
                    let that = this;
                    let st = that.getValue();
                    if (st === that.oldValue) {
                        return;
                    }

                    let r = that.createRoute('set');
                    r.modelName = 'pagina_orientamento'
                    r.setParams({
                        field: 'ordine',
                        value: st,
                        id: that.modelData.id,
                    })
                    cs.Server.route(r, function (json) {
                        console.debug('json', json)
                        if (json.error) {
                            cs.CrudCore.alertError(json.msg);
                            return;
                        }
                        that.view.reload();
                    })

                }
            },

            'attivo' : {
                type : "w-swap",
                modelName : 'pagina_orientamento',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},
            'homepage' : {
                type : "w-swap",
                modelName : 'pagina_orientamento',
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
        modelName : 'pagina_orientamento',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'titolo_it',
			//'sottotitolo_it',
			'ordine',
            'attivo',
            'homepage',
            'sezioni',
            'fotos',
            'attachments',

        ],
        fieldsConfig: {
            'attivo' : {
                type : "w-radio",
                layout : {
                    colClass : 'col-12 md:col-4',
                }
            },
            'homepage' : {
                type : "w-radio",
                layout : {
                    colClass : 'col-12 md:col-4',
                }
            },
			'titolo_it' : {
                type : "w-input",
                layout : {
                    colClass : 'col-12',
                }
			},
			'sottotitolo_it' : {
                type : "w-input",
			},
			'ordine' : {
                type : "w-select",
                layout : {
                    colClass : 'col-12 md:col-4',
                }
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
                            modelName : 'pagina_orientamento',
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
                            modelName : 'pagina_orientamento',
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
                limit: 1,
            },
            sezioni : {
                label: '',
                type :'w-hasmany',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Le sezioni della pagina',
                // hasmanyType : 'list',
                hasmanyConf : {
                    // name : 'sezioni',
                    // modelName: 'sezione_contenuto',
                    langContext : 'sezione_contenuto.fields',
                    fields : [
                        'id','nome_it',
                        'contenuto_it',
                        'status',
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
