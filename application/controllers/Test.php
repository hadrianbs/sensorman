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
}