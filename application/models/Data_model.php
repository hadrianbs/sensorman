<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data_model extends CI_Model{

	public function getSensorReading($sensorId)
	{
		$this->db->select('sensor_data.sensor_reading as datareading, sensor_data.timestamp as timestamp');
		$this->db->from('sensor_data');
		$this->db->where('sensor_data.sensor_id', $sensorId);
		$query = $this->db->get();
		return $query->result();
	}
}