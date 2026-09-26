<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: members.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM members WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$member = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$member) {
    header("Location: members.php");
    exit();
}

$subscriptions = [];
$stmt = $conn->prepare("SELECT * FROM subscriptions WHERE member_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$subscriptions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$payments = [];
$stmt = $conn->prepare("SELECT * FROM payments WHERE member_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$payments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
    <h1>Member Details</h1>
    
	
	<div style = "text-align: center;" class="mt-4 p-5 bg-primary text-white rounded">
		
			  <img src = "<?php echo $member['profile_image']?>" width = "250" height = "200" class="rounded-circle">
			  <h5>Id: <?php echo $member["Id"];?></h5>
			  <h5>Member name: <?php echo $member['First_name']. " ". $member['Last_name'];?></h5>
			  
			  <h5>Gender: <?php echo $member['Gender'];?></h5>
			  <h5>Phone: <?php echo $member['Phone']; ?></h5>
			  <h5>Email: <?php echo $member['Email']; ?></h5>
			  <h5>birth_date: <?php echo $member['birth_date']; ?></h5>
			  <h5>join_date: <?php echo $member['join_date']; ?></h5>
			  <h5>status: <?php echo $member['status'];?></h5>

    </div>
	<br>
	<br>
	<div>
    <h3>Member Subscription</h3>
    <?php if (count($subscriptions) > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>id</th>
                    <th>plan_id</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Paid Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subscriptions as $sub): ?>
                <tr>
                    <td><?php echo $sub['Id']; ?></td>
                    <td><?php echo $sub['plan_id']; ?></td>
                    <td><?php echo $sub['start_date']; ?></td>
                    <td><?php echo $sub['end_date']; ?></td>
                    <td><?php echo $sub['paid_amount']; ?></td>
                    <td><?php echo $sub['status']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No subscriptions found.</p>
    <?php endif; ?>
	</div>
	<br>
	<div>
    <h3>Member Payment</h3>
    <?php if (count($payments) > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>id</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Method</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $pay): ?>
                <tr>
                    <td><?php echo $pay['Id']; ?></td>
                    <td><?php echo $pay['amount']; ?></td>
                    <td><?php echo $pay['payment_date']; ?></td>
                    <td><?php echo $pay['payment_method']; ?></td>
                    <td><?php echo $pay['transaction_id']; ?></td>
                    <td><?php echo $pay['status']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No payments found.</p>
    <?php endif; ?>
	</div>

    <a href="members.php" class="btn btn-secondary btn-lg">Return</a>
</div>
</body>
</html>
<?php $conn->close(); ?>