<?php


namespace App\Repository;

class CardmarketRepository extends CardmarketServiceRepository
{
    private const link = 'https://api.cardmarket.com/ws/v2.0/output.json/';
    private const version = "1.0";
    private const signatureMethod = "HMAC-SHA1";


    public function __construct()
    {
      parent::__construct(self::link,self::version,self::signatureMethod,strval(time()),uniqid());
    }

    /**
     * @param array $credentials
     * @param string $target
     * @return mixed
     */
    public function getInfo(array $credentials, string $target)
    {
        $method = "GET";
        return $this->output($credentials, $method,$target);
    }
}
