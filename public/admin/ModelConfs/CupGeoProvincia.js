var ModelCupGeoProvincia = {
    modelName : 'cup_geo_provincia',
    search: {
        modelName : 'cup_geo_provincia',
        //langContext : 'user',
        fields : ['regione_id','nome_it'],
        fieldsConfig: {
            'regione_id' : {
                type: 'w-select'

            }
        }
    },
    // view : {
    //     modelName : 'cup_geo_provincia',
    //     //fields : ['name','email','password','password_confirmation','banned','mainrole','fotos','attachments'],
    //     actions : [],
    //     fieldsConfig : {
    //         mainrole : {
    //             type : 'w-belongsto',
    //             fields : ['name']
    //         }
    //     }
    // },
    list: {
        modelName : 'cup_geo_provincia',
        fields : [
            'codice','nome_it','sigla',
            'regione',
            'attivo'

        ],
        actions : ['action-edit','action-delete','action-insert','action-view',
            'action-export-csv'
        ],
        orderFields : {
            'codice':'codice',
            'nome_it':'nome_it',
            'sigla':'sigla'
        },
        fieldsConfig : {
            'attivo' : {
                type : 'w-swap',
                modelName : 'cup_geo_provincia'
            },
            'regione' : {
                type : 'w-belongsto',
                labelFields : [
                    'nome_it',
                ]
            }
        },
        actionsConfig : {
            'action-export-csv' : {
                text: 'Csv',
            }
        }


    },
    edit: {
        modelName : 'cup_geo_provincia',
        actions : ['action-save','action-back'],
        fields : ['codice','nome_it','sigla','regione_id','codice_nuovo'
            //'comuni'
        ],

        fieldsConfig: {
            regione_id : 'w-select',
            //roles : 'w-select',
            comuni : {
                type : 'w-hasmany',
                // limit : 1,
                hasmanyConf : {
                    langContext : 'comune',
                    fields : ['id','codice','nome_it','codice_catastale','cap','prefisso_telefonico'],
                    fieldsConfig : {
                        // codice_catastale :  {
                        //     type : 'w-select'
                        // }
                    }
                },
                template : 'tpl-no',
            },
        },
    },
    view : {
        modelName : 'cup_geo_provincia',
        //actions : ['action-save','action-back'],
        fields : ['codice','nome_it','sigla','regione',
            'comuni'
        ],
        fieldsConfig: {
            regione : {
                type: 'w-belongsto-view',
                labelFields:
                    [
                        'nome_it',
                    ],
            },
            //roles : 'w-select',
            comuni : {
                type : 'w-custom',
                // limit : 1,

                mounted: function () {
                    var that = this;
                    that.value = '<div class="table-responsive w-100">'+
                        '<table class="table table-sm">'+
                        '<thead>'+
                        '<tr>'+
                        '<th colspan="2">Comuni</th>'+
                        '</tr>'+
                        '</thead>'+

                        '<tbody>';




                    var j = 0;
                    for (var i in that.modelData['comuni']) {
                        var comune = that.modelData['comuni'][i];
                        if (j % 2 == 0) {
                            that.value += '<tr>';
                        }

                        that.value += '<td>'+comune.nome_it+'</td>';

                        if (j % 2 != 0) {
                            that.value += '</tr>';
                        }
                        j++;
                    }
                    if (j % 2 == 0) {
                        that.value += '<td>&nbsp;</td></tr>';
                    }
                    that.value +=
                        '</tbody>'+
                        '</table>'+
                        '</div>';
                },

                // hasmanyConf : {
                //     langContext : 'comune',
                //     fields : ['id','codice','nome_it','codice_catastale','cap','prefisso_telefonico'],
                //     fieldsConfig : {
                //         // codice_catastale :  {
                //         //     type : 'w-select'
                //         // }
                //     }
                // },
                template : 'tpl-full-no',
            },
        },
    },
    // view : {
    //     //actions: ['action-save', 'action-back', 'action-test'],
    //     fields: ['name','email', 'password', 'password_confirmation', 'banned', 'mainrole', 'fotos', 'attachments'],
    //     fieldsConfig :  {
    //         mainrole :  {
    //             type : 'w-belongsto',
    //             fields : ['name']
    //         }
    //     }
    // },
}

