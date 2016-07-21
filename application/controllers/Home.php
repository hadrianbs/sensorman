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
		$data['sensorlist'] = $this->Dashboard_model->getSensorList($this->getUserData()->id);
		$data['collablist'] = $this->Dashboard_model->getCollabList($this->getUserData()->id);

		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('home', $data);
		$this->load->view('footer');
	}

	public function create_sensor($param = NULL)
	{
		$this->checkLogin();
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
				$sensor_status = $this->input->post('sensor_status');

				$newSensorData = array(
					'user_id' => $user_id,
					'sensor_key' => $sensor_key,
					'sensor_name' => $sensor_name,
					'sensor_description' => $sensor_description,
					'status' => $sensor_status
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
		$this->checkLogin();
		$data['userdata'] = $this->getUserData();

		if(isset($param))
		{
			if($param == 'form2')
			{
				$data['sensor_list'] = $this->Dashboard_model->getSensorList($this->getUserData()->id);
				$this->load->view('header');
				$this->load->view('menu', $data);
				$this->load->view('new_collab_form');
				$this->load->view('footer');
			}
			if($param == 'form3')
			{
				$data['sensor_list'] = $this->Dashboard_model->getSensorList($this->getUserData()->id);
				$this->load->view('header');
				$this->load->view('menu', $data);
				$this->load->view('new_three_collab_form');
				$this->load->view('footer');
			}
		
			else
			{
				if($param == 'submit2')
				{
					$user_id = $this->getUserData()->id;
					$sensor_collab_name = $this->input->post('name');
					$sensor_collab_desc = $this->input->post('description');
					$sensor_x_id = $this->input->post('sensor_x');
					$sensor_y_id = $this->input->post('sensor_y');
					$sensor_x_rule = $this->input->post('sensor_x_rule');
					$sensor_y_rule = $this->input->post('sensor_y_rule');
					$comparator = $this->input->post('comp_operator');
					$operator = $this->input->post('operator');

					$newSensorData = array(
						'user_id' => $user_id,
						'sensor_collab_name' => $sensor_collab_name,
						'sensor_collab_desc' => $sensor_collab_desc,
						'sensor_x_id' => $sensor_x_id,
						'sensor_y_id' => $sensor_y_id,
						'sensor_x_rule_id' => $sensor_x_rule,
						'sensor_y_rule_id' => $sensor_y_rule,
						'comp_operator' => $comparator,
						'operator' => $operator
						);

					$this->Dashboard_model->createNewCollab($newSensorData);
					$this->session->set_flashdata('successmessage', 'Sensor / data point successfully created!');
					redirect('home');
				}
				if($param == 'submit3')
				{
					$user_id = $this->getUserData()->id;
					$sensor_collab_name = $this->input->post('name');
					$sensor_collab_desc = $this->input->post('description');
					$sensor_x_id = $this->input->post('sensor_x');
					$sensor_y_id = $this->input->post('sensor_y');
					$sensor_z_id = $this->input->post('sensor_z');
					$sensor_x_rule = $this->input->post('sensor_x_rule');
					$sensor_y_rule = $this->input->post('sensor_y_rule');
					$sensor_z_rule = $this->input->post('sensor_z_rule');
					$comparator = $this->input->post('comparator');
					$operator = $this->input->post('operator');

					$newCollabData = array(
						'user_id' => $user_id,
						'sensor_collab_name' => $sensor_collab_name,
						'sensor_collab_desc' => $sensor_collab_desc,
						'sensor_x_id' => $sensor_x_id,
						'sensor_y_id' => $sensor_y_id,
						'sensor_z_id' => $sensor_z_id,
						'sensor_x_rule_id' => $sensor_x_rule,
						'sensor_y_rule_id' => $sensor_y_rule,
						'sensor_z_rule_id' => $sensor_x_rule,
						'comp_operator' => $comparator,
						'operator' => $operator
						);

					print_r($newCollabData);
					$this->Dashboard_model->createNewCollab($newCollabData);
					$this->session->set_flashdata('successmessage', 'Collab data point successfully created!');
					redirect('home');
				}
			}
		}
	}

	public function viewPublicSensors()
	{
		$this->checkLogin();
		$this->session->set_userdata('referred_from', current_url());
		#Get user Data
		$data['userdata'] = $this->getUserData();
		$data['sensorlist'] = $this->Dashboard_model->getPublicSensorList();

		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('public_sensors', $data);
		$this->load->view('footer');
	}

	public function viewsensor($sensorid = NULL)
	{
		$this->checkLogin();
		if(isset($sensorid))
		{
			#Get sensor data
			$data['userdata'] = $this->getUserData();
			$data['sensordata'] = $this->Data_model->getSensorData($sensorid);
			$data['sensor_rules'] = $this->Data_model->getAllSensorRules($sensorid);
			$this->load->view('header');
			$this->load->view('menu',$data);
			$this->load->view('view_sensor',$data);
			$this->load->view('footer');
		}
	}

	public function viewcollab($collabId = NULL)
	{
		$this->checkLogin();
		if(isset($collabId))
		{
			$data['userdata'] = $this->getUserData();
			$data['collabdata'] = $this->Data_model->getCollabData($collabId);
			$this->load->view('header');
			$this->load->view('menu',$data);
			$this->load->view('view_collab',$data);
			$this->load->view('footer');
		}
	}

	public function analyzeCollab($collabId = NULL)
	{
		$this->checkLogin();
		$data['userdata'] = $this->getUserData();
		$data['collabdata'] = $this->Data_model->getCollabData($collabId);
		$data['maxcollabdata'] = $this->Data_model->getMaxCollabReading($collabId);
		$data['mincollabdata'] = $this->Data_model->getMinCollabReading($collabId);
		$data['averagecollabdata'] = $this->Data_model->getAverageCollabReading($collabId);
		$this->load->view('header');
		$this->load->view('menu',$data);
		$this->load->view('analyze_collab', $data);
		$this->load->view('footer');
	}

	public function analyzeSensor($sensorid = NULL)
	{
		$this->checkLogin();
		$data['userdata'] = $this->getUserData();
		$data['sensordata'] = $this->Data_model->getSensorData($sensorid); //charts
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
		$this->checkLogin();
		$data['userdata'] = $this->getUserData();
		$data['sensordata'] = $this->Data_model->getSensorData($sensorid);
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('new_alert', $data);
		$this->load->view('footer');
	}

	public function submitNewAlert()
	{
		$this->checkLogin();
		$sensor_id = $this->input->post('sensor_id');
		$rule_type = $this->input->post('alert_type');
		$value = $this->input->post('value');

		$newAlertData = array(
			'sensor_id' => $sensor_id,
			'rule_type' => $rule_type,
			'rule_value' => $value
			);
		$this->Dashboard_model->insertNewAlert($newAlertData);
		redirect('sensor/view'."/".$sensor_id);
	}

	public function viewUserProfile()
	{
		$this->checkLogin();
		#get user profile

		$data['userdata'] = $this->getUserData();
		#view how many sensor left to cap
		$data['sensorNumber'] = $this->Dashboard_model->countDatabaseResult('sensor', $this->getUserData()->id);
		$data['collabNumber'] = $this->Dashboard_model->countDatabaseResult('sensor_collab', $this->getUserData()->id);
 		#view how many sensor data the user's have.
 		$data['totalSensorData'] = $this->Dashboard_model->countSensorData($this->getUserData()->id);
 		
 		$this->load->view('header');
 		$this->load->view('menu', $data);
 		$this->load->view('profile', $data);
 		$this->load->view('footer'); 		
	}

	public function viewDocumentation()
	{
		$this->checkLogin();
		$data['userdata'] = $this->getUserData();
		$this->load->view('header');
 		$this->load->view('menu', $data);
 		$this->load->view('documentation');
 		$this->load->view('footer'); 
	}

}