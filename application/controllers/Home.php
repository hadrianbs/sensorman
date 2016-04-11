<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function checkLogin()
	{
		if(!$this->ion_auth->logged_in())
		{
			redirect('authentication');
		}
	}

	public function index()
	{
		$this->checkLogin();

		#Get user Data
		$currentUser = $this->ion_auth->user()->row();

		$data['userdata'] = $currentUser;
		$this->load->view('header');
		$this->load->view('menu',$data);
		#$this->load->view('');
		$this->load->view('footer');
	}

}