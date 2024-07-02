<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    //validate name
    if (empty($name)) {
        header("Location: form.php?error=" . urlencode("Name cannot be empty"));
        exit();
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: form.php?error=" . urlencode("Invalid email format"));
        exit();
    }

    // Validate message
    if (empty($message)) {
        header("Location: form.php?error=" . urlencode("Message cannot be empty"));
        exit();
    }

    echo "<p>Thank you for your message, $name!</p>";
}
?>
