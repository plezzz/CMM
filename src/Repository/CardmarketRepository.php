<?php


namespace App\Repository;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class CardmarketRepository
{
    private $client;
    private $time;
    private $nonce;
    private $signatureMethod;
    private $link;
    private $version;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->time = strval(time());
        $this->nonce = uniqid();
        $this->version = "1.0";
        $this->link = 'https://api.cardmarket.com/ws/v2.0/';
        $this->signatureMethod = "HMAC-SHA1";

    }

    public function getProfileInfo(string $appToken, string $appSecret, string $accessToken, string $accessSecret)
    {

//        $response = $this->client->request(
//            'GET',
//            'https://api.github.com/repos/symfony/symfony-docs'
//        );
//
//        $statusCode = $response->getStatusCode();
//        // $statusCode = 200
//        $contentType = $response->getHeaders()['content-type'][0];
//        // $contentType = 'application/json'
//        $content = $response->getContent();
//        // $content = '{"id":521583, "name":"symfony-docs", ...}'
//        $content = $response->toArray();
//        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
//
//        return $content;

        $timestamp = $this->time;
        $nonce = $this->nonce;
        $signatureMethod = $this->signatureMethod;
        $link = $this->link;
        $method = "GET";
        $url = $link . "account";
        $version = $this->version;

        /**
         * Gather all parameters that need to be included in the Authorization header and are know yet
         *
         * Attention: If you have query parameters, they MUST also be part of this array!
         *
         * @var $params array|string[] Associative array of all needed authorization header parameters
         */
        $params = array(
            'realm' => $url,
            'oauth_consumer_key' => $appToken,
            'oauth_token' => $accessToken,
            'oauth_nonce' => $nonce,
            'oauth_timestamp' => $timestamp,
            'oauth_signature_method' => $signatureMethod,
            'oauth_version' => $version,
        );

        /**
         * Start composing the base string from the method and request URI
         *
         * Attention: If you have query parameters, don't include them in the URI
         *
         * @var $baseString string Finally the encoded base string for that request, that needs to be signed
         */
        $baseString = strtoupper($method) . "&";
        $baseString .= rawurlencode($url) . "&";

        /*
         * Gather, encode, and sort the base string parameters
         */
        $encodedParams = array();
        foreach ($params as $key => $value) {
            if ("realm" != $key) {
                $encodedParams[rawurlencode($key)] = rawurlencode($value);
            }
        }
        ksort($encodedParams);

        /*
         * Expand the base string by the encoded parameter=value pairs
         */
        $values = array();
        foreach ($encodedParams as $key => $value) {
            $values[] = $key . "=" . $value;
        }
        $paramsString = rawurlencode(implode("&", $values));
        $baseString .= $paramsString;

        /*
         * Create the signingKey
         */
        $signatureKey = rawurlencode($appSecret) . "&" . rawurlencode($accessSecret);

        /**
         * Create the OAuth signature
         * Attention: Make sure to provide the binary data to the Base64 encoder
         *
         * @var $oAuthSignature string OAuth signature value
         */
        $rawSignature = hash_hmac("sha1", $baseString, $signatureKey, true);
        $oAuthSignature = base64_encode($rawSignature);

        /*
         * Include the OAuth signature parameter in the header parameters array
         */
        $params['oauth_signature'] = $oAuthSignature;

        /*
         * Construct the header string
         */
        $header = "Authorization: OAuth ";
        $headerParams = array();
        foreach ($params as $key => $value) {
            $headerParams[] = $key . "=\"" . $value . "\"";
        }
        $header .= implode(", ", $headerParams);

        /*
         * Get the cURL handler from the library function
         */
        $curlHandle = curl_init();

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
        $content = curl_exec($curlHandle);
        $info = curl_getinfo($curlHandle);
        curl_close($curlHandle);

        /*
         * Convert the response string into an object
         *
         * If you have chosen XML as response format (which is standard) use simplexml_load_string
         * If you have chosen JSON as response format use json_decode
         *
         * @var $decoded \SimpleXMLElement|\stdClass Converted Object (XML|JSON)
         */
        // $decoded            = json_decode($content);
        return simplexml_load_string($content);

    }

}
