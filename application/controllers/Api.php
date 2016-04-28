<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#API Controller for RESTFUL Stuff.

class Api extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model');
		$this->load->model('Data_model');
	}

	private function return_message($message)
	{
		$data = array(
			'message' => $message
			);

		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data));
	}

	public function index()
	{
		$data = array(
			'message' => "undefined function call"
			);

		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data));
	}

	function retrieve_data()
	{
		$raw_data = $this->input->raw_input_stream;
		$json_data = json_decode($raw_data);

		$sensor_key = $json_data->sensor_key;
		$sensor_reading = $json_data->sensor_reading;

		#Check 'sensor' database for sensor with equivalent 'sensor_key' . If Available, return the id of the sensor
		if($sensor_id = $this->Api_model->checkSensorKey($sensor_key))
		{
			#prepare data
			$sensorReadingData = array(
					'sensor_id' => $sensor_id[0]->SENSORID,
					'sensor_reading' => $sensor_reading
					);
			if($collab_data = $this->Api_model->checkCollab($sensor_id[0]->SENSORID))
			{
				#Check Collab COMPARATIVE OPERATOR (AND / OR)
				if($collab_data[0]->comp_operator == 'OR')
				{
					if($collab_data[0]->sensor_x_id == $sensor_id[0]->SENSORID)
					{
						#Get the Y last record of Y value
						$sensor_y_value = $this->Data_model->getLastRecord($collab_data[0]->sensor_y_id);

						#calculate the result
						switch ($collab_data[0]->operator) {
							case '*':
								$result = $sensor_reading * $sensor_y_value[0]->datareading;
								break;
							case '+':
								$result = $sensor_reading + $sensor_y_value[0]->datareading;
								break;
							case '-':
								$result  = $sensor_reading - $sensor_y_value[0]->datareading;
								break;
							case '/':
								$result = $sensor_reading / $sensor_y_value[0]->datareading;							
						}

						#Prepare the Data
						$newCollabData = array(
						'sensor_x_value' => $sensor_reading,
						'sensor_y_value' => $sensor_y_value[0]->datareading,
						'sensor_collab_id' => $collab_data[0]->sensor_collab_id,
						'sensor_reading' => $result
						);

						#output data (for debug purpose)
						echo "OR, DATA FROM X \n";
						print_r($newCollabData);
					}
					elseif($collab_data[0]->sensor_y_id == $sensor_id[0]->SENSORID)
					{
						#GET last value of X
						$sensor_x_value = $this->Data_model->getLastRecord($collab_data[0]->sensor_x_id);

						#calculate the result
						switch($collab_data[0]->operator)
						{
							case '*':
								$result = $sensor_reading * $sensor_x_value[0]->datareading;
								break;
							case '+':
								$result = $sensor_reading + $sensor_x_value[0]->datareading;
								break;
							case '-':
								$result = $sensor_reading - $sensor_x_value[0]->datareading;
								break;
							case '/':
								$result = $sensor_reading / $sensor_x_value[0]->datareading;
								break;
						}
						$newCollabData = array(
							'sensor_x_value' => $sensor_x_value[0]->datareading,
							'sensor_y_value' => $sensor_reading,
							'sensor_collab_id' => $collab_data[0]->sensor_collab_id,
							'sensor_reading' => $result
							);

						echo "OR, DATA FROM Y\n";
						print_r($newCollabData);

					}					
				}
				elseif($collab_data[0]->comp_operator == 'AND')
				{
					#Check wether the incoming data is from X or Y
					#incoming data from X
					if($collab_data[0]->sensor_x_id == $sensor_id[0]->SENSORID)
					{
						#Check wether the Y value satisfies its rule

						#get the rule data
						$sensorAlertData = $this->Api_model->getSensorAlertData($collab_data[0]->sensor_y_id);

						#get the latest Y value
						$sensor_y_value = $this->Data_model->getLastRecord($collab_data[0]->sensor_y_id);

						#compare with rule
						#Rule satisfied
						if($this->Api_model->checkSensorRule($sensorAlertData, $lastSensorYRecord))
						{
							switch ($collab_data[0]->operator) 
							{
								case '*':
									$result = $sensor_reading * $sensor_y_value[0]->datareading;
									break;
								case '+':
									$result = $sensor_reading + $sensor_y_value[0]->datareading;
									break;
								case '-':
									$result  = $sensor_reading - $sensor_y_value[0]->datareading;
									break;
								case '/':
									$result = $sensor_reading / $sensor_y_value[0]->datareading;							
							}

							#prepdata
							$newCollabData = array(
								'sensor_x_value' => $sensor_reading,
								'sensor_y_value' => $sensor_y_value[0]->datareading,
								'sensor_collab_id' => $collab_data[0]->sensor_collab_id,
								'sensor_reading' => $result
								);
							echo "AND, Y SATISFIED". "\n";

							#Send collab data
							print_r($newCollabData);
						}


					}
				}
			}

			#Insert sensor data reading to 'sensor_data' table
			$this->Api_model->insertSensorReadingData($sensorReadingData);

			print_r($sensorReadingData);
			$this->return_message('Successfully retrieved sensor_reading data');
		}
		else
		{
			$data = array(
			'message' => "invalid sensor_key. please recheck your sensor_key or register your sensor first"
			);

			$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($data));
		}
	}

}
