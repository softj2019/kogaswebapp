<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-12
 * Time: 오후 5:58
 */

class Kgpbt  extends CI_Controller
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

    }
    public function writeform()
    {
        $data=Array();
		//사용자 정보


		$data['page_title']="";
		$data['page_sub_title']="";
		$data['menu_code']="003";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('main/index');
		$config['total_rows'] = $this->common->select_count('kgart','','');
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];

		//기본목록
		$data["list"]= $this->common->select_list_table_result('kgart',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='',$like='',$joina='',$joinb='',$limit);
		$like=array(
			'key1_cd','2','after'
		);

		$data["listKey1"]= $this->common->select_list_table_result('kgloc',$sql='distinct key1_cd,key1_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='',$like,$joina='',$joinb='','');
//		$data['footerScript']="/assets/dist/js/chart/defaultChart.js";
		$this->load->view('layout/header',$data);
        $this->load->view('kgpbt/writeform',$data);
		$this->load->view('layout/footer',$data);
    }
    public function ajaxMultiSelect(){
		header('Content-type: application/json');
//		$data["kgpbtList1"]= $this->common->select_list_table_result('kgloc',$sql='distinct key1_cd,key1_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='','',$joina='',$joinb='','');
		echo json_encode('123');
	}
}
