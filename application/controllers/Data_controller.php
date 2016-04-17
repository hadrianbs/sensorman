<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Data_model');
	}

	public function getSensorData($sensorid)
	{
		$this->db->select('sensor.id as SENSORID, sensor.sensor_name as SENSORNAME, sensor.sensor_description as SENSORDESC, sensor_data.timestamp as TIMESTAMP, sensor_data.sensor_reading as DATAREADING');
		$this->db->from('sensor');
		$this->db->join('sensor_data', 'sensor_data.sensor_id = sensor.id');
		$this->db->where('sensor.id', $sensorid);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRealTimeSensorData($sensor_id)
	{
		$this->load->model('Data_model');
		$data = $this->Data_model->getSensorReading($sensor_id);
		foreach($data as $row)
		{
			$ret = array(strtotime($row->timestamp)*1000, (float)$row->datareading);
		}
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($ret));
	}

	public function getDataWithParam($sensor_id)
	{
		$this->load->model('Data_model');
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

}

?>