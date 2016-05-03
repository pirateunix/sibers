<?php
/**
 * Created by PhpStorm.
 * User: pirate
 * Date: 05.03.16
 * Time: 9:15
 */

namespace AppBundle\Services;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class Md5Encoder implements PasswordEncoderInterface
{

    public function __construct()
    {
    }

    public function encodePassword($raw, $salt)
    {
        return md5($raw . $salt);

    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return md5($raw . $salt) == $encoded;

    }

}