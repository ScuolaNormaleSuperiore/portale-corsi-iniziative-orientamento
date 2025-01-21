export default {
    modelName: 'user',
    search : {
        cRef : 'searchUser',
        type : 'v-search',
        modelName : 'user',
        //langContext : 'user',
        fields : ['email','name','roles|id'],
        fieldsConfig : {
            'roles|id' : {
                type: 'w-select',
                defaultValue : -1,
                template : {
                    name : 'tpl-search',
                    labelType : 'bottom',
                    layoutType : 'full'
                }
            }
        },
        //searchType : 'advanced'
    },
    view : {
        modelName : 'user',
        type:'v-view',
        //fields : ['name','email','password','password_confirmation','banned','mainrole','fotos','attachments'],
        actions : [],
        fieldsConfig : {
            mainrole : {
                type : 'w-belongsto',
                labelFields : ['name']
            },
            fotos : {
                type : 'w-hasmany',
                hasmanyType : 'view-only',
                hasmanyConf : {
                    fields : ['resource'],
                    fieldsConfig : {
                        resource : {
                            template: 'tpl-base',
                            type : 'w-preview'
                        }
                    }
                }
            },
        }
    },
    list : {
        cRef : 'listUser',
        type : 'v-list',
        //template:'inner',
        modelName : 'user',
        fields : ['id','email','name',
            // 'email_verified_at',
            'fotos',
            'banned','mainrole'],
        actions : [
            'action-edit',
            'action-delete',
            'action-insert',
            // 'action-delete-selected',
            'action-view'
        ],
        //actions : ['ActionSelect','action-delete-selected'],
        //actions : ['action-delete-selected'],
        actionsConfig : {
            ActionSelect : {
                text : 'cc',
                domainValues : {
                    0 : 'Nessuna azione',
                    1 : 'Pippo',
                    2 : 'Pluto'
                },
                // execute() {
                //     alert('bbo')
                // }
            }
        },
        orderFields : {
            'email':'email',
            'name' : 'name'
        },
        fieldsConfig : {
            email_verified_at : {
                type : 'w-swap',
                modelName : 'user',
            },
            banned : {
                type : 'w-swap',
                modelName : 'user',
                switchClass: 'form-switch-danger banned',
                dataSwitched : true,
                //label: 'bannare tu',
            },
            fotos : {
                type : 'w-hasmany',
                hasmanyType : 'view-only',
                hasmanyConf : {
                    fields : ['resource'],
                    fieldsConfig : {
                        resource : {
                            template: 'tpl-base',
                            type : 'w-preview'
                        }
                    }
                }
            },
            attachments : {
                type : 'w-hasmany-view',
                hasmanyConf : {
                    fields : ['resource'],
                    fieldsConfig : {
                        resource : {
                            type : 'w-preview',
                            template: 'tpl-base',
                        }
                    }
                }
            }
        }
    },
    edit : {
        modelName : 'user',
        type : 'v-edit',
        actions : ['action-save','action-save-back','action-back'],
        fields : ['info','name','email','password','password_confirmation','mainrole','empty',
            'fotos','attachments'
        ],
        methods : {
            fillData : function (route,json) {
                var that = this;
                if (json.metadata.is_auth) {
                    that.fieldsConfig.mainrole = 'w-hidden';
                }
                that.$options.methods.fillData.apply(that,[route,json]);
            },
            completed() {
                // console.log('widget mainrole',this.getWidget('mainrole'))
                // var widget = this.getWidget('mainrole');
                // if (widget.type === 'w-hidden') {
                //     this.getWidget('asl_id').jQe().closest('.asl_id').addClass('d-none');
                // } else
                //     widget.showHideUsl();
            }
        },
        fieldsConfig: {
            info : {
                type : 'w-custom',
                ready() {
                    this.value = '<h2>Questa form contiene il campo (fotos) nascosto, mentre il campo (attachments) rimosso</h2>Utilizzare le actions per verificare il comportamento';
                },
                layout : {
                    labelPosition : 'none',
                    colClass : 'col-12'
                }
            },
            empty : {
                type : 'w-custom',
                layout : {
                    labelPosition : 'none'
                }
            },
            mainrole : {
                type:'w-select',
                change() {
                    console.log('mainrole value',this.getValue())
                }

            },
            banned : 'w-radio',
            password : {
                type:'w-input',
                inputType:'password',
            },
            password_confirmation : {
                type:'w-input',
                inputType:'password',
            },
            //roles : 'w-select',
            attachments : {
                type : 'w-hasmany',
                removeWidget : true,
                hasmanyConf : {
                    fields : ['id','nome','descrizione','resource','status'],
                    fieldsConfig : {
                        resource : {
                            type : 'w-upload-ajax',
                            extensions : ['csv','xls'],
                            maxFileSize : '2M',
                            ajaxFields : {
                                field : 'attachments|resource',
                                resource_type : 'attachment'
                            },
                            modelName : 'user'
                        },
                        status : 'w-hidden',
                        id : 'w-hidden',
                    },
                },
            },
            fotos : {
                type : 'w-hasmany',
                hiddenWidget : true,
                hasmanyConf : {
                    fields : ['status','id','nome','descrizione','resource'],
                    fieldsConfig : {
                        resource : {
                            type : 'w-upload-ajax',
                            extensions : ['jpg','png'],
                            maxFileSize : '2M',
                            ajaxFields : {
                                field : 'fotos|resource'
                            },
                            modelName : 'user'
                        },
                        status : 'w-hidden',
                        id : 'w-hidden'

                    },
                }
            }
        },
        actionsConfig : {
            'action-test' : {
                visible : function () {
                    return true;
                },
                //enabled : false,
                enabled : function() {
                    return false;
                },
                text : 'test'
            },
            'action-remove' : {
                text : 'Rimuovi widget',
                execute() {
                    let fieldName = prompt('inserire nome campo da rimuovere. campi disponibili ( ' + this.view.fields.join(',') + ')');
                    this.view.removeWidget(fieldName);
                }

            },
            'action-hide' : {
                text : 'Hide widget',
                execute() {
                    let fieldName = prompt('inserire nome campo da nascondere. campi disponibili ( ' + this.view.fields.join(',') + ')');
                    this.view.hideWidget(fieldName);
                }

            },
            'action-put-in' : {
                text : 'Put-in widget',
                execute() {
                    let fieldName = prompt('inserire nome campo da reinserire. campi disponibili ( ' + this.view.removedWidgets.join(',') + ')');
                    this.view.putInWidget(fieldName);
                }

            },
            'action-show' : {
                text : 'show widget',
                execute() {
                    let fieldName = prompt('inserire nome campo da visualizzare. campi disponibili ( ' + this.view.hiddenWidgets.join(',') + ')');
                    this.view.showWidget(fieldName);
                }

            }
        }
    },
    listEdit : {
        type : 'v-list-edit',
        modelName: 'user',
        fieldsConfigEditMode : {
            'id' : 'w-text',
            'email' : 'w-text',
            'banned' : 'w-text'
        }
    }
}
