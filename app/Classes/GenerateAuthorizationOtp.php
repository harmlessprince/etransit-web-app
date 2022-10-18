<?php
/**
 * Created by Olawuyi.
 * Date: 16/08/22
 * Time: 7:51 PM
 */

namespace App\Classes;


class GenerateAuthorizationOtp
{
    public static function generate()
    {
        $no = (string)random_int(0000, 9999);
        $no = "$no";

        if (strlen($no) != 4) {
            return self::generate();
        }

        if (\App\Models\UserTrustee::where('code', $no)->count() > 0) {
            return self::generate();
        }

        return $no;
    }
}
