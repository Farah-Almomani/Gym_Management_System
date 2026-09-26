<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$message = "";
$message_type = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$subscription_id = intval($_GET['id']);
$stmt =$conn->prepare("SELECT s.*, p.plan_name 
    FROM subscriptions s
    JOIN membership_plans p ON s.plan_id = p.Id
    WHERE s.Id = ?");
$stmt->bind_param("i", $subscription_id);
$stmt->execute();
$old_subscription = $stmt->get_result()->fetch_assoc();
$stmt->close();


if (!$old_subscription) {
    header("Location: subscriptions.php");
    exit();
}	

$plans = [];
$stmt =$conn->prepare("SELECT Id, plan_name, Price FROM membership_plans WHERE is_active = 'Active'");
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
	$plans[]= $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$plan_id = intval($_POST['plan_id']);
    $start_date = test_input($_POST["start_date"]);
	
	$stmt =$conn->prepare("SELECT duration_months, Price FROM membership_plans WHERE Id = ?");
	$stmt->bind_param("i", $plan_id);
	$stmt->execute();
	$plan_details = $stmt->get_result()->fetch_assoc();
	$stmt->close();
	
	$end_date = date("Y,m,d", strtotime($start_date. " + ". $plan_details["duration_months"]. "months"));
	$paid_amount = $plan_details["Price"];
	
	$stmt =$conn->prepare("INSERT INTO subscriptions (member_id, plan_id, start_date, end_date, status, paid_amount)
	VALUES (?, ?, ?, ?, 'Active', ?)");
	$stmt->bind_param("iisss", $old_subscription["member_id"], $plan_id, $start_date, $end_date, $paid_amount);
	
	if ($stmt->execute()) {
		$message = "Subscription renewed successfully :)";
		$message_type = "success";
	} else {
		$message = "An error occurred while renewed: " . $stmt->error;
		$message_type = "danger";
		}
		
		$stmt->close();
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
    <h1 class = "text-primary">Renew Subscription</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>
	
	<div style = "text-align: center;" class="mt-4 p-5 bg-info rounded">
			  
			  <h5>Member id: <?php echo $old_subscription['member_id'];?></h5>
			  <h5>Current_plan: <?php echo htmlspecialchars($old_subscription['plan_name']);?></h5>
			  <h5>Start Date: <?php echo $old_subscription['start_date']; ?></h5>
			  <h5>End Date: <?php echo $old_subscription['end_date']; ?></h5>
			  <h5>Status: <?php echo $old_subscription['status']; ?></h5>
    </div>
	
<br>
  <br>
<form method = "post">
  
  <label><h5>Plan:</h5></label>
  <select name="plan_id" required>
    <option value="">Select New Plan</option>
	<?php foreach ($plans as $plan): ?>
    <option value="<?php echo $plan["Id"];?>">
	<?php echo htmlspecialchars($plan['plan_name']. ' - '. $plan['Price']. 'JD');?>
	</option>
	<?php endforeach;?>
  </select>  
  
  <label><h5>Start date:</h5></label>
  <input type="date" name="start_date" value="<?php echo date('Y-m-d'); ?>" required>
  
<button type="submit" name="submit" class="btn btn-success btn-lg">Renew Subscription</button>
<a href="subscriptions.php" class="btn btn-secondary btn-lg">Return</a>

</form>

</div>
</body>
</html>

<?php $conn->close();?>