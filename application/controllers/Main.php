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
    public function index()
    {
        $data=Array();
		//사용자 정보


		$data['page_title']="신뢰도 분석 시스템 홈";
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
		$data["list"]= $this->common->select_list_table_result(''.
			'(select ar_cd, ar_time, user_id, analysis_name, analysis_flg '.
			'from kgartview ORDER BY id DESC limit 10) A',
			$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit ='');
		$data["list2"]= $this->common->select_list_table_result(''.
			'(SELECT (SELECT distinct C.key1_nm FROM kgLOC C WHERE C.key1_cd = A.plant) plant, '.
			'(SELECT distinct C.key2_nm_old FROM kgLOC C WHERE C.key2_cd_old = A.prloc and C.key1_cd = A.plant) prloc, '.
		    '(SELECT distinct B.pr FROM kgspmt B WHERE B.pr_cd = A.pr_cd) pr, '.
		    'probj, sdate '.
			'from kgdata A where bstat = \'F\' ORDER BY id DESC limit 10) C ',
			$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit ='');
//		$where=array(
//			'code_name'=>'is not null',
//		);


		$data['footerScript']="/assets/dist/js/chart/defaultChart.js";
		$data['footerScript']="/assets/dist/js/noticealert.js";
		$this->load->view('layout/header',$data);
        $this->load->view('main/index',$data);
		$this->load->view('layout/footer',$data);
    }

    public function mainAjaxCall(){
		//값이 정확해서 폼체크 안해도
		header('Content-type: application/json');


		//해당 년도 고장모드 비율
		$data["listA"]=$this->common->select_list_table_result('' .
			'(select num_nm code_name,' .
			'count(*) as cnt ' .
			'from kgdata inner join kgcod on num_cd = break_cd ' .
			'WHERE sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() ' .
			'group by break_cd ORDER BY cnt DESC limit 10) A',
			$sql='','code_name is not null',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');
		//해당 년도 고장원인 비율
		$data["listB"]=$this->common->select_list_table_result('' .
			'(select num_nm code_name,' .
			'count(*) as cnt ' .
			'from kgdata inner join kgcod on num_cd = cause_cd ' .
			'WHERE sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() ' .
			'group by cause_cd ORDER BY cnt DESC limit 10) A',
			$sql='','code_name is not null',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');
		//해당 년도 고장조치 비율
		$data["listC"]=$this->common->select_list_table_result(
			'(select num_nm code_name,' .
			'count(*) as cnt ' .
			'from kgdata inner join kgcod on num_cd = action_cd ' .
			'WHERE sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() ' .
			'group by action_cd ORDER BY cnt DESC limit 10) A',
			$sql='','code_name is not null',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');

		$data["listD"]=$this->common->select_list_table_result(
			'(SELECT chartDate , sbtCnt, pbtCnt '.
			'FROM(SELECT substring(CURDATE(),1,7) chartDate '.
			'	UNION all select SUBSTRING(DATE_ADD(CURDATE(), INTERVAL -1 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -2 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -3 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -4 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -5 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -6 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -7 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -8 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -9 MONTH),1,7) '.
			'	UNION all select substring(DATE_ADD(CURDATE(), INTERVAL -10 MONTH),1,7) '.
			'	UNION all SELECT SUBSTRING(DATE_ADD(CURDATE(), INTERVAL -11 MONTH),1,7)) DATE_TABLE '.
			'LEFT OUTER JOIN '.
			'(SELECT SUBSTRING(sdate,1,7) ym, COUNT(*) sbtCnt FROM kgdata '.
			'	WHERE plant LIKE \'3%\' '.
			'	AND bstat = \'F\' '.
			'	AND sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() '.
			'	GROUP BY SUBSTRING(sdate,1,7)) DATA_TABLE1 '.
			'ON DATE_TABLE.chartDate = DATA_TABLE1.ym '.
			'LEFT OUTER JOIN '.
			'(SELECT SUBSTRING(sdate,1,7) ym, COUNT(*) pbtCnt FROM kgdata '.
			'	WHERE plant LIKE \'2%\' '.
			'	AND bstat = \'F\' '.
			'	AND sdate BETWEEN DATE_ADD(NOW(),INTERVAL -12 MONTH) AND NOW() '.
			'	GROUP BY SUBSTRING(sdate,1,7)) DATA_TABLE2 '.
			'ON DATE_TABLE.chartDate = DATA_TABLE2.ym order by chartDate) A',
			$sql='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='','');

		echo json_encode($data);
	}
	public function menu(){
		$data["list"] = $this->common->select_list_table_result($table='menu',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit='');

		$this->load->view('layout/menu',$data);
	}
}
