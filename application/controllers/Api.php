	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		if(isset($raw_data))
		{
			$raw_data = $this->input->raw_input_stream;
			$json_data = json_decode($raw_data);

			$sensor_key = $json_data->sensor_key;
			$sensor_reading = $json_data->sensor_reading;

			// $sensor_key = $this->input->post('sensor_key');
			// $sensor_reading = $this->input->post('sensor_reading');

			#Check 'sensor' database for sensor with equivalent 'sensor_key' . If Available, return the id of the sensor
			if($sensor_id = $this->Api_model->checkSensorKey($sensor_key))
			{
				#prepare data
				$sensorReadingData = array(
						'sensor_id' => $sensor_id[0]->SENSORID,
						'sensor_reading' => $sensor_reading
						);

				#Insert sensor data reading to 'sensor_data' table
				$this->Api_model->insertSensorReadingData($sensorReadingData);

				#Check if this sensor is registered to a collaboration.
				if($collab_data = $this->Api_model->checkCollab($sensor_id[0]->SENSORID))
				{
					foreach($collab_data as $collabs)
					{
						#Check member sensor in collab. if 2 :
						if(!isset($collabs->sensor_z_id))
						{
							#Check Collab COMPARATIVE OPERATOR (AND / OR)
							# OR Case
							if($collabs->comp_operator == 'OR')
							{
								# INCOMING DATA FROM X
								if($collabs->sensor_x_id == $sensor_id[0]->SENSORID)
								{
									#Get the Y last record of Y value
									$sensor_y_value = $this->Data_model->getLastRecord($collabs->sensor_y_id);

									#CALCULATION BLOCK
									$x = $sensor_reading;
									$y = $sensor_y_value[0]->datareading;
									$collabMathExpression = $collabs->operator;
									$replace = array("x", "y");
									$replaceWith = array($x, $y);
									$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
									$result = eval('return '.$mathExpressionEval.';');
									#END OF CALCULATION BLOCK							

									#Prepare the Data for insertion to DATABASE
									$newCollabData = array(
									'sensor_x_value' => $sensor_reading,
									'sensor_y_value' => $sensor_y_value[0]->datareading,
									'sensor_collab_id' => $collabs->sensor_collab_id,
									'sensor_reading' => $result
									);

									#output data (for debug purpose)
									echo "OR, DATA FROM X \n";
									print_r($newCollabData);
									$this->Api_model->insertCollabData($newCollabData);

								}
								# INCOMING DATA FROM Y
								elseif($collabs->sensor_y_id == $sensor_id[0]->SENSORID)
								{
									#GET last value of X
									$sensor_x_value = $this->Data_model->getLastRecord($collabs->sensor_x_id);

									#CALCULATION BLOCK
									$x = $sensor_x_value[0]->datareading;
									$y = $sensor_reading;
									$collabMathExpression = $collabs->operator;
									$replace = array("x", "y");
									$replaceWith = array($x, $y);
									$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
									$result = eval('return '.$mathExpressionEval.';');
									#END OF CALCULATION BLOCK
									
									#Prepare the data for insertion to database
									$newCollabData = array(
										'sensor_x_value' => $sensor_x_value[0]->datareading,
										'sensor_y_value' => $sensor_reading,
										'sensor_collab_id' => $collabs->sensor_collab_id,
										'sensor_reading' => $result
										);

									echo "OR, DATA FROM Y\n";
									print_r($newCollabData);
									$this->Api_model->insertCollabData($newCollabData);
								}					
							}
							elseif($collabs->comp_operator == 'AND')
							{

								#INCOMING DATA FROM X
								if($collabs->sensor_x_id == $sensor_id[0]->SENSORID)
								{
									#Get Y sensor rule id.
									$sensorCollabRuleId = $collabs->sensor_y_rule_id;

									#get the latest Y value
									$sensor_y_value = $this->Data_model->getLastRecord($collabs->sensor_y_id);

									#Compare the last y result to RULE stored in database
									#IF RULE IS SATISFIED.
									if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId, $sensor_y_value[0]->datareading))
									{
										#CALCULATION BLOCK
										$x = $sensor_reading;
										$y = $sensor_y_value[0]->datareading;
										$collabMathExpression = $collabs->operator;
										$replace = array("x", "y");
										$replaceWith = array($x, $y);
										$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
										$result = eval('return '.$mathExpressionEval.';');
										#ENDOF CALCULATION BLOCK

										#prepare data for insertion
										$newCollabData = array(
											'sensor_x_value' => $sensor_reading,
											'sensor_y_value' => $sensor_y_value[0]->datareading,
											'sensor_collab_id' => $collabs->sensor_collab_id,
											'sensor_reading' => $result
											);

										echo "AND, Y SATISFIED". "\n";
										#Insert to database
										print_r($newCollabData);
										$this->Api_model->insertCollabData($newCollabData);
									}
									else
									{
										echo "Y Not Satisfied\n";
									}
								}
								#INCOMING DATA FROM Y
								elseif($collabs->sensor_y_id == $sensor_id[0]->SENSORID)
								{
									#Get X sensor rule id.
									$sensorCollabRuleId = $collabs->sensor_x_rule_id;

									#Get the latest X value.
									$sensor_x_value = $this->Data_model->getLastRecord($collabs->sensor_x_id);

									#Compare last X value to RULE in database
									#IF RULE IS SATISFIED
									if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId, $sensor_x_value[0]->datareading))
									{
										#CALCULATION BLOCK
										$x = $sensor_x_value[0]->datareading;
										$y = $sensor_reading;
										$collabMathExpression = $collabs->operator;
										$replace = array("x", "y");
										$replaceWith = array($x, $y);
										$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
										$result = eval('return '.$mathExpressionEval.';');
										#ENDOFCALCULATION BLOCK

										#Prepare data for insertion to database
										$newCollabData = array(
											'sensor_x_value' => $sensor_x_value[0]->datareading,
											'sensor_y_value' => $sensor_reading,
											'sensor_collab_id' => $collabs->sensor_collab_id,
											'sensor_reading' => $result
											);

										echo "AND, X SATISFIED". "\n";
										#insert to database
										print_r($newCollabData);
										$this->Api_model->insertCollabData($newCollabData);
									}
									else
									{
										echo "X Not Satisfied";
									}
								}
							}
						}
						#endof 2 sensor checking

						#IF 3 Sensor Collab :
						elseif(isset($collabs->sensor_z_id))
						{
							#Check Collab COMPARATIVE OPERATOR (AND / OR)
							# OR Case
							if($collabs->comp_operator == 'OR')
							{
								# INCOMING DATA FROM X
								if($collabs->sensor_x_id == $sensor_id[0]->SENSORID)
								{
									#Get the last record of Y value
									$sensor_y_value = $this->Data_model->getLastRecord($collabs->sensor_y_id);
									#Get the last record of Z Value
									$sensor_z_value = $this->Data_model->getLastRecord($collabs->sensor_z_id);

									#CALCULATION BLOCK
									$x = $sensor_reading;
									$y = $sensor_y_value[0]->datareading;
									$z = $sensor_z_value[0]->datareading;
									$collabMathExpression = $collabs->operator;
									$replace = array("x", "y", "z");
									$replaceWith = array($x, $y, $z);
									$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
									$result = eval('return '.$mathExpressionEval.';');
									#END OF CALCULATION BLOCK							

									#Prepare the Data for insertion to DATABASE
									$newCollabData = array(
									'sensor_x_value' => $sensor_reading,
									'sensor_y_value' => $sensor_y_value[0]->datareading,
									'sensor_z_value' => $sensor_z_value[0]->datareading,
									'sensor_collab_id' => $collabs->sensor_collab_id,
									'sensor_reading' => $result
									);

									#output data (for debug purpose)
									echo "3 SENSOR COLLAB, OR, DATA FROM X \n";
									print_r($newCollabData);
									$this->Api_model->insertCollabData($newCollabData);
								}

								#Incoming data from Y
								elseif($collabs->sensor_y_id == $sensor_id[0]->SENSORID)
								{
									#Get the last record of X value
									$sensor_x_value = $this->Data_model->getLastRecord($collabs->sensor_x_id);
									#Get the last record of Z Value
									$sensor_z_value = $this->Data_model->getLastRecord($collabs->sensor_z_id);

									#CALCULATION BLOCK
									$x = $sensor_x_value[0]->datareading;
									$y = $sensor_reading;
									$z = $sensor_z_value[0]->datareading;
									$collabMathExpression = $collabs->operator;
									$replace = array("x", "y", "z");
									$replaceWith = array($x, $y, $z);
									$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
									$result = eval('return '.$mathExpressionEval.';');
									#END OF CALCULATION BLOCK							

									#Prepare the Data for insertion to DATABASE
									$newCollabData = array(
									'sensor_x_value' => $sensor_x_value[0]->datareading,
									'sensor_y_value' => $sensor_reading,
									'sensor_z_value' => $sensor_z_value[0]->datareading,
									'sensor_collab_id' => $collabs->sensor_collab_id,
									'sensor_reading' => $result
									);

									#output data (for debug purpose)
									echo "3 SENSOR COLLAB, OR, DATA FROM Y \n";
									print_r($newCollabData);
									$this->Api_model->insertCollabData($newCollabData);
								}

								#incoming data from Z
								elseif($collabs->sensor_z_id == $sensor_id[0]->SENSORID)
								{
									#Get the last record of X value
									$sensor_x_value = $this->Data_model->getLastRecord($collabs->sensor_x_id);
									#Get the last record of Y Value
									$sensor_y_value = $this->Data_model->getLastRecord($collabs->sensor_y_id);

									#CALCULATION BLOCK
									$x = $sensor_x_value[0]->datareading;
									$y = $sensor_reading[0]->datareading;
									$z = $sensor_reading;
									$collabMathExpression = $collabs->operator;
									$replace = array("x", "y", "z");
									$replaceWith = array($x, $y, $z);
									$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
									$result = eval('return '.$mathExpressionEval.';');
									#END OF CALCULATION BLOCK							

									#Prepare the Data for insertion to DATABASE
									$newCollabData = array(
									'sensor_x_value' => $sensor_x_value[0]->datareading,
									'sensor_y_value' => $sensor_reading[0]->datareading,
									'sensor_z_value' => $sensor_reading,
									'sensor_collab_id' => $collabs->sensor_collab_id,
									'sensor_reading' => $result
									);

									#output data (for debug purpose)
									echo "3 SENSOR COLLAB, OR, DATA FROM Y \n";
									print_r($newCollabData);
									$this->Api_model->insertCollabData($newCollabData);
								}
							}
							elseif($collabs->comp_operator == 'AND')
							{
								#INCOMING DATA FROM X
								if($collabs->sensor_x_id == $sensor_id[0]->SENSORID)
								{
									#Get Y sensor rule id.
									$sensorCollabRuleId_y = $collabs->sensor_y_rule_id;
									#Get Z sensor rule id.
									$sensorCollabRuleId_z = $collabs->sensor_z_rule_id;

									#get the latest Y value
									$sensor_y_value = $this->Data_model->getLastRecord($collabs->sensor_y_id);
									#get latest Z value
									$sensor_z_value = $this->Data_model->getLastRecord($collabs->sensor_z_id);

									#Compare the last y result to RULE stored in database
									#IF RULE IS SATISFIED -> COMPARE Z RULE
									if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId_y, $sensor_y_value[0]->datareading))
									{
										#Compare Last Z result to RULE stored in database. If TRUE, start calculating.
										if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId_z, $sensor_z_value[0]->datareading))
										{
											#CALCULATION BLOCK
											$x = $sensor_reading;
											$y = $sensor_y_value[0]->datareading;
											$z = $sensor_z_value[0]->datareading;
											$collabMathExpression = $collabs->operator;
											$replace = array("x", "y", "z");
											$replaceWith = array($x, $y, $z);
											$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
											$result = eval('return '.$mathExpressionEval.';');
											#ENDOF CALCULATION BLOCK

											#prepare data for insertion
											$newCollabData = array(
												'sensor_x_value' => $sensor_reading,
												'sensor_y_value' => $sensor_y_value[0]->datareading,
												'sensor_z_value' => $sensor_z_value[0]->datareading,
												'sensor_collab_id' => $collabs->sensor_collab_id,
												'sensor_reading' => $result
												);
											echo "AND, Y, Z SATISFIED". "\n";

											#Insert to database
											print_r($newCollabData);
											$this->Api_model->insertCollabData($newCollabData);
										}
										else
										{
											echo "Source X | Z not Satisfied\n";
										}
									}
									else
									{
										echo "Surce X | Y Not Satisfied\n";
									}
								}

								#INCOMING DATA FROM Y
								if($collabs->sensor_y_id == $sensor_id[0]->SENSORID)
								{
									#Get X sensor rule id.
									$sensorCollabRuleId_x = $collabs->sensor_x_rule_id;
									#Get Z sensor rule id.
									$sensorCollabRuleId_z = $collabs->sensor_z_rule_id;

									#get the latest X value
									$sensor_x_value = $this->Data_model->getLastRecord($collabs->sensor_x_id);
									#get latest Z value
									$sensor_z_value = $this->Data_model->getLastRecord($collabs->sensor_z_id);

									#Compare the last X result to RULE stored in database
									#IF RULE IS SATISFIED -> COMPARE Z RULE
									if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId_x, $sensor_x_value[0]->datareading))
									{
										#Compare Last Z result to RULE stored in database. If TRUE, start calculating.
										if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId_z, $sensor_z_value[0]->datareading))
										{
											#CALCULATION BLOCK
											$x = $sensor_x_value[0]->datareading;
											$y = $sensor_reading;
											$z = $sensor_z_value[0]->datareading;
											$collabMathExpression = $collabs->operator;
											$replace = array("x", "y", "z");
											$replaceWith = array($x, $y, $z);
											$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
											$result = eval('return '.$mathExpressionEval.';');
											#ENDOF CALCULATION BLOCK

											#prepare data for insertion
											$newCollabData = array(
												'sensor_x_value' => $sensor_x_value[0]->datareading,
												'sensor_y_value' => $sensor_reading,
												'sensor_z_value' => $sensor_z_value[0]->datareading,
												'sensor_collab_id' => $collabs->sensor_collab_id,
												'sensor_reading' => $result
												);
											echo "AND, X, Z SATISFIED". "\n";

											#Insert to database
											print_r($newCollabData);
											$this->Api_model->insertCollabData($newCollabData);
										}
										else
										{
											echo "Source Y | Z not Satisfied\n";
											print_r($sensor_z_value);
											print_r($sensorCollabRuleId_z);
										}
									}
									else
									{
										echo "Source Y | X Not Satisfied\n";
									}
								}
								#INCOMING DATA FROM Z
								if($collabs->sensor_z_id == $sensor_id[0]->SENSORID)
								{
									#Get X sensor rule id.
									$sensorCollabRuleId_x = $collabs->sensor_x_rule_id;
									#Get Y sensor rule id.
									$sensorCollabRuleId_y = $collabs->sensor_y_rule_id;

									#get the latest X value
									$sensor_x_value = $this->Data_model->getLastRecord($collabs->sensor_x_id);
									#get latest Y value
									$sensor_y_value = $this->Data_model->getLastRecord($collabs->sensor_y_id);

									#Compare the last X result to RULE stored in database
									#IF RULE IS SATISFIED -> COMPARE Z RULE
									if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId_x, $sensor_x_value[0]->datareading))
									{
										#Compare Last Z result to RULE stored in database. If TRUE, start calculating.
										if($this->Api_model->checkCollabSensorRule($sensorCollabRuleId_y, $sensor_y_value[0]->datareading))
										{
											#CALCULATION BLOCK
											$x = $sensor_x_value[0]->datareading;
											$y = $sensor_y_value[0]->datareading;
											$z = $sensor_reading;
											$collabMathExpression = $collabs->operator;
											$replace = array("x", "y", "z");
											$replaceWith = array($x, $y, $z);
											$mathExpressionEval = str_replace($replace, $replaceWith, $collabMathExpression);
											$result = eval('return '.$mathExpressionEval.';');
											#ENDOF CALCULATION BLOCK

											#prepare data for insertion
											$newCollabData = array(
												'sensor_x_value' => $sensor_x_value[0]->datareading,
												'sensor_y_value' => $sensor_y_value[0]->datareading,
												'sensor_z_value' => $sensor_reading,
												'sensor_collab_id' => $collabs->sensor_collab_id,
												'sensor_reading' => $result
												);
											echo "AND, X, Y SATISFIED". "\n";

											#Insert to database
											print_r($newCollabData);
											$this->Api_model->insertCollabData($newCollabData);
										}
										else
										{
											echo "Source Z | Y not Satisfied\n";
										}
									}
									else
									{
										echo "Source Z | X Not Satisfied\n";
									}
								}
							}

						}
						print_r($collabs);
					}
				}
				print_r($sensorReadingData); #Print for Debugging
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
		else
		{
			print_r($raw_data);
			$message = "No data received. Check your device code";
			$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($message));
		}
	}

}
