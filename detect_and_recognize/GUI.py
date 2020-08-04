from guizero import App, Text, TextBox, PushButton
import tkinter as tk
import mysql.connector as mariadb
import os
from gpiozero import InputDevice
from gpiozero import OutputDevice
import time
from datetime import datetime
from picamera import PiCamera
import cv2

pir = InputDevice(17)

def convertToBinaryData(filename):
    # Convert digital data to binary format
    with open(filename, 'rb') as file:
        binaryData = file.read()
    return binaryData

def add():
    t["state"]="normal"
    b3["state"]="normal"
    
def enter():
    print("opening recognizer..")
    os.system("python3 /home/pi/Documents/det_and_recog/recognizeface2.py")
def check():
    mariadb_connection = mariadb.connect(user='samra', password='123456', database='securehome')
    cursor = mariadb_connection.cursor()
    cursor.execute("""SELECT Password FROM User WHERE Username = %s""",("samrakhalid00",))
    record = cursor.fetchall()

    for row in record:
        p = row[0]
    if password.get()==p:
        print("matched")
        camera = PiCamera()
        camera.resolution = (640, 480)
        camera.framerate = 30
        
        now = datetime.now()
        current= now.strftime("%m/%d/%Y, %H:%M:%S")
        cursor = mariadb_connection.cursor()
        cursor.execute("""DELETE FROM camera WHERE Username=%s""",("samrakhalid00",))
        cursor.execute("""INSERT INTO camera (Username,Time) VALUES (%s,%s)""",("samrakhalid00",current))
        cursor.execute("""DELETE FROM Cam WHERE Username=%s""",("samrakhalid00",))
        cursor.execute("""INSERT INTO Cam (Username,Status) VALUES (%s,%s)""",("samrakhalid00",1))
        mariadb_connection.commit()

        
        camera.start_preview()
        time.sleep(5)
        camera.capture('/home/pi/Documents/det_and_recog/pic.jpg')
        camera.stop_preview()
        camera.close()

        cursor = mariadb_connection.cursor()
        cursor.execute("""DELETE FROM Cam WHERE Username=%s""",("samrakhalid00",))
        cursor.execute("""INSERT INTO Cam (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
        mariadb_connection.commit()

        image = cv2.imread("/home/pi/Documents/det_and_recog/pic.jpg")
        r=600.0/ image.shape[1]
        dim = (600, int(image.shape[0]*r))
        resized=cv2.resize(image,dim,interpolation=cv2.INTER_AREA)
        cv2.imwrite('/home/pi/Documents/det_and_recog/pic.jpg',resized)
        
        now = datetime.now()
        current= now.strftime("%m/%d/%Y, %H:%M:%S")
        cursor = mariadb_connection.cursor()
        cursor.execute("""INSERT INTO securitynotifications (Username,Time,Image,Message,Status) VALUES (%s,%s,%s,%s,%s)""",("samrakhalid00",current,convertToBinaryData("/home/pi/Documents/det_and_recog/pic.jpg"),"This Person Wants Access To Become Member",1))
        cursor.execute("""INSERT INTO MemberRequest (Username,Time,Message,Image) VALUES (%s,%s,%s,%s)""",("samrakhalid00",current,"This Person Wants Access To Become Member", convertToBinaryData("/home/pi/Documents/det_and_recog/pic.jpg")))
        mariadb_connection.commit()

        c=0
        while True:
            mariadb_connection = mariadb.connect(user='samra', password='123456', database='securehome')
            cursor = mariadb_connection.cursor()
            cursor.execute("""SELECT * FROM MemberRequest WHERE Username=%s""",("samrakhalid00",))
            record = cursor.fetchall()
            for row in record:
                s = row[5]
                print(s)
            if s==1:
                cursor = mariadb_connection.cursor()
                cursor.execute("""Delete FROM MemberRequest Where Username=%s""",("samrakhalid00",))
                mariadb_connection.commit()
                print("opening trainer..")
                t.delete(0,"end")
                t["state"]= "disabled"
                b3["state"]= "disabled"
                os.system("python3 /home/pi/Documents/det_and_recog/trainface2.py")
                break
            c=c+1
            if c==20000:
                cursor = mariadb_connection.cursor()
                cursor.execute("""Delete FROM MemberRequest Where Username=%s""",("samrakhalid00",))
                mariadb_connection.commit()
                print("Request Expired, No Reply")
                break
            time.sleep(3)
    else:
        print("incorrect password")
        
        
master = tk.Tk()
master.title("Face recognition")
master.geometry("300x250")
b1 = tk.Button(master, text="Select if you are a member",height="2", font="6px"  , width="24", bg='deep sky blue', command = enter)
b2 = tk.Button(master, text="Select if you are new",height="2", font="6px"  , width="24", bg='deep sky blue', command = add)
b3 = tk.Button(master, text="Ok",height="2",font="6px" , width="12", bg='deep sky blue', command = check)
l = tk.Label(master,text="Enter Password",font="6px")
password = tk.StringVar()
t = tk.Entry(master, textvariable=password, show='*', width="36")

b1.pack()
b2.pack()
l.pack()
t["state"]= "disabled"
t.pack()
b3["state"]= "disabled"
b3.pack(padx=15,pady=5, side="right")
count = 0
while True:
    if pir.value == 0:
        count = count+1
        if count>=5000:
            try:
                master.destroy()
            except:
                pass
    
    master.update()
    
