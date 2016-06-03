	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#API Controller for RESTFUL Stuff.

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Data_model');
	}

	public function index()
	{
		#$this->load->view();
	}
}