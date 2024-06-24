<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-12
 * Time: 오후 5:58
 */

class Kgbasicpbt  extends CI_Controller
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
		if(!@$this->session->userdata('logged_in')) {
//            modal_alert('로그인 후 이용가능합니다.','member/login',$this);
			redirect('member/login');
		}else{
//			if(!@$this->session->userdata('is_admin')) {
//				modal_alert('접근권한이 없습니다..','main',$this);
//			}else{
			if (method_exists($this, $method)) {
				$this->{"{$method}"}();
			}
//			}
		}

	}
	public function writeform()
	{
		$data=Array();

		$data['page_title']="기초 통계 분석 (생산)";
		$data['page_sub_title']="";
		$data['menu_code']="005";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('kgbasicpbt/writeform');

		//사용자 정보
		$user_id = @$this->session->userdata('user_id');
		$config['total_rows'] = $this->common->select_count('(select * from kgartPbtView where analysis_type = \'A\''.
		                                                    'and user_id = (select name from kguse where id = \''.$user_id.'\')) TB','','');
		$config['per_page'] = 5;

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
//			"(select distinct Z.key1_nm from kgloc Z where Z.key1_cd = TB.key1_cd) as key1_nm," .
//			"(select Z.key3_cd from kgpbt Z where Z.key3_cd = TB.key3_cd) as key3_nm," .
//			"(select Z.htm4 from kgrct Z where Z.ar_cd = TB.ar_cd) as htm4" .
			"";
		$order_by=array('key'=>'ar_time','value'=>'desc');
		$data["list"]= $this->common->select_list_table_result('(select * from kgartPbtView where analysis_type = \'A\''.
		                                                    'and user_id = (select name from kguse where id = \''.$user_id.'\')) TB',$sql,$where='',$coding=false,$order_by,$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);
		$like=array(
			'key1_cd','2','after'
		);
		//플랜트 조회
		$data["listKey1"]= $this->common->select_list_table_result('kgloc',$sql='distinct key1_cd,key1_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like,$joina='',$joinb='','');
//		$data['footerScript']="/assets/dist/js/chart/defaultChart.js";

		$data["kgpbtClass1"]= $this->common->select_list_table_result('kgpbt',$sql='distinct key3_cd,key3_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');
		$data["kgcodList"]= $this->common->select_list_table_result('kgcod',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',array('num_cd','1','after'),$joina='',$joinb='','');

		$this->load->view('layout/header',$data);
		$this->load->view('kgbasicpbt/writeform',$data);
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

			if (in_array("1", $keyArr) || in_array("2", $keyArr) || in_array("3", $keyArr) ) {
				$data["list"]= $this->common->select_list_table_result('kgtag',$sql='distinct key4_cd,key4_nm',$where="key4_cd != ''",$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
			}else{
				$data["list"]= $this->common->select_list_table_result('kgpbt',$sql='distinct key4_cd,key4_nm',$where="key4_cd != ''",$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
			}
		}
		echo json_encode($data);
	}
	//1차 분류 선택 1-1 차 조회
	public function ajaxMultiSelectKgpbtFirstB(){
		header('Content-type: application/json');
		$keyArr = $this->input->post("key3_cd");


		$where_in = array(
			"key3_cd"=>	$keyArr,
		);
		//1차분류는 하나만 선택가능
		if(count($keyArr) > 1){
			//알림 타입 error,info,success,warning,question
			$data["alerts_icon"]="error";
			$data["alerts_title"]="&nbsp;1차 분류는 1개만 선택 가능";
		}else{
			$data["list"]= $this->common->select_list_table_result('kgpbt',$sql='distinct key3_1_cd,key3_1_nm',$where="key3_1_cd != ''",$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
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
			$data["list"]= $this->common->select_list_table_result('kgtag',$sql='distinct key5_cd,key5_nm',$where="key5_cd != ''",$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}else{
			$data["list"]= $this->common->select_list_table_result('kgpbt',$sql='distinct key5_cd,key5_nm',$where="key5_cd != ''",$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
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

	//make where in
	public function whereInArrayInsert($array){
		if(is_array($array)){
			$arrString ="";
			$arrayLast = array_pop($array);
			array_push($array,$arrayLast);
			foreach($array as $key=>$value){
				$arrString.=$value;
				if($arrayLast != $value) $arrString.=",";
			}
		}else{
			if($array==null){
				$arrString='ALL';
			}else{
				$arrString=$array;
			}
		}
		return $arrString;
	}
	//make where in mode
	public function whereInArrayInsertForMode($array){
		if(is_array($array)){
			$arrString ="";
			$arrayLast = array_pop($array);
			array_push($array,$arrayLast);
			foreach($array as $key=>$value){
				$arrString.=$value;
				if($arrayLast != $value) $arrString.=",";
			}
		}else{
			$arrString=$array;
		}
		return $arrString;
	}
	//기본 입력폼
	public function insertKgArt(){

		header('Content-type: application/json');
		$this->form_validation->set_rules('key1_cd[]', '플랜트 ', 'required');
		$this->form_validation->set_rules('key3_cd[]', '1차 ', 'required');
		$key1_cd_arr = $this->whereInArrayInsert($this->input->post("key1_cd",TRUE));
		$key2_cd_arr = $this->whereInArrayInsert($this->input->post("key2_cd",TRUE));
		$key3_cd_arr = $this->whereInArrayInsert($this->input->post("key3_cd",TRUE));
		$key4_cd_arr = $this->whereInArrayInsert($this->input->post("key4_cd",TRUE));
		$key5_cd_arr = $this->whereInArrayInsert($this->input->post("key5_cd",TRUE));
		$key6_cd_arr = $this->whereInArrayInsert($this->input->post("key6_cd",TRUE));
		$key3_1_cd_arr = $this->whereInArrayInsert($this->input->post("key3_1_cd",TRUE));
		$fmode = $this->whereInArrayInsertForMode($this->input->post("fmode"),true);
		$smode = $this->whereInArrayInsertForMode($this->input->post("smode"),true);

		$better_date = date('Ymd');
		//AR_CD 값
		$like=array(
			'ar_cd','AR'.$better_date,'after'
		);
		//select_row($table='',$sql='',$where='',$coding=false,$order_by='',$group_by='',$like='' )
		$arcdMakeSql="ifnull(CONCAT('AR',substring(max(ar_cd), 3)+1),CONCAT('AR','$better_date' , '00001')) as ar_cd";
		$arCdRow=$this->common->select_row($table='kgart',$arcdMakeSql,$where='',$coding=false,$order_by='',$group_by='',$like);
		$ar_cd = $arCdRow->ar_cd;
		$anal_type =$this->input->post("anal_type");

		$wvalue=$this->input->post("wvalue");
		$sdate=$this->input->post("startDate");
		$edate=$this->input->post("endDate");

		if ($this->form_validation->run() == true){
			$call_row = $this->common->use_procedure('selectPBTDataCount',
				array(
					$key1_cd_arr,
					$key2_cd_arr,
					$key3_cd_arr,
					$key4_cd_arr,
					$key5_cd_arr,
					$key6_cd_arr,
					$key3_1_cd_arr,
					$sdate,
					$edate
				)
			);
			//프로시저 호출 후 DB 다시연결
			mysqli_next_result( $this->db->conn_id );

			$data["rowCnt"]=$call_row->cnt;
			if($data["rowCnt"] > 0) {
				$updateData = Array(
					//data 없으면 ALL
					"AR_CD" => $ar_cd,
					"analysis_type" => 'A',
					"analysis_flg" => 'S',
					"key1_cd" => $key1_cd_arr,
					"key2_cd" => $key2_cd_arr,
					"key3_cd" => $key3_cd_arr,
					"key4_cd" => $key4_cd_arr,
					"key5_cd" => $key5_cd_arr,
					"key6_cd" => $key6_cd_arr,
					"key3_1_cd" => $key3_1_cd_arr,
					"sdate" => $sdate,
					"edate" => $edate,
					"fmode" => $fmode,
					"smode" => $smode,
					"wvalue" => $wvalue,
					"ohour" => $this->input->post("ohour"),
					"user_id" => @$this->session->userdata('user_id'),
				);
				$this->common->insert("kgart",$updateData);
				$data['alerts_title'] = array("분석요청 완료");
				$data['alerts_status'] = "success";
				$data['anal_type'] = $anal_type;
				$data['ar_cd'] = $ar_cd;
				//윈도우 파일 실행
				execCmdRun('start /b cmd /c '.$this->config->item("exe_path")."KGANS.exe ".$ar_cd);
				//실행 결과 반환
				$data['kgart']=$this->common->select_row($table='kgart','',$where=array('ar_cd'=>$ar_cd),$coding=false,$order_by='',$group_by='','');
				$data['kgartview']=$this->common->select_row($table='kgartview','',$where=array('ar_cd'=>$ar_cd),$coding=false,$order_by='',$group_by='','');

			}else{
				$data["alerts_icon"]="error";
				$data['alerts_title']= array("요청에 해당하는 DATA 가 없습니다.");
			}
		}else{
			//알림 타입 error,info,success,warning,question
			$data["alerts_icon"]="error";
			$data['alerts_title'] = $this->form_validation->error_array();
		}
		echo json_encode($data);
	}
}
