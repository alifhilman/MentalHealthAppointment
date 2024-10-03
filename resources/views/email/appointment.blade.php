<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <p>Dear {{ $mailData['name'] }},</p>
    <p>Thank you for booking your appointment with TranquilMinds.</p>
    <p>The details of your appointment are below:</p>
    <p>Time: {{ $mailData['time'] }}</p>
    <p>Date: {{ $mailData['date'] }}</p>
    <p>Therapist: {{ $mailData['doctorName'] }}</p>
    <p>Appointment Venue: {{ $mailData['address'] }}</p> 
    <p>Contact: {{ $mailData['phone_number'] }}</p> 
</body>
</html>
