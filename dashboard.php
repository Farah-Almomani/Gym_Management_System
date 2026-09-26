<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$members_count = 0;
$trainers_count = 0;
$subscriptions_count = 0;
$total_revenue = 0;
$plans_count = 0;
$classes_count = 0;

$result = $conn->query("SELECT COUNT(*) AS count FROM members");
if ($result) {
    $members_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM trainers");
if ($result) {
    $trainers_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM subscriptions");
if ($result) {
    $subscriptions_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT SUM(amount) AS total FROM payments");
if ($result) {
    $total_revenue = $result->fetch_assoc()['total'] ?? 0;
}

$result = $conn->query("SELECT COUNT(*) AS count FROM membership_plans");
if ($result) {
    $plans_count = $result->fetch_assoc()['count'];
}

$result = $conn->query("SELECT COUNT(*) AS count FROM classes");
if ($result) {
    $classes_count = $result->fetch_assoc()['count'];
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
        <h1>Dashboard</h1>
        <p>Welcome، <?php echo $_SESSION['username']; ?></p>
        
			<div style = "text-align: center;">
			<button class = "btn btn-primary btn-lg">
			<a href="members.php" class = "text-decoration-none text-light">
                <h5>members</h5>
                <h2><?php echo $members_count; ?></h2>  
			</a>
			</button>
			
			<button class = "btn btn-info btn-lg">
			<a href="trainers.php" class = "text-decoration-none text-light">
                <h5>trainers</h5>
				<h2><?php echo $trainers_count; ?></h2>    
			</a>
			</button>
           
			<button class = "btn btn-warning btn-lg">
			<a href="subscriptions.php" class = "text-decoration-none text-secondary">
				<h5>subscriptions</h5>
				<h2><?php echo $subscriptions_count; ?></h2>
			</a>
            </button>
			</div>
			<br><br>
			<div style= "text-align: center;">
			<button class = "btn btn-success btn-lg">
			<a href="payments.php" class = "text-decoration-none text-light">
			    <h5>Revenue</h5>
				<h2><?php echo number_format($total_revenue); ?>JD</h2>
			</a>
			</button>
			
			<button class = "btn btn-dark btn-lg">
			<a href="membership_plans.php" class = "text-decoration-none text-light">
				<h5>Plans</h5>
				<h2><?php echo $plans_count;?></h2>
			</a>
			</button>
			
			<button class = "btn btn-secondary btn-lg">
			<a href="classes.php" class = "text-decoration-none text-light">
				<h5>Classes</h5>
				<h2><?php echo $classes_count;?></h2>
			</a>
			</button>
			</div>
			<br><br>
			<div style = "text-align: center;">
			<button class = "btn btn-primary btn-lg">
			<a href="reports.php" class = "text-decoration-none text-light">
				<h5>Reports</h5>
			</a>
			</button>
			
			<button class = "btn btn-warning btn-lg">
			<a href="notifications.php" class = "text-decoration-none text-secondary">
				<h5>Notifications</h5>
			</a>
			</button>
			</div>

        </div>
        <br><br><br>
		<div style = "text-align: center;">
        <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>
		</div>
    </div>

</body>
</html>