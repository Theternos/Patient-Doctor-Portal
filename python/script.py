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
# try:
#     connection = mysql.connector.connect(
#         host='sql12.freesqldatabase.com',
#         database='sql12647197',
#         user='sql12647197',
#         password='iyz1Fh63tI'
#     )
except Error as e:
    print("Error:", e)
#pari ACC
account_sid = 'AC503de9905cc284b03793cf56f09cb10e'
auth_token = '054f5f0061d9ab57dca4996deac6de58'
client = Client(account_sid, auth_token)

#####Remainder for doctors before 2 hours with slots booked so far  


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
#                         from_='+15178360795',
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




###### Generating Room ID for video consultancy


# import datetime
# cursor = connection.cursor()
# no_patient = "select appoid, S.scheduletime, P.ptel, D.docname, apponum, mode from appointment A, `schedule` S, patient P, Doctor D where D.docid = S.docid AND A.scheduleid = S.scheduleid AND room_flag = 0 AND P.pid = A.pid AND `mode` = 'Video Consultancy' AND DATE(S.scheduledate) = CURDATE()"
# cursor.execute(no_patient)
# rows = cursor.fetchall()
# for row in rows:
#     appoid = row[0]
#     current_time = datetime.datetime.now()  # Use datetime.datetime.now()
#     fetched_time = row[1]
#     patient_tel = row[2]
#     doc_name = row[3]
#     apponum = row[4]
#     mode = row[5]
#     meeting_time = fetched_time + datetime.timedelta(minutes=0 + (10*(apponum-1))) 
#     if(mode == 'Video Consultancy'):
#         message_time = fetched_time - datetime.timedelta(hours=2, minutes=10 - (10*apponum))
#     else:
#         message_time = fetched_time - datetime.timedelta(hours=2, minutes=0)
#     current_time = datetime.datetime.now()
#     t = current_time.strftime("%H:%M:%S")
#     t = "15:35:00"  # to be removed while at live
#     time_delta = datetime.datetime.strptime(t, "%H:%M:%S") - datetime.datetime(1900, 1, 1)

#     if (message_time <= time_delta):
#         roomid = random.randint(1000000, 9999999)
#         link = 'https://peercalls.com/call/' + str(roomid)
#         update_sql = "UPDATE appointment SET roomid = %s where appoid = %s" % (roomid, appoid)
#         cursor.execute(update_sql)
#         message = client.messages.create(
#             from_='+15178360795',
#             body = "Don't miss the video consultancy with Dr. %s scheduled at %s. The meeting link for your session is %s. NOTE : Kindly join the session before 5minutes of scheduled time." % (doc_name,meeting_time, link),
#             to='+91' + patient_tel
#         )
#         update_sql = "UPDATE appointment SET room_flag = 1 where appoid = %s" % (appoid)
#         cursor.execute(update_sql)
        
        
        
######## Blood Donation SMS alert!
# cursor = connection.cursor()
# patient_number = "SELECT ptel, bgrid, patient.blood_group, patient.pname, unit from patient INNER JOIN blood_group_request on blood_group_request.blood_group = patient.blood_group where flag = 0;"
# cursor.execute(patient_number)
# rows = cursor.fetchall()
# bgrid = 0
# for row in rows:
#     number = row[0]
#     bgrid = row[1]
#     blood_group = row[2]
#     pname = row[3]
#     unit = row[4]
#     number = '8072677947'    #This line need to be removed while Twillio uses live account
#     body = '''
# Urgent: Blood Needed

# Dear %s,

# We are in urgent need of blood donations to save lives. Please call to 9442792601 before coming.

# Location: Sathyamangalam
# Address: 2nd Street, Coimbatore Road, Sathy, 638401
# Blood Type Needed: %s
# Units Needed: %s

# Your donation can help save lives. Thank you for your generosity.

# Best Regards,
# PEaS
#     ''' % (pname, blood_group, unit)
#     message = client.messages.create(
#         from_='+15178360795',
#         body = body,
#         to='+91' + number
#         )
# if(bgrid != 0):
#     update_sql = "UPDATE blood_group_request SET flag = 1 where bgrid = %s" % (bgrid)
#     cursor.execute(update_sql)
#     print("mesaged")


####### Feedback form link
# cursor = connection.cursor()
# review = "SELECT doc_review.docid, doc_review.pid, patient.pname, patient.ptel, drid FROM doc_review INNER JOIN patient ON patient.pid = doc_review.pid  WHERE seen_status = 1 and feedback_flag = 0"
# cursor.execute(review)
# rows = cursor.fetchall()
# for row in rows:
#     pid = row[1]    
#     pname = row[2]
#     # number = row[3] 
#     drid = row[4]
#     number = '8072677947'  #remove this line in implementing
#     fblink = 'http://10.10.237.155:91/fbform/index.php?id=' + str(pid) + '&drid=' + str(drid)
#     body_content = '''Dear %s,

# We hope you're feeling better after your recent visit. Please share your feedback to help us improve by clicking this link: %s.

# Your insights are valuable to us. Thank you for choosing us for your healthcare needs.

# Best regards,
# Team Sleek''' % (pname, fblink)
#     message = client.messages.create(
#         from_= '+15178360795',
#         body= body_content,
#         to='+91%s' % (number)
#     )
#     print(body_content)
#     flag_update = "UPDATE doc_review SET feedback_flag = 1 WHERE drid = %d" % (drid)
#     cursor.execute(flag_update)
    
    
###### Re-booking appointment sms


import datetime

cursor = connection.cursor()
next_appointment = "SELECT * FROM report INNER JOIN patient ON patient.pid = report.pid WHERE next_appointment > 1 and nxt_apmt_flag = 0;"
cursor.execute(next_appointment)
rows = cursor.fetchall()
today_date = datetime.datetime.now()

for row in rows:
    repid = row[0]
    pid = row[1]
    docid = row[2]
    # number = row[18]
    number = '8072677947'   #remove this line in implementing
    pname = row[13]  
    # ...
    visit_date_raw = row[11]
    next_appointment = row[8]
    sms_days = next_appointment - 1    
    # Ensure visit_date_str is a string
    if isinstance(visit_date_raw, str):
        visit_date_str = visit_date_raw
    else:
        # If not a string, convert to string in an appropriate format
        visit_date_str = visit_date_raw.strftime('%Y-%m-%d %H:%M:%S')

    next_appointment = row[8]
    sms_days = next_appointment - 1

    # Parse visit_date_str into a datetime object
    visit_date = datetime.datetime.strptime(visit_date_str, '%Y-%m-%d %H:%M:%S')

    # Add sms_days to visit_date
    modified_visit_date = visit_date + datetime.timedelta(days=sms_days)

    # Compare today's date with modified_visit_date
    if today_date.date() == modified_visit_date.date():
    # Rest of your code...

    # Rest of your code...
        fblink = 'http://10.10.237.155:91/patient/rebooking.php?pid=' + str(pid) + '&docid=' + str(docid)
        body_content = '''Dear %s,

Your doctor has recommended scheduling your next appointment for your continued care. To book your appointment, please click on the following link: %s

We're here to ensure your health and well-being. Feel free to reach out if you have any questions or need assistance.

Best regards,
Team Sleek''' % (pname, fblink)
        message = client.messages.create(
            from_= '+15178360795',
            body= body_content,
            to='+91%s' % (number)
        )
        print(body_content)
        flag_update = "UPDATE report SET nxt_apmt_flag = 1 WHERE repid = %d" % (repid)
        cursor.execute(flag_update)

