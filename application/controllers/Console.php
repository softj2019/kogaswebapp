<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-11-12
 * Time: 오후 5:58
 */

class Console  extends CI_Controller
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
            modal_alert('로그인 후 이용가능합니다.','member/login',$this);
			redirect('member/login');
		}else{
			if(!@$this->session->userdata('is_admin')) {
				modal_alert('접근권한이 없습니다..','main',$this);
			}else{
				if (method_exists($this, $method)) {
					$this->{"{$method}"}();
				}
			}
		}

	}
    public function mguser()
    {
        $data=Array();
		//사용자 정보


		$data['page_title']="사용자관리";
//		$data['page_sub_title']="";
//        $data['page_css_style']="fee.css";
		$data['menu_code']="009";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('console/mguser');
		$config['total_rows'] = $this->common->select_count('kguse','','');
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];

		//기본목록
		$data["list"]= $this->common->select_list_table_result('kguse',
			$sql='kguse.*, (select Z.typename from kgref Z where Z.typetable = \'kguse\' and Z.typecolumn = \'role\' and Z.typecode = kguse.role) as role_name',
			$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);

		$this->load->view('layout/header',$data);
        $this->load->view('console/mguser',$data);
		$this->load->view('layout/footer',$data);
    }
	public function loginhistory()
	{
		$data=Array();
		//사용자 정보


		$data['page_title']="로그인이력";
//		$data['page_sub_title']="";
//        $data['page_css_style']="fee.css";
		$data['menu_code']="011";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('console/mguser');
		$config['total_rows'] = $this->common->select_count('kguse','','');
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];

		//기본목록
		$data["list"]= $this->common->select_list_table_result('kguse',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);

		$this->load->view('layout/header',$data);
		$this->load->view('console/loginhistory',$data);
		$this->load->view('layout/footer',$data);
	}
	public function boardlist()
	{
		$data=Array();
		//사용자 정보

		$type = $this->input->get("board_type");
		if(!$type){
			$type = "A";
		}
		$data['page_title']="게시판관리";
//		$data['page_sub_title']="";
//        $data['page_css_style']="fee.css";
		$data['menu_code']="012";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('board/boardlist');
		$config['total_rows'] = $this->common->select_count('board','',array('type'>$type));
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];

		//기본목록
		$data["list"]= $this->common->select_list_table_result('board',$sql='',array('type'=>$type),$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);

		$this->load->view('layout/header',$data);
		$this->load->view('board/boardlist',$data);
		$this->load->view('layout/footer',$data);
	}

}
