<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize variables and error array
    $errors = [];
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = $_POST['service'] ?? '';
    $date = $_POST['date'] ?? '';
    $guests = isset($_POST['guests']) ? (int)$_POST['guests'] : 1;
    $specialRequests = trim($_POST['special_requests'] ?? '');
    
    // Validate inputs
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    
    if (!empty($phone) && !preg_match('/^[0-9\+\-\s]+$/', $phone)) {
        $errors['phone'] = 'Invalid phone number';
    }
    
    if (empty($service)) {
        $errors['service'] = 'Service type is required';
    }
    
    if (empty($date)) {
        $errors['date'] = 'Booking date is required';
    } elseif (strtotime($date) < strtotime('today')) {
        $errors['date'] = 'Booking date cannot be in the past';
    }
    
    if ($guests < 1) {
        $errors['guests'] = 'Number of guests must be at least 1';
    }
    
    // If no errors, process the booking
    if (empty($errors)) {
        // In a real application, you would:
        // 1. Save to database
        // 2. Send confirmation email
        // 3. Maybe process payment
        
        // For this example, we'll just redirect to a success page
        header('Location: booking_form.php?success=1');
        exit;
    }
}

// If there are errors or form wasn't submitted, show the form again with errors
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        /* Same styles as in booking_form.php */
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>Booking Form</h1>
    
    <?php if (!empty($errors)): ?>
        <div class="error">Please fix the following errors:</div>
    <?php endif; ?>
    
    <form action="process_booking.php" method="post">
        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <?php if (isset($errors['name'])): ?>
                <div class="error"><?php echo $errors['name']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <?php if (isset($errors['phone'])): ?>
                <div class="error"><?php echo $errors['phone']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="service">Service Type *</label>
            <select id="service" name="service" required>
                <option value="">-- Select a Service --</option>
                <option value="hotel" <?php echo $service === 'hotel' ? 'selected' : ''; ?>>Hotel Booking</option>
                <option value="flight" <?php echo $service === 'flight' ? 'selected' : ''; ?>>Flight Booking</option>
                <option value="car" <?php echo $service === 'car' ? 'selected' : ''; ?>>Car Rental</option>
                <option value="tour" <?php echo $service === 'tour' ? 'selected' : ''; ?>>Tour Package</option>
            </select>
            <?php if (isset($errors['service'])): ?>
                <div class="error"><?php echo $errors['service']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="date">Booking Date *</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required>
            <?php if (isset($errors['date'])): ?>
                <div class="error"><?php echo $errors['date']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="guests">Number of Guests</label>
            <input type="number" id="guests" name="guests" min="1" value="<?php echo $guests; ?>">
            <?php if (isset($errors['guests'])): ?>
                <div class="error"><?php echo $errors['guests']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="special_requests">Special Requests</label>
            <textarea id="special_requests" name="special_requests" rows="4"><?php echo htmlspecialchars($specialRequests); ?></textarea>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Submit Booking">
        </div>
    </form>
</body>
</html>