<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * controllers global function
 *
 * @param $str
 * @param $find
 * @param $n
 * @return bool|int
 */
function str_n_pos($str,$find,$n) {
    $pos_val = 0;
    for ($i=1;$i<=$n;$i++){
        $pos = strpos($str,$find);
        $str = substr($str,$pos+1);
        $pos_val=$pos+$pos_val+1;
    }
    return $pos_val-1;
}

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
