<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim(htmlspecialchars($_POST["name"]));
    $email   = trim(htmlspecialchars($_POST["email"]));
    $phone   = trim(htmlspecialchars($_POST["phone"]));
    $service = trim(htmlspecialchars($_POST["service"]));
    $staff   = trim(htmlspecialchars($_POST["staff"]));
    $date    = trim(htmlspecialchars($_POST["date"]));

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($date)) {
        echo "All required fields must be filled.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo "Invalid phone number (must be 10 digits).";
        exit;
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo "Invalid name format (letters and spaces only).";
        exit;
    }

    // Prevent Email Header Injection
    $email = str_replace(array("\r", "\n", "%0A", "%0D"), '', $email);

    // Email details
    $to = "ashishtarale002@gmail.com";  // Replace with your email
    $subject = "New Booking from $name";
    $message = "
        Name: $name\n
        Email: $email\n
        Phone: $phone\n
        Service: $service\n
        Staff: $staff\n
        Date: $date\n
    ";
    $headers = "From: ashishtarale002@gmail.com\r\nReply-To: $email\r\n";

    // Send email to admin
    if (mail($to, $subject, $message, $headers)) {
        echo "success: Your appointment has been booked!";

        // Send confirmation email to the user
        $user_subject = "Appointment Confirmation";
        $user_message = "Dear $name,\n\nThank you for booking an appointment. Here are your details:\n\n" . $message . "\n\nBest Regards,\nYour Company";
        $user_headers = "From: ashishtarale002@gmail.com\r\n";
        
        mail($email, $user_subject, $user_message, $user_headers);
    } else {
        echo "Error sending email. Please try again.";
    }
}
?>
