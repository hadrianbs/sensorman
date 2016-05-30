<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function index()
	{
		$this->load->view('auth/header');
		$this->load->view('auth/login');
	}

	public function register()
	{
		if($this->ion_auth->logged_in())
		{
			redirect('home');
		}
		else
		{
			$this->load->view('auth/header');
			$this->load->view('auth/register');
		}
	}

	public function create_account()
	{
		$identity = $this->input->post('identity');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		if(!$this->ion_auth->username_check($identity))
		{
			$this->ion_auth->register($identity, $password, $email);
			$this->session->set_flashdata('message', 'Akun kamu berhasil di daftarkan! Silahkan login disini');
			redirect('authentication');
		}
		else
		{
			#$this->session->set_flashdata('message', 'Username sudah dipakai');
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('authentication/register');
		}
	}

	public function login()
	{
		if($this->ion_auth->logged_in())
		{
			redirect('home');
		}
		else
		{
			$identity = $this->input->post('identity');
			$password = $this->input->post('password');
			if($this->ion_auth->login($identity, $password))
			{
				redirect('home');
			}
			else
			{
				$this->session->set_flashdata('message', 'Email atau Password salah!');
				redirect('authentication');
			}
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('authentication');
	}
}