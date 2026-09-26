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
        <h1>Members List</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>profile_image</th>
				  <th>First_name</th>
				  <th>Last_name</th>
				  <th>Gender</th>
				  <th>Phone</th>
				  <th>Email</th>
				  <th>birth_date</th>
				  <th>join_date</th>
				  <th>status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM members";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class="<?php echo ($row['status'] == 'Inactive') ? 'table-danger' : ''; ?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td>
			  <img src = "<?php echo htmlspecialchars($row['profile_image'])?>" width="50" height="50" class="rounded-circle">
			  </td>
			  <td><?php echo htmlspecialchars($row['First_name']);?></td>
			  <td><?php echo htmlspecialchars($row['Last_name']);?></td>
			  
			  <td><?php echo htmlspecialchars($row['Gender']);?></td>
			  <td><?php echo htmlspecialchars($row['Phone']); ?></td>
			  <td><?php echo htmlspecialchars($row['Email']); ?></td>
			  <td><?php echo htmlspecialchars($row['birth_date']); ?></td>
			  <td><?php echo htmlspecialchars($row['join_date']); ?></td>
			  <td><?php echo htmlspecialchars($row['status']);?></td>
			  <td>
			  <a href="member_details.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-info btn-sm">display</a>
              <a href="edit_member.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update</a>
              <a href="delete_member.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No members to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		<a href="add_member.php" class="btn btn-primary btn-lg">Add New Member</a>
		<a href="dashboard.php" class="btn btn-secondary btn-lg">Return</a>

    </div>    

</body>
</html>
<?php $conn->close(); ?>
