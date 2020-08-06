<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\User\AvatarServiceInterface;

class UserController extends AbstractController
{
    private $avatarService;
    public function __construct(AvatarServiceInterface $avatarService)
    {
        $this->avatarService = $avatarService;
    }

    /**
     * @Route("/profile", name="current_profile")
     *
     */
    public function currentUserProfile()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $avatar = $this->avatarService->getAvatar($user->getEmail());



        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'avatar'=>$avatar
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
