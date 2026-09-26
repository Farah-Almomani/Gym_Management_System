<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$memberList = [];
$result = $conn->query("SELECT Id, First_name, Last_name FROM members");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $memberList[] = $row;
    }
}

$planList = [];
$result = $conn->query("SELECT Id, plan_name FROM membership_plans");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $planList[] = $row;
    }
}

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$member_id = test_input($_POST["member_id"]);
    $plan_id = test_input($_POST["plan_id"]);
    $start_date = test_input($_POST["start_date"]);
	$end_date = test_input($_POST["end_date"]);
    $status = test_input($_POST["status"]);
	$paid_amount = test_input($_POST["paid_amount"]);
		
			$stmt =$conn->prepare("INSERT INTO subscriptions (member_id, plan_id, start_date, end_date, status, paid_amount)
			VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("iissss", $member_id, $plan_id, $start_date, $end_date, $status, $paid_amount);
			
			if ($stmt->execute()) {
				$message = "Subscription added successfully :)";
				$message_type = "success";
			} else {
				$message = "An error occurred while adding: " . $stmt->error;
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
    <h1 class = "text-primary">Add New Subscription</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype = "multipart/form-data">

  <br>
  <label><h5>member_id:</h5></label>
  <select name="member_id" required>
    <option value="">Member</option>
	<?php foreach ($memberList as $members): ?>
    <option value="<?php echo $members['Id']; ?>">
	<?php echo htmlspecialchars($members['Id'] . '-' . $members['First_name'] . ' ' . $members['Last_name']); ?>
            </option>
        <?php endforeach; ?>
  </select>
  <br>
  
  <br>
  <label><h5>plan_id:</h5></label>
  <select name="plan_id" required>
    <option value="">Plan</option>
    <?php foreach ($planList as $plans): ?>
    <option value="<?php echo $plans['Id']; ?>">
	<?php echo htmlspecialchars($plans['Id'] . '-' . $plans['plan_name']); ?>
            </option>
        <?php endforeach; ?>
  </select>
  <br>
  
  <br>
  <label><h5>start_date:</h5></label>
  <input type = "date" name = "start_date" required>
  <br>
  
  <br>
  <label><h5>end_date:</h5></label>
  <input type = "date" name = "end_date" required>
  <br>
  
  <br>
  <label><h5>status:</h5></label>
  <select name="status" required>
    <option value="Active">Active</option>
    <option value="Expired">Expired</option>
	<option value="Cancelled">Cancelled</option>
	<option value="Pending">Pending</option>
  </select>
  
  
  <br>
  
  <br>
  <label><h5>paid_amount:</h5></label>
  <input type = "text" name = "paid_amount" required>
  <br>
  
  
  <br>
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Add Subscription</button>
<a href="subscriptions.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php
$conn->close();
?>