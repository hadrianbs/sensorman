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

	public function checkCollab($sensor_id)
	{
		$this->db->from('sensor_collab');
		$this->db->where('sensor_x_id', $sensor_id);
		$this->db->or_where('sensor_y_id', $sensor_id);
		$this->db->or_where('sensor_x_id', $sensor_id);
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

	public function insertCollabData($collabData)
	{
		$this->db->insert('sensor_collab_data', $collabData);
	}

	public function getSensorAlertData($sensorId)
	{
		$this->db->from('sensor_rule');
		$this->db->where('sensor_rule.sensor_id', $sensorId);
		$query = $this->db->get();
		return $query->result();
	}

	public function checkSensorRule($ruledata, $sensor_reading)
	{
		foreach($ruledata as $rules)
		{
			if($rules->rule_type == 'high')
			{
				if($rules->rule_value > $sensor_reading)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			elseif($rules->rule_type == 'low')
			{
				if($rules->rule_value < $sensor_reading)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			elseif($rules->rule_type == 'equal')
			{
				if($rules->rule_value == $sensor_reading)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
	}

	public function checkCollabSensorRule($ruleId, $sensor_reading)
	{
		$this->db->from('sensor_rule');
		$this->db->where('sensor_rule.rule_id', $ruleId);
		$query = $this->db->get()->result();
		foreach($query as $rules)
		{
			if($rules->rule_type == 'high')
			{
				if($rules->rule_value < $sensor_reading)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			elseif($rules->rule_type == 'low')
			{
				if($rules->rule_value > $sensor_reading)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			elseif($rules->rule_type == 'equal')
			{
				if($rules->rule_value == $sensor_reading)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
	}
}
