<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Brevo\Client\Api\AccountApi;
use Brevo\Client\Api\ContactsApi;
use Brevo\Client\ApiException;
use Brevo\Client\Model\AddContactToList;
use Carbon\Carbon;
use Hofmannsven\Brevo\Facades\Brevo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Vedmant\FeedReader\Facades\FeedReader;
use willvincent\Feeds\Facades\FeedsFacade;

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

    public function test()
    {
        return redirect(RouteServiceProvider::REGISTER_CIE)
            ->with([
                'samlAttributes' => json_encode([
                    'cn' => 'fjkdsfjkds']),
                'nome' => 'GG','cognome' => 'TT',
                'codice_fiscale' => 'TRIETERO545'
            ]);

//        $response = Http::get("https://sns.idp.pp.cineca.it/idp/shibboleth");
//
//        print_r($response->body());
//
//        File::put(base_path('cineca-pp-metadata.xml'),$response->body());
//        return;

//        $f = FeedReader::read('https://normalenews.sns.it/feed-highlights.xml');

        $f = FeedsFacade::make('https://normalenews.sns.it/feed-highlights.xml', 3, true);
//        $data = array(
//            'title'     => $feed->get_title(),
//            'permalink' => $feed->get_permalink(),
//            'items'     => $feed->get_items(),
//        );

        echo '<pre>';

//        echo count($f->get_items()) . "<br/>";


        $response = Arr::get(Arr::get(Arr::get($f->data, 'child', []), "", []), 'response', []);
        $items = Arr::get(Arr::get(Arr::get(Arr::get($response, 0, []), "child", []), "", []), 'item', []);

        $news = [];

        foreach ($items as $item) {
            $itemData = Arr::get(Arr::get($item, 'child', []), "", []);

            $singleNews = [];

            $singleNews['title'] = html_entity_decode(Arr::get(Arr::get(Arr::get($itemData, 'title', []), 0, []), 'data'));
            $singleNews['link'] = Arr::get(Arr::get(Arr::get($itemData, 'link', []), 0, []), 'data');
            $singleNews['date'] = Carbon::parse(Arr::get(Arr::get(Arr::get($itemData, 'pubDate', []), 0, []), 'data'))->toDateTimeString();
            $singleNews['media'] = Arr::get(Arr::get(Arr::get($itemData, 'media', []), 0, []), 'data');

            $news[] = $singleNews;
            if (count($news) >= 3) {
                break;
            }
        }

//        print_r($f->data);
//        foreach ($f->get_items() as $k => $item) {
//            echo "-------<br/>";
//            echo "-------<br/>";
//            echo "-------<br/>";
//            echo $k . '/' . count($f->get_items()) . "<br/>";
//            print_r($item->get_title());
//            echo "-------<br/>";
//            print_r($item->get_permalink());
//            echo "-------<br/>";
//            print_r($item->data);
//            echo "-------<br/>";
//            echo "-------<br/>";
//            echo "-------<br/>";
//            echo "-------<br/>";
//            echo "-------<br/>";
//            echo "-------<br/>";
////            print_r($item->get_image_url());
////            print_r($item->get_image_link());
////            print_r($item->get_image_title());
//
////            break;
//
//        }


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


    public function newsletter(Request $request)
    {


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

        $identifier = "giacomo.terreni@gmail.com";
        $list = 63;
        $templateId = 516;


        $action = $request->get("action");

        echo '<pre>';

        try {

            $jsonResult = [];
            switch ($action) {
                case 'info':
                    $jsonResult = $contanctsApiInstance->getContactInfo($identifier);
                    break;

                case 'add':
                    $contact = new \Brevo\Client\Model\CreateContact();
                    $contact->setEmail($identifier);
                    $contact->setListIds([$list]);
                    $jsonResult = $contanctsApiInstance->createContact($contact);
                    break;


                case 'doi':
                    $contact = new \Brevo\Client\Model\CreateDoiContact();
                    $contact->setEmail($identifier);
                    $contact->setIncludeListIds([$list]);
                    $contact->setTemplateId($templateId);
                    $contact->setRedirectionUrl( route('fe-index').'?newsletterconfirmed=1');

                    $contanctsApiInstance->createDoiContact($contact);
                    $jsonResult = [];

                    break;
                case 'deletecontact':
                    $contanctsApiInstance->deleteContact($identifier);
                    $jsonResult = [];
                    break;
                case 'deletefromlist':
                    $contactEmails = new \Brevo\Client\Model\RemoveContactFromList(['emails' => [$identifier]]); // \Brevo\Client\Model\RemoveContactFromList | Emails addresses OR IDs of the contacts

                    $jsonResult = $contanctsApiInstance->removeContactFromList($list, $contactEmails);
                    break;
                case 'list':
                    $jsonResult = $contanctsApiInstance->getContactsFromList($list);
                    break;
                default:
                    $jsonResult = ["nessuna azione"];
                    break;
            }
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }

            print_r($jsonResult);


        echo "<pre/>";


        return;
        try {
            if ($result->getId()) {
                $lists = $result->getListIds();
                if (in_array($list, $lists)) {
                    echo "Contact already in list";
                } else {
                    $identifier = $result->getId();
                    $contact = new AddContactToList(['ids' => [$identifier]]);
                    $result = $contanctsApiInstance->addContactToList(63, $contact);
                    print_r($result);
                }
            } else {
                $contact = new \Brevo\Client\Model\CreateContact();
                $contact->setEmail($identifier);
                $contact->setListIds([63]);
                $result = $contanctsApiInstance->createContact($contact);
                print_r($result);

            }

            $result = $contanctsApiInstance->getLists(50);
            $result = $contanctsApiInstance->getContactsFromList(63);
            print_r($result);
//            $contanctsApiInstance->deleteContact("giacomo.terreni@gmail.com");
//            $result = $contanctsApiInstance->getContactInfo("giacomo.terreni@gmail.com");
//            print_r($result);
        } catch (ApiException $e) {
            Log::info('BREVO API Exception');
            Log::info($e->getMessage());
            Log::info($e->getCode());
        } catch (\Throwable $e) {
            Log::info('BREVO API Exception -- OTHER ERROR');
            Log::info($e->getMessage());
        }


        echo '</pre>';
    }

}
