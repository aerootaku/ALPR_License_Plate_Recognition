#mysql connection
from __future__ import print_function
from datetime import date, datetime, timedelta
import mysql.connector as mconn
from mysql.connector import errorcode as errcode

#program-related stuff
from subprocess import Popen, PIPE
import json
from pprint import pprint
import numpy as np
import cv2
import threading

#scan_plates()

#Executes a bash command, and returns output. As string. Probably.
def run(command):
    process = Popen(command, stdout=PIPE, shell=True)
    while True:
        line = process.stdout.readline().rstrip()
        if not line:
            break
        yield line

#def process_output(output): 

#I know this is slow, but sorry man, I'm still noob at python.
#Optimized queries coming soon. xD

### RECORDS SPEED DATA INTO THE DATABASE ###
## Please put this in a background thread, at least. hahaha
def record_data(plate,speed):

	cnx = mconn.connect(user='root',password='Rachel17.dopadopa',host='127.0.0.1',database='platecontainer')
	cursor = cnx.cursor()

	add_plates = ("INSERT INTO plate_record (plate_no,date_record,est_speed) values (%s,%s,%s) ON DUPLICATE KEY UPDATE date_record=%s,est_speed=%s")

	data_plates = (plate,datetime.now(),speed,datetime.now(),speed)

	cursor.execute(add_plates,data_plates)

	cnx.commit()

	cursor.close()
	cnx.close()

### DEBUG CODE -- DO NOT ENABLE IF YOU DON'T KNOW WHAT YOU'RE DOING###

#def parse_json_data(output):
	

#def process_results(results):
	
#def disp_cam():

	#cap = cv2.VideoCapture('http://192.168.254.105:8080/video')
	#cap = cv2.VideoCapture('rtsp://admin:admin@192.168.0.108/live')

	#while(cap.isOpened()):
	    #ret, frame = cap.read()
	    #gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

	    #cv2.line(frame,(0,0),(511,511),(255,0,0),5)
	    #img = frame.array
	    #cv2.namedWindow("frame",cv2.WINDOW_NORMAL)
	    #cv2.resizeWindow('frame',520,520)
	    #cv2.imshow('frame',frame)
	    #if cv2.waitKey(1) & 0xFF == ord('q'):
	     #   break

	#cap.release()
	#cv2.destroyAllWindows()

def scan_plates():

	#Initialize the thread for capturing video stream.
	#Adjust this according to the ip of the cam where you'll get your stream.
	cap = cv2.VideoCapture('http://192.168.43.220:8080/video')#'http://192.168.254.106:8080/video')

	#We use openalpr to detect the plates. this then returns valuable information
	#which will be used and can be seen below.
	for path in run("alpr -j -n 1 http://192.168.43.220:8080/video"):#http://192.168.254.106:8080/video"):

		#decode the received response from the execution of the bash code above.
		output = path.decode("utf-8")

		#Initialize the video frame.
		ret, frame = cap.read()
		#gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

		if "connecting" in output:
			print("Connecting to video stream...")
		elif "connected" in output:
			print("Connected to video stream. Checking plates.")
		else:
			#load the response string as JSON to become a list
			#with keys which we can now access.
			jsondata = json.loads(output)
			#If there are results presented by openalpr, we process them
			if jsondata["results"]:
				for data in jsondata["results"]:
					#We get the first result which is the highest confidence presented by openalpr.
					results = data["candidates"][0]

					#We then fetch the coordinates of the plate number detected.
					coordinates = data["coordinates"]
					#The coordinates presented has four points, which represent a four-sided polygon:
					coord1 = coordinates[0]
					coord2 = coordinates[1]
					coord3 = coordinates[2]
					coord4 = coordinates[3]

					# Initialization of the coordinates extracted from openalpr.
					# We initialize the coordinates as an array.
					pts = np.array([(coord1["x"],coord1["y"]),(coord2["x"],coord2["y"]),(coord3["x"],coord3["y"]),(coord4["x"],coord4["y"])], np.int32)
					pts = pts.reshape((-1,1,2))
					#create a polygon with four vertices. Not necessary a rectangle, but yeah, a four-sided polygon.
					cv2.polylines(frame,[pts],True,(255,0,0),thickness=2,lineType=8,shift=0)
					#put text to the third coordinate, which is the lower left side of the rectangle
					cv2.putText(frame,results["plate"],(coord4["x"],coord4["y"]),cv2.FONT_HERSHEY_TRIPLEX,1,1)
					#save file to the folder where the script was executed
					cv2.imwrite("img_"+results["plate"]+".jpg",frame)

					#wrap the result to database then...
					with open('spd.data', 'r') as myfile:
						data=myfile.read().replace('\n', '')

					data = data.strip()

					speedval = float(data)

					record_data(results["plate"],speedval)

					### DEBUG CODE -- DO NOT ENABLE IF YOU DON'T KNOW WHAT YOU'RE DOING###
					#cv2.rectangle(frame,(coord1["x"],coord1["y"]),(coord2["x"],coord2["y"]),(coord3["x"],coord3["y"]),5)
					#print(coordinates[0]["x"])

		### DEBUG CODE -- DO NOT ENABLE IF YOU DON'T KNOW WHAT YOU'RE DOING###
		#cv2.line(frame,(0,0),(511,511),(255,0,0),5)
	    #img = frame.array

		#cv2.namedWindow("Plate Number Scanner",cv2.WINDOW_NORMAL)
		#cv2.resizeWindow('frame',520,520)
		cv2.imshow('Plate Number Scanner',frame)
		if cv2.waitKey(1) & 0xFF == ord('q'):
			break
		#print(path.decode("utf-8"))
		cv2.line(frame,(0,0),(511,511),(255,0,0),5)

if __name__ == "__main__":

	global frame
	#global cnx
	#global cursor

	### DEBUG CODE -- DO NOT ENABLE IF YOU DON'T KNOW WHAT YOU'RE DOING###
	#t1 = threading.Thread(target=scan_plates)
	#t1.daemon = False
	#t1.start()

	# I call both these things at the main thread for performance. hehe.
	#initialize_database()
	scan_plates()