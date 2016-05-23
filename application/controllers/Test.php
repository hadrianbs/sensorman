<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function chart_test()
	{
		$sensorId = 1;
		$this->load->view('chart_test');
	}

	public function ajax_getChartData($sensorId)
	{
		$this->load->model('Data_model');
		$data = $this->Data_model->getSensorReading($sensorId);
		foreach($data as $row)
		{

		}
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($data));
	}

	public function ajax_random()
	{
		$this->load->model('Data_model');
		$data = $this->Data_model->getSensorReading(1);
		foreach($data as $row)
		{
			$ret = array(strtotime($row->timestamp)*1000, (float)$row->datareading);
		}
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($ret));
	}

	public function ajax_random2()
	{
		$this->load->model('Data_model');
		$querydata = $this->Data_model->getSensorReading(1);
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

	public function cli_test()
	{
		while(1)
		{
			$this->load->model('Data_model');
			$datax = $this->Data_model->getSensorReading(1);
			$datay = $this->Data_model->getSensorReading(1);
			foreach($datax as $row)
			{
				$retx = array(strtotime($row->timestamp)*1000, (float)$row->datareading);
			}
			foreach($datay as $row)
			{
				$rety = array(strtotime($row->timestamp)*1000, (float)$row->datareading);
			}
			echo $retx;
			echo $rety;

		}
	}

	public function math_test()
	{
		$this->load->model('Data_model');
		$this->load->model('Api_model');
		$collabData = $this->Api_model->checkCollab(1);
		$x = $this->Data_model->getLastRecord($collabData[0]->sensor_x_id)[0]->datareading;
		$y = $this->Data_model->getLastRecord($collabData[0]->sensor_y_id)[0]->datareading;
		$op = $collabData[0]->operator;
		$replace = array("x", "y");
		$replaceWith = array($x, $y);
		$mathEx = str_replace($replace, $replaceWith, $op);
		echo $mathEx."    ";
		echo eval('return '.$mathEx.';');
	}

	public function rule_test()
	{
		$this->load->model('Api_model');
		var_dump($this->Api_model->checkCollabSensorRule(2, 21));
	}
}