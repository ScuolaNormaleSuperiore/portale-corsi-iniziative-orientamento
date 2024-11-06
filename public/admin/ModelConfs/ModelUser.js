var ModelUser = {
    modelName: 'user',
    search : {
        cRef : 'searchUser',
        modelName : 'user',
        //langContext : 'user',
        fields : ['email','name','roles|id'],
        fieldsConfig : {
            'roles|id' : {
                type: 'w-select',
                defaultValue : -1,

            }
        }
    },
    view : {
        modelName : 'user',
        //fields : ['name','email','password','password_confirmation','banned','mainrole','fotos','attachments'],
        actions : [],
        fieldsConfig : {
            mainrole : {
                type : 'w-belongsto',
                labelFields : ['name']
            }
        }
    },
    list : {
        cRef : 'listUser',
        //template:'inner',
        modelName : 'user',
        fields : ['id','email','name',
            // 'email_verified_at',
            'banned','mainrole'],
        actions : ['action-edit','action-delete','action-insert','action-delete-selected'],
        //actions : ['action-delete-selected'],
        orderFields : {
            'email':'email'
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
                type : 'w-hasmany-view',
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
        actions : ['action-save','action-back','action-test'],
        fields : ['name','email','password','password_confirmation','mainrole',
            // 'fotos','attachments'
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
            mainrole : {
                type:'w-select',
                // mounted() {
                //     this.showHideUsl();
                // },
                methods: {
                    showHideUsl() {
                        if (this.getValue() == 5) {
                            this.view.getWidget('asl_id').jQe().closest('.asl_id').removeClass('d-none');
                        } else {
                            this.view.getWidget('asl_id').jQe().closest('.asl_id').addClass('d-none');
                            this.view.getWidget('asl_id').setValue(-1);
                        }
                    },
                    showHideSerd() {
                        if (this.getValue() == 8) {
                            this.view.getWidget('serd_id').jQe().closest('.serd_id').removeClass('d-none');
                        } else {
                            this.view.getWidget('serd_id').jQe().closest('.serd_id').addClass('d-none');
                            this.view.getWidget('serd_id').setValue(-1);
                        }
                    },
                    change() {
                        console.log('mainrole value',this.getValue())
                        this.showHideUsl();
                        this.showHideSerd();
                    }
                }
            },
            asl_id: {
                type: 'w-select',
                methods: {
                    ready () {
                        if (parseInt(this.view.value.mainrole) != 5) {
                            this.jQe().closest('.asl_id').addClass('d-none');
                        }
                    }
                }
            },
            serd_id: {
                type: 'w-select',
                methods: {
                    ready () {
                        if (parseInt(this.view.value.mainrole) != 8) {
                            this.jQe().closest('.serd_id').addClass('d-none');
                        }
                    }
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
                    return false;
                },
                //enabled : false,
                enabled : function() {
                    return false;
                },
                text : 'test'
            }
        }
    },
    listEdit : {
        modelName: 'user',
        fieldsConfigEditMode : {
            'id' : 'w-text',
            'email' : 'w-text',
            'banned' : 'w-text'
        }
    }
}
