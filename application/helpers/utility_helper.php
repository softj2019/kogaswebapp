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
function execCmdRun($exec){
	$output = "";
	$return="";
	$outExecArray = exec($exec, $output,$return);
	return $outExecArray;
}
function file_get_contents_utf8($contentData,$to_encoding='UTF-8',$encoding_list='UTF-8, ISO-8859-1') {
	$content = file_get_contents($contentData);
	return
		mb_convert_encoding($content, $to_encoding,
		mb_detect_encoding($content, $encoding_list, true));
}
?>
