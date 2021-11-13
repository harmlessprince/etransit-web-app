<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */

namespace App\Classes;

class Reference
{
    public static function generateTrnxRef()
    {
        $no = (string)random_int(00000000, 99999999);
        $no = "ETZ-$no";

        if (strlen($no) != 12) {
            return self::generateTrnxRef();
        }

        if (\App\Models\Transaction::where('reference', $no)->count() > 0) {
            return self::generateTrnxRef();
        }

        return $no;
    }

}








