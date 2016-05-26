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

	public function getCollabList()
	{
		$this->db->from('sensor_collab');
		$query = $this->db->get();
		return $query->result();
	}

	public function createNewCollab($newSensorData)
	{
		$this->db->insert('sensor_collab', $newSensorData);
	}

	public function insertNewAlert($newAlertData)
	{
		$this->db->insert('sensor_rule', $newAlertData);
	}
}