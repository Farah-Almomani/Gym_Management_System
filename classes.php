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

        <br><br>
		<a href="class_members.php" class="btn btn-info btn-lg">Classes Members</a>
		<h1>Classes List</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>trainer_id</th>
				  <th>class_name</th>
				  <th>session_type</th>
				  
				  <th>gender_specific</th>
				  <th>start_time</th>
				  <th>end_time</th>
				  <th>max_capacity</th>
				  
				  <th>room</th>
				  <th>is_active</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM classes";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class="<?php echo ($row['is_active'] == 'Inactive') ? 'table-danger' : ''; ?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['trainer_id']);?></td>
			  <td><?php echo htmlspecialchars($row['class_name']);?></td>
			  <td><?php echo htmlspecialchars($row['session_type']);?></td>
			  
			  <td><?php echo htmlspecialchars($row['gender_specific']);?></td>
			  <td><?php echo htmlspecialchars($row['start_time']); ?></td>
			  <td><?php echo htmlspecialchars($row['end_time']); ?></td>
			  <td><?php echo htmlspecialchars($row['max_capacity']); ?></td>
			  
			  <td><?php echo htmlspecialchars($row['room']); ?></td>
			  <td><?php echo htmlspecialchars($row['is_active']); ?></td>
			  <td>
              <a href="edit_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update</a>
              <a href="enroll_class.php?class_id=<?php echo $row['Id']; ?>" class="btn btn-outline-primary btn-sm">Enroll class</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No classes to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		<a href="add_class.php" class="btn btn-primary btn-lg">Add New Class</a>
		<a href="dashboard.php" class="btn btn-secondary btn-lg">Return</a>

    </div>    

</body>
</html>
<?php $conn->close(); ?>
