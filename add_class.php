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

$trainersList = [];
$result = $conn->query("SELECT Id, first_name, specialization FROM trainers");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $trainersList[] = $row;
    }
}

$message = "";
$message_type = "";

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
		
			$stmt =$conn->prepare("INSERT INTO classes (trainer_id, class_name, session_type, 
			gender_specific, start_time, end_time, max_capacity, room, is_active)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssssss", $trainer_id, $class_name, $session_type, $gender_specific, 
			$start_time, $end_time, $max_capacity, $room, $is_active);
			
			if ($stmt->execute()) {
				$message = "Class added successfully :)";
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
    <h1 class = "text-primary">Add New Class</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype = "multipart/form-data">

  <br>
  <label><h5>trainer_id:</h5></label>
  <select name="trainer_id" required>
    <option value="">Trainer</option>
	<?php foreach ($trainersList as $trainers): ?>
    <option value="<?php echo $trainers['Id']; ?>">
	<?php echo htmlspecialchars($trainers['Id'] . '-' . $trainers['first_name'] . ' ' . $trainers['specialization']); ?>
            </option>
        <?php endforeach; ?>
  </select>
  <br>
  
  <br>
  <label><h5>class_name:</h5></label>
  <select name="class_name" required>
    <option value="Bodybuilding">Bodybuilding</option>
    <option value="Yoga">Yoga</option>
    <option value="Warm-up">Warm-up</option>
	<option value="Fitness">Fitness</option>
	<option value="Swimming">Swimming</option>

  </select>
  <br>
  
  <br>
  <label><h5>session_type:</h5></label>
  <select name="session_type" required>
    <option value="morning">morning</option>
    <option value="evening">evening</option>
  </select>
  <br>
  
  <br>
  <label><h5>gender_specific:</h5></label>
  <select name="gender_specific" required>
    <option value="male">male</option>
    <option value="female">female</option>
  </select>
  
  
  <br>
  
  <br>
  <label><h5>start_time:</h5></label>
  <input type = "time" name = "start_time" required>
  <br>
  
  <br>
  <label><h5>end_time:</h5></label>
  <input type = "time" name = "end_time" required>
  <br>
  
  <br>
  <label><h5>max_capacity:</h5></label>
  <input type = "number" name = "max_capacity" min = "0" max = "40" required>
  <br>
  
  <br>
  <label><h5>room:</h5></label>
  <select name="room" required>
    <option value="room 1">room 1</option>
    <option value="room 2">room 2</option>
    <option value="swimming pool">swimming pool</option>
  </select>
  <br>
  
  <br>
  <label><h5>is_active:</h5></label>
  <select name="is_active" required>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
  </select>
  <br>
  
  
  <br>
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Add Class</button>
<a href="classes.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php
$conn->close();
?>