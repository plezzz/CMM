<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\User\AvatarServiceInterface;
use App\Service\User\CardmarketServiceInterface;

class UserController extends AbstractController
{
    private $avatarService;
    private $cardmarketService;

    public function __construct(AvatarServiceInterface $avatarService,
                                CardmarketServiceInterface $cardmarketService)
    {
        $this->avatarService = $avatarService;
        $this->cardmarketService = $cardmarketService;
    }

    /**
     * @Route("/profile", name="current_profile")
     *
     */
    public function currentUserProfile()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $avatar = $this->avatarService->getAvatar($user->getEmail());
        $decoded = $this->cardmarketService->getInfo($user->getCmAppToken(), $user->getCmAppSecret(), $user->getCmAccessToken(), $user->getCmAccessSecret());
var_dump(uniqid());

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'avatar' => $avatar,
            'cardmarket' => $decoded,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profile/{user}", name="profile")
     */
    public function userProfile(string $user)
    {
        print_r($user);


        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
