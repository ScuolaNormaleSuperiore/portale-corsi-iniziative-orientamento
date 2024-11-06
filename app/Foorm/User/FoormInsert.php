<?php

namespace App\Foorm\User;


use Gecche\Cupparis\App\Foorm\Base\FoormInsert as BaseFoormInsert;
use Illuminate\Support\Arr;

class FoormInsert extends BaseFoormInsert
{

    protected $isAuth = false;


    public function setValidationSettings($input,$rules = null)
    {

        parent::setValidationSettings($input,$rules);

        if (!$this->isAuth) {
            $this->validationSettings['rules']['mainrole'] = ['required'];
        }

    }

    protected function setFieldsToModel($model, $configFields, $input)
    {
        unset($input['mainrole']);
        unset($input['password_confirmation']);

        $input['password'] = bcrypt($input['password']);

        parent::setFieldsToModel($model, $configFields, $input);
    }

    protected function saveModel($input) {
        parent::saveModel($input);
        $this->model->syncRoles(Arr::wrap(Arr::get($input,'mainrole',[])));
    }

    public function setFormMetadata() {

        parent::setFormMetadata();
        $this->formMetadata['is_auth'] = $this->isAuth;

    }

}
