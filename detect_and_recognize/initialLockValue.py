import time
from datetime import datetime
import RPi.GPIO as GPIO
import os
from gpiozero import MotionSensor
from gpiozero import InputDevice
from gpiozero import OutputDevice
import mysql.connector as mariadb

pir = InputDevice(17)
relay = OutputDevice(3, active_high=True, initial_value=False)

relay.off()
print("locked")

mariadb_connection = mariadb.connect(user='samra', password='123456', database='securehome')
cursor = mariadb_connection.cursor()

count=1
while True:
    if count>1:
        if pir.value == 1:
            
            now = datetime.now()
            current= now.strftime("%m/%d/%Y, %H:%M:%S")
            cursor = mariadb_connection.cursor()
            cursor.execute("""DELETE FROM PIRSensor WHERE Username=%s""",("samrakhalid00",))
            cursor.execute("""INSERT INTO PIRSensor (Username,Time) VALUES (%s,%s)""",("samrakhalid00",current))
            mariadb_connection.commit()
            cursor.execute("""DELETE FROM Motion WHERE Username=%s""",("samrakhalid00",))
            cursor.execute("""INSERT INTO Motion (Username,Status) VALUES (%s,%s)""",("samrakhalid00",1))
            mariadb_connection.commit()
            print("someone is here")
            os.system("python3 /home/pi/Documents/det_and_recog/GUI.py")
            
        else:
            cursor = mariadb_connection.cursor()
            cursor.execute("""DELETE FROM Motion WHERE Username=%s""",("samrakhalid00",))
            cursor.execute("""INSERT INTO Motion (Username,Status) VALUES (%s,%s)""",("samrakhalid00",0))
            mariadb_connection.commit()
            print("no movement")
            relay.off()
    count=count+1       
