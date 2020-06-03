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
	public function writeform()
	{
		$data=Array();
		//사용자 정보


		$data['page_title']="기초통계분석(생산)";
		$data['page_sub_title']="";
		$data['menu_code']="005";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('kgpbt/writeform');
		$config['total_rows'] = $this->common->select_count('kgartpbtview','','');
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
		$data["list"]= $this->common->select_list_table_result('kgartpbtview TB',$sql,$where='',$coding=false,$order_by,$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);
		$like=array(
			'key1_cd','3','after'
		);
		//플랜트 조회
		$data["listKey1"]= $this->common->select_list_table_result('kgloc',$sql='distinct key1_cd,key1_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like,$joina='',$joinb='','');
//		$data['footerScript']="/assets/dist/js/chart/defaultChart.js";

		$data["kgpbtClass1"]= $this->common->select_list_table_result('kgsbt',$sql='distinct key3_cd,key3_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');
		$data["kgcodList"]= $this->common->select_list_table_result('kgcod',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');

		$this->load->view('layout/header',$data);
		$this->load->view('kgbasicpbt/writeform',$data);
		$this->load->view('layout/footer',$data);
	}
	//플랜트 선택 위치 조회
	public function ajaxMultiSelect(){
		header('Content-type: application/json');
		$keyArr = $this->input->post("key1arr");
		$like=array(
			'key1_cd','3','after'
		);
		$where_in = array(
			"key1_cd"=>$keyArr
		);
		$data["localeList"]= $this->common->select_list_table_result('kgloc',$sql='distinct key2_cd,key2_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like,$joina='',$joinb='','');

		echo json_encode($data);
	}
	//1차 분류 선택 2차 조회
	public function ajaxMultiSelectKgsbtFirst(){
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
			$data["list"]= $this->common->select_list_table_result('kgsbt',$sql='distinct key4_cd,key4_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}
		echo json_encode($data);
	}
	//1차 분류 선택 1-1 차 조회
	public function ajaxMultiSelectKgsbtFirstB(){
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
			$data["list"]= $this->common->select_list_table_result('kgsbt',$sql='distinct key3_1_cd,key3_1_nm',$where="key3_1_cd != ''",$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');
		}
		echo json_encode($data);
	}
	//2차 분류 선택 3차 조회
	public function ajaxMultiSelectKgsbtSecond(){
		header('Content-type: application/json');

		$keyArr = $this->input->post("key3_cd");
		$keyArr2 = $this->input->post("key4_cd");
		$where_in =array(
			"key3_cd"=>	$keyArr,
			"key4_cd"=>	$keyArr2,
		);

		$data["list"]= $this->common->select_list_table_result('kgsbt',$sql='distinct key5_cd,key5_nm',$where='',$coding=false,$order_by='',$group_by='',$where_in,$like='',$joina='',$joinb='','');

		echo json_encode($data);
	}

	//생산 기본/심화 분석 뷰어
	public function htmlViewer(){
		header('Content-type: application/json');
		$arcd = $this->input->post("arcd");
		$where = array(
			"ar_cd"=>$arcd,
		);
		$row =  $this->common->select_row($table='kgrct','htm3, htm4',$where,$coding=false,$order_by='',$group_by='' );
		$data['viewArtDetail']  =  $this->common->select_row($table='kgartpbtview','',$where,$coding=false,$order_by='',$group_by='' );
		$data['viewRctDetail']  =  $this->common->select_row($table='kgrct','',$where,$coding=false,$order_by='',$group_by='' );
		$data['content']="";
		if($row->htm3) $data['content'] .= file_get_contents('file:///'.$row->htm3);
		if($row->htm4) $data['content'] .= file_get_contents('file:///'.$row->htm4);
		echo json_encode($data);
	}
	//기초분석 뷰어
	public function htmlDefaultViewer(){
		$arcd = $this->input->post("arcd");
		$selectKey = $this->input->post("htmlNum")." as htmNum ";
		$where = array(
			"ar_cd"=>$arcd,
		);
		$row =  $this->common->select_row($table='kgrct',$selectKey,$where,$coding=false,$order_by='',$group_by='' );
		$content = file_get_contents($row->htmNum);
		echo $content;
	}
	//make where in
	public function whereInArray($array){
		if(is_array($array)){
			$arrString ="";
			$arrayLast = array_pop($array);
			array_push($array,$arrayLast);
			foreach($array as $key=>$value){
				$arrString.="'".$value."'";
				if($arrayLast != $value) $arrString.=",";
			}
		}else{
			$arrString=$array;
		}
		return $arrString;
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
			$arrString=$array;
		}
		return $arrString;
	}
	//기본 입력폼
	public function insertKgArt(){

		header('Content-type: application/json');
		$this->form_validation->set_rules('key1_cd[]', '플랜트 ', 'required');
		$this->form_validation->set_rules('key3_cd[]', '1차 ', 'required');
		$key1_cd = $this->whereInArray($this->input->post("key1_cd"));
		$key2_cd = $this->whereInArray($this->input->post("key2_cd"));
		$key3_cd = $this->whereInArray($this->input->post("key3_cd"));
		$key4_cd = $this->whereInArray($this->input->post("key4_cd"));
		$key5_cd = $this->whereInArray($this->input->post("key5_cd"));
		$key6_cd = $this->whereInArray($this->input->post("key6_cd"));
		$key3_1_cd = $this->whereInArray($this->input->post("key3_cd_1"));


		$key1_cd_arr = $this->whereInArrayInsert($this->input->post("key1_cd"));
		$key2_cd_arr = $this->whereInArrayInsert($this->input->post("key2_cd"));
		$key3_cd_arr = $this->whereInArrayInsert($this->input->post("key3_cd"));
		$key4_cd_arr = $this->whereInArrayInsert($this->input->post("key4_cd"));
		$key5_cd_arr = $this->whereInArrayInsert($this->input->post("key5_cd"));
		$key6_cd_arr = $this->whereInArrayInsert($this->input->post("key6_cd"));
		$key3_1_cd_arr = $this->whereInArrayInsert($this->input->post("key3_1_cd"));

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

		$smode=$this->whereInArray($this->input->post("smode"));
		$fmode=$this->whereInArray($this->input->post("fmode"));
		$wvalue=$this->input->post("wvalue");
		$sdate=$this->input->post("startDate");
		$edate=$this->input->post("endDate");
		($key1_cd)? $key1_cd_query="AND key1_cd in ($key1_cd)  \n" :$key1_cd_query='';
		($key2_cd)? $key2_cd_query="AND key2_cd in ($key2_cd)  \n" :$key2_cd_query='';
		($key3_cd)? $key3_cd_query="AND key3_cd in ($key3_cd)  \n" :$key3_cd_query='';
		($key4_cd)? $key4_cd_query="AND key3_cd in ($key4_cd)  \n" :$key4_cd_query='';
		($key5_cd)? $key5_cd_query="AND key4_cd in ($key5_cd)  \n" :$key5_cd_query='';
		($key3_1_cd)? $key3_1_cd_query="AND key3_1_cd in ($key3_1_cd)  \n" :$key3_1_cd_query='';
		($key6_cd)? $key6_cd_query="AND key6_cd in ($key6_cd)  \n" :$key6_cd_query='';
		$subQuery ="";
		$topSubQuery="";
		if ($key3_cd=="1" || $key3_cd=="2" || $key3_cd=="3") {
			$subQuery = "".
				"AND fl_tag REGEXP (SELECT CONCAT('^',group_CONCAT(FL_TAG SEPARATOR '-|^'),'-') \n" .
				"FROM KGTAG \n".
				"WHERE 1=1 \n".
				$key3_cd_query.
				$key4_cd_query.
				$key5_cd_query.
				$key6_cd_query.
				")\n";
		}else{
			$topSubQuery=$key4_cd_query.$key5_cd_query.$key3_1_cd_query;

		}



		if ($this->form_validation->run() == true)
		{
			$sql='' .
				'COUNT(*) as cnt ';
			$table= "" .
				"(SELECT RANK() OVER(PARTITION BY pr_cd ORDER BY pr_num) pr_rank,\n" .
				"IFNULL(CONCAT(prfdate,' ',TIME('00:00:00')), '2008-12-31 00:00:00') ptp,\n" .
				"TIMESTAMPDIFF(hour, IFNULL(CONCAT(DATE(LAG(edate, 1) OVER (PARTITION BY pr_cd ORDER BY pr_num)),' ',TIME(LAG(etime, 1) OVER (PARTITION BY pr_cd ORDER BY pr_num))),IFNULL(CONCAT(prfdate,' ',TIME('00:00:00')), '2008-12-31 00:00:00')), IF(bstat = 'C', NOW(), CONCAT(sdate,' ',stime))) bhour \n" .
				"FROM KGDATA WHERE 1 = 1\n" .
				"AND plant like '2%' \n" .
				"AND !(edate IS NULL AND bstat = 'F') \n" .
//					"AND prloc in (SELECT key2_cd_old FROM kgloc WHERE key2_cd IN ('3010','3100','3200')) -- key2_cd 변수 if all이면 해당쿼리 사용x \n" .
				"AND fl_cd IN (SELECT DISTINCT CONCAT(key1_cd,'-', fl_cd) \n" .
				"FROM KGLOC INNER JOIN KGPBT \n" .
				"WHERE 1=1\n" .
				$key1_cd_query.
				$key2_cd_query.
				$topSubQuery.

				")\n" .

				"AND fl_tag REGEXP (SELECT CONCAT('^',group_CONCAT(FL_TAG SEPARATOR '-|^'),'-') \n" .
				"FROM KGTAG \n".
				"WHERE 1=1 \n".
				"AND key3_cd in ('2') \n".
				$subQuery.
				")\n".
				" AND (sdate >= '2009-01-01' or bstat = 'C') \n".
				" AND (sdate <= '2020-05-24' or bstat = 'C') \n".
				" ORDER BY pr_cd, pr_num) A \n";
			$row =  $this->common->select_row(
				$table,
				$sql,
				$where=Array(
//						"!(ptp < '2009-01-01 00:00:00' AND pr_rank = '1')",
//						"bhour > 0;",
				),
				$coding=false,
				$order_by='',
				$group_by='' );
			$data["alerts_icon"]="success";
			$data["rowCnt"]=$row->cnt;
			$updateData = Array(
				//data 없으면 ALL
				"AR_CD"=>$ar_cd,
				"analysis_type"=>$anal_type,
				"analysis_flg"=>'S',
				"key1_cd"=>$key1_cd_arr?$key1_cd_arr:'ALL',
				"key2_cd"=>$key2_cd_arr?$key2_cd_arr:'ALL',
				"key3_cd"=>$key3_cd_arr?$key3_cd_arr:'ALL',
				"key4_cd"=>$key4_cd_arr?$key4_cd_arr:'ALL',
				"key5_cd"=>$key5_cd_arr?$key5_cd_arr:'ALL',
				"key6_cd"=>$key6_cd_arr?$key6_cd_arr:'ALL',
				"key3_1_cd"=>$key3_1_cd_arr?$key3_1_cd_arr:'ALL',
				"sdate"=>$sdate,
				"edate"=>$edate,
				"fmode"=>$fmode,
				"smode"=>$smode,
				"wvalue"=>$wvalue,
				"user_id"=>@$this->session->userdata('id'),
			);
			$this->common->insert("kgart",$updateData);
//			$data['alerts_title'] = array("분석요청 완료");
			//윈도우 파일 실행
//			execCmdRun('start /b cmd /c '.$this->config->item("exe_path")."KGANS.exe");
		}
		else
		{
			//알림 타입 error,info,success,warning,question
			$data["alerts_icon"]="error";
			$data['alerts_title'] = $this->form_validation->error_array();
		}


		echo json_encode($data);
	}
}
