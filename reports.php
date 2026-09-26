<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$result = $conn->query("SELECT COUNT(*) AS count FROM members");
if ($result) {
    $members_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM members WHERE Gender = 'Male'");
if ($result) {
    $members_male = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM members WHERE Gender = 'Female'");
if ($result) {
    $members_Female = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM members WHERE status = 'Active'");
if ($result) {
    $members_active = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM members WHERE status = 'Inactive'");
if ($result) {
    $members_inactive = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM trainers");
if ($result) {
    $trainers_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM trainers WHERE gender = 'male'");
if ($result) {
    $trainers_male = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM trainers WHERE gender = 'female'");
if ($result) {
    $trainers_female = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions");
if ($result) {
    $subscriptions_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Active'");
if ($result) {
    $subscriptions_active = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Expired'");
if ($result) {
    $subscriptions_expired = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Pending'");
if ($result) {
    $subscriptions_pending = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Cancelled'");
if ($result) {
    $subscriptions_cancelled = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT SUM(amount) AS total FROM payments");
if ($result) {
    $total_revenue = $result->fetch_assoc()['total'] ?? 0;
}

$result = $conn->query("SELECT SUM(amount) AS total FROM payments WHERE status = 'Paid'");
if ($result) {
    $total_paid = $result->fetch_assoc()['total'] ?? 0;
}

$result = $conn->query("SELECT SUM(amount) AS total FROM payments WHERE status = 'Failed'");
if ($result) {
    $total_failed = $result->fetch_assoc()['total'] ?? 0;
}

$result = $conn->query("SELECT SUM(amount) AS total FROM payments WHERE status = 'Pending'");
if ($result) {
    $total_pending = $result->fetch_assoc()['total'] ?? 0;
}

$result = $conn->query("SELECT COUNT(*) AS count FROM membership_plans");
if ($result) {
    $plans_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM membership_plans WHERE is_active = 'Active'");
if ($result) {
    $plans_active = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM membership_plans WHERE is_active = 'Inactive'");
if ($result) {
    $plans_inactive = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM classes");
if ($result) {
    $classes_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM classes WHERE is_active = 'Active'");
if ($result) {
    $classes_active = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM classes WHERE is_active = 'Inactive'");
if ($result) {
    $classes_inactive = $result->fetch_assoc()['count'];
}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset = "utf-8">
<meta name = "viewport" content = "width = device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</head>
<body>

<div class="container mt-5">
        <h1 class = "bg-info">My Gym Report</h1>
        
		<div style = "text-align: center;" class="mt-4 p-2 bg-light rounded">
			  <h2>Members</h2>
			  <h5 class = "text-primary">Count of Male Member: <?php echo $members_male?></h5>
			  <h5 class = "text-secondary">Count of Female Member: <?php echo $members_Female?></h5>
			  <h5 class = "text-success">Count of Active Member: <?php echo $members_active?></h5>
			  <h5 class = "text-danger">Count of Inactive Member: <?php echo $members_inactive?></h5>
			  <h5>Count of all Member: <?php echo $members_count?></h5>
		</div>
		<br>
		<br>
		<div style = "text-align: center;" class="mt-24 p-2 bg-light rounded">
			  <h2>Trainers</h2>
			  <h5 class = "text-primary">Count of Male Trainers: <?php echo $trainers_male?></h5>
			  <h5 class = "text-secondary">Count of Female Trainers: <?php echo $trainers_female?></h5>
			  <h5>Count of all Trainers: <?php echo $trainers_count?></h5>
		</div>
		
		<div style = "text-align: center;" class="mt-4 p-2 bg-light rounded">
			  <h2>Plans</h2>
			  <h5 class = "text-success">Count of Active Plans: <?php echo $plans_active?></h5>
			  <h5 class = "text-danger">Count of Inactive Plans: <?php echo $plans_inactive?></h5>
			  <h5>Count of all Plans: <?php echo $plans_count?></h5>
		</div>
		
		<div style = "text-align: center;" class="mt-4 p-2 bg-light rounded">
			  <h2>Classes</h2>
			  <h5 class = "text-success">Count of Active Classes: <?php echo $classes_active?></h5>
			  <h5 class = "text-danger">Count of Inactive Classes: <?php echo $classes_inactive?></h5>
			  <h5>Count of all Classes: <?php echo $classes_count?></h5>

		</div>
		
		<div style = "text-align: center;" class="mt-4 p-2 bg-light rounded">
			  <h2>Subscriptions</h2>
			  <h5 class = "text-success">Count of Active Subscriptions: <?php echo $subscriptions_active?></h5>
			  <h5 class = "text-warning">Count of Expired Subscriptions: <?php echo $subscriptions_expired?></h5>
			  <h5 class = "text-primary">Count of Pending Member: <?php echo $subscriptions_pending?></h5>
			  <h5 class = "text-danger">Count of Cancelled Member: <?php echo $subscriptions_cancelled?></h5>
			  <h5>Count of all Subscriptions: <?php echo $subscriptions_count?></h5>
		</div>
		
		<div style = "text-align: center;" class="mt-4 p-2 bg-light rounded">
			  <h2>Payments Total</h2>
			  <h5 class = "text-success">Total of Paid Payments: <?php echo $total_paid?></h5>
			  <h5 class = "text-danger">Total of Failed Payments: <?php echo $total_failed?></h5>
			  <h5 class = "text-warning">Total of Pending Payments: <?php echo $total_pending?></h5>
			  <h5>Total of all Payments: <?php echo $total_revenue?></h5>

		</div>

        <br><br><br>
        <a href="dashboard.php" class="btn btn-secondary btn-lg">Return</a>
    </div>

</body>
</html>