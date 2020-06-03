<?php


class download extends CI_Controller
{
	function __construct()
	{
	}
	public function index($fileName = NULL)
	{
		if ($fileName) {
			$file = realpath("download") . "\\" . $fileName;
			// check file exists
			if (file_exists($file)) {
				// get file content
				$data = file_get_contents($file);
				//force download
				force_download($fileName, $data);
			} else {
				// Redirect to base url
				redirect(base_url());
			}
		}
	}
}
