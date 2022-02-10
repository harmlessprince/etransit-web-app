<?php
/**
 * Created by Olawuyi.
 * Date: 07/02/22
 * Time: 11:15 AM
 */

namespace App\Classes;


class VerificationToken
{
    public static function generate()
    {
        $no = (string)random_int(0000, 9999);
        $no = "$no";

        if (strlen($no) != 4) {
            return self::generate();
        }

        if (\App\Models\User::where('verification_token', $no)->count() > 0) {
            return self::generate();
        }

        return $no;
    }
}
