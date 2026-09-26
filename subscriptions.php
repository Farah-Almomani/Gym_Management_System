<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$All_subscriptions = 0;
$active_subscriptions = 0;
$Expired_subscriptions = 0;
$Pending_subscriptions = 0;
$Cancelled_subscriptions = 0;


$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions");
if ($result) {
    $All_subscriptions = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Active'");
if ($result) {
    $active_subscriptions = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Expired'");
if ($result) {
    $Expired_subscriptions = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Pending'");
if ($result) {
    $Pending_subscriptions = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions WHERE status = 'Cancelled'");
if ($result) {
    $Cancelled_subscriptions = $result->fetch_assoc()['count'];
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
        <h1>Subscriptions</h1>
        
			<div style = "text-align: center;">
			<button style = "text-align:center;"class = "btn btn-info btn-lg">
			<a href="all_subscriptions.php" class = "text-decoration-none text-light">
				<h5>All Subscriptions</h5>
				<h2><?php echo $All_subscriptions; ?></h2>
			</a>
			</button>
			</div>
			
			<br><br>
			<div style = "text-align:center;">
            <button class = "btn btn-success">
			<a href="active_subscriptions.php" class = "text-decoration-none text-light">
                <h5>Active Subscriptions</h5>
				<h2><?php echo $active_subscriptions; ?></h2>
            </a>
            </button>
			
			<button class = "btn btn-warning btn-lg">
			<a href="expired_subscriptions.php" class = "text-decoration-none text-secondary">
                <h5>Expired_subscriptions</h5>
				<h2><?php echo $Expired_subscriptions; ?></h2>
            </a>
            </button>
			
			<button class = "btn btn-primary btn-lg">
			<a href="pending_subscriptions.php" class = "text-decoration-none text-light">
                <h5>Pending Subscriptions</h5>
				<h2><?php echo $Pending_subscriptions; ?></h2>
            </a>
            </button>
			
			<button class = "btn btn-danger btn-lg">
			<a href="cancelled_subscriptions.php" class = "text-decoration-none text-light">
				<h5>Cancelled Subscriptions</h5>
				<h2><?php echo $Cancelled_subscriptions; ?></h2>
			</a>
			</button>
			</div>

        <br><br><br>
		<a href="new_subscriptions.php" class="btn btn-primary btn-lg">Add New Subscription</a>
        <a href="dashboard.php" class="btn btn-secondary btn-lg">Return</a>
    </div>
</body>
</html>