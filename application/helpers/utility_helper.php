<?php
/**
 * Created by PhpStorm.
 * User: ttagg
 * Date: 2019-10-01
 * Time: 오후 12:26
 */


defined('BASEPATH') OR exit('No direct script access allowed');



function assets_url() {

    return base_url() . 'assets/';

}
function random($min, $max, $num) {
    $arr = array();
    while ($num > count($arr)) {
        $i = rand($min, $max);
        $arr[$i] = $i;
    }

    return $arr;
}


?>
