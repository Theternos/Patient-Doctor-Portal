from twilio.rest import Client
import mysql.connector
from mysql.connector import Error
from datetime import *
import smtplib
import sys  
    
doc_name = sys.argv[1]
app_date = sys.argv[2]
app_time = sys.argv[3]
number = sys.argv[4]
app_num = sys.argv[5]

try:
    connection = mysql.connector.connect(
        host='localhost',
        database='peas',
        user='root',
        password=''
    )
except Error as e:
    print("Error:", e)
  
  
account_sid = 'AC20a90cf6594e6b7d2318c6bdd79865cc'
auth_token = '2a6d17d1eebcb02d47d2bef5bd323fab'
client = Client(account_sid, auth_token)

message = client.messages.create(
    from_='+18146377570',
    body='Your Booking have been confirmed with %s on %s @ %s and your appointment number is %s.' % (doc_name, app_date, app_time, app_num),
    to='+91%s' % (number)
)

def doc_not_available():
    # import sys  
    # scheduleid = sys.argv[1] 
    scheduleid = 21
    if connection.is_connected():
        cursor = connection.cursor()
        patient = "select pemail, ptel from `patient` inner join `appointment` on `appointment`.`pid`=`patient`.`pid` where `appointment`.`scheduleid` = %s;" % (scheduleid)
        cursor.execute(patient)
        rows = cursor.fetchall()
        for row in rows:
            pemail = row[0]
            ptel = row[1]
            message = client.messages.create(
                from_='+18146377570',
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

            