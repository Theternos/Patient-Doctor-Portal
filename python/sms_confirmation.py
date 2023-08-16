from twilio.rest import Client
import sys

doc_name = sys.argv[1]
app_date = sys.argv[2]
app_time = sys.argv[3]
number = sys.argv[4]
app_num = sys.argv[5]
account_sid = 'AC20a90cf6594e6b7d2318c6bdd79865cc'
auth_token = '2a6d17d1eebcb02d47d2bef5bd323fab'
client = Client(account_sid, auth_token)

message = client.messages.create(
    from_='+18146377570',
    body='Your Booking have been confirmed with %s on %s @ %s and your appointment number is %s.' % (doc_name, app_date, app_time, app_num),
    to='+91%s' % (number)
)


