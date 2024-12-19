<?php

namespace App\Http\Controllers\Api;

use App\Models\Panino;
use BaconQrCode\Common\ErrorCorrectionLevel;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class FoormController extends Controller
{
    function getAppMenu(Request $request)
    {
        $user = $request->user();
        $nome = $user && $user->name ? $user->name : 'noname';
        $menu = [
            [
                "label" => 'Dashboard', "icon" => 'fa fa-tachometer-alt', "to" => '/'
            ],
            [
                "label" => 'Candidati',
                'icon' => 'fa-solid fa-rectangle-list',
                "items" => [
                    [
                        "label" => 'Candidati', "icon" => 'fa fa-graduation-cap', "to" => '/manage/ModelCandidato'
                    ],
                ],
            ],
            [
                "label" => 'Iniziative e corsi',
                'icon' => 'fa-solid fa-rectangle-list',
                "items" => [
                    [
                        "label" => 'Iniziative', "icon" => 'fa fa-rectangle-list', "to" => '/manage/ModelIniziativa'
                    ],
                    [
                        "label" => 'Corsi', "icon" => 'fa fa-book', "to" => '/manage/ModelCorso'
                    ],
                ],
            ],
            [
                "label" => 'Gestione editoriale',
                'icon' => 'fa-solid fa-rectangle-list',
                "items" => [
                    [
                        "label" => 'Pagine orientamento', "icon" => 'fa fa-users-line', "to" => '/manage/ModelPaginaOrientamento'
                    ],
                    [
                        "label" => 'Pagine standard', "icon" => 'fa fa-users-line', "to" => '/manage/ModelPagina'
                    ],
//                    [
//                        "label" => 'News', "icon" => 'fa fa-newspaper', "to" => '/manage/ModelNews'
//                    ],
                    [
                        "label" => 'Eventi', "icon" => 'fa fa-bullhorn', "to" => '/manage/ModelEvento'
                    ],
                    [
                        "label" => 'Sportello studenti', "icon" => 'fa fa-users-line', "to" => '/manage/ModelStudenteOrientamento'
                    ],
                    [
                        "label" => 'Video', "icon" => 'fa fa-brands fa-youtube', "to" => '/manage/ModelVideo'
                    ],
                    [
                        "label" => 'Testi statici', "icon" => 'fa fa-font', "to" => '/manage/ModelSezioneLayout'
                    ],
                    [
                        "label" => 'Avvisi', "icon" => 'fa fa-exclamation-circle', "to" => '/manage/ModelAvviso'
                    ],
                    [
                        "label" => 'Copertina', "icon" => 'fa fa-star', "to" => '/manage/ModelCopertina/edit/1'
                    ],
                ],
            ],
        ];

        if (auth_role_name() == 'Superutente') {
            $menu[] =
                [
                    "label" => 'Scuole',
                    'icon' => 'fa-solid fa-school',
                    "items" => [
                        [
                            "label" => 'Scuole', "icon" => 'fa fa-school', "to" => '/manage/ModelScuola'
                        ],
                        [
                            "label" => 'Importa scuole pubbliche', "icon" => "fa fa-upload", "to" => '/import/ModelDScuola'
                        ],
                        [
                            "label" => 'Importa scuole paritarie', "icon" => "fa fa-upload", "to" => '/import/ModelDScuolaParitaria'
                        ],
                    ],
                ];
        } else {
            $menu[] =
                [
                    "label" => 'Scuole',
                    'icon' => 'fa-solid fa-school',
                    "items" => [
                        [
                            "label" => 'Scuole', "icon" => 'fa fa-school', "to" => '/manage/ModelScuola'
                        ],
                    ],
            ];

        }


        $menu[] =
            [
                "label" => 'Admin',
                'icon' => 'fa-solid fa-toolbox',
                "items" => [
//                    [
//                        "label" =>'Dashboard', "icon"=>'fa fa-tachometer-alt', "to"=>'/'
//                    ],
                    [
                        "label" => 'Utenti', "icon" => 'fa fa-users', "to" => '/manage/ModelUser'
                    ],
                    [
                        "label" => 'Richieste scuole', "icon" => 'fa fa-circle-question', "to" => '/manage/ModelScuolaRichiesta'
                    ],

                    [
                        "label" => 'Tabelle di supporto', "icon" => 'fa fa-wrench', "to" => '/tabelle'
                    ],
                ]
            ];
        if (\config('cupparis-vue-client.profile_items_in_menu')) {
            $menu[] = [
                "label" => 'Profilo',
                'icon' => 'fa fa-user',
                "items" => [
                    [
                        "label" => $nome,
                        "icon" => 'pi pi-fw pi-user',
                        "to" => '/profilo'
                    ],
                    [
                        "label" => 'Logout',
                        "icon" => 'fa-solid fa-right-from-bracket',
                        "to" => '/logout'
                    ],
                ]
            ];
        };
        // [
        //     "label"  =>'Gestione',
        //     "items"  =>[
        //         [
        //             "label" =>'Italia', "icon"=>'pi pi-fw pi-home', "to"=>'/geoitalia'
        //         ],
        //         [
        //             "label" =>'Mondo', "icon"=>'pi pi-fw pi-globe', "to"=>'/geomondo'
        //         ],
        //         [
        //             "label" =>'Anag. Tipologie', "icon"=>'pi pi-fw pi-home', "to"=>'/anagtipologie'
        //         ],
        //         [
        //             "label" =>'Anag. Miscellanous', "icon"=>'pi pi-fw pi-home', "to"=>'/anagmisc'
        //         ],
        //         [
        //             "label" =>'Cont Misc', "icon"=>'pi pi-fw pi-home', "to"=>'/contmisc'
        //         ],
        //     ]
        // ],

        return response()->json($menu);
    }

    public function faIcons() {
        /*
         * FONT-AWESOME PANEL
         */

        $faFileName = Theme::url('css/font-awesome/css/font-awesome.min.css');
        $files = new Filesystem();
        $faFile = $files->get(public_path() . $faFileName);

        /*
        $icons = [];
        $hits = preg_match_all("#(.+):before(.+)#",$faFile,$icons,PREG_SET_ORDER);
        */

        $icons = preg_split("#:before\{#", $faFile);
        $faIcons = array_map(function ($item) {
            $dotPos = strrpos($item, '.');
            if ($dotPos === false) {
                return false;
            }
            return substr($item, $dotPos + 4);
        }, $icons);

        $faIcons = array_filter($faIcons);

        return view('fa-icons',compact('faIcons'));
    }

}
