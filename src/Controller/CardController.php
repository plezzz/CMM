<?php

namespace App\Controller;

use App\Entity\Price;
use DateTimeInterface;
use JsonStreamingParser\Listener\InMemoryListener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use App\Service\Card\CardmarketServiceInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class CardController extends AbstractController
{

    private $normalizer;
    private $cardmarketService;

    public function __construct(NormalizerInterface $normalizer, CardmarketServiceInterface $cardmarketService)
    {
        $this->normalizer = $normalizer;
        $this->cardmarketService = $cardmarketService;
    }

    /**
     * @Route("/card", name="card")
     */
    public function index()
    {
        print_r('opit45<br>');
        $data = $this->cardmarketService->searchProduct();
        print_r($data);

        //        $j = json_encode($plain_string);
//        $k =json_decode($j);
        // $decoded            = simplexml_load_string($plain_string);
//      foreach ($datas as $item => $value){
//          print_r($item);
//              echo "<br>";
//          print_r($value);
//          echo '<br>';
//      }

        //  $plain_string = [1, 2, 3];
        // file_put_contents('111.json', $plain_string);
        //print_r($plain_string);


        //file_put_contents('111',$cardFile['productsfile']);
        // print_r($cardFile['mime']);
        // var_dump($cardFile);
        //  $uncompressed = gzuncompress($cardFile['productsfile']);
        // print_r($uncompressed);

//        $stream = fopen('/volume1/web/cardmarket11/public/AllPrices.json', 'r');
//        $listener = new InMemoryListener();
//        try {
//            $parser = new \JsonStreamingParser\Parser($stream, $listener);
//            $parser->parse();
//            fclose($stream);
//        } catch (Exception $e) {
//            fclose($stream);
//            throw $e;
//        }
//        var_dump($parser);

//        set_time_limit(300);
//        $listener = new \JsonStreamingParser\Listener\InMemoryListener();
//        $stream = fopen('/volume1/web/cardmarket11/public/AllPrices.json', 'r');
//        try {
//            $parser = new \JsonStreamingParser\Parser($stream, $listener);
//            $parser->parse();
//            fclose($stream);
//        } catch (Exception $e) {
//            fclose($stream);
//            throw $e;
//        }
//        var_dump($listener->getJson());

//        $file = file_get_contents('/volume1/web/cardmarket11/public/AllPrices.json');
//        //$pe = normalizer_normalize($file, 'json');
//        $pr = $this->normalizer->normalize($file,'json');
//        $pt = json_decode($pr,true);
//
//        foreach ($pt['data'] as $card=>$info){
//            print_r($card."<br>");
//            //print_r($info."<br><br>");
//        }


//        $dir = '/volume1/web/cardmarket11/allCards';
//        $files1 = scandir($dir);
//        $files = strval($files1[3]);
//
        $counter = 343;
//        foreach ($files1 as $file){
//    $handle = @fopen("/volume1/web/cardmarket11/allCards/".$file, "r");
//    if ($handle) {
//        while (($buffer = fgets($handle, 4096)) !== false) {
//            echo $buffer;
//        }
//        if (!feof($handle)) {
//            echo "Error: unexpected fgets() fail\n";
//        }
//        fclose($handle);
//    }
//    $counter++;
//}


        // print_r($files1);

        //   var_dump();
        //    $currentFile = fopen("/volume1/web/cardmarket11/allCards/2ED.json",'r');
        //$string = file_get_contents("/volume1/web/cardmarket11/allCards/2ED.json");
//
        //  print_r($currentFile);
        //print_r($string);
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $jsonStream = \JsonMachine\JsonMachine::fromFile("AllPrices.json", "/data" /* <- Json Pointer */);

//        foreach ($jsonStream as $name => $data) {
//            foreach ($data as $datum => $datun) {
//                foreach ($datun as $item => $value) {
//                    foreach ($value as $pesho => $gosho) {
//                        foreach ($gosho as $minka => $penka) {
//                            foreach ($penka as $date => $price) {
//                                $product = new Price();
//                                $product->setUuid($name);
//                                $product->setCardFormat($datum);
//                                $product->setProvider($item);
//                                $product->setPriceType($pesho);
//                                $product->setCardType($minka);
//                                $date = \DateTime::createFromFormat('Y-m-d', $date);
//                                $product->setDate($date);
//                                $product->setPrice($price * 100);
//                                $entityManager->persist($product);
//                                $counter++;
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        $entityManager->flush();
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
            'counter' => $counter,
            // 'list' => $datas
        ]);
    }

    /**
     * @Route("/productlist", name="productlist")
     */
    public function productList()
    {
        //$cardFile = $this->cardmarketService->getProductList();

        //  $decoded = base64_decode($cardFile['productsfile']);
        // $plain_string = gzdecode($decoded);

        $csvPath = '/volume1/web/cardmarket11/public/111.csv';
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $datas = $serializer->decode(file_get_contents($csvPath), 'csv', array(CsvEncoder::DELIMITER_KEY => ','));
        //    print_r($datas);
        return $datas;
    }




    /**
     * @Route("/productlist2", name="productlist2")
     */
    public function productList2()
    {



        $method             = "GET";
        $url                = "https://api.cardmarket.com/ws/v1.1/output.json/products/Springleaf%20Drum/1/1/false";
        $appToken           = "pbZOjCcavHs5E6Aw";
        $appSecret          = "v3AFZmH4yPaYbMmsmrVej4pezJ3Bjmln";
        $accessToken        = "mM23QCRlGAZ11mJhtp1k17hB3wjM9UEU";
        $accessSecret       = "cEQRSZpvxlsViCi1hRz27FVdGugflQxD";
        $nonce              = "53eb1f44909d6";
        $timestamp          = "1407917892";
        $signatureMethod    = "HMAC-SHA1";
        $version            = "1.0";
        $cardname = 'Springleaf%20Drum';

        /**
         * Gather all parameters that need to be included in the Authorization header and are know yet
         *
         * Attention: If you have query parameters, they MUST also be part of this array!
         *
         * @var $params array|string[] Associative array of all needed authorization header parameters
         */
        $params             = array(
            'realm'                     => $url,
            'oauth_consumer_key'        => $appToken,
            'oauth_token'               => $accessToken,
            'oauth_nonce'               => $nonce,
            'oauth_timestamp'           => $timestamp,
            'oauth_signature_method'    => $signatureMethod,
            'oauth_version'             => $version,
        );




        /**
         * Start composing the base string from the method and request URI
         *
         * Attention: If you have query parameters, don't include them in the URI
         *
         * @var $baseString string Finally the encoded base string for that request, that needs to be signed
         */
        $baseString         = strtoupper($method) . "&";
        $baseString        .= rawurlencode($url) . "&";

        /*
         * Gather, encode, and sort the base string parameters
         */
        $encodedParams      = array();
        foreach ($params as $key => $value)
        {
            if ("realm" != $key)
            {
                $encodedParams[rawurlencode($key)] = rawurlencode($value);
            }
        }
        ksort($encodedParams);

        /*
         * Expand the base string by the encoded parameter=value pairs
         */
        $values             = array();
        foreach ($encodedParams as $key => $value)
        {
            $values[] = $key . "=" . $value;
        }
        $paramsString       = rawurlencode(implode("&", $values));
        $baseString        .= $paramsString;

        /*
         * Create the signingKey
         */
        $signatureKey       = rawurlencode($appSecret) . "&" . rawurlencode($accessSecret);

        /**
         * Create the OAuth signature
         * Attention: Make sure to provide the binary data to the Base64 encoder
         *
         * @var $oAuthSignature string OAuth signature value
         */
        $rawSignature       = hash_hmac("sha1", $baseString, $signatureKey, true);
        $oAuthSignature     = base64_encode($rawSignature);

        /*
         * Include the OAuth signature parameter in the header parameters array
         */
        $params['oauth_signature'] = $oAuthSignature;

        /*
         * Construct the header string
         */
        $header             = "Authorization: OAuth ";
        $headerParams       = array();
        foreach ($params as $key => $value)
        {
            $headerParams[] = $key . "=\"" . $value . "\"";
        }

        $header            .= implode(", ", $headerParams);

        /*
         * Get the cURL handler from the library function
         */
        $curlHandle         = curl_init();

        /*
         * Set the required cURL options to successfully fire a request to MKM's API
         *
         * For more information about cURL options refer to PHP's cURL manual:
         * http://php.net/manual/en/function.curl-setopt.php
         */
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);

        /**
         * Execute the request, retrieve information about the request and response, and close the connection
         *
         * @var $content string Response to the request
         * @var $info array Array with information about the last request on the $curlHandle
         */
        $content            = curl_exec($curlHandle);
        $info               = curl_getinfo($curlHandle);
        curl_close($curlHandle);

        /*
         * Convert the response string into an object
         *
         * If you have chosen XML as response format (which is standard) use simplexml_load_string
         * If you have chosen JSON as response format use json_decode
         *
         * @var $decoded \SimpleXMLElement|\stdClass Converted Object (XML|JSON)
         */

        $decoded            = json_decode($content);
        //$decoded            = simplexml_load_string($content);
        print_r($decoded);

        return $this->render('card/testapi.html.twig', [
            'controller_name' => 'CardController',
        ]);

    }
}
