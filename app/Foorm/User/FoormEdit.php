<?php

namespace App\Foorm\User;


use Gecche\Cupparis\App\Foorm\Base\FoormEdit as BaseFoormEdit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FoormEdit extends BaseFoormEdit
{

    protected $isAuth = false;
    protected $hasPasswordCompiled = true;


    protected function init() {

        if ($this->model->getKey() == Auth::id()) {
            $this->isAuth = true;
        }

    }

    public function finalizeData($finalizationFunc = null) {
        if (is_array($this->formData['mainrole'])) {
            $this->formData['mainrole'] = $this->formData['mainrole']['id'];
        }
    }

    public function setValidationSettings($input,$rules = null)
    {

        parent::setValidationSettings($input,$rules);

        if (!Arr::get($input,'password') && !Arr::get($input,'password_confirmation')) {
            $this->hasPasswordCompiled = false;
            unset($this->validationSettings['rules']['password']);
        }

        if (!$this->isAuth) {
            $this->validationSettings['rules']['mainrole'] = ['required'];
        }

    }

    protected function setFieldsToModel($model, $configFields, $input)
    {

        if (!$this->hasPasswordCompiled) {
            unset($input['password']);
        } else {
            $input['password'] = bcrypt($input['password']);
        }

        unset($input['password_confirmation']);
        unset($input['mainrole']);
        parent::setFieldsToModel($model, $configFields, $input);

    }

    protected function saveModel($input) {
        parent::saveModel($input);
        if (!$this->isAuth) {
            $this->model->syncRoles(Arr::wrap(Arr::get($input,'mainrole',[])));
        }
    }

    public function setFormMetadata() {

        parent::setFormMetadata();
        $this->formMetadata['is_auth'] = $this->isAuth;

    }

}
