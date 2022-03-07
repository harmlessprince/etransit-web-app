<?php
/**
 * Created by Olawuyi.
 * Date: 10/11/21
 * Time: 11:15 PM
 */

namespace App\Classes;


class ReturnUUIDTracker
{
    public static function generate()
    {
        $no = (string)random_int(000000000000000, 999999999999999);

        if (strlen($no) != 15) {
            return self::generateTrnxRef();
        }

        if (\App\Models\Schedule::where('return_uuid_tracker', $no)->count() > 0) {
            return self::generateTrnxRef();
        }

        return $no;
    }
}
