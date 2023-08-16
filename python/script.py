import mysql.connector
from mysql.connector import Error

try:
    connection = mysql.connector.connect(
        host='localhost',
        database='peas',
        user='root',
        password=''
    )
    
    if connection.is_connected():
        print("Connected to MySQL database")
except Error as e:
    print("Error:", e)


