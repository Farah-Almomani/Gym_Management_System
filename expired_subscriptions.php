<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
<?php endif; ?>

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
        <h1>Expired_subscriptions</h1>
		 <table class="table table-hover" style = "border: 2px;">
            <thead class="table-info">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>plan_id</th>
				  <th>start_date</th>
				  <th>end_date</th>
				  <th>paid_amount</th>
				  <th>status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM subscriptions WHERE status = 'Expired'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr>
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo $row["member_id"];?></td>
			  <td><?php echo $row["plan_id"];?></td>
			  
			  <td><?php echo htmlspecialchars($row['start_date']);?></td>
			  <td><?php echo htmlspecialchars($row['end_date']);?></td>
			  <td><?php echo htmlspecialchars($row['paid_amount']);?></td>
			  <td><?php echo htmlspecialchars($row['status']); ?></td>
			  <td>
			  <a href="renew_subscription.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-success btn-sm">Renew</a>
			  </td>
			  
			  	  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No Subscription to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		<a href="subscriptions.php" class="btn btn-secondary btn-lg">Return</a>

    </div>    

</body>
</html>
<?php $conn->close(); ?>
