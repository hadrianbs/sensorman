<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->model('Data_model');
	}

	function checkLogin()
	{
		if(!$this->ion_auth->logged_in())
		{
			redirect('authentication');
		}
	}

	function getUserData()
	{
		return $this->ion_auth->user()->row();
	}

	public function index()
	{
		$this->checkLogin();

		#Get user Data
		$data['userdata'] = $this->getUserData();
		$data['sensorlist'] = $this->Dashboard_model->getSensorList();

		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('home', $data);
		$this->load->view('footer');
	}

	public function create_sensor($param = NULL)
	{
		$data['userdata'] = $this->getUserData();

		if(isset($param))
		{
			if($param == 'form')
			{
				$this->load->view('header');
				$this->load->view('menu', $data);
				$this->load->view('new_sensor_form');
				$this->load->view('footer');
			}
			elseif($param == 'submit')
			{
				#Inserting Logics
				$user_id = $this->getUserData()->id;
				$sensor_name = $this->input->post('name');
				$sensor_description = $this->input->post('description');
				$sensor_key = sha1($sensor_name + time() + $user_id);

				$newSensorData = array(
					'user_id' => $user_id,
					'sensor_key' => $sensor_key,
					'sensor_name' => $sensor_name,
					'sensor_description' => $sensor_description,
					);

				$this->Dashboard_model->createNewSensor($newSensorData);
				$this->session->set_flashdata('successmessage', 'Sensor / data point successfully created!');
				redirect('home');
			}
		}
		else
		{
			redirect('new_sensor');
		}
	}

	public function viewsensor($sensorid = NULL)
	{
		if(isset($sensorid))
		{
			#Get sensor data
			$data['userdata'] = $this->getUserData();
			$data['sensordata'] = $this->Data_model->getSensorData($sensorid);
			$this->load->view('header');
			$this->load->view('menu',$data);
			$this->load->view('view_sensor',$data);
			$this->load->view('footer');
		}
	}

	public function analyzeSensor($sensorid = NULL)
	{
		$data['userdata'] = $this->getUserData();
		$data['sensordata'] = $this->Data_model->getSensorData($sensorid);
		$this->load->view('header');
		$this->load->view('menu',$data);
		$this->load->view('analyze',$data);
		$this->load->view('footer');
	}

}