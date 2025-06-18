<?php
$conn = new mysqli("localhost", "root", "", "moodmate");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Check if email already exists
$check = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($check);
if ($result->num_rows > 0) {
    echo "Email already registered. <a href='index.html'>Login here</a>";
} else {
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql)) {
        echo "Registration successful! <a href='index.html'>Login Now</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
