<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$date = $_POST['date'];
$amount = $_POST['amount'];
$type = $_POST['type'];
$category = $_POST['category'];
$description = $_POST['description'];

$sql = "INSERT INTO transactions (user_id, date, amount, type, category, description)
VALUES ('$user_id', '$date', '$amount', '$type', '$category', '$description')";

if ($conn->query($sql) === TRUE) {
    echo "Transaction added successfully! <a href='dashboard.php'>Go Back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
