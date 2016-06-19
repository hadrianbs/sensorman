import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = '9b34105dfe82611b628e750f9dea4663f7a3c8bb'
	sensor_reading = random.uniform(23, 31)


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
	time.sleep(2)	
