<?php


namespace App\Service\User;


interface AvatarServiceInterface
{
    public function getAvatar($email): string;
}
