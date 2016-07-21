import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = 'df000bc04cb16c65265ba52ede78028d2c451abb'
	sensor_reading = random.uniform(27.00, 27.00)


	data = 	{
		'sensor_key': sensor_key,
		'sensor_reading': sensor_reading
	}

	req = urllib2.Request('http://localhost/sensorman/send-data')
	req.add_header('Content-Type', 'application/json')
	response = urllib2.urlopen(req, json.dumps(data))
	print json.dumps(data)
	print response.read()


while(True):

	sendSensorData()
	time.sleep(1)	
