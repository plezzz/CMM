<?php


namespace App\Service\User;


interface CardmarketServiceInterface
{
    public function getInfo(string $appToken, string $appSecret, string $accessToken, string $accessSecret);
}
