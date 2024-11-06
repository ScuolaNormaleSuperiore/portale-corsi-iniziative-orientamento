<?php namespace App\Console\Commands;


class Permissions extends \Gecche\Cupparis\App\Console\Commands\Permissions
{

    /*
         * PERMESSI SUI MODELLI ASSOCIATI AI RUOLI
         */
    protected function buildRolesModelsPermissions()
    {

        $models = $this->config['models'];
        print_r($models);
        //SOLO GUARDIA WEB

        //ADMIN
        $adminModels = [];
        foreach ($models as $model) {
            $adminModels[$model] = null;
        }

        foreach ($models as $model) {
            $adminModels[$model] = [
                'view',
                'list',
                'menu',
                'tab',
                'edit',
                'insert',
                'update',
                'new',
                'insert',
                'create',
                'listing',
                'datafile',
            ];

        }

        //OPERATORE
        $operatoreModels = [];
        foreach ($models as $model) {
            $operatoreModels[$model] = [
                'view',
                'list',
                'menu',
                'tab',
            ];
        }


        $rolesModelsPermissions = [
            'web' => [
                'Admin' => $adminModels,
                'Operatore' => $operatoreModels,
            ],
        ];

        return $rolesModelsPermissions;

    }

    protected function buildRolesOtherPermissions()
    {

        $rolesOtherPermissions = [
            'web' => [
                'Admin' => [
//                    'permission_1',
//                    'permission_2',
                ],
                'Operatore' => [
//                    'permission_1',
//                    'permission_3',
                ],
            ],
        ];

        return $rolesOtherPermissions;

    }


}
