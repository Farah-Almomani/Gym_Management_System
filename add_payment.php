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

$subscriptionList = [];
$result = $conn->query("SELECT Id, member_id, status, paid_amount FROM subscriptions");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $subscriptionList[] = $row;
    }
}

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$member_id = test_input($_POST["member_id"]);
    $subscription_id = test_input($_POST["subscription_id"]);
    $amount = test_input($_POST["amount"]);
    $payment_date = test_input($_POST["payment_date"]);
    $payment_method = test_input($_POST["payment_method"]);
    $transaction_id = test_input($_POST["transaction_id"]);
    $status = test_input($_POST["status"]);

			
			$stmt =$conn->prepare("INSERT INTO payments (member_id, subscription_id, amount, payment_date, payment_method, transaction_id, status)
			VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssss", $member_id, $subscription_id, $amount, $payment_date, $payment_method, $transaction_id, $status);
			
			if ($stmt->execute()) {
				$message = "Payment added successfully :)";
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
    <h1 class = "text-primary">Add New Payment</h1>

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
  <label><h5>subscription_id:</h5></label>
  <select name="subscription_id" required>
    <option value="">subscription</option>
    <?php foreach ($subscriptionList as $subscriptions): ?>
    <option value="<?php echo $subscriptions['Id']; ?>">
	<?php echo htmlspecialchars($subscriptions['Id'] . '- Member_id: ' . $subscriptions['member_id'] . ' - ' . $subscriptions['status'] . ' ' . $subscriptions['paid_amount']); ?>
            </option>
        <?php endforeach; ?>
  </select>
  <br>
  
  <br>
  <label><h5>amount:</h5></label>
  <input type = "text" name = "amount" required>
  <br>
  
  <br>
  <label><h5>payment_date:</h5></label>
  <input type = "date" name = "payment_date" required>
  <br>
  
  <br>
  <label><h5>payment_method:</h5></label>
  <select name="payment_method" required>
    <option value="Cash">Cash</option>
    <option value="Credit Card">Credit Card</option>
	<option value="Bank Transfer">Bank Transfer</option>
  </select>
  <br>
  
  <br>
  <label><h5>transaction_id:</h5></label>
  <input type = "text" name = "transaction_id" required>
  <br>
  
  <br>
  <label><h5>status:</h5></label>
  <select name="status" required>
    <option value="Paid">Paid</option>
    <option value="Pending">Pending</option>
	<option value="Failed">Failed</option>
  </select>
  
  
  <br>
  <br>
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Add Payment</button>
<a href="payments.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php
$conn->close();
?>