<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-10-09
 * Time: 오후 8:47
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('alert_main')) {
    function alert_main($msg) {
        $baseURL = 'base_url';

        echo <<< HTML
                <script type="text/javascript">
                    alert('{$msg}');
                    window.location = "{$baseURL()}";
                </script>
HTML;
    }
}

if(!function_exists('alert')) {
    function alert($msg,$url) {
        $site_url=base_url();
        echo <<< HTML
                <script type="text/javascript">
                    var msg ="{$msg}"
                    var site_url = "{$site_url}";
                    var url="{$url}";
                    alert(msg);               
                    window.location = site_url + url;
                </script>

HTML;
    }

    if(!function_exists('modal_alert')) {
        function modal_alert($msg,$target_url,$rq_this)
        {
            $data = array(
                'message' => $msg,
                'target_url' => $target_url
            );
            $rq_this->load->view('layout/modal', $data);
        }
    }

}