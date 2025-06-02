<?php
$servername = "localhost";
$username = "root";  // use your MySQL username
$password = "";      // your password (empty if no password)
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash the password

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
    echo "Registration successful! <a href='login.html'>Login here</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
