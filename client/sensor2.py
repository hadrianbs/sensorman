import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = '3b623224a84a1dd88de344037e17c20ddfb72725'
	sensor_reading = random.uniform(20, 37)


	data = 	{
		'sensor_key': sensor_key,
		'sensor_reading': sensor_reading
	}

	req = urllib2.Request('http://bayanulhaq.me/api/retrieve_data')
	req.add_header('Content-Type', 'application/json')
	response = urllib2.urlopen(req, json.dumps(data))
	print json.dumps(data)
	print response.read()


while(True):

	sendSensorData()
	time.sleep(1)	
