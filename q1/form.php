<?php
session_start();

// Hardcoded credentials (for demonstration purposes)
$valid_username = "msamik";
$valid_password = "password";

// Check if the user is already logged in via session or cookie
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit;
} elseif (isset($_COOKIE['remember_me'])) {
    $cookie = json_decode($_COOKIE['remember_me'], true);
    if ($cookie['username'] === $valid_username && $cookie['password'] === $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");
        exit;
    }
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        
        // "Remember Me" functionality
        if (isset($_POST['remember'])) {
            $cookie_value = json_encode(['username' => $username, 'password' => $password]);
            setcookie("remember_me", $cookie_value, time() + 3600 * 24 * 30, "/"); // 30 days expiration
        }
        
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="form.php">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <?php if (isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
