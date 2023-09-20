from twilio.rest import Client
import mysql.connector
from mysql.connector import Error
from datetime import *
import smtplib
import sys  
    
doc_name = sys.argv[1]
app_date = sys.argv[2]
twenty_four_hour_time = sys.argv[3]
number = sys.argv[4]
app_num = sys.argv[5]

# doc_name = 'Sanjay A R'
# app_date = '2023-08-24'
# twenty_four_hour_time = '17:30:00'
# number = 8072677947
# app_num = 2

time_obj = datetime.strptime(twenty_four_hour_time, "%H:%M:%S")
app_time = time_obj.strftime("%I:%M %p")
print(app_time)

try:
    connection = mysql.connector.connect(
        host='localhost',
        database='peas',
        user='root',
        password=''
    )
# try:
# connection = mysql.connector.connect(
#     host='sql12.freesqldatabase.com',
#     database='sql12647197',
#     user='sql12647197',
#     password='iyz1Fh63tI'
# )
except Error as e:
    print("Error:", e)
  
  #pari Acc
account_sid = 'AC503de9905cc284b03793cf56f09cb10e'
auth_token = '054f5f0061d9ab57dca4996deac6de58'
client = Client(account_sid, auth_token)

message = client.messages.create(
    from_='+15178360795',
    body='Your Booking have been confirmed with Dr. %s on %s @ %s and your appointment number is %s.' % (doc_name, app_date, app_time, app_num),
    to='+91%s' % (number)
)

def doc_not_available():
    # import sys  
    # scheduleid = sys.argv[1] 
    scheduleid = 21  #need to be changed
    if connection.is_connected():
        cursor = connection.cursor()
        patient = "select pemail, ptel from `patient` inner join `appointment` on `appointment`.`pid`=`patient`.`pid` where `appointment`.`scheduleid` = %s;" % (scheduleid)
        cursor.execute(patient)
        rows = cursor.fetchall()
        for row in rows:
            pemail = row[0]
            ptel = row[1]
            message = client.messages.create(
                from_='+15178360795',
                body='Sorry for the inconvinence, due to an emergency, your appointmet with doctor has been cancelled. So you are asked to book an alternate docter. Note: Need not to pay again.',
                to='+91%s' % (ptel)
            )
            server = smtplib.SMTP('smtp.gmail.com',587)
            server.starttls()
            server.login('hospitalpeas@gmail.com','oourqfwunrpmxuzs')
            message = f'''\
Subject: Kindly reschedule your Appointment!

Dear Patient,

        Sorry for the inconvinence, due to an emergency, your appointmet with doctor has been cancelled. So you are asked to book an alternate docter. Note: Need not to pay again.


Thanks & Regards,
Team Hospital,
Sathyamangalam-638 401
Erode District, Tamilnadu
Ph: 04295-226122, 226123'''
            print('Mailed')

            