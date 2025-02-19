<?php

namespace App\Listeners;

use App\Enums\CandidatoStatuses;
use App\Enums\ProfileDocumentStatuses;
use App\Enums\ProfileStatuses;
use App\Mail\NuovaCandidaturaScuolaAdmin;
use App\Mail\NuovaCandidaturaStudenteAdmin;
use App\Models\Alert;
use App\Models\Profile;
use App\Models\ProfileAlert;
use App\Models\ProfileDocument;
use Gecche\FSM\Events\StatusTransitionDone;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class HandleCandidatoStatusTransition
{

    protected $model;
    protected $prevStatusCode;
    protected $statusCode;
    protected $statusData;
    protected $saved;
    protected $params;


    public function handle(StatusTransitionDone $event)
    {


        $this->model = $event->model;
        $this->prevStatusCode = $event->prevStatusCode;
        $this->statusCode = $event->statusCode;
        $this->statusData = $event->statusData;
        $this->saved = $event->saved;
        $this->params = $event->params;

//        $methodName = 'handleTransitionFrom'.Str::studly($event->prevStatusCode).'To'.Str::studly($event->statusCode);
//        if (method_exists($this,$methodName)) {
//            return $this->$methodName();
//        }

        $this->handleTransition();
    }

//    protected function handleTransitionFromValidToInvalid() {
//
//    }
//
//    protected function handleTransitionFromPendingToValid() {
//        $this->handleTransition();;
//    }

    protected function handleTransition()
    {
        $user = $this->model->user;
        if (!$user) {
            return;
        }
        switch ($this->statusCode) {
            case CandidatoStatuses::INVIATA->value:
                $user->sendCandidaturaInviataNotification($this->model);
                if ($this->model->tipo == 'studente') {
                    Mail::to(config('mail.admin-to.address'))->send(new NuovaCandidaturaStudenteAdmin($this->model));
                } else {
                    Mail::to(config('mail.admin-to.address'))->send(new NuovaCandidaturaScuolaAdmin($this->model));
                }
                break;
            case CandidatoStatuses::APPROVATA->value:
                $user->sendCandidaturaApprovataNotification($this->model);
                break;
            default:
                break;
        }

    }

}
