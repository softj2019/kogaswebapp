<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-12
 * Time: 오후 5:58
 */

class Kgrct  extends CI_Controller
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
//		if(!@$this->session->userdata('logged_in')) {
//            modal_alert('로그인 후 이용가능합니다.','member/login',$this);
//			redirect('member/login');
//		}else{
//			if(!@$this->session->userdata('is_admin')) {
//				modal_alert('접근권한이 없습니다..','main',$this);
//			}else{
			if (method_exists($this, $method)) {
				$this->{"{$method}"}();
			}
//			}
//		}

    }
	public function kgrctlist()
	{
		$data=Array();
		//사용자 정보


		$data['page_title']="분석 결과 조회";
		$data['page_sub_title']="";
		$data['menu_code']="008";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('kgrct/kgrctlist');
		$config['total_rows'] = $this->common->select_count('kgartpbtview','','');
		$config['per_page'] = 5;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];


		//기본목록
		$sql="" .
			"TB.*," .
//			"(select distinct Z.key1_nm from kgloc Z where Z.key1_cd = TB.key1_cd) as key1_nm," .
//			"(select Z.key3_cd from kgpbt Z where Z.key3_cd = TB.key3_cd) as key3_nm," .
//			"(select Z.htm4 from kgrct Z where Z.ar_cd = TB.ar_cd) as htm4" .
			"";
		$order_by=array('key'=>'ar_time','value'=>'desc');
		$data["list"]= $this->common->select_list_table_result('kgartpbtview TB',$sql,$where='',$coding=false,$order_by,$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);

		$this->load->view('layout/header',$data);
		$this->load->view('kgrct/kgrctlist',$data);
		$this->load->view('layout/footer',$data);
	}

}
