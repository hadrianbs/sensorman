import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = '4112f06300ff3c0da70186c16ee6f229fa6cb126'
	sensor_reading = random.uniform(81, 87)


	data = 	{
		'sensor_key': sensor_key,
		'sensor_reading': sensor_reading
	}

	req = urllib2.Request('http://192.168.1.114/sensorman/api/retrieve_data/')
	req.add_header('Content-Type', 'application/json')
	response = urllib2.urlopen(req, json.dumps(data))
	print json.dumps(data)
	print response.read()


while(True):

	sendSensorData()
	time.sleep(2)	
