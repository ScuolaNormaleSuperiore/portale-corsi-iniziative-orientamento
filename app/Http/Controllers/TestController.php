<?php

namespace App\Http\Controllers;

use Brevo\Client\Api\AccountApi;
use Brevo\Client\Api\ContactsApi;
use Hofmannsven\Brevo\Facades\Brevo;
class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function test() {

        $brevo = new Brevo();



        $apiInstance = new AccountApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
            null,
            $brevo::getConfiguration()
        );
        $contanctsApiInstance = new ContactsApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
            null,
            $brevo::getConfiguration()
        );

        echo '<pre>';


        try {
//            $result = $apiInstance->getAccount();
//            print_r($result);
            $result = $contanctsApiInstance->getContactsFromList(45);
            print_r($result);
            $result = $contanctsApiInstance->getLists(50);
            print_r($result);
        } catch (\Throwable $e) {
            echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
        }


        echo '</pre>';

    }

}
