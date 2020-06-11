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
		$this->load->library('user_agent');


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
		$config['base_url'] =base_url('console/loginhistory');
		$config['total_rows'] = $this->common->select_count('kguse_history','','');
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];

		//기본목록
		$data["list"]= $this->common->select_list_table_result('kguse_history user',
			$sql='' .
				'user.*,(select Z.name from kguse Z where Z.id=user.user_id) as user_name, ' .
				'(select Z.email from kguse Z where Z.id=user.user_id) as email',
			$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);

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
		$data['page_title']="도움말 관리";
//		$data['page_sub_title']="";
//        $data['page_css_style']="fee.css";
		$data['menu_code']="012";
//		$user_data = $this->common->select_row('member','',Array('email'=>@$this->session->userdata('email')));

		//페이징 base_url '컨트롤러명/컨트롤러안의 함수명
		$config['base_url'] =base_url('console/boardlist');
		$config['total_rows'] = $this->common->select_count('board','',array('type'=>$type));
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3,0);
		$data['pagination']= $this->pagination->create_links();
		$limit[1]=$page;
		$limit[0]=$config['per_page'];
		$order_by=array('key'=>'num','value'=>'desc');
		$where = array(
			'type'=>$type,
//			"(@rownum:=0) = "=>0,

		);
		//기본목록
		$data["list"]= $this->common->select_list_table_result('board a,(select (@rownum:=0) = 0) tmp',$sql='(@rownum:=@rownum+1) as num,a.*,(select kguse.name from kguse where kguse.id = a.user_id) as name',$where,$coding=false,$order_by,$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit);

		$this->load->view('layout/header',$data);
		$this->load->view('console/boardlist',$data);
		$this->load->view('layout/footer',$data);
	}
	public function boarddelete(){
		$where=array(
			"br_cd"=> $this->uri->segment(3,0),
		);
		$boardRow =$this->common->select_row($table='board','',$where,$coding=false,$order_by='',$group_by='' );
		$this->common->delete_row($table='board',array('br_cd'=>$boardRow->br_cd));

		redirect(base_url()."console/boardlist?board_type=$boardRow->type");
	}
	public function boardform()
	{
		$data=Array();
		$data['page_title']="도움말 글쓰기";
		$data['menu_code']="012";
		$data['footerScript']='/assets/dist/js/summernote-basic.js';
		$data['board_type']=$this->input->get("board_type");
		$data['br_cd']='';
		$data['title']='';
		$data['content']='';
		$this->load->view('layout/header',$data);
		$this->load->view('console/boardform',$data);
		$this->load->view('layout/footer',$data);
	}
	public function boardread()
	{
		$data=Array();
		$data['page_title']="도움말 글수정";
		$data['menu_code']="012";
		$data['footerScript']='/assets/dist/js/summernote-basic.js';
		$where=array(
			"id"=> $this->uri->segment(3,0),
		);
		$boardRow =$this->common->select_row($table='board',
			'board.*,(select kguse.name from kguse where kguse.id = board.user_id) as name',
			$where,$coding=false,$order_by='',$group_by='' );

		$data['boardRow']=$boardRow;
		$data['board_type']=$boardRow->type;
		$data['title']=$boardRow->title;
		$data['content']=$boardRow->content;
		$data['br_cd']=$boardRow->br_cd;

		$data['boardFileList']=$this->common->select_list_table_result('boardfile','',array('br_cd'=>$boardRow->br_cd),$coding=false,$order_by,$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit='');
		//에디터 에 내용전달
		$data['insertEditorCode']="$('#summernote').summernote('code', '$boardRow->content')";
		$this->load->view('layout/header',$data);
		$this->load->view('console/boardform',$data);
		$this->load->view('layout/footer',$data);
	}
	public function boardformproc()
	{
		//파일 업로드
		//		header('Content-type: application/json');
		$config['upload_path']          = $this->config->item("uploads")."\\board\\";
//		$config['upload_path']          = 'assets/board/';
		$config['allowed_types']        = 'txt|ppt|pptx|xls|xlsx|doc|docx|hwp|gif|jpg|png|sql|csv';
		$config['max_size']             = 1000000;
		$config['max_width']            = 10240000;
		$config['max_height']           = 7680000;
		$config['encrypt_name']         = true;
		$config['overwrite']         	= true;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$files_name = $_FILES['file']['name'];
		$files = $_FILES['file'];

		# 파일 변수명이 배열 형태인지 구분하여 처리
		if ( !is_array($files_name) )
		{
			self::_board_upload_one();
		}
		else if ( count($files_name) > 0 )
		{
			foreach ( $files_name as $key => $val )
			{
				$_FILES['file'] = array(
					'name' => $files['name'][$key],
					'type' => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error' => $files['error'][$key],
					'size' => $files['size'][$key]
				);
				self::_board_upload_one();
			}
		}
		//파일 업로드 종료

		$data=Array();
		$data['page_title']="도움말 글쓰기";
		$data['menu_code']="012";
		$data['footerScript']='/assets/dist/js/summernote-basic.js';
		$data['board_type']=$this->input->post("board_type");
		$data['br_cd']='';
		$data['title']='';
		if($this->input->post("br_cd"))$data['br_cd']=$this->input->post("br_cd");
		if($this->input->post("title"))$data['title']=$this->input->post("title");

		//파일 번호
		$better_date = date('Ymd');

		//업데이트 할떼
		if($this->input->post("br_cd")){
			$br_cd = $this->input->post("br_cd");
		}else{
			$like=array(
				'br_cd','BR'.$better_date,'after'
			);
			$brcdMakeSql="ifnull(CONCAT('BR',substring(max(br_cd), 3)+1),CONCAT('BR','$better_date' , '00001')) as br_cd";
			$brCdRow=$this->common->select_row($table='board',$brcdMakeSql,$where='',$coding=false,$order_by='',$group_by='',$like);
			$br_cd = $brCdRow->br_cd;
		}

		$this->form_validation->set_rules('title', '글 제목', 'required');
		$this->form_validation->set_rules('content', '글 내용','required');

		if ($this->form_validation->run() == TRUE) {
			$param =  array(
				"title"=>$this->input->post("title"),
				"content"=>$this->input->post("content"),
				"user_id"=>@$this->session->userdata('user_id'),
				"type"=>$this->input->post("board_type"),
				"br_cd"=>$br_cd,
			);
			$this->common->insert_on_dup('board',$param);
			if($this->upload->file_name){
				$paramfile =  array(
					"br_cd"=>$br_cd,
					"file"=>$this->upload->file_name,
					"path"=>$this->upload->upload_path,
				);
				$this->common->insert('boardfile',$paramfile);
			}

			redirect(base_url().'console/boardlist?board_type='.$this->input->post("board_type"));
		}else{
			$this->load->view('layout/header',$data);
			$this->load->view('console/boardform',$data);
			$this->load->view('layout/footer',$data);
		}

	}

	# 파일 업로드 하나씩 처리
	private function _board_upload_one ()
	{
		if ( ! $this->upload->do_upload('file'))
		{
			$data['error'] =  $this->upload->display_errors();
//			$this->load->view('upload_form', $error);
		}
		else
		{
			$data['imgData'] = $this->upload->data();
		}
		return $data;
	}

	public function joinapply()
	{
		header('Content-type: application/json');

		$param=Array(
			'role' => "user",
		);

		//권한 확인 Flag
		$isOk = true;
		foreach ($this->input->post("chk") as $key=>$value){
			// id 값으로 Role 조회
			$where= array(
				'id' => $value,
			);
			$targetRole = $this->common->select_row('(select role, id '.'from kguse) A ',$sql='',$where );

			// 타겟의 권한이 admin인 계정이 있으면 불가능.
			if($targetRole->role == "admin" || $targetRole->role == "root"){
				$isOk = false;
			}
		}

		if($isOk == true){
			foreach ($this->input->post("chk") as $key=>$value){
				$this->common->update_row('kguse',$param,'id',$value);
			}
			$data["alerts_status"]="success";
		}
		else{
			$data["alerts_status"]="fail";
		}

		echo json_encode($data);
	}
	public function userAccessApply()
	{
		header('Content-type: application/json');
		$rootUser = @$this->session->userdata('is_root');
		if($rootUser == true) {
			$param = array(
				'role' => "user",
			);
			foreach ($this->input->post("chk") as $key => $value) {
				$this->common->update_row('kguse', $param, 'id', $value);
			}
			$data["alerts_status"] = "success";
		}
		else{
			$data["alerts_status"]="fail";
		}

		echo json_encode($data);
	}
	public function adminAccessApply()
	{
		header('Content-type: application/json');
		$rootUser = @$this->session->userdata('is_root');
		if($rootUser == true){
			$param=Array(
				'role' => "admin",
			);
			foreach ($this->input->post("chk") as $key=>$value){
				$this->common->update_row('kguse',$param,'id',$value);
			}
			$data["alerts_status"]="success";
		}
		else{
			$data["alerts_status"]="fail";
		}

		echo json_encode($data);
	}
	public function deleteUser()
	{
		header('Content-type: application/json');
		//권한 확인 Flag
		$isOk = true;
		$rootUser = @$this->session->userdata('is_root');
		foreach ($this->input->post("chk") as $key=>$value){
			// id 값으로 Role 조회
			$where= array(
				'id' => $value,
			);
			$targetRole = $this->common->select_row('(select role, id '.'from kguse) A ',$sql='',$where );
			
			// 타겟의 권한이 admin인 경우 ROOT가 아니면 불가능.
			if($targetRole->role == "admin" || $targetRole->role == "root"){
				if($rootUser == false){
					$isOk = false;
				}
			}
		}
		
		// 만약 이상이 없다면 삭제
		if($isOk == true){
			foreach ($this->input->post("chk") as $key=>$value) {
				$this->common->delete_row("kguse", array('id' => $value));
			}
			$data["alerts_status"] = "success";
		}
		else{
			$data["alerts_status"]="fail";
		}

		echo json_encode($data);
	}
	public function deleteBoardFile()
	{
		header('Content-type: application/json');
		//권한 확인 Flag

		$this->common->delete_row("boardfile", array('id' => $this->input->post_get("file_id")));

		$data["alerts_status"] = "success";


		echo json_encode($data);
	}
}
