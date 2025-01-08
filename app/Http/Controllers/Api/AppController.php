<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\JsonControllerTrait;
use App\Models\Corso;
use App\Models\Iniziativa;
use App\Models\Scuola;
use Brevo\Client\Api\AccountApi;
use Brevo\Client\Api\ContactsApi;
use Brevo\Client\ApiException;
use Brevo\Client\Model\AddContactToList;
use Egulias\EmailValidator\Result\ValidEmail;
use Hofmannsven\Brevo\Facades\Brevo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AppController extends Controller
{

    use JsonControllerTrait;

    public function getIniziativaCorsi(Iniziativa $iniziativa)
    {

        $corso = new Corso();

        $corsiList = $corso->getForSelectList($corso->where('iniziativa_id', $iniziativa->getKey()));

        $result = [
            'options' => $corsiList,
            'options_order' => array_keys($corsiList),
        ];

        return $this->_result($result);
    }

    public function getScuoleAutocomplete(Request $request)
    {


        $nItems = $request->get('nItems', 50);

        $value = $request->get('value');

        $searchFields = ['denominazione'];
        $resultFields = [
            'denominazione', 'codice', 'email_riferimento',
            'tipologia_grado_istruzione',
            'indirizzo',
            'cap',
            'comune',
        ];
        $appends = ['provincia_sigla'];


        $autocompleteResult = Scuola::autoComplete($value, $searchFields, $resultFields, $nItems, null, $appends);

//        $options = [];
//        foreach ($autocompleteResult as $scuola) {
//            $options[$scuola['id']] = $scuola['denominazione'] . ' (' . $scuola['provincia_sigla'] . ') - Cod:' . $scuola['codice'];
//        }

        $result = $autocompleteResult;

        return $this->_result($result);
    }

    public function newsletterAdd(Request $request)
    {

        $email = $request->get('email');

        if (!$this->validate($request, ['email' => 'required|email'])) {
            return $this->_errorAndExit("Indirizzo email non valido", 400);
        }


        $brevo = new Brevo();


        $contanctsApiInstance = new ContactsApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
            null,
            $brevo::getConfiguration()
        );


        $list = intval(env("BREVO_LIST_ID", -1));

        try {

            try {
                $result = $contanctsApiInstance->getContactInfo($email);
                $identifier = $result->getId();
            } catch (ApiException $e) {
//                Log::info("BREVO CONTACT INFO::: " . $e->getCode());
                $eBody = json_decode($e->getResponseBody(), true);
                if (Arr::get($eBody, 'code') != 'document_not_found') {
                    throw $e;
                }
                $contact = new \Brevo\Client\Model\CreateContact();
                $contact->setEmail($email);
                $contact->setListIds([$list]);
                $contanctsApiInstance->createContact($contact);
                return $this->_result(null);
            }

            $lists = $result->getListIds();
            if (in_array($list, $lists)) {
                return $this->_errorAndExit("Indirizzo email già presente", 400);
            }
            $contact = new AddContactToList(['ids' => [$identifier]]);
            $contanctsApiInstance->addContactToList($list, $contact);

        } catch (ApiException $e) {
            Log::info('BREVO API Exception');
            Log::info($e->getMessage());
            Log::info($e->getCode());
            return $this->_errorAndExit("Problemi ad aggiungere l'indirizzo email. Si prega di riprovare,", 400);
        } catch (\Throwable $e) {
            Log::info('BREVO API Exception -- OTHER ERROR');
            Log::info($e->getMessage());
            Log::info($e->getTraceAsString());
            return $this->_errorAndExit("Problemi ad aggiungere l'indirizzo email. Si prega di riprovare,", 400);
        }


        return $this->_result(null);

    }

}
