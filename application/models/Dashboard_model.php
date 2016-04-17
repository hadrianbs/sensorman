<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model{

	public function createNewSensor($newSensorData)
	{
		$this->db->insert('sensor', $newSensorData);
	}

	public function getSensorList()
	{
		$this->db->from('sensor');
		$query = $this->db->get();
		return $query->result();
	}
}