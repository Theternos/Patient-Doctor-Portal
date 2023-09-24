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

time_obj = datetime.strptime(twenty_four_hour_time, "%H:%M:%S")
app_time = time_obj.strftime("%I:%M %p")
print(app_time)


try:
    connection = mysql.connector.connect(
        host='',    #Your Host
        database='',    #your Database Name
        user='',        #MYSQL Username
        password=''         #MYSQL Password
    )

except Error as e:
    print("Error:", e)
    
#Twilio Account Setup
account_sid = ''    #  Your twilo Authentication ID 
auth_token = ''        #  Your twilo Authentication Token
twilio_number = ''      #Your twilio Provided phone number
client = Client(account_sid, auth_token)

# Mail ID authentication Setup
mail_id = ''
security_code = ''

message = client.messages.create(
    from_=twilio_number,
    body='Your Booking have been confirmed with Dr. %s on %s @ %s and your appointment number is %s.' % (doc_name, app_date, app_time, app_num),
    to='+91%s' % (number)
)

def doc_not_available():
    import sys  
    scheduleid = sys.argv[1] 
    if connection.is_connected():
        cursor = connection.cursor()
        patient = "select pemail, ptel from `patient` inner join `appointment` on `appointment`.`pid`=`patient`.`pid` where `appointment`.`scheduleid` = %s;" % (scheduleid)
        cursor.execute(patient)
        rows = cursor.fetchall()
        for row in rows:
            # SMS
            pemail = row[0]
            ptel = row[1]
            message = client.messages.create(
                from_=twilio_number,
                body='Sorry for the inconvinence, due to an emergency, your appointmet with doctor has been cancelled. So you are asked to book an alternate docter. Note: Need not to pay again.',
                to='+91%s' % (ptel)
            )
            #Mailing
            server = smtplib.SMTP('smtp.gmail.com',587)
            server.starttls()
            server.login(mail_id,security_code)           
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

            