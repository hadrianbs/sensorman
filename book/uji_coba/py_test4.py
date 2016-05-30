import socket
import time
import json
import urllib2
import datetime
import random



def sendSensorData():

        #ROOM01 HUMID
	sensor_key = 'e1964c20ec6dcf74ceb271cdafc4dd4aa405a412'
	sensor_reading = random.uniform(50, 55)


	data = 	{
		'sensor_key': sensor_key,
		'sensor_reading': sensor_reading
	}

	req = urllib2.Request('http://192.168.1.6/sensorman/api/retrieve_data')
	req.add_header('Content-Type', 'application/json')
	print "Sending data \n"
	start_time = datetime.datetime.now()
	#print start_time
	response = urllib2.urlopen(req, json.dumps(data))
	print json.dumps(data)
	print response.read()
	print "\n"
	end_time = datetime.datetime.now()
	#print end_time
	delta_time = end_time - start_time
	print "Start ", start_time
	print "end ", end_time
	print "Time elapsed ", delta_time


while(True):

	sendSensorData()
	time.sleep(1)	
