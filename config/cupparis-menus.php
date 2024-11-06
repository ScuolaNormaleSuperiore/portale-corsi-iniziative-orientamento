<?php

return array(
    /*
      |--------------------------------------------------------------------------
      | Menus
      |--------------------------------------------------------------------------
      |
      | Menu array structure:
         <menuid> => [
            'titolo' => <titolo>, se vuoto prende <menuid>
            'icon' => <icon>, se vuoto null
            'items' =>
                [
                    <menuitemid> =>
                    [
                        'nome' => <nomeitem> se vuoto prende <menuitemid>
                        'path' => "/tab/user" "http://dffd.it",
                        'permission' => <permission> se vuoto null (visibile a tutti)
                                            se l'utente soddisfa il permesso allora l'elemento è visibile.
                                            In ogni caso questa proprietà non è controllata se esiste un metodo
                                            nella classe definita in checkerClass chiamato check<menuid><menuitemid>
                                            che restituisce true|false
                        'resource_id' => <permission> se vuoto null
                        'icon' => <iconitem> se vuoto null
                        'items' => array di sottoelementi con la stessa struttura
                    ],
        ]

      |
     */

    'default-icon' => 'fa-bar-chart-o',
    'default-path' => 'javascript:;',
    /*
     * STRUCTURE
     */
    'vue-main-page' => 'dashboard',
    'menu_data' => [
        'Admin' => [
            'items' => [
                "Users" =>
                    [
                        'nome' => 'Users',
                        "path" => "/manage/user",
                        "vuepath" => "/manage/ModelUser"
                        //"permission" => "TAB_USER",
                    ],
            ],
        ],
        'CupGeo' => [
            'items' => [
                "Tabelle geografiche (Italia)" =>
                    [
                        'nome' => 'Tabelle Geografiche (Italia)',
                        "vuepath" => "/page/tabgeoitalia"
                        //"permission" => "ADMIN_LANG",
                    ],
                "Tabelle geografiche (Mondo)" =>
                    [
                        'nome' => 'Tabelle Geografiche (Mondo)',
                        "vuepath" => "/page/tabgeomondo"
                        //"permission" => "ADMIN_LANG",
                    ],
                "Importazione comuni XLS" =>
                    [
                        'nome' => 'Importazione comuni XLS',
                        "vuepath" => "/import/DCupGeoComune"
                        //"permission" => "ADMIN_LANG",
                    ],

            ],
        ],
        'CupAnag' => [
            'items' => [
                "Anagrafiche" =>
                    [
                        'nome' => 'Anagrafiche',
                        "vuepath" => "/manage/ModelCupAnagAnagrafica"
                        //"permission" => "ADMIN_LANG",
                    ],
                "Tabelle tipologie anagrafiche" =>
                    [
                        'nome' => 'Tab. tipologie x anagrafiche',
                        "vuepath" => "/page/tabanagtipologie"
                        //"permission" => "ADMIN_LANG",
                    ],
                "Tabelle varie anagrafiche" =>
                    [
                        'nome' => 'Tab. varie x anagrafiche',
                        "vuepath" => "/page/tabanagmisc"
                        //"permission" => "ADMIN_LANG",
                    ],
            ],
        ],
        'CupCont' => [
            'items' => [
                "Tabelle varie contabilità" =>
                    [
                        'nome' => 'Tab. varie x contabilità',
                        "vuepath" => "/page/tabcontmisc"
                        //"permission" => "ADMIN_LANG",
                    ],
            ],
        ],
        'Superadmin' => [
            'items' => [

            ],
        ],
        'Main' => [
            'titolo' => 'Menù principale',
            'items' => [
//                [
//                    'nome' => 'Anagrafica',
//                    "path" => "/manage/anagrafica",
//                    "vuepath" => "c-manage?cModel=anagrafica"
//                    //"permission" => "TAB_USER",
//                ],
            ],
        ],
    ],


    //standard, add
    'dynamic_menus' => [

    ],
);

