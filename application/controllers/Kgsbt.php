<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-12
 * Time: 오후 5:58
 */

class Kgsbt  extends CI_Controller
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


		$data['page_title']="신뢰도 분석 (공급)";
		$data['page_sub_title']="";
		$data['menu_code']="004";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('kgpbt/writeform');
		$config['total_rows'] = $this->common->select_count('kgart','','');
		$config['per_page'] = 7;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];

		$where=array(
			"analysis_type"=>"B",
		);
		//기본목록
		$sql="" .
			"TB.*," .
			"(select Z.key1_nm from kgloc Z where Z.key1_cd = TB.key1_cd) as key1_nm," .
//			"(select Z.key3_cd from kgpbt Z where Z.key3_cd = TB.key3_cd) as key3_nm," .
			"(select Z.htm4 from kgrct Z where Z.ar_cd = TB.ar_cd) as htm4" .
			"";
		$data["list"]= $this->common->select_list_table_result('kgart TB',$sql,$where,$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);
		$like=array(
			'key1_cd','2','after'
		);
		//플랜트 조회
		$data["listKey1"]= $this->common->select_list_table_result('kgloc',$sql='distinct key1_cd,key1_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like,$joina='',$joinb='','');
//		$data['footerScript']="/assets/dist/js/chart/defaultChart.js";

		$data["kgpbtClass1"]= $this->common->select_list_table_result('kgpbt',$sql='distinct key3_cd,key3_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');
		$data["kgcodList"]= $this->common->select_list_table_result('kgcod',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');

		$this->load->view('layout/header',$data);
        $this->load->view('kgpbt/writeform',$data);
		$this->load->view('layout/footer',$data);
    }
    //플랜트 선택 위치 조회
    public function ajaxMultiSelect(){
		header('Content-type: application/json');
		$keyArr = $this->input->post("key1arr");
		$like=array(
			'key1_cd','2','after'
		);
		$where_in = array(
			"key1_cd"=>$keyArr
		);
		$data["localeList"]= $this->common->select_list_table_result('kgloc',$sql='distinct key2_cd,key2_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like,$joina='',$joinb='','');

		echo json_encode($data);
	}
	//1차 분류 선택 2차 조회
	public function ajaxMultiSelectKgpbtFirst(){
		header('Content-type: application/json');
		$keyArr = $this->input->post("key3_cd");


		$where_in = array(
			"key3_cd"=>	$keyArr
		);
		//1차분류는 하나만 선택가능
		if(count($keyArr) > 1){
			//알림 타입 error,info,success,warning,question
			$data["alerts_icon"]="error";
			$data["alerts_title"]="&nbsp;1차 분류는 1개만 선택 가능";
		}else{
			$data["list"]= $result = $this->common->select_list_table_result('kgpbt',$sql='distinct key4_cd,key4_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}
		echo json_encode($data);
	}
	//2차 분류 선택 3차 조회
	public function ajaxMultiSelectKgpbtSecond(){
		header('Content-type: application/json');

		$keyArr = $this->input->post("key3_cd");
		$keyArr2 = $this->input->post("key4_cd");
		$where_in =array(
			"key3_cd"=>	$keyArr,
			"key4_cd"=>	$keyArr2,
		);
		if (in_array("1", $keyArr) || in_array("2", $keyArr) || in_array("3", $keyArr) ) {
			$data["list"]= $this->common->select_list_table_result('kgtag',$sql='distinct key5_cd,key5_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}else{
			$data["list"]= $this->common->select_list_table_result('kgpbt',$sql='distinct key5_cd,key5_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}
		echo json_encode($data);
	}
	//3차 분류 선택 4차 조회
	public function ajaxMultiSelectKgpbtThird(){
		header('Content-type: application/json');
		$keyArr = $this->input->post("key3_cd");
		$keyArr2 = $this->input->post("key4_cd");
		$keyArr3 = $this->input->post("key5_cd");
		$where_in =array(
			"key3_cd"=>	$keyArr,
			"key4_cd"=>	$keyArr2,
			"key5_cd"=>	$keyArr3,
		);
		if (in_array("1", $keyArr) || in_array("2", $keyArr) || in_array("3", $keyArr) ) {
			$data["list"]= $this->common->select_list_table_result('kgtag',$sql='distinct key6_cd,key6_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}else{
			$data["list"]= $this->common->select_list_table_result('kgpbt',$sql='distinct key6_cd,key6_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}


		echo json_encode($data);
	}
	public function htmlViewer(){
		$content = file_get_contents($this->input->post("url"));
		echo $content;
	}
}
