<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('alert');
        //CSRF 방지
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->helper('utility');

        $this->load->library('email');
        //기본 Data modal
        $this->load->model('common');
    }


    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function _remap($method)
    {
        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
    }

    public function login(){

    if(@$this->session->userdata('logged_in')) {
        redirect('/', 'refresh');
    }
	$this->load->view('member/login');
    }
	//로그인 체크 콜백
    function login_check($password,$email){
    	$password= do_hash($password,'sha1');
		$where= array(
			'email' => $email,
			'password' => $password,
		);
		$result = $this->common->select_row('kguse',$sql='',$where );
		$this->form_validation->set_message('login_check', '아이디 패스워드를 확인하세요.');
		if($result==null){
			return false;
		}else{
			return true;
		}
		return $result;
	}
	//이메일 중복체크 콜백
	function email_check($email){
		$result = $this->common->select_row('kguse','',array('email'=>$email));
		$this->form_validation->set_message('email_check', '이미 등록된 이메일 주소입니다.');
		if($result==null){
			return true;
		}else{
			return false;
		}
	}
	/*로그인 처리*/
	public function login_proc()
	{
		$email = $this->input->post('email', TRUE);
		$this->form_validation->set_rules('email', '이메일', 'required|valid_email');
		$this->form_validation->set_rules('password', '비밀번호','required|callback_login_check['.$email.']');

		if ($this->form_validation->run() == TRUE) {
			$where= array(
				'email' => $email,
			);
			$result = $this->common->select_row('kguse',$sql='',$where );
			//세션 생성
			$newdata = array(
//                        'username' => $result->username,
				'name' => $result->name,
				'user_id'=> $result->id,
				'logged_in' => TRUE,
				'is_admin'=>FALSE,
//					'lang_cd'=>$this->input->post('lang_cd'),
			);
			if($result->role =="admin"){
				$newdata['is_admin']=TRUE;
			}

			$this->session->set_userdata($newdata);
			redirect(site_url('/'));
		}else{
			$this->load->view('member/login');
		}
	}
//    회원가입
    public function join()
    {
        if(@$this->session->userdata('logged_in')) {
            redirect('/', 'refresh');
        }
        //이메일중복체크 초기화
        $data['email_duplicate']="none";
        $data['send_email_status']='true';
        $this->load->view('member/join',$data);
    }
//  회원가입 처리
    public function join_proc()
    {
        /*로그인되어있으면 매인화면으로*/
        if(@$this->session->userdata('logged_in')) {
            redirect('/', 'refresh');
        }


        //폼 검증할 필드와 규칙 사전 정의

        $this->form_validation->set_rules('email', '이메일', 'required|valid_email');
		$this->form_validation->set_rules('name', '사용자명', 'required');
        // password field with confirmation field matching
        $this->form_validation->set_rules('password', '비밀번호', 'required');
        $this->form_validation->set_rules('password_proc', '비밀번호 확인', 'required|matches[password]');

        /*이메일 중복 체크*/
		$this->form_validation->set_rules('email', 'email', 'required|callback_email_check');

        if ($this->form_validation->run() == TRUE) {
			$param = array(
				'email' => $this->input->post('email', TRUE),
				'name' => $this->input->post('name', TRUE),
				'password' => do_hash($this->input->post('password', TRUE),'sha1'),
			);
			$this->common->insert('kguse',$param);
			redirect('/member/login', 'refresh');
		}else{
            $this->load->view('member/join');
        }

    }
    //로그아웃
    public function logout()
    {
        $this->session->sess_destroy();
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
//        modal_alert('로그아웃 되었습니다', 'member/login',$this);
        redirect(site_url('member/login'));
    }
    //sendmail
    public  function send_mail($email_data)
    {
        //환경설정데이터를 배열로 변환
        $where=Array('key'=>'config_cd','value'=>'EMAIL');
        foreach ($this->common->select_list($where) as $val) {
            $config_data[$val->config_name]=$val->config_value;
        }

        $config = array(
            'protocol' => "smtp",
            'smtp_host' => $config_data['smtp_host'],
            'smtp_port' => $config_data['smtp_port'],//"587", // 465 나 587 중 하나를 사용
            'smtp_user' => $config_data['smtp_user'],
            'smtp_pass' => $config_data['smtp_pass'],
            'charset' => "utf-8",
            'mailtype' => "html",
            'smtp_timeout' => 10,
            'wordwrap' => TRUE,
        );

// gmail smtp 메일 발송
        $this->load->library('email', $config);
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->set_newline("\r\n");
//        $this->email->clear(); // 클리어시 텔플릿 초기화 ㅡㅡ;
        $this->email->from("apexsoftj@gmail.com", "System Manager");
        $this->email->to($email_data['email']);
        $this->email->subject($email_data['subject']);
        $message_data['email_auth']=$email_data['email_auth'];
        $message_data['site_url']=$email_data['site_url'];
        $message_data['type']=$email_data['type'];
        $message_data['html']=$email_data['html'];
        $message = $this->load->view("member/authmail",$message_data,true);
        $this->email->message($message);
        if($this->email->send()) {
//            modal_alert('로그아웃 되었습니다', 'member/login',$this);
            return true;
        } else {
            //이메일중복체크 초기화
            return false;
        }
    }
    //이메일인증
    public function  email_auth()
    {
        $param['auth_code']=$this->input->get('email_auth');
        $result = $this->auth_member->email_auth_proc($param);
        if($result){
            //인증성공
            $data['auth_mail_status']='true';
        }else{
            //인증실패
            $data['auth_mail_status']='false';
        }
        $this->load->view("member/authmailreturn",$data);
        //인증완료 -> 로그인하세요
        //인증실패 -> 메일다시보내기 -> 코드 등록
    }

    function passwordfind(){
        $this->form_validation->set_rules('email', 'email', 'required|callback_email_check');
        if ($this->form_validation->run() == TRUE) {
            //이메일 확인후 토큰저장
            $random_result = '';
            foreach (random(1, 9, 8) as $v) $random_result .= $v;
            $this->common->insert('reset_password',Array(
                'email'=>$this->input->post('email'),
                'email_auth'=>$random_result,
            ));
            $email_data['html']='<p>'.$this->lang->line('resetPasswordSendMailTitle').'</p>' .
                '<p>'.$this->lang->line('resetPasswordSendMailMemo').'</p>';
            $email_data['subject']='Social Algo trading password reset';
            $email_data['site_url']="member/resetpassword?email_auth=";
            $email_data['email']=$this->input->post('email');
            $email_data['email_auth']=$random_result;
            $email_data['type']='reset_password';
            $send_mail = $this->send_mail($email_data);
            if($send_mail){
                modal_alert('수신된 이메일을 확인하세요.','member/login',$this);
            }
            $data['modal_active'] = false;
        }else{
            $data['modal_active'] = true;
        }
        $this->load->view('member/login',$data);
    }

    public function resetpassword()
    {
        $email_auth = $this->input->get('email_auth');
        $result = $this->common->select_row('reset_password','',Array('email_auth'=>$email_auth));
        $data['target_url']='member/login';
        $data['email']=$result->email;
        $this->load->view('member/resetpassword',$data);
    }
    public function resetpasswordproc()
    {
		header('Content-type: application/json');
        // password field with confirmation field matching
		$result = $this->common->select_row('kguse','',Array('id'=>$this->input->post('user_id')));

		$this->form_validation->set_rules('password', '비밀번호','required|callback_login_check['.$result->email.']');
		$this->form_validation->set_rules('new_password', '신규 비밀번호', 'required');
        $this->form_validation->set_rules('new_password_proc', '신규 비밀번호', 'required|matches[new_password]');

        if ($this->form_validation->run() == TRUE) {
            $param=Array(
				'password' => do_hash($this->input->post('new_password', TRUE),'sha1'),
            );
             $this->common->update_row('kguse',$param,'id',$result->id);
             $data["alerts_status"]="success";
        }else{
			$data['alerts_title'] = $this->form_validation->error_array();
			$data['alerts_icon'] ="error";
        }
        echo json_encode($data);
    }
	public function joinapply()
	{
		header('Content-type: application/json');

		$param=Array(
			'role' => "user",
		);
		foreach ($this->input->post("chk") as $key=>$value){
			$this->common->update_row('kguse',$param,'id',$value);
		}
		$data["alerts_status"]="success";

		echo json_encode($data);
	}
}
