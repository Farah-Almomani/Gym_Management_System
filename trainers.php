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
        <h1>Trainers List</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>profile_image</th>
				  <th>first_name</th>
				  <th>last_name</th>
				  <th>gender</th>
				  <th>phone</th>
				  <th>email</th>
				  <th>specialization</th>
				  <th>trains_gender</th>
				  <th>experience_years</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM trainers";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr>
		
			  <td><?php echo $row["Id"];?></td>
			  <td>
			  <img src = "<?php echo htmlspecialchars($row['profile_image'])?>" width="50" height="50" class="rounded-circle">
			  </td>
			  <td><?php echo htmlspecialchars($row['first_name']);?></td>
			  <td><?php echo htmlspecialchars($row['last_name']);?></td>
			  
			  <td><?php echo htmlspecialchars($row['gender']);?></td>
			  <td><?php echo htmlspecialchars($row['phone']); ?></td>
			  <td><?php echo htmlspecialchars($row['email']); ?></td>
			  <td><?php echo htmlspecialchars($row['specialization']); ?></td>
			  <td><?php echo htmlspecialchars($row['trains_gender']); ?></td>
			  <td><?php echo htmlspecialchars($row['experience_years']);?></td>
			  <td>
			  <a href="trainer_details.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-info btn-sm">display</a>
              <a href="edit_trainer.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update</a>
              <a href="delete_trainer.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No trainers to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		<a href="add_trainer.php" class="btn btn-primary btn-lg">Add New trainer</a>
		<a href="dashboard.php" class="btn btn-secondary btn-lg">Return</a>

    </div>    

</body>
</html>
<?php $conn->close(); ?>
