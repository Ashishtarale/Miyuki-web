<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);

    $recipient = "ashishtarale002@gmail.com"; // Replace with your Gmail address
    $subject = "New Appointment Request from $name";
    $body = "You have a new appointment request:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n" .
            "Date: $date\n" .
            "Time: $time\n";

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ashishtarale002@gmail.com'; // Your Gmail
        $mail->Password = 'yesb vxpa wied lpaq'; // Use App Password (not real password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use STARTTLS
        $mail->Port = 587; // Use port 587

        // Email Settings
        $mail->setFrom('ashishtarale002@gmail.com', 'Appointment System'); // Change sender
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send Email
        if ($mail->send()) {
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Thank You</title>
                <style>
                    body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                    .container { max-width: 500px; margin: auto; padding: 20px; border-radius: 10px; background: #f8f8f8; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
                    h2 { color: green; }
                    p { font-size: 18px; }
                </style>
                <meta http-equiv='refresh' content='5;url=index.html'> <!-- Redirect after 5 seconds -->
            </head>
            <body>
                <div class='container'>
                    <h2>Thank You!</h2>
                    <p>Your appointment request has been submitted successfully.</p>
                    <p>You will be redirected to the homepage in 5 seconds...</p>
                    <a href='index.html'>Click here</a> if you are not redirected.
                </div>
            </body>
            </html>";
        } else {
            echo "Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>
