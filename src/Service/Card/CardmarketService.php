<?php


namespace App\Service\Card;

use App\Repository\CardmarketRepository;
use App\Service\User\UserServiceInterface;


class CardmarketService implements CardmarketServiceInterface
{
    /**
     * @var CardmarketRepository
     */
    private $cardmarketRepo;
    private $userService;

    /**
     * CardmarketService constructor.
     * @param CardmarketRepository $cardmarketRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(CardmarketRepository $cardmarketRepository, UserServiceInterface $userService)
    {
        $this->cardmarketRepo = $cardmarketRepository;
        $this->userService = $userService;
    }

    function getCredential()
    {
        $current = $this->userService->currentUser();

        return [
            'appToken' => $current->getCmAppToken(),
            'appSecret' => $current->getCmAppSecret(),
            'accessToken' => $current->getCmAccessToken(),
            'accessSecret' => $current->getCmAccessSecret()
        ];
    }

    /**
     * @return mixed
     */
    public function getProfileInfo()
    {
        $target = 'account';
        return $this->cardmarketRepo->getInfo($this->getCredential(), $target);
    }

    /**
     *
     * @return mixed
     */
    public function getProductList()
    {
        $target = 'productlist';
        return $this->cardmarketRepo->getInfo($this->getCredential(), $target);
    }

    public function searchProduct()
    {
        $target = 'products/find?search=Springleaf&idGame=1&idLanguage=1';
        return $this->cardmarketRepo->getInfo($this->getCredential(), $target);
    }
}