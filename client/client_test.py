import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = 'e5e0fca9ca401a562067d4125b1fb588f0c5c0aa'
	sensor_reading = random.uniform(47, 58)


	data = 	{
		'sensor_key': sensor_key,
		'sensor_reading': sensor_reading
	}

	req = urllib2.Request('http://sensorman.bayanulhaq.me/send-data')
	req.add_header('Content-Type', 'application/json')
	response = urllib2.urlopen(req, json.dumps(data))
	print json.dumps(data)
	print response.read()


while(True):

	sendSensorData()
	time.sleep(1)	
