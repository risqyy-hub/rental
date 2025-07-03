<?php
session_start();
// Load user data
$users = [];
$data_file = 'users.txt';
if (file_exists($data_file)) {
    $userData = file($data_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($userData as $line) {
        // Attempt to decode the JSON line. If it fails, skip it.
        $user = json_decode($line, true);
        if ($user !== null) {
            $users[] = $user;
        }else{
            echo "Error decoding JSON: " . json_last_error_msg() . " Line: " . $line;
        }
    }
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
// Find the user
$authenticated = false;
foreach ($users as $user) {
    if (isset($user["username"]) && isset($user["password"]) && $user["username"] == $username && password_verify($password, $user["password"])) {
        $authenticated = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        break;
    }
}

if ($authenticated) {
    // Redirect to a protected page (e.g., home.php)
    header("Location: home.php");
    exit();
} else {
    // Login failed
    echo "<script>alert('Invalid username or password.'); window.location.href='login.php';</script>";
}
}
?>
