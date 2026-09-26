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
$stmt =$conn->prepare("SELECT * FROM classes WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$class = $result->fetch_assoc();



if (!$class) {
    header("Location: classes.php");
    exit();
}	

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$trainer_id = test_input($_POST["trainer_id"]);
	$class_name = test_input($_POST["class_name"]);
    $session_type = test_input($_POST["session_type"]);
    $gender_specific = test_input($_POST["gender_specific"]);
    $start_time = test_input($_POST["start_time"]);
    $end_time = test_input($_POST["end_time"]);
    $max_capacity = test_input($_POST["max_capacity"]);
	$room = test_input($_POST["room"]);
    $is_active = test_input($_POST["is_active"]);
	
	$stmt =$conn->prepare("UPDATE classes SET trainer_id = ?, class_name = ?, session_type = ?, gender_specific = ?, 
	start_time = ?, end_time = ?, max_capacity = ?, room = ?, is_active = ? WHERE Id = ?");
	$stmt->bind_param("sssssssssi", $trainer_id, $class_name, $session_type, $gender_specific, $start_time, $end_time, $max_capacity, $room, $is_active, $id);
	
	if ($stmt->execute()) {
		
				$message = "Class updated successfully :)";
				$message_type = "success";
				
				$class["trainer_id"] = $trainer_id;
				$class["class_name"] = $class_name;
				$class["session_type"] = $session_type;
				$class["gender_specific"] = $gender_specific;
				$class["start_time"] = $start_time;
				$class["end_time"] = $end_time;
				$class["max_capacity"] = $max_capacity;
				$class["room"] = $room;
				$class["is_active"] = $is_active;
				
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
    <h1 class = "text-primary">Edit Class Details</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post">

  <br>
  <br>


  <label><h5>trainer_id:</h5></label>
  <input type = "text" name = "trainer_id" value = "<?php echo $class["trainer_id"]?>" required>
  
  
  <br>
  <br>
  
  <label><h5>class_name:</h5></label>
  <input type = "text" name = "class_name" value = "<?php echo $class["class_name"]?>" required>
  
  <br>
  <br>
  
  <label><h5>session_type:</h5></label>
  <select name="session_type" required>
    <option value="morning"<?php echo ($class['session_type'] == 'morning') ? 'selected' : ''; ?>>morning</option>
    <option value="evening"<?php echo ($class['session_type'] == 'evening') ? 'selected' : ''; ?>>evening</option>
  </select>
  
  <br>
  <br>
 
  <label><h5>gender_specific:</h5></label>
  <select name="gender_specific" required>
    <option value="male"<?php echo ($class['gender_specific'] == 'male') ? 'selected' : ''; ?>>male</option>
    <option value="female"<?php echo ($class['gender_specific'] == 'female') ? 'selected' : ''; ?>>female</option>
  </select>
  
  
  <br>
  <br>
  
  <label><h5>start_time:</h5></label>
  <input type = "time" name = "start_time" value = "<?php echo $class["start_time"]?>" required>
  
  <br>
  
  <br>
  
  <label><h5>end_time:</h5></label>
  <input type = "time" name = "end_time" value = "<?php echo $class["end_time"]?>" required>
  
  <br>
  
  <br>
  
  <label><h5>max_capacity:</h5></label>
  <input type = "number" name = "max_capacity" min = "0" max = "40" value = "<?php echo $class["max_capacity"]?>" required>
  
  <br>
  
  <br>
  
  <label><h5>room:</h5></label>
  <select name="room" required>
    <option value="room 1"<?php echo ($class['room'] == 'room 1') ? 'selected' : ''; ?>>>room 1</option>
    <option value="room 2"<?php echo ($class['room'] == 'room 2') ? 'selected' : ''; ?>>>room 2</option>
    <option value="swimming pool"<?php echo ($class['room'] == 'swimming pool') ? 'selected' : ''; ?>>>swimming pool</option>
  </select>
  
  <br>
  <br>
  
  <label><h5>is_active:</h5></label>
  <select name="is_active" required>
    <option value="Active"<?php echo ($class['is_active'] == 'Active') ? 'selected' : ''; ?>>Active</option>
    <option value="Inactive"<?php echo ($class['is_active'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
  </select>
 
  <br>
  <br>
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
<a href="classes.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php $conn->close();?>