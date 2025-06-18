<?php
session_start();
$conn = new mysqli("localhost", "root", "", "moodmate");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        // header("Location: /MENTAL%20HEALTH%20DETETCTION/dashboard/index.html"); // ✅ redirect to dashboard
        header("Location: index.php"); // ✅ redirect to dashboard
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}
$conn->close();
?>
