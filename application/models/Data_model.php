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

	public function getSensorData($sensorid)
	{
		$this->db->select('sensor.id as SENSORID, sensor.sensor_name as SENSORNAME, sensor.sensor_description as SENSORDESC, sensor_data.timestamp as TIMESTAMP, sensor_data.sensor_reading as DATAREADING');
		$this->db->from('sensor');
		$this->db->join('sensor_data', 'sensor_data.sensor_id = sensor.id');
		$this->db->where('sensor.id', $sensorid);
		$query = $this->db->get();
		return $query->result();
	}
}