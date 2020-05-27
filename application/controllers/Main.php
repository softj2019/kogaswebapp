<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-12
 * Time: 오후 5:58
 */

class Main  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //모델로드
//        $this->load->model('admin_plan');
//        $this->load->model('admin_member');
//        $this->load->model('kgart_model');
		$this->load->model('common');
        //CSRF 방지
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('array');
		$this->load->helper('alert');
		$this->load->library('pagination');



    }
    public function _remap($method)
    {
        $data=Array();

        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
        $this->load->view('layout/footer',$data);
    }
    public function index()
    {
        $data=Array();
		//사용자 정보


//		$data['page_title']=$this->lang->line('fee_history');
//		$data['page_sub_title']="";
//        $data['page_css_style']="fee.css";
		$data['menu_code']="001";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));
		$where=array(
//			'cc.paid_fee_uid'=>$user_data->uid,
		);
		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('main/index');
		$config['total_rows'] = $this->common->select_count('kgart','',$where);
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];
		//CONCAT(z.fee_group_first_rate,'/',z.fee_group_payment_rate,'/',z.fee_group_play_rate)


//		$data["list"]= $this->common->select_list_table('kgart','','',$coding=false,'');
		$data["list"]= $this->common->select_list_table_result('kgart',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='',$like='',$joina='',$joinb='',$limit);
		$this->load->view('layout/header',$data);
        $this->load->view('main/index',$data);
    }
}
