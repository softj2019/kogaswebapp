<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-10-09
 * Time: 오후 8:28
 */

class Kguser  extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('common');
	}


	//아이디 비빌번호 체크
	function login($auth)
	{
		$sql =" select *  from member where email =? and password =?";
		$query=$this->db->query($sql,
			array(
				'email'=>$auth['email'],
				'password'=>$auth['password']
			)
		);

		if($query->num_rows()>0)
		{
			// 맞는 데이터가 있다면 해당 내용 반환
			return $query->row();
		}
		else
		{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}
	function sign_proc($param)
	{
		//회원등록
//        $this->db->query("SET NAMES 'utf-8'");
		$sql="insert into member(username,firstname,lastname,password,email,email_auth,refferal_code,country_code,group_id)VALUES (?,?,?,?,?,?,?,?,?)";
//        $this->db->simple_query('SET NAMES \'utf-8\'');
		$this->db->query($sql,
			array(
//                'username'=>$param['lastname']." ".$param['firstname'],
				'username'=>$param['username'],
				'firstname'=>$param['firstname'],
				'lastname'=>$param['lastname'],
				'password'=>$param['password'],
				'email'=>$param['email'],
				'email_auth'=>$param['email_auth'],
				'refferal_code'=>$param['refferal_code'],
				'country_code'=>$param['country_code'],
				'group_id'=>$param['group_id'],
			)
		);

		if($param['upper_uid']){
			$user_data = $this->common->select_row('member','',Array('uid'=>$param['upper_uid']));
			$result_group = $this->common->select_row('fee_group_master', '', Array('fee_group_id' => $user_data->group_id));
			//레퍼럴코드가 관리자 인경우

			if($user_data->level=="10"){
				$top_upper_cd = $param['top_upper_cd'];
				$top_upper_id = 0;
			}else{
//                $top_upper_cd = $user_data->top_upper_cd;
//            }
//            //
//            if ($result_group->fee_group_order == 0) {
//                $top_upper_id = 0;
//
//            }else{
				$result_refferal=$this->common->select_row('member_refferal_detail','',Array('uid'=>$user_data->uid));
//                $top_upper_id = $param['upper_uid'];
				$top_upper_cd = $result_refferal->top_upper_cd;
			}


			$query = $this->db->query('select uid from member where email=? ',array('uid'=>$param['email'],));
			$result = $query->row();
			$uid = $result->uid;

			$this->db->query('insert into member_refferal_detail(upper_uid,uid,top_upper_cd)VALUES (?,?,?)',
				array(
					'upper_uid'=>$param['upper_uid'],
					'uid'=>$uid,
//                    'top_upper_id'=>$top_upper_id,
					'top_upper_cd'=>$top_upper_cd,
				)
			);
		}

	}
	function email_duplicate($email)
	{
		//이메일인증
		$sql =" select email from member where email =?";
		$query=$this->db->query($sql,
			array(
				'email'=>$email,
			)
		);
		if($query->num_rows()>0)
		{
			// 맞는 데이터가 있다면 해당 내용 반환
			return $query->row();
		}
		else
		{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}
	//이메이인증 확인
	function email_auth_proc($param)
	{
		$sql="select email_auth from member where email_auth =?";
		$query = $this->db->query($sql,
			array(
				'email_auth'=>$param['auth_code'],
			)
		);
		if($query->num_rows()>0)
		{
			// 맞는 데이터가 있다면 인증 상태 업데이트
			$set['email_auth_status']=1;
			$where['email_auth']=$param['auth_code'];
			$this->db->update('member', $set, $where);
			return $query->row();
		}
		else
		{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}
	//가입코드 확인
	function select_refferal_user($param)
	{
		$sql =" select * from member where refferal_code=?";
		$query=$this->db->query($sql,
			array(
				'email'=>$param,
//                'password'=>$auth['password']
			)
		);

		if($query->num_rows()>0)
		{
			// 맞는 데이터가 있다면 해당 내용 반환
			return $query->row();
		}
		else
		{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}

}
