<?php
/**
 * Created by PhpStorm.
 * User: road
 * Date: 2019-10-16
 * Time: 오전 6:37
 */

class Common extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    function select_list($where='',$order_by='')
    {
        $this->db->select();
        if($where){
            $this->db->where($where['key'],$where['value']);
        }
        if($order_by){
            $this->db->order_by($order_by['key'],$order_by['value']);
        }
        $query= $this->db->get('ci_config');
        return $query->result();
    }
    function list_update($param,$pid)
    {
        $this->db->where('config_id', $pid);
        return $this->db->update('ci_config', $param);
    }
    //
    function select_row($table='',$sql='',$where='',$coding=true,$order_by='',$group_by='',$like='' )
    {
        $this->db->select($sql);
        if($where)  $this->db->where($where);
		if($like) $this->db->like($like[0],$like[1],$like[2]);
        if($order_by) $this->db->order_by($order_by);
        if($group_by) $this->db->group_by($group_by);
        $result = $this->db->get($table);
        return $result->row();
    }
    function select_list_table($table='',$sql='',$where='',$coding=false,$order_by='')
    {
        $this->db->select($sql);
        if($where)  $this->db->where($where);
        if($order_by) $this->db->order_by($order_by);
        $result = $this->db->get($table);
        return $result->result_array();
    }
    function select_count($table='',$sql='',$where='',$coding=false,$where_in_key='',$where_in_array='')
    {
        $this->db->select($sql);
        if($where)  $this->db->where($where);
        if($where_in_key) $this->db->where_in($where_in_key,$where_in_array);
        $result = $this->db->get($table);
        return $result->num_rows();
    }
	// where in array
	function multiple_where_in($array){
		foreach($array as $key  => $data){
			$this->db->where_in($key, $data);
		}
	}
    function select_list_table_result($table='',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit='')
    {
        $this->db->select($sql,$coding);
        if($where)  $this->db->where($where);
//        if($where_in) $this->db->where_in($where_in);
		if($where_in) $this->multiple_where_in($where_in);
        if($like) $this->db->like($like[0],$like[1],$like[2]);
        if($joina) $this->db->join($joina[0],$joina[1],$joina[2]);
        if($joinb) $this->db->join($joinb[0],$joinb[1],$joinb[2]);
        if($limit) $this->db->limit($limit[0],$limit[1]);
        if($order_by) $this->db->order_by($order_by['key'],$order_by['value']);
        if($group_by) $this->db->group_by($group_by);
        $result = $this->db->get($table);
        return $result->result();
    }
	function select_list_table_result_new($table='',$sql='',$where='',$coding=false,$order_by='',$group_by='',$where_in='',$like='',$joina='',$joinb='',$limit='')
	{
		$this->db->select($sql,$coding);
		if($where)  $this->db->where($where);
//        if($where_in) $this->db->where_in($where_in);
		if($where_in) $this->multiple_where_in($where_in);
		if($like) $this->db->like($like);
		if($joina) $this->db->join($joina[0],$joina[1],$joina[2]);
		if($joinb) $this->db->join($joinb[0],$joinb[1],$joinb[2]);
		if($limit) $this->db->limit($limit[0],$limit[1]);
		if($order_by) $this->db->order_by($order_by);
		if($group_by) $this->db->group_by($group_by);
		$result = $this->db->get($table);
		return $result->result();
	}
    function insert($table,$param)
    {
        return $this->db->insert($table,$param);
    }

    //배열의 마지막요소를 sdtArray 로로
	function array_end($array)
	{
		$val = end($array);
		return array(array_search($val, $array) => $val);
	}
    function insert_on_dup($table,$param){
		$dupValue='';
		foreach($param as $key=>$value){
			$dupValue .=$key."='".$value."'";
			if('br_cd' != $key) $dupValue.=", ";
		}

		$sql = $this->db->insert_string($table, $param) . ' ON DUPLICATE KEY UPDATE ' .$dupValue;

		$this->db->query($sql);
	}
    function update_row($table='',$param='',$pid_key='',$pid_value='')
    {
        $this->db->where($pid_key, $pid_value);
        return $this->db->update($table, $param);
    }
	function update_c($table='',$param='',$where='')
	{
		$this->db->where($where);
		return $this->db->update($table, $param);
	}
    function delete_row($table='',$where='')
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }
	/**
	 * 프로시져 호출
	 * @author Jongwon Byun <codeigniterk@gmail.com>
	 */
	function use_procedure($proc_name, $arg_arr=array())
	{
		if($arg_arr)
		{
			$arg = '\'';
			$arg .= implode('\',\'', $arg_arr);
			$arg .= '\'' .
//				',@return_value' .
				'';

			$sql = "CALL {$proc_name}({$arg});";
		}
		else
		{
			$sql = "CALL {$proc_name}(@return_value)";
		}

//		$this->mysqli = $this->load->database('mysqli', TRUE);


//		$sql = $this->db->query($sql);
		$result = $this->db->query($sql);

		$returns = $result->row();

		//로깅
//		$this->procedure_log($proc_name, implode('|', $arg_arr), implode('|', $returns[0]));

		return $returns;

	}
	/**
	 * 프로시져 호출
	 * 멀티 리턴
	 * @author Jongwon Byun <codeigniterk@gmail.com>
	 */
	function use_procedure_multi($proc_name, $arg_arr=array())
	{
		if($arg_arr)
		{
			$arg = '\'';
			$arg .= implode('\',\'', $arg_arr);
//			$arg .= '\'';
			$arg .= '\'' .
//				',@return_value' .
				'';

			$sql = "CALL {$proc_name}({$arg});";
		}
		else
		{
			$sql = "CALL {$proc_name}(@return_value)";
		}

//		$this->mysqli = $this->load->database('mysqli', TRUE);


		$result = $this->db->query($sql);

		$returns = $result->row();

		//로깅
//		$this->procedure_log($proc_name, implode('|', $arg_arr), @implode('|', $returns[0]));

		return $returns;

	}
}
