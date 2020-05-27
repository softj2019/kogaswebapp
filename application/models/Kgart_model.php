<?php


class Kgart_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
//		$this->load->model('common');
	}
	//분석요청 select_row
	function kgArtSelectList()
	{
		$sql ="select *  from kgart";
		//바인딩 예제
//		$sql =" select *  from member where email =? and password =?";
		$query=$this->db->query($sql
//			array(
//				array(3,6),//in (1,2) 바인딩
//				'email'=>$auth['email'],
//				'password'=>$auth['password']
//			),
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
