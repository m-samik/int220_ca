<?php
session_start();
session_unset();
session_destroy();
setcookie("remember_me", "", time() - 3600, "/"); // Unset the remember_me cookie
header("Location: form.php");
exit;
?>
