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

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('main/index');
		$config['total_rows'] = $this->common->select_count('kgart','','');
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];
		//CONCAT(z.fee_group_first_rate,'/',z.fee_group_payment_rate,'/',z.fee_group_play_rate)


//		$data["list"]= $this->common->select_list_table('kgart','','',$coding=false,'');
		//기본목록
		$data["list"]= $this->common->select_list_table_result('kgart',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='',$like='',$joina='',$joinb='',$limit);
//		$where=array(
//			'code_name'=>'is not null',
//		);


		$data['footerScript']="/assets/dist/js/chart/defaultChart.js";
		$this->load->view('layout/header',$data);
        $this->load->view('main/index',$data);
		$this->load->view('layout/footer',$data);
    }

    public function mainAjaxCall(){
		//값이 정확해서 폼체크 안해도
		header('Content-type: application/json');


		//해당 년도 고장모드 비율
		$data["listA"]=$this->common->select_list_table_result('' .
			'(select (select num_nm from kgcod where num_cd = break_cd) code_name,' .
			'count(*) as cnt ' .
			'from kgdata ' .
			'WHERE sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() ' .
			'group by break_cd) A',
			$sql='','code_name is not null',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='',$like='',$joina='',$joinb='','');
		//해당 년도 고장원인 비율
		$data["listB"]=$this->common->select_list_table_result('' .
			'(select (select num_nm from kgcod where num_cd = cause_cd) code_name,' .
			'count(*) as cnt ' .
			'from kgdata ' .
			'WHERE sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() ' .
			'group by cause_cd) A',
			$sql='','code_name is not null',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='',$like='',$joina='',$joinb='','');
		//해당 년도 고장조치 비율
		$data["listC"]=$this->common->select_list_table_result(
			'(select (select num_nm from kgcod where num_cd = action_cd) code_name,' .
			'count(*) as cnt ' .
			'from kgdata ' .
			'WHERE sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() ' .
			'group by action_cd) A',
			$sql='','code_name is not null',$coding=false,$order_by='',$group_by='',$where_in_key='',$where_in_array='',$like='',$joina='',$joinb='','');

		if(@$data["listA"]) {
			$data["listAarr"]="[";
			foreach ($data["listA"] as $row) {
				$data["listAarr"] .= '\''.$row->code_name.'\'';
				if (next($data["listA"])==true) $data["listAarr"] .= ",";
			}
			$data["listAarr"].="]";

			$data["listAlabelsArr"]="[";
			foreach ($data["listA"] as $row) {
				$data["listAlabelsArr"] .= '\''.$row->cnt.'\'';
				if (next($data["listA"])==true) $data["listAlabelsArr"] .= ",";
			}
			$data["listAlabelsArr"].="]";
		}
		if(@$data["listB"]) {
			$data["listBarr"]="[";
			foreach ($data["listB"] as $key=>$row) {
				$data["listBarr"] .= '\''.$row->code_name.'\'';
				if (next($data["listB"])==true) $data["listBarr"] .= ",";
			}
			$data["listBlabelsArr"]="[";
			foreach ($data["listB"] as $row) {
				$data["listBlabelsArr"] .= '\''.$row->cnt.'\'';
				if (next($data["listB"])==true) $data["listBlabelsArr"] .= ",";
			}
			$data["listBlabelsArr"].="]";
		}
		if(@$data["listC"]) {
			$data["listCarr"]="[";
			foreach ($data["listC"] as $key=>$row) {
				$data["listCarr"] .= '\''.$row->code_name.'\'';
				if (next($data["listC"])==true) $data["listCarr"] .= ",";
			}

			$data["listClabelsArr"]="[";
			foreach ($data["listC"] as $row) {
				$data["listClabelsArr"] .= '\''.$row->cnt.'\'';
				if (next($data["listC"])==true) $data["listClabelsArr"] .= ",";
			}
			$data["listClabelsArr"].="]";
		}
		echo json_encode($data);
	}
}
