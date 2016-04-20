<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model{

	public function checkSensorKey($sensorKey)
	{
		$this->db->select('sensor.id as SENSORID');
		$this->db->from('sensor');
		$this->db->where('sensor_key', $sensorKey);
		if($query = $this->db->get())
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	public function insertSensorReadingData($sensorReadingData)
	{
		$this->db->insert('sensor_data', $sensorReadingData);
	}

}
