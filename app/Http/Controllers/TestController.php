<?php

namespace App\Http\Controllers;

use Brevo\Client\Api\AccountApi;
use Brevo\Client\Api\ContactsApi;
use Hofmannsven\Brevo\Facades\Brevo;
use Vedmant\FeedReader\Facades\FeedReader;

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


        $f = FeedReader::read('https://normalenews.sns.it/feed-highlights.xml');

        echo '<pre>';

        echo count($f->get_items());
        print_r($f->data);
        foreach ($f->get_items() as $k => $item) {
            echo "-------<br/>";
            echo "-------<br/>";
            echo "-------<br/>";
            echo $k . '/' . count($f->get_items()) . "<br/>";
            print_r($item->get_title());
            echo "-------<br/>";
            print_r($item->get_permalink());
            echo "-------<br/>";
            print_r($item->data);
            echo "-------<br/>";
            echo "-------<br/>";
            echo "-------<br/>";
            echo "-------<br/>";
            echo "-------<br/>";
            echo "-------<br/>";
//            print_r($item->get_image_url());
//            print_r($item->get_image_link());
//            print_r($item->get_image_title());

//            break;

        }



        echo '</pre>';


        return;

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
