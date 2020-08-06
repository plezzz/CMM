<?php


namespace App\Service\User;


class AvatarService implements AvatarServiceInterface
{
    private $link = 'https://www.gravatar.com/avatar/';

    function getAvatar($email):string
    {
        $email = trim($email); // "MyEmailAddress@example.com"
        $email = strtolower($email); // "myemailaddress@example.com"
        $hash = md5($email);
        $url = $this->link . $hash;
        return $url;
    }
}

