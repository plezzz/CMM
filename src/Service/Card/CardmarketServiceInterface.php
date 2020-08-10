<?php


namespace App\Service\Card;


interface CardmarketServiceInterface
{
    public function getProfileInfo();

    public function getProductList();

    public function searchProduct();
}
