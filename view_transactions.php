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
$sql = "SELECT * FROM transactions WHERE user_id='$user_id' ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Transactions</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Your Transactions</h2>
  <table border="1">
    <tr>
      <th>Date</th>
      <th>Amount</th>
      <th>Type</th>
      <th>Category</th>
      <th>Description</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['date']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['type']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['description']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No transactions found.</td></tr>";
    }
    ?>
  </table>
  <br><a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
<?php
$conn->close();
?>
