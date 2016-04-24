import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = '758853b2aa8a7ab9361a25c2a4228656e7313dd1'
	sensor_reading = random.uniform(13, 37)


	data = 	{
		'sensor_key': sensor_key,
		'sensor_reading': sensor_reading
	}

	req = urllib2.Request('http://localhost/sensorman/api/retrieve_data')
	req.add_header('Content-Type', 'application/json')
	response = urllib2.urlopen(req, json.dumps(data))
	print json.dumps(data)
	print response.read()


while(True):

	sendSensorData()
	time.sleep(1)	