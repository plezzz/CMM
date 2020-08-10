<?php

namespace App\Repository;

class CardmarketServiceRepository
{
    private $link;
    private $version;
    private $signatureMethod;
    private $time;
    private $nonce;

    public function __construct(string $link, string $version, string $signatureMethod, string $time, string $nonce)
    {
        $this->link = $link;
        $this->version = $version;
        $this->signatureMethod = $signatureMethod;
        $this->time = $time;
        $this->nonce = $nonce;
    }

    /**
     * Gather all parameters that need to be included in the Authorization header and are know yet
     *
     * Attention: If you have query parameters, they MUST also be part of this array!
     *
     * @param $url
     * @param $appToken
     * @param $accessToken
     * @return array
     */
    public function getParam($url, $appToken, $accessToken): array
    {
        return array(
            'realm' => $url,
            'oauth_consumer_key' => $appToken,
            'oauth_token' => $accessToken,
            'oauth_nonce' => $this->nonce,
            'oauth_timestamp' => $this->time,
            'oauth_signature_method' => $this->signatureMethod,
            'oauth_version' => $this->version,
        );
    }

    /**
     * Gather, encode, and sort the base string parameters
     * @param $params
     * @return array
     */
    public function encodeParams($params): array
    {
        $encodedParams = array();
        foreach ($params as $key => $value) {
            if ("realm" != $key) {
                $encodedParams[rawurlencode($key)] = rawurlencode($value);
            }
        }
        ksort($encodedParams);
        return $encodedParams;
    }

    /**
     * Get the cURL handler from the library function
     * @param $url
     * @param $header
     * @return string
     */
    public function getRequest($url, $header): string
    {

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
        //$info = curl_getinfo($curlHandle);
        curl_close($curlHandle);
        return $content;
    }

    /**
     * Create the OAuth signature
     * Attention: Make sure to provide the binary data to the Base64 encoder
     *
     *
     * @param $appSecret
     * @param $accessSecret
     * @param $baseString
     * @return string
     */
    public function oAuthSignature($appSecret, $accessSecret, $baseString): string
    {

        /*
         * Create the signingKey
         */
        $signatureKey = rawurlencode($appSecret) . "&" . rawurlencode($accessSecret);

        $rawSignature = hash_hmac("sha1", $baseString, $signatureKey, true);
        return base64_encode($rawSignature);
    }

    /**
     * @param $params
     * @return string
     */
    public function constructHeader($params): string
    {
        /*
        * Construct the header string
        */
        $header = "Authorization: OAuth ";
        $headerParams = array();
        foreach ($params as $key => $value) {
            $headerParams[] = $key . "=\"" . $value . "\"";
        }
        $header .= implode(", ", $headerParams);
        return $header;
    }

    /**
     * Start composing the base string from the method and request URI
     *
     * Attention: If you have query parameters, don't include them in the URI
     * @param $method
     * @param $url
     * @param $params
     * @return string
     */
    public function composingBaseString($method, $url, $params): string
    {

        $baseString = strtoupper($method) . "&";
        $baseString .= rawurlencode($url) . "&";

        $encodedParams = $this->encodeParams($params);
        /*
         * Expand the base string by the encoded parameter=value pairs
         */
        $values = array();
        foreach ($encodedParams as $key => $value) {
            $values[] = $key . "=" . $value;
        }
        $paramsString = rawurlencode(implode("&", $values));
        $baseString .= $paramsString;
        return $baseString;
    }

    /**
     * @param array $credentials
     * @param string $method
     * @param string $target
     * @return mixed
     */
    public function output(array $credentials, string $method, string $target)
    {
        $url = $this->link . $target;
        $params = $this->getParam($url, $credentials['appToken'], $credentials['accessToken']);
        $baseString = $this->composingBaseString($method, $url, $params);
        $oAuthSignature = $this->oAuthSignature($credentials['appSecret'], $credentials['accessSecret'], $baseString);
        $params['oauth_signature'] = $oAuthSignature;
        $header = $this->constructHeader($params);
        $content = $this->getRequest($url, $header);
        return json_decode($content, true);
    }

}