<?php
$to = "mohit.xteam@gmail.com";
$subject = "Test Email from PHP";
$message = "Hello, this is a test email sent using PHP's mail function.";
$headers = "From: webmaster@app.mauricetrapp.com" . "\r\n" .
           "Reply-To: webmaster@app.mauricetrapp.com";

if(mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email delivery failed.";
}
?>
