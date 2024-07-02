<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: form.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to the Dashboard!</h1>
        <p>You are logged in.</p>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile</h4>
                    </div>
                    <div class="card-body">
                        <p>Here you can view and edit your profile information. Make sure to keep your details up-to-date.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>About</h4>
                    </div>
                    <div class="card-body">
                        <p>This application is developed as a part of the project for Lovely Professional University. It demonstrates a simple login system using PHP sessions and cookies.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Features</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Secure login system</li>
                            <li>"Remember Me" functionality</li>
                            <li>Responsive design using Bootstrap</li>
                            <li>User-friendly interface</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
</body>
</html>
