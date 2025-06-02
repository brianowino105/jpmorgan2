<?php
include 'db.php';

// Replace with session-based user ID in real project
$user_id = 1;

$total_income = 0;
$total_expenses = 0;

// Calculate total income
$result = $conn->query("SELECT SUM(amount) AS total_income FROM transactions WHERE user_id=$user_id AND type='income'");
if ($row = $result->fetch_assoc()) {
    $total_income = $row['total_income'] ?? 0;
}

// Calculate total expenses
$result = $conn->query("SELECT SUM(amount) AS total_expenses FROM transactions WHERE user_id=$user_id AND type='expense'");
if ($row = $result->fetch_assoc()) {
    $total_expenses = $row['total_expenses'] ?? 0;
}

// Net savings
$net_savings = $total_income - $total_expenses;

echo json_encode([
    'total_income' => $total_income,
    'total_expenses' => $total_expenses,
    'net_savings' => $net_savings
]);
?>
<?php
include 'db.php';

// Replace with session-based user ID in real project
$user_id = 1;

$total_income = 0;
$total_expenses = 0;

// Calculate total income
$result = $conn->query("SELECT SUM(amount) AS total_income FROM transactions WHERE user_id=$user_id AND type='income'");
if ($row = $result->fetch_assoc()) {
    $total_income = $row['total_income'] ?? 0;
}

// Calculate total expenses
$result = $conn->query("SELECT SUM(amount) AS total_expenses FROM transactions WHERE user_id=$user_id AND type='expense'");
if ($row = $result->fetch_assoc()) {
    $total_expenses = $row['total_expenses'] ?? 0;
}

// Net savings
$net_savings = $total_income - $total_expenses;

echo json_encode([
    'total_income' => $total_income,
    'total_expenses' => $total_expenses,
    'net_savings' => $net_savings
]);
?>
