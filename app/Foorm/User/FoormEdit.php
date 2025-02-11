<?php

namespace App\Foorm\User;


use App\Models\Scuola;
use Gecche\Cupparis\App\Foorm\Base\FoormEdit as BaseFoormEdit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoormEdit extends BaseFoormEdit
{

    protected $isAuth = false;
    protected $hasPasswordCompiled = true;
    protected $scuolaId;


    protected function init() {

        if ($this->model->getKey() == Auth::id()) {
            $this->isAuth = true;
        }

    }

    public function finalizeData($finalizationFunc = null) {
        if (is_array($this->formData['mainrole'])) {
            $this->formData['mainrole'] = $this->formData['mainrole']['id'];
        }
        if ($this->model->scuola) {
            $this->formData['scuola_id'] = $this->model->scuola->getKey();
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

        $this->validationSettings['rules']['name'] = [];

    }

    protected function setFieldsToModel($model, $configFields, $input)
    {
        unset($input['mainrole']);
        unset($input['password_confirmation']);

        if (!$this->hasPasswordCompiled) {
            unset($input['password']);
        } else {
            $input['password'] = bcrypt($input['password']);
        }

        $input['name'] = $input['email'];

        $this->scuolaId = Arr::get($input,'scuola_id');
        unset($input['scuola_id']);

        parent::setFieldsToModel($model, $configFields, $input);
    }

    protected function saveModel($input) {
        parent::saveModel($input);
        $mainrole = Arr::get($input,'mainrole');
        if (!$this->isAuth) {
            $this->model->syncRoles(Arr::wrap($mainrole));
        }

        if ($mainrole == 5 && $this->scuolaId) { //Scuola
            $scuola = Scuola::find($this->scuolaId);
            if ($scuola && $scuola->getKey()) {
                $scuola->user_id = $this->model->getKey();
                $scuola->email_riferimento = $this->model->email;
                $scuola->save();
            }
            Scuola::where('user_id',$this->model->getKey())
                ->where('id','!=',$this->scuolaId)
                ->update(['user_id' => null,'email_riferimento' => DB::raw('email')]);
        } else {
            Scuola::where('user_id',$this->model->getKey())
                ->update(['user_id' => null,'email_riferimento' => DB::raw('email')]);
        }
    }

    public function setFormMetadata() {

        parent::setFormMetadata();
        $this->formMetadata['is_auth'] = $this->isAuth;

    }

}
