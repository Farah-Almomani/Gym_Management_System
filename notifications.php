<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include "database.php";

$expired = [];
$stmt = $conn->prepare("SELECT * FROM subscriptions WHERE status = 'Expired'");
$stmt->execute();
$expired = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$expiring_soon = [];
$stmt = $conn->prepare("
    SELECT * FROM subscriptions 
    WHERE status = 'Active' 
    AND DATEDIFF(end_date, CURDATE()) BETWEEN 0 AND 5
");
$stmt->execute();
$expiring_soon = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$full_classes = [];
$stmt = $conn->prepare("
    SELECT c.*, 
           (SELECT COUNT(*) FROM class_members WHERE class_id = c.Id) AS enrolled
    FROM classes c
    WHERE c.is_active = 'Active' 
    AND (SELECT COUNT(*) FROM class_members WHERE class_id = c.Id) >= c.max_capacity
");
$stmt->execute();
$full_classes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$payment_pending = [];
$stmt = $conn->prepare("SELECT * FROM payments WHERE status = 'Pending'");
$stmt->execute();
$payment_pending = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$payment_failed = [];
$stmt = $conn->prepare("SELECT * FROM payments WHERE status = 'Failed'");
$stmt->execute();
$payment_failed = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$members = [];
$result = $conn->query("SELECT Id, First_name, Last_name FROM members");
while ($row = $result->fetch_assoc()) {
    $members[$row['Id']] = $row['First_name'] . ' ' . $row['Last_name'];
}

$trainers = [];
$result = $conn->query("SELECT Id, first_name, last_name FROM trainers");
while ($row = $result->fetch_assoc()) {
    $trainers[$row['Id']] = $row['first_name'] . ' ' . $row['last_name'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Notifications</h1>

    <?php if (empty($expiring_soon) && empty($expired) && empty($full_classes) && empty($payment_issues)): ?>
        <div class="alert alert-success">All good! No notifications.</div>
    <?php endif; ?>

    <?php if (!empty($expiring_soon)): ?>
        <div class="alert alert-warning">
            <h4>Subscriptions Expiring Soon</h4>
            <ul>
                <?php foreach ($expiring_soon as $sub): ?>
                    <li>
                        Member ID: <?php echo $sub['member_id']; ?> 
                        - ends on <?php echo $sub['end_date']; ?>
                        (Plan ID: <?php echo $sub['plan_id']; ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($expired)): ?>
        <div class="alert alert-danger">
            <h4>Expired Subscriptions</h4>
            <ul>
                <?php foreach ($expired as $sub): ?>
                    <li>
                        Member ID: <?php echo $sub['member_id']; ?> 
                        - expired on <?php echo $sub['end_date']; ?>
                        (Plan ID: <?php echo $sub['plan_id']; ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($full_classes)): ?>
        <div class="alert alert-info">
            <h4>Full Classes</h4>
            <ul>
                <?php foreach ($full_classes as $class): ?>
                    <li>
                        <?php echo $class['class_name']; ?> 
                        - <?php echo $class['enrolled']; ?>/<?php echo $class['max_capacity']; ?> booked
                        (Trainer ID: <?php echo $class['trainer_id']; ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($payment_failed)): ?>
        <div class="alert alert-danger">
            <h4>Payment Failed</h4>
            <ul>
                <?php foreach ($payment_failed as $pay): ?>
                    <li>
                        Member ID: <?php echo $pay['member_id']; ?> 
                        - <?php echo $pay['amount']; ?> JD 
                        (<?php echo $pay['status']; ?>) 
                        - <?php echo $pay['payment_date']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
	
	<?php if (!empty($payment_pending)): ?>
        <div class="alert alert-warning">
            <h4>Payment Pending</h4>
            <ul>
                <?php foreach ($payment_pending as $pay): ?>
                    <li>
                        Member ID: <?php echo $pay['member_id']; ?> 
                        - <?php echo $pay['amount']; ?> JD 
                        (<?php echo $pay['status']; ?>) 
                        - <?php echo $pay['payment_date']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <a href="dashboard.php" class="btn btn-secondary">Return</a>
</div>
</body>
</html>