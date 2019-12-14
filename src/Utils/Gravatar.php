<?php

namespace App\Utils;


class Gravatar
{
    private $url = 'https://www.gravatar.com';

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public function getAvatar($email, $s = 80, $d = 'mm', $r = 'g'): string
    {
        return sprintf('%s/avatar/%s?s=%s&d=%s&r=%s', $this->url, md5(strtolower(trim($email))), $s, $d, $r);
    }

    public function getBackground($email): ?string
    {
        try {
            $profile = $this->getProfile($email);
            return $profile['profileBackground']['url'];
        } catch (\Throwable $e) {
            return null;
        }
    }


    public function getProfile($email): ?Array
    {
        $str = file_get_contents(sprintf('%s/%s.php', $this->url, md5(strtolower(trim($email)))));
        $profile = unserialize($str);

        if (is_array($profile) && isset($profile['entry']))
            return $profile['entry'][0];
    }

    public function isProfile($email)
    {
        try {
            $this->getProfile($email);
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}