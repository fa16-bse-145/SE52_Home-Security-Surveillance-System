from guizero import App, Text, TextBox, PushButton
import tkinter as tk
import cv2
import os
from picamera.array import PiRGBArray
from picamera import PiCamera
import numpy as np
import pickle
import RPi.GPIO as GPIO
import mysql.connector as mariadb
import time
import smtplib
import imghdr
from datetime import datetime
from email.message import EmailMessage
from gpiozero import InputDevice
from gpiozero import OutputDevice
import secrets

pir = InputDevice(17)
relay = OutputDevice(3, active_high=True, initial_value=False)

Sender_Email = "automationfyp@gmail.com"
Reciever_Email = "samrakhalid00@gmail.com"
Member_Email = ""
Password = "AHWSFD06"

def confirm_pin():
    pin = my_pin.value
    app.destroy()
                

while True:

#    if GPIO.input(sensor_pin)==0:
    if pir.value == 0:
        cv2.destroyAllWindows()
        break
        
        
    def convertToBinaryData(filename):
    # Convert digital data to binary format
        with open(filename, 'rb') as file:
            binaryData = file.read()
        return binaryData

    def write_file(data, filename):
        # Convert binary data to proper format and write it on Hard Disk
        with open(filename, 'wb') as file:
            file.write(data)

    mariadb_connection = mariadb.connect(user='samra', password='123456', database='securehome')
    cursor = mariadb_connection.cursor()

    cursor.execute("""SELECT * FROM Train WHERE Username = %s""",("samrakhalid00",))
    record = cursor.fetchall()

    
        

    for row in record:
        write_file(row[1], "/home/pi/Documents/det_and_recog/trainer.yml")
        write_file(row[2], "/home/pi/Documents/det_and_recog/labels")

    with open('/home/pi/Documents/det_and_recog/labels', 'rb') as f:
        dicti = pickle.load(f)
        f.close()

    faceCascade = cv2.CascadeClassifier("/home/pi/Documents/det_and_recog/haarcascade_frontalface_default.xml")
    recognizer = cv2.face.LBPHFaceRecognizer_create()
    recognizer.read("/home/pi/Documents/det_and_recog/trainer.yml")

    font = cv2.FONT_HERSHEY_SIMPLEX

    camera = PiCamera()
    camera.resolution = (640, 480)
    camera.framerate = 30
    rawCapture = PiRGBArray(camera, size=(640, 480))
    
    now = datetime.now()
    current= now.strftime("%m/%d/%Y, %H:%M:%S")
    cursor = mariadb_connection.cursor()
    cursor.execute("""DELETE FROM camera WHERE Username=%s""",("samrakhalid00",))
    cursor.execute("""INSERT INTO camera (Username,Time) VALUES (%s,%s)""",("samrakhalid00",current))
    mariadb_connection.commit()
    
    
    for frame in camera.capture_continuous(rawCapture, format="bgr", use_video_port=True):
        frame = frame.array
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        faces = faceCascade.detectMultiScale(gray, scaleFactor = 1.5, minNeighbors = 5)
        cursor = mariadb_connection.cursor()
        cursor.execute("""DELETE FROM Cam WHERE Username=%s""",("samrakhalid00",))
        cursor.execute("""INSERT INTO Cam (Username,Status) VALUES (%s,%s)""",("samrakhalid00",1))
        mariadb_connection.commit()
        
        
        
        for (x, y, w, h) in faces:
            roiGray = gray[y:y+h, x:x+w]

            id_, threshold = recognizer.predict(roiGray)
    
            for name, value in dicti.items():
                if value == id_:
                    print(name)

            if threshold <= 70:
                
                confidence = float("{0:.2f}".format((100*(1-(threshold)/300))))
                print(confidence)
                
                cv2.rectangle(frame, (x, y), (x+w, y+h), (0, 255, 0), 2)
                cv2.putText(frame, name + str(confidence), (x, y), font, 2, (0, 0 ,255), 2,cv2.LINE_AA)
                fileName= name+".jpg"
                cv2.imwrite(fileName, roiGray)
                cursor = mariadb_connection.cursor()
                cursor.execute("""SELECT Email FROM member WHERE name = %s""",(name,))
                record = cursor.fetchone()
                Member_Email = record
                secret = '{:0>4}'.format(secrets.randbelow(10**4)) 
                newMessage = EmailMessage()                         
                newMessage['Subject'] = "SECURITY PIN" 
                newMessage['From'] = Sender_Email                   
                newMessage['To'] = Member_Email                   
                newMessage.set_content('You are found at the door! Please enter this security pin in the dialogue box. PIN IS: '+secret)
                with open(name+'.jpg', 'rb') as f:
                    image_data = f.read()
                    image_type = imghdr.what(f.name)
                    image_name = f.name
                newMessage.add_attachment(image_data, maintype='image', subtype=image_type, filename=image_name) 
                with smtplib.SMTP_SSL('smtp.gmail.com', 465) as smtp:
    
                    smtp.login(Sender_Email, Password)              
                    smtp.send_message(newMessage)
                app = App(title="Confirm Authorization", width="500",height="150",bg='deep sky blue')
                welcome_message = Text(app, text="A temporary security pin was emailed to you. Please Enter")
                my_pin = TextBox(app)
                update_text = PushButton(app, command=confirm_pin, text="OK")
                app.display()
                count=0
                while True:
                    if my_pin.value==secret:
                        cursor = mariadb_connection.cursor()
                        cursor.execute("""DELETE FROM Door WHERE Username=%s""",("samrakhalid00",))
                        cursor.execute("""INSERT INTO Door (Username,Status) VALUES (%s,%s)""",("samrakhalid00",1))
                        mariadb_connection.commit()         
                        print("opening lock for 10 seconds")
                        relay.on()
                        time.sleep(10)
                        relay.off()
                        cursor = mariadb_connection.cursor()
                        cursor.execute("""DELETE FROM Door WHERE Username=%s""",("samrakhalid00",))
                        cursor.execute("""INSERT INTO Door (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
                        mariadb_connection.commit()
                        print("locked after 10 seconds")
                        cursor = mariadb_connection.cursor()
                        now = datetime.now()
                        current= now.strftime("%m/%d/%Y, %H:%M:%S")
                        cursor.execute("""DELETE FROM DoorLock WHERE Username=%s""",("samrakhalid00",))
                        cursor.execute("""INSERT INTO DoorLock (Username,Time) VALUES (%s,%s)""",("samrakhalid00",current))
                        cursor.execute("""INSERT INTO securitynotifications (Username,Time,Image,Message) VALUES (%s,%s,%s,%s)""",("samrakhalid00",current,convertToBinaryData("/home/pi/Documents/det_and_recog/"+name+".jpg"),name+" Has entered the house!"))
                        mariadb_connection.commit()
                        cursor.close()
                        break;
                    else:
                        print("wrong pin!")
                    count=count+1
                    if count>60000:
                        try:
                            app.destroy()
                        except:
                            pass
                        my_pin.value=0
                        break;
                relay.off()
                cursor = mariadb_connection.cursor()
                cursor.execute("""DELETE FROM Door WHERE Username=%s""",("samrakhalid00",))
                cursor.execute("""INSERT INTO Door (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
                mariadb_connection.commit()
                print("door still locked")
                cursor = mariadb_connection.cursor()
                now = datetime.now()
                current= now.strftime("%m/%d/%Y, %H:%M:%S")
                cursor.execute("""INSERT INTO securitynotifications (Username,Time,Image,Message) VALUES (%s,%s,%s,%s)""",("samrakhalid00",current,convertToBinaryData("/home/pi/Documents/det_and_recog/"+name+".jpg"),name+" was found near the door but entered the wrong pin! Access denied."))
                mariadb_connection.commit()
                cursor.close()
                newMessage = EmailMessage()                         
                newMessage['Subject'] = "UNAUTHORIZED PERSON SECURITY ALERT" 
                newMessage['From'] = Sender_Email                   
                newMessage['To'] = Reciever_Email                   
                newMessage.set_content(name+' was found near the door but entered the wrong pin! Access denied.')
                with open(name+'.jpg', 'rb') as f:
                    image_data = f.read()
                    image_type = imghdr.what(f.name)
                    image_name = f.name
                newMessage.add_attachment(image_data, maintype='image', subtype=image_type, filename=image_name) 
                with smtplib.SMTP_SSL('smtp.gmail.com', 465) as smtp:
    
                    smtp.login(Sender_Email, Password)              
                    smtp.send_message(newMessage)

            else:
                relay.off()
                cursor = mariadb_connection.cursor()
                cursor.execute("""DELETE FROM Door WHERE Username=%s""",("samrakhalid00",))
                cursor.execute("""INSERT INTO Door (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
                mariadb_connection.commit()
                print("door still locked")
                #GPIO.output(relay_pin, 0)
                confidence = float("{0:.2f}".format((100*(1-(threshold)/300))))
                print(confidence)
                cv2.rectangle(frame, (x, y), (x+w, y+h), (0, 255, 0), 2)
                cv2.putText(frame, "unknown" + str(confidence), (x, y), font, 2, (0, 0 ,255), 2,cv2.LINE_AA)
                fileName="unknown.jpg"
                cv2.imwrite(fileName, roiGray)
                now = datetime.now()
                
                current= now.strftime("%m/%d/%Y, %H:%M:%S")
        
                cursor = mariadb_connection.cursor()
                cursor.execute("""INSERT INTO securitynotifications (Username,Time,Image,Message) VALUES (%s,%s,%s,%s)""",("samrakhalid00",current,convertToBinaryData("/home/pi/Documents/det_and_recog/unknown.jpg"),"This person was found near your house!"))
                mariadb_connection.commit()
                cursor.close()
                newMessage = EmailMessage()                         
                newMessage['Subject'] = "UNKNOWN PERSON SECURITY ALERT" 
                newMessage['From'] = Sender_Email                   
                newMessage['To'] = Reciever_Email                   
                newMessage.set_content('This person was found near your house!')
                with open('unknown.jpg', 'rb') as f:
                    image_data = f.read()
                    image_type = imghdr.what(f.name)
                    image_name = f.name
                newMessage.add_attachment(image_data, maintype='image', subtype=image_type, filename=image_name) 
                with smtplib.SMTP_SSL('smtp.gmail.com', 465) as smtp:
    
                    smtp.login(Sender_Email, Password)              
                    smtp.send_message(newMessage)            
                

        cv2.imshow('frame', frame)
        key = cv2.waitKey(1)

        rawCapture.truncate(0)
        
        #if GPIO.input(sensor_pin)==0:
        if pir.value == 0:    
            cursor = mariadb_connection.cursor()
            cursor.execute("""DELETE FROM Cam WHERE Username=%s""",("samrakhalid00",))
            cursor.execute("""INSERT INTO Cam (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
            mariadb_connection.commit()
            cv2.destroyAllWindows()
            break
        if key == 27:
            cursor = mariadb_connection.cursor()
            cursor.execute("""DELETE FROM Cam WHERE Username=%s""",("samrakhalid00",))
            cursor.execute("""INSERT INTO Cam (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
            mariadb_connection.commit()
            break

mariadb_connection = mariadb.connect(user='samra', password='123456', database='securehome')
cursor = mariadb_connection.cursor()
cursor.execute("""DELETE FROM Cam WHERE Username=%s""",("samrakhalid00",))
cursor.execute("""INSERT INTO Cam (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
mariadb_connection.commit()
cv2.destroyAllWindows()