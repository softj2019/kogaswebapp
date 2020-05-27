<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-04
 * Time: 오후 9:08
 */
defined('BASEPATH') OR exit('No direct script access allowed');
$config['full_tag_open']='<ul class="pagination justify-content-center">';
$config['full_tag_close']='</ul>';
//        $config['first_tag_open'] = '';
//        $config['first_tag_close'] = '';
$config['last_link']='<i class="fas fa-angle-double-right"></i>';

$config['cur_tag_open'] = '<li class="page-item active"><strong class="page-link">';
$config['cur_tag_close'] = '</strong></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

$config['next_link'] = '<i class="fas fa-angle-right"></i>';
$config['prev_link'] = '<i class="fas fa-angle-left"></i>';
$config['num_links'] = 9;
