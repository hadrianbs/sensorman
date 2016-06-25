import socket
import time
import json
import urllib2
import random



def sendSensorData():


	sensor_key = '26d4a5d7cf4fb4511253358448ff89171c2e901f'
	sensor_reading = random.uniform(15, 9)


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
	time.sleep(1.5)	
