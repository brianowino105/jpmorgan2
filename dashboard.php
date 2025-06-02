<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
  <nav>
    <a href="add_transaction.html">Add Transaction</a> |
    <a href="view_transactions.php">View Transactions</a> |
    <a href="set_goal.php">Set Goals</a> |
    <a href="logout.php">Logout</a>
  </nav>
  <p>This is your dashboard. Choose an action above.</p>
</body>
</html>
