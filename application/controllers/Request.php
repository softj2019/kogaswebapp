<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-13
 * Time: 오전 10:12
 */

class Request extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //모델로드
//        $this->load->model('admin_plan');
//        $this->load->model('admin_member');
//        $this->load->model('common');
        //CSRF 방지
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('array');
    }
    public function _remap($method)
    {
        $data=Array();
        $this->load->view('layout/header',$data);
        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
        $this->load->view('layout/footer',$data);
    }
    public function index()
    {
        $data=Array();
        $this->form_validation->set_rules('password_proc', '비밀번호 확인', 'required|matches[password]');

        /*이메일 중복 체크*/
        $result = $this->auth_member->email_duplicate($this->input->post('email', TRUE));


        if ($this->form_validation->run() == TRUE) {

        }
        redirect('/');
    }
}