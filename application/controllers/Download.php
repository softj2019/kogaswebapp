<?php


class download extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->model('common');
	}
	public function getfile($fileName = NULL)
	{
		$where = array(
			"ar_cd"=>$fileName,
		);
		$row =  $this->common->select_row($table='kgrct','',$where,$coding=false,$order_by='',$group_by='' );

		if ($fileName) {
			$file = realpath($row->csvpath) . "\\" . $fileName."_file.csv";
//			// check file exists
			if (file_exists($file)) {
//				// get file content
				$data = file_get_contents('file:///'.$file);
//				//force download
				force_download($fileName."_file.csv", $data);
			} else {
//				// Redirect to base url
				redirect($this->agent->referrer());;
			}
		}
	}
	public function getBoardFile($fileName = NULL)
	{
		if ($fileName) {
			$file = realpath($this->config->item("uploads")) . "\\board\\" . $fileName;
//			// check file exists
			if (file_exists($file)) {
//				// get file content
				$data = file_get_contents('file:///'.$file);
//				//force download
				force_download($fileName, $data);
			} else {
//				// Redirect to base url
				redirect($this->agent->referrer());;
			}
		}
	}
}
