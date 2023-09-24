# 🏥 Appointment Booking for Patients with Hospital Management 📅

Welcome to the **Appointment Booking for Patients with Hospital Management** project! This comprehensive system allows patients to book hospital consultations, video consultations, and medical tests. It includes multiple features for patients, doctors, receptionists, medical lab technicians, pharmacists, and administrators. The stack used in this project includes HTML, CSS, JavaScript, MySQL, PHP, Python, SCSS, jQuery, and the Rasa Framework.

## 🛠️ Installation and Configuration

Before you start using the system, you need to perform some setup steps:

1. Install Python libraries by running:

   ```
   pip install -r requirements.txt
   ```

2. Modify the `connection.php` file to configure MySQL connectivity according to your settings.

3. Customize `python/bot.py` with your Medisearch API key, which you can obtain from [Medisearch Developers](https://medisearch.io/developers).

4. Customize `python/script.py` and `python/sms_confirmation.py` with your Twilio authentication details, which you can obtain from [Twilio Console](https://console.twilio.com/).

5. In `python/sms_confirmation.py`, customize the email ID and security code for SMTP mailing.

6. In `patient/booking.php` and `patient/booking_test.php`, change the apiKey to reflect your Razorpay account for payment processing. Obtain the API key from [Razorpay Dashboard](https://dashboard.razorpay.com/).

7. Run the `SQL_Database_PAeS.sql` file in phpMyAdmin to create the necessary database and tables.

## 🌟 Features

### 1. Patient Portal 👩‍⚕️📆

- Book hospital and video consultations 🏨📹.
- Add multiple medical tests to the cart 💼🧪.
- Supports multiple languages: English, Tamil, Kannada, Telugu, Malayalam, and Hindi 🌐🗣️.
- Track payments with an internal wallet 💰.
- View upcoming appointments and access previous consultancy reports and prescriptions 📆📋.
- Register for organ donation with a cancellation option 🫀❤️.
- Share reports and prescriptions seamlessly with a link 🔗.
- Receive SMS and email confirmations on successful bookings, as well as SMS reminders 📲📧.
- Includes a chatbot with basic symptom and precaution information 🤖.

### 2. Doctor Portal 👨‍⚕️📅

- Schedule sessions with a specified number of slots 📅⏰.
- View the number of registered patients 👥.
- Upload patient prescriptions and reports 📄💊.
- Access patient health records 📂🩺.
- Receive SMS and email notifications regarding the number of patients booked for a session two hours before the session 📲📧.

### 3. Reception Portal 🧾🏥

- Access all patient details 👀📋.
- Upload basic metrics to patient data upon their arrival at the hospital 📈🏥.
- Send SMS notifications to patients with required blood groups in a single click 🩸📲.
- View patients registered for organ donation 🫀📋.

### 4. Medical Lab Technician Portal 🧪👨‍🔬

- View patients registered for the day 📅📋.
- Upload patient reports 📄🩺.
- View reports uploaded by patients 📂👀.

### 5. Pharmacy Portal 💊💼

- View prescriptions uploaded by doctors and bill the prescribed medicines 💰💊.
- Search and view all available medicines with their prices 🔍💰.

### 6. Admin Portal 🛡️👩‍💼

- Features a dashboard with monetized information from all portals 📊📈.
- View and edit patient, doctor, and lab assistant records 📂✏️.
- Access total payment details with graphical representation 📊💰.
- See the top 3 rated doctors and the 3 most booked specialties for the past 5 days 🌟📅.
- Approve emergency leave for doctors 🚑📆.
- Schedule sessions for doctors 📅⏰.
- Search and view feedback provided by patients 📝🔎.

### Dynamic Feedback System 🌟📝

After a doctor's visit, patients can rate their experience out of 5 stars ⭐⭐⭐⭐⭐. Upon submitting their ratings, a dynamic feedback form is sent to the patient's registered mobile number 📲📝.

## Conclusion 🎉

This Hospital Management System offers a comprehensive solution for patient appointment booking and hospital administration. It streamlines the process for patients, doctors, receptionists, medical lab technicians, pharmacists, and administrators. Customize the configuration, follow the installation steps, and enjoy the efficient management of hospital resources and patient care. 🏥👩‍⚕️💼
