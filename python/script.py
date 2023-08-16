import mysql.connector
from mysql.connector import Error
from twilio.rest import Client

try:
    # Establish a connection to the MySQL database
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

if connection.is_connected():
    cursor = connection.cursor()
    
    no_patient = "SELECT nop, scheduletime from schedule WHERE DATE(scheduledate) = CURDATE()"
    cursor.execute(no_patient)
    rows = cursor.fetchall()
    for row in rows:
        totalbooked = row[0]
        scheduletime = row[1]
        row_count = "select COUNT(*) from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid;"
        cursor.execute(row_count)
        seatbooked = cursor.fetchone()[0]
        if (seatbooked != 0):
            seatleft = totalbooked - seatbooked;
        else: 
            seatleft = totalbooked;
        percentage = seatleft / totalbooked * 100
        
        message = client.messages.create(
            from_='+18146377570',
            body='Your Booking have been confirmed with %s on %s @ %s and your appointment number is %s.' % (doc_name, app_date, app_time, app_num),
            to='+91%s' % (number)
)
