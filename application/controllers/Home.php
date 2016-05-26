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
		$data['collablist'] = $this->Dashboard_model->getCollabList();

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

	public function create_collab($param = NULL)
	{
		$data['userdata'] = $this->getUserData();

		if(isset($param))
		{
			if($param == 'form')
			{
				$data['sensor_list'] = $this->Dashboard_model->getSensorList();
				$this->load->view('header');
				$this->load->view('menu', $data);
				$this->load->view('new_collab_form');
				$this->load->view('footer');
			}
		}
		else
		{
			$user_id = $this->getUserData()->id;
			$sensor_collab_name = $this->input->post('name');
			$sensor_collab_desc = $this->input->post('description');
			$sensor_x_id = $this->input->post('sensor_x');
			$sensor_y_id = $this->input->post('sensor_y');
			$operator = $this->input->post('operator');

			$newSensorData = array(
				'user_id' => $user_id,
				'sensor_collab_name' => $sensor_collab_name,
				'sensor_collab_desc' => $sensor_collab_desc,
				'sensor_x_id' => $sensor_x_id,
				'sensor_y_id' => $sensor_y_id,
				'operator' => $operator,
				);

			$this->Dashboard_model->createNewCollab($newSensorData);
			$this->session->set_flashdata('successmessage', 'Sensor / data point successfully created!');
			redirect('home');


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
		$data['maxsensordata'] = $this->Data_model->getMaxSensorReading($sensorid);
		$data['minsensordata'] = $this->Data_model->getMinSensorReading($sensorid);
		$data['averagesensordata'] = $this->Data_model->getAverageSensorReading($sensorid);
		$this->load->view('header');
		$this->load->view('menu',$data);
		$this->load->view('analyze',$data);
		$this->load->view('footer');
	}

	public function createAlertForm($sensorid = NULL)
	{
		$data['userdata'] = $this->getUserData();
		$data['sensordata'] = $this->Data_model->getSensorData($sensorid);
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('new_alert', $data);
		$this->load->view('footer');
	}

	public function submitNewAlert()
	{
		$sensor_id = $this->input->post('sensor_id');
		$rule_type = $this->input->post('alert_type');
		$value = $this->input->post('value');

		$newAlertData = array(
			'sensor_id' => $sensor_id,
			'rule_type' => $rule_type,
			'rule_value' => $value
			);
		$this->Dashboard_model->insertNewAlert($newAlertData);
		redirect('viewsensor'."/".$sensor_id);
	}

}