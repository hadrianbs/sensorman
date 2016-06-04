import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = '16f715e480d1ae011c03eb5908dbce9870d346a1'
	sensor_reading = random.uniform(13, 37)


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
