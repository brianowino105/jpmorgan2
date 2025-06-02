<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=You must be logged in to set goals");
    exit();
}

include 'db.php';

// Process form submission if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $required_fields = ['goal_name', 'target_amount', 'due_date'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error'] = "Please fill in all fields";
            header("Location: set_goal.php");
            exit();
        }
    }

    $user_id = $_SESSION['user_id'];
    $goal_name = htmlspecialchars($_POST['goal_name']);
    $target_amount = (float)$_POST['target_amount'];
    $due_date = $_POST['due_date'];

    // Validate date format
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $due_date)) {
        $_SESSION['error'] = "Invalid date format. Use YYYY-MM-DD";
        header("Location: set_goal.php");
        exit();
    }

    // Database operation
    $stmt = $conn->prepare("INSERT INTO goals (user_id, goal_name, target_amount, current_amount, due_date) VALUES (?, ?, ?, 0, ?)");
    if (!$stmt) {
        $_SESSION['error'] = "Database error: " . $conn->error;
        header("Location: set_goal.php");
        exit();
    }

    $stmt->bind_param("isds", $user_id, $goal_name, $target_amount, $due_date);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Goal '{$goal_name}' set successfully";
    } else {
        $_SESSION['error'] = "Error setting goal: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
    
    header("Location: set_goal.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="styles.css">
<head>
    <meta charset="UTF-8">
    <title>Set Financial Goal</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 20px auto; padding: 20px; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert-error { background-color: #ffdddd; color: #d8000c; }
        .alert-success { background-color: #ddffdd; color: #4F8A10; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background: #4CAF50; color: white; border: none; padding: 10px 15px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Set Financial Goal</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <form method="POST" action="set_goal.php">
        <div class="form-group">
            <label for="goal_name">Goal Name:</label>
            <input type="text" id="goal_name" name="goal_name" required>
        </div>
        
        <div class="form-group">
            <label for="target_amount">Target Amount ($):</label>
            <input type="number" step="0.01" id="target_amount" name="target_amount" required>
        </div>
        
        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date" required>
        </div>
        
        <button type="submit">Set Goal</button>
    </form>
</body>
</html>