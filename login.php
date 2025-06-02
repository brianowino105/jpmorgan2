<?php
session_start();
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password_input = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password_input, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}
$conn->close();
?>
