<?php


namespace App\Service\User;

use App\Repository\CardmarketRepository;


class CardmarketService implements CardmarketServiceInterface
{
    private $cardmarketRepo;

    public function __construct(CardmarketRepository $cardmarketRepository)
    {
        $this->cardmarketRepo = $cardmarketRepository;
    }

    public function getInfo(string $appToken, string $appSecret, string $accessToken, string $accessSecret)
    {
        return $this->cardmarketRepo->getProfileInfo($appToken, $appSecret, $accessToken, $accessSecret);

    }

}
