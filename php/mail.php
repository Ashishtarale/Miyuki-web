<?php
    // Only process POST reqeusts.
    include 'connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $number = trim($_POST["number"]);
        $locality = trim($_POST["subject"]);
        //$message = trim($_POST["message"]);
        // echo "<script>window.dataLayer.push({'event' : 'form_register', 'name' : '$name', 'last_name' : '$last_name', 'email' : '$email', 'number' : '$number', 'subject' : '$locality'});</script>";

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($number) OR empty($locality) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }
        $sql = "INSERT INTO miyukienquiry (name, email, phone, locality)
        VALUES ('$name', '$email', $number, '$locality')";

        if ($conn->query($sql) === TRUE) {
            echo "Thank You! Your message has been sent.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
	}
?>
