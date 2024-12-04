<?php


namespace App\Helpers;

class UuidHelper
{
    public static function generateObjectId()
    {
        return bin2hex(random_bytes(12));
    }
}
