<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model{

	public function createNewSensor($newSensorData)
	{
		$this->db->insert('sensor', $newSensorData);
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

	public function getSensorList()
	{
		$this->db->from('sensor');
		$query = $this->db->get();
		return $query->result();
	}
}