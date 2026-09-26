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

$message = "";
$message_type = "";

$id = intval($_GET['id']);
$stmt =$conn->prepare("SELECT * FROM class_members WHERE Id	= ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$class = $result->fetch_assoc();



if (!$class) {
    header("Location: class_members.php");
    exit();
}	

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$attendance_status = test_input($_POST["attendance_status"]);
	
	
	$stmt =$conn->prepare("UPDATE class_members SET attendance_status = ? WHERE Id = ?");
	$stmt->bind_param("si", $attendance_status, $id);
	
	if ($stmt->execute()) {
		
				$message = "status updated successfully :)";
				$message_type = "success";
				
				$class["attendance_status"] = $attendance_status;
				
				
			} else {
				$message = "An error occurred while updating: " . $stmt->error;
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
    <h1 class = "text-primary">Edit status</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post">

  <br>
  <br>
  <h2>Member id: <?php echo $class['member_id']?></h2>
  <label><h5>attendance_status:</h5></label>
  <select name="attendance_status" required>
    <option value="Booked"<?php echo ($class['attendance_status'] == 'Booked') ? 'selected' : ''; ?>>Booked</option>
    <option value="Attended"<?php echo ($class['attendance_status'] == 'Attended') ? 'selected' : ''; ?>>Attended</option>
	<option value="Absent"<?php echo ($class['attendance_status'] == 'Absent') ? 'selected' : ''; ?>>Absent</option>
	<option value="Expired"<?php echo ($class['attendance_status'] == 'Expired') ? 'selected' : ''; ?>>Expired</option>
  </select>
  
  <br>
  <br>
<button type="submit" name="submit" class="btn btn-primary btn-lg">Update status</button>
<a href="class_members.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php $conn->close();?>