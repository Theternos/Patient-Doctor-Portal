import mysql.connector
from mysql.connector import Error
from twilio.rest import Client
from datetime import *
import smtplib
import random


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

# #Remainder for doctors before 2 hours with slots booked so far  
# if connection.is_connected():
#     cursor = connection.cursor()

#     no_patient = "SELECT docid, nop, scheduletime, mail_flag from schedule WHERE DATE(scheduledate) = CURDATE()"
#     cursor.execute(no_patient)
#     rows = cursor.fetchall()
#     for row in rows:
#         doc_id = row[0]
#         totalbooked = row[1]
#         scheduletime = row[2]
#         print(totalbooked, scheduletime)
#         mail_time = scheduletime - timedelta(hours=2, minutes=0)
#         print("adjusted_time:", mail_time, type(mail_time))
#         current_time = datetime.now()

#         t = current_time.strftime("%H:%M:%S")
#         t = "19:03:00"            #to be removed while at live
#         import datetime
#         time_delta = datetime.datetime.strptime(
#             t, "%H:%M:%S") - datetime.datetime(1900, 1, 1)
#         print("Current_time:", time_delta, type(time_delta))
#         if (mail_time <= time_delta):
#             print("hola")
#             row_count = "select COUNT(*) from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid;"
#             cursor.execute(row_count)
#             seatbooked = cursor.fetchone()[0]
#             print(seatbooked, totalbooked)
#             doc_number = "SELECT doctel, docemail from doctor where docid = %s;" % (
#                 doc_id)
#             cursor.execute(doc_number)
#             doc_rows = cursor.fetchall()
#             for doc in doc_rows:
#                 if (row[3] == 0):
#                     doc_tel = doc[0]
#                     doc_tel = '8072677947'
#                     doc_email = doc[1]
#                     print(doc_tel, doc_email)
#                     message = client.messages.create(
#                         from_='+18146377570',
#                         body='A gentle remainder for the upcoming schecdule on %s and %s seats booked of %s so far.' % (
#                             scheduletime, seatbooked, totalbooked),
#                         to='+91' + doc_tel
#                     )
#                     sql = "UPDATE schedule SET mail_flag = 1;"
#                     cursor.execute(sql)
#                     connection.commit()
#                     email = 'anusuya.cs21@bitsathy.ac.in'
#                     server = smtplib.SMTP('smtp.gmail.com', 587)
#                     server.starttls()
#                     server.login('hospitalpeas@gmail.com', 'oourqfwunrpmxuzs')
#                     message = f'''\
# Subject: Gentle remainder for Schedule!

# Dear Doctor,

#         A gentle remainder for the upcoming schecdule on {scheduletime} and {seatbooked} seats booked of {totalbooked} so far.


# Thanks & Regards,
# Team Hospital,
# Sathyamangalam-638 401
# Erode District, Tamilnadu
# Ph: 04295-226122, 226123
#                         '''.format(scheduletime, seatbooked, totalbooked)
#                     server.sendmail('hospitalpeas@gmail.com', email, message)
#                     print('Mailed')


# Generating Room ID for video consultancy
import datetime
cursor = connection.cursor()
no_patient = "select appoid, S.scheduletime, P.ptel, D.docname, apponum, mode from appointment A, `schedule` S, patient P, Doctor D where D.docid = S.docid AND A.scheduleid = S.scheduleid AND room_flag = 0 AND P.pid = A.pid AND `mode` = 'Video Consultancy' AND DATE(S.scheduledate) = CURDATE()"
cursor.execute(no_patient)
rows = cursor.fetchall()
for row in rows:
    appoid = row[0]
    current_time = datetime.datetime.now()  # Use datetime.datetime.now()
    fetched_time = row[1]
    patient_tel = row[2]
    doc_name = row[3]
    apponum = row[4]
    mode = row[5]
    meeting_time = fetched_time + datetime.timedelta(minutes=0 + (10*(apponum-1))) 
    if(mode == 'Video Consultancy'):
        message_time = fetched_time - datetime.timedelta(hours=2, minutes=10 - (10*apponum))
    else:
        message_time = fetched_time - datetime.timedelta(hours=2, minutes=0)
    current_time = datetime.datetime.now()
    t = current_time.strftime("%H:%M:%S")
    t = "15:35:00"  # to be removed while at live
    time_delta = datetime.datetime.strptime(t, "%H:%M:%S") - datetime.datetime(1900, 1, 1)

    if (message_time <= time_delta):
        roomid = random.randint(1000000, 9999999)
        link = 'https://peercalls.com/call/' + str(roomid)
        update_sql = "UPDATE appointment SET roomid = %s where appoid = %s" % (roomid, appoid)
        cursor.execute(update_sql)
        message = client.messages.create(
            from_='+18146377570',
            body = "Don't miss the video consultancy with Dr. %s scheduled at %s. The meeting link for your session is %s. NOTE : Kindly join the session before 5minutes of scheduled time." % (doc_name,meeting_time, link),
            to='+91' + patient_tel
        )
        update_sql = "UPDATE appointment SET room_flag = 1 where appoid = %s" % (appoid)
        cursor.execute(update_sql)
        
