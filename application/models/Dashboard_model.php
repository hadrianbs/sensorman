<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model{

	public function createNewSensor($newSensorData)
	{
		$this->db->insert('sensor', $newSensorData);
	}

	public function getSensorList($userId)
	{
		$this->db->from('sensor');
		$this->db->where('sensor.user_id', $userId);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCollabList($userId)
	{
		$this->db->from('sensor_collab');
		$this->db->where('sensor_collab.user_id', $userId);
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

	public function countDatabaseResult($table, $userId)
	{
		$this->db->from($table);
		$this->db->where($table.'.'.'user_id', $userId);
		return $this->db->count_all_results();
	}

	public function countSensorData($userId)
	{
		$this->db->from('sensor');
		$this->db->join('sensor_data', 'sensor_data.sensor_id = sensor.id', 'left');
		$this->db->where('sensor.user_id', $userId);
		return $this->db->count_all_results();
	}

	public function getPublicSensorList()
	{
		$this->db->from('sensor');
		$this->db->where('sensor.status','pub');
		$query = $this->db->get();
		return $query->result();
	}
}