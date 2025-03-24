<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 1.1em; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Booking Form</h1>
    
    <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
        <div class="success">Thank you! Your booking has been submitted successfully.</div>
    <?php endif; ?>
    
    <form action="process_booking.php" method="post">
        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone">
        </div>
        
        <div class="form-group">
            <label for="service">Service Type *</label>
            <select id="service" name="service" required>
                <option value="">-- Select a Service --</option>
                <option value="hotel">Hotel Booking</option>
                <option value="flight">Flight Booking</option>
                <option value="car">Car Rental</option>
                <option value="tour">Tour Package</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="date">Booking Date *</label>
            <input type="date" id="date" name="date" required>
        </div>
        
        <div class="form-group">
            <label for="guests">Number of Guests</label>
            <input type="number" id="guests" name="guests" min="1" value="1">
        </div>
        
        <div class="form-group">
            <label for="special_requests">Special Requests</label>
            <textarea id="special_requests" name="special_requests" rows="4"></textarea>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Submit Booking">
        </div>
    </form>
</body>
</html>