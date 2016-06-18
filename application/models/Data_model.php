<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data_model extends CI_Model{

	public function getSensorData($sensorid)
	{
		$this->db->select('sensor.id as SENSORID, sensor.sensor_name as SENSORNAME, sensor.sensor_description as SENSORDESC, sensor.sensor_key as SENSORKEY, sensor_data.timestamp as TIMESTAMP, sensor_data.sensor_reading as DATAREADING');
		$this->db->from('sensor');
		$this->db->join('sensor_data', 'sensor_data.sensor_id = sensor.id', 'left');
		$this->db->where('sensor.id', $sensorid);
		$this->db->limit(500);
		$query = $this->db->get();
		return $query->result();
	}

	//all collab data for data tables.
	public function getCollabData($collabId)
	{
		$this->db->select('sensor_collab.sensor_collab_id as COLLABID, sensor_collab.sensor_collab_name as COLLABNAME, sensor_collab.sensor_collab_desc as COLLABDESC, sensor_collab_data.timestamp as TIMESTAMP, sensor_collab_data.sensor_reading as DATAREADING');
		$this->db->from('sensor_collab');
		$this->db->join('sensor_collab_data', 'sensor_collab_data.sensor_collab_id = sensor_collab.sensor_collab_id', 'left');
		$this->db->where('sensor_collab.sensor_collab_id', $collabId);
		$this->db->limit(1000);
		$query = $this->db->get();
		return $query->result();
	}

	#For getting real time and ALL sensor data
	public function getSensorReading($sensorId)
	{
		$this->db->select('sensor_data.sensor_reading as datareading, sensor_data.timestamp as timestamp');
		$this->db->from('sensor_data');
		$this->db->where('sensor_data.sensor_id', $sensorId);
		$this->db->order_by('sensor_data.timestamp', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	//all collab data for charts / real time.
	public function getCollabReading($collabId)
	{
		$this->db->select('sensor_collab_data.sensor_reading as datareading, sensor_collab_data.timestamp as timestamp');
		$this->db->from('sensor_collab_data');
		$this->db->where('sensor_collab_data.sensor_collab_id', $collabId);
		$this->db->order_by('sensor_collab_data.timestamp', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	#Get Last Record of Data
	public function getLastRecord($sensorId)
	{
		$this->db->select('sensor_data.sensor_reading as datareading, sensor_data.timestamp as timestamp');
		$this->db->from('sensor_data');
		$this->db->where('sensor_data.sensor_id', $sensorId);
		$this->db->order_by('sensor_data.id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	#for getting each day MAX data from all sensor data.
	public function getMaxSensorReading($sensorid)
	{
		$this->db->select('MAX(sensor_data.sensor_reading) as sensordata, DATE(sensor_data.timestamp) as sensordate');
		$this->db->from('sensor_data');
		$this->db->where('sensor_data.sensor_id', $sensorid);
		$this->db->group_by('DATE(sensor_data.timestamp)');
		$this->db->order_by('DATE(sensor_data.timestamp)', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getMinSensorReading($sensorid)
	{
		$this->db->select('MIN(sensor_data.sensor_reading) as sensordata, DATE(sensor_data.timestamp) as sensordate');
		$this->db->from('sensor_data');
		$this->db->where('sensor_data.sensor_id', $sensorid);
		$this->db->group_by('DATE(sensor_data.timestamp)');
		$this->db->order_by('DATE(sensor_data.timestamp)', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAverageSensorReading($sensorid)
	{
		$this->db->select('AVG(sensor_data.sensor_reading) as sensordata, DATE(sensor_data.timestamp) as sensordate');
		$this->db->from('sensor_data');
		$this->db->where('sensor_data.sensor_id', $sensorid);
		$this->db->group_by('DATE(sensor_data.timestamp)');
		$this->db->order_by('DATE(sensor_data.timestamp)', 'DESC');
		$query = $this->db->get();
		return $query->result();	
	}

	public function getMaxCollabReading($sensorid)
	{
		$this->db->select('MAX(sensor_collab_data.sensor_reading) as sensordata, DATE(sensor_collab_data.timestamp) as sensordate');
		$this->db->from('sensor_collab_data');
		$this->db->where('sensor_collab_data.sensor_collab_id', $sensorid);
		$this->db->group_by('DATE(sensor_collab_data.timestamp)');
		$this->db->order_by('DATE(sensor_collab_data.timestamp)', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getMinCollabReading($sensorid)
	{
		$this->db->select('MIN(sensor_collab_data.sensor_reading) as sensordata, DATE(sensor_collab_data.timestamp) as sensordate');
		$this->db->from('sensor_collab_data');
		$this->db->where('sensor_collab_data.sensor_collab_id', $sensorid);
		$this->db->group_by('DATE(sensor_collab_data.timestamp)');
		$this->db->order_by('DATE(sensor_collab_data.timestamp)', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAverageCollabReading($sensorid)
	{
		$this->db->select('AVG(sensor_collab_data.sensor_reading) as sensordata, DATE(sensor_collab_data.timestamp) as sensordate');
		$this->db->from('sensor_collab_data');
		$this->db->where('sensor_collab_data.sensor_collab_id', $sensorid);
		$this->db->group_by('DATE(sensor_collab_data.timestamp)');
		$this->db->order_by('DATE(sensor_collab_data.timestamp)', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSensorRulesById($sensorId)
	{
		$this->db->select('rule_id, sensor_id, rule_type');
		$this->db->from('sensor_rule');
		$this->db->where('sensor_id', $sensorId);
		$query = $this->db->get();
		$rules = array();

		if($query->result())
		{
			foreach ($query->result() as $rule) {
				$rules[$rule->rule_id] = $rule->rule_type;
			}
			return $rules;
		}
		else
		{
			return FALSE;
		}
	}

	public function getAllSensorRules($sensorId)
	{
		$this->db->select('rule_id, sensor_id, rule_type, rule_value');
		$this->db->from('sensor_rule');
		$this->db->where('sensor_id', $sensorId);
		$query = $this->db->get();
		return $query->result();
	}
}