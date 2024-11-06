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
        }
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
            }
        }
    },
    list : {
        cRef : 'listUser',
        type : 'v-list',
        //template:'inner',
        modelName : 'user',
        fields : ['id','email','name',
            // 'email_verified_at',
            'banned','mainrole'],
        actions : ['action-edit','action-delete','action-insert','action-delete-selected','action-view'],
        //actions : ['action-delete-selected'],
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
        type : 'v-edit',
        actions : ['action-save','action-back','action-test'],
        fields : ['name','email','password','password_confirmation','mainrole','banned'
            // 'fotos','attachments'
        ],
        fieldsConfig: {

            mainrole : {
                type:'w-select',
            },
            banned : {
                type : 'w-radio'
            },
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
        type : 'v-list-edit',
        modelName: 'user',
        fieldsConfigEditMode : {
            'id' : 'w-text',
            'email' : 'w-text',
            'banned' : 'w-text'
        }
    }
}
