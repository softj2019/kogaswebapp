<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-12
 * Time: 오후 5:58
 */

class Kgview  extends CI_Controller
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

	//생산 기본 분석 뷰어
	public function htmlViewer(){
		header('Content-type: application/json');
		$arcd = $this->input->post("arcd");
		$where = array(
			"ar_cd"=>$arcd,
		);
		$row =  $this->common->select_row($table='kgrct','htm3, htm4',$where,$coding=false,$order_by='',$group_by='' );
		$kgartRow = $this->common->select_row($table='kgart','',$where,$coding=false,$order_by='',$group_by='' );
		$data['kgart']  =  $kgartRow;
		$data['kgartView']  =  $this->common->select_row($table='kgartview','',$where,$coding=false,$order_by='',$group_by='' );
		$data['viewRctDetail']  =  $this->common->select_row($table='kgrct','',$where,$coding=false,$order_by='',$group_by='' );
		$data['content']="";
		if($kgartRow->smode == null){
			if($row->htm3) $data['content'] .= file_get_contents('file:///'.$row->htm3);
		}
		if($row->htm4) $data['content'] .= file_get_contents('file:///'.$row->htm4);

		//표시데이터
		if(!$data['kgart']){
			$data['alerts_status']="error";
		}else{
			$data['alerts_status']="success";
		}
		echo json_encode($data);
	}
	//생산 심화 분석 뷰어
	public function htmlAdViewer(){
		header('Content-type: application/json');

		$ar_cd = $this->input->post("ar_cd");
		$analysis_flg = $this->input->post("analysis_flg");

		if($analysis_flg !="Z") {
			$yy = substr($ar_cd,'2',4);
			$dd = substr($ar_cd,'6',4);
			$data['contentD'] = file_get_contents('file:///'.$this->config->item("report_path").$yy."\\".$dd."\\".$ar_cd."\\".$ar_cd."_distriID.htm");
			$data['contentD2'] = file_get_contents('file:///'.$this->config->item("report_path").$yy."\\".$dd."\\".$ar_cd."\\".$ar_cd."_distriID2.htm");
		}
		$where = array(
			"ar_cd"=>$ar_cd,
		);
		$data['kgart'] =  $this->common->select_row($table='kgart','',$where,$coding=false,$order_by='',$group_by='' );
		$data['kgartview'] =  $this->common->select_row($table='kgartview','',$where,$coding=false,$order_by='',$group_by='' );
		echo json_encode($data);
	}
	//기초분석 뷰어
	public function htmlDefaultViewer(){
    	$arcd = $this->input->post("ar_cd");
    	$selectKey = $this->input->post("htmlNum")." as htmNum ";
    	$where = array(
    		"ar_cd"=>$arcd,
		);
    	$row =  $this->common->select_row($table='kgrct',$selectKey,$where,$coding=false,$order_by='',$group_by='' );
		$content = file_get_contents($row->htmNum);
		echo $content;
	}
	//분석 결과 복사
	public function getKgArt(){
		header('Content-type: application/json');
		$ar_cd = $this->input->post("ar_cd");
		$where = array(
			"ar_cd"=>$ar_cd,
		);
		$row =  $this->common->select_row($table='kgart','',$where,$coding=false,$order_by='',$group_by='' );
		echo json_encode($row);
	}
}
