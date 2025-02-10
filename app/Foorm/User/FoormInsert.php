<?php

namespace App\Foorm\User;


use App\Models\Scuola;
use Gecche\Cupparis\App\Foorm\Base\FoormInsert as BaseFoormInsert;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FoormInsert extends BaseFoormInsert
{

    protected $isAuth = false;
    protected $scuolaId;


    public function setValidationSettings($input,$rules = null)
    {

        parent::setValidationSettings($input,$rules);

        if (!$this->isAuth) {
            $this->validationSettings['rules']['mainrole'] = ['required'];
        }
        $this->validationSettings['rules']['name'] = [];

    }

    protected function setFieldsToModel($model, $configFields, $input)
    {
        unset($input['mainrole']);
        unset($input['password_confirmation']);

        $input['password'] = bcrypt($input['password']);
        $input['name'] = $input['email'];

        $this->scuolaId = Arr::get($input,'scuola_id');
        unset($input['scuola_id']);

        parent::setFieldsToModel($model, $configFields, $input);
    }

    protected function saveModel($input) {
        parent::saveModel($input);
        $mainrole = Arr::get($input,'mainrole');
        $this->model->syncRoles(Arr::wrap($mainrole));

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
