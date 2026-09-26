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
        <h1>Female Yoga Class</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 1";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Female Warm-up Class</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 2";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Female Fitness Class</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 3";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Female Swimming Class</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 4";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Male Warm-up Class</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 5";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Male Fitness Class 1</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 6";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Male Bodybuilding Class</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 7";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Male Swimming Class</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 8";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<h1>Male Fitness Class 2</h1>
		 <table class="table table-bordered table-hover" style = "border: 2px;">
            <thead class="table-dark">
                <tr>
				  <th>Id</th>
				  <th>member_id</th>
				  <th>attendance_status</th>
				  <th>procedures</th>
				</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM class_members WHERE class_id = 9";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		?>
			<tr class = "<?php if ($row['attendance_status'] == 'Absent') {echo 'table-danger';} 
			elseif ($row['attendance_status'] == 'Booked') {echo 'table-primary';}
			elseif ($row['attendance_status'] == 'Expired') {echo 'table-warning';}?>">
		
			  <td><?php echo $row["Id"];?></td>
			  <td><?php echo htmlspecialchars($row['member_id']);?></td>
			  <td><?php echo htmlspecialchars($row['attendance_status']);?></td>
			  <td>
              <a href="edit_status.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-warning btn-sm">Update status</a>
			  <a href="delete_member_class.php?id=<?php echo $row['Id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure about deleting it?')">Delete member</a>
			  </td>			  
			</tr>
			<?php 
		}
		}
                else{
                ?>
				<tr>
                    <td colspan="10" class="text-center">No member to display</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
		<a href="classes.php" class="btn btn-secondary btn-lg">Return</a>

    </div>    

</body>
</html>
<?php $conn->close(); ?>
