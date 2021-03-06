<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Data_model');
	}

	public function getRealTimeSensorData($sensor_id)
	{
		$data = $this->Data_model->getSensorReading($sensor_id);
		foreach($data as $row)
		{
			$ret = array(strtotime($row->timestamp)*1000, (float)$row->datareading);
		}
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($ret));
	}

	public function getRealTimeCollabData($collabId)
	{
		$data = $this->Data_model->getCollabReading($collabId);
		foreach($data as $row)
		{
			$ret = array(strtotime($row->timestamp)*1000, (float)$row->datareading);
		}
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($ret));
	}

	public function getAllSensorData($sensor_id)
	{
		$querydata = $this->Data_model->getSensorReading($sensor_id);
		foreach($querydata as $row)
		{
			$datetime = strtotime($row->timestamp)*1000;
			$datareading = (float)$row->datareading;
			$data[] = [$datetime, $datareading];
		}
		
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
	}

	public function getMaxSensorReading($sensor_id)
	{
		$querydata = $this->Data_model->getMaxSensorReading($sensor_id);
		foreach($querydata as $row)
		{
			$datetime = strtotime($row->sensordate)*1000;
			$datareading = (float)$row->sensordata;
			$data[] = [$datetime, $datareading];
		}
		
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
	}

	public function getMinSensorReading($sensor_id)
	{
		$querydata = $this->Data_model->getMinSensorReading($sensor_id);
		foreach($querydata as $row)
		{
			$datetime = strtotime($row->sensordate)*1000;
			$datareading = (float)$row->sensordata;
			$data[] = [$datetime, $datareading];
		}
		
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
	}

	public function getAverageSensorReading($sensor_id)
	{
		$querydata = $this->Data_model->getAverageSensorReading($sensor_id);
		foreach($querydata as $row)
		{
			$datetime = strtotime($row->sensordate)*1000;
			$datareading = (float)$row->sensordata;
			$data[] = [$datetime, $datareading];
		}
		
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
	}

	public function getSensorRules($sensorId)
	{
		$rules = $this->Data_model->getSensorRulesById($sensorId);
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($rules));
	}

	public function getCollabCharts($collabId = NULL, $chartType = NULL)
	{
		if($chartType == 'all')
		{
			$querydata = $this->Data_model->getCollabReading($collabId);
			foreach($querydata as $row)
			{
				$datetime = strtotime($row->timestamp)*1000;
				$datareading = (float)$row->datareading;
				$data[] = [$datetime, $datareading];
			}
			
			$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
		}
		else if ($chartType == 'max')
		{
			$querydata = $this->Data_model->getMaxCollabReading($collabId);
			foreach($querydata as $row)
			{
				$datetime = strtotime($row->sensordate)*1000;
				$datareading = (float)$row->sensordata;
				$data[] = [$datetime, $datareading];
			}
			
			$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
		}
		else if ($chartType == 'min')
		{
			$querydata = $this->Data_model->getMinCollabReading($collabId);
			foreach($querydata as $row)
			{
				$datetime = strtotime($row->sensordate)*1000;
				$datareading = (float)$row->sensordata;
				$data[] = [$datetime, $datareading];
			}
			
			$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
		}
		else if ($chartType == 'average')
		{
			$querydata = $this->Data_model->getAverageCollabReading($collabId);
			foreach($querydata as $row)
			{
				$datetime = strtotime($row->sensordate)*1000;
				$datareading = (float)$row->sensordata;
				$data[] = [$datetime, $datareading];
			}
			
			$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($data, JSON_NUMERIC_CHECK));
		}
		else
		{
			echo "notspecified";
		}
	}
}

?>