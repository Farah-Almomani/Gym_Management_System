<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

if (!isset($_GET['class_id']) || empty($_GET['class_id'])) {
    header("Location: classes.php");
    exit();
}

$message = "";
$message_type = "";

$class_id = intval($_GET['class_id']);

$stmt = $conn->prepare("SELECT * FROM classes WHERE Id = ?");
$stmt->bind_param("i", $class_id);
$stmt->execute();
$result = $stmt->get_result();
$class = $result->fetch_assoc();
$stmt->close();



if (!$class) {
    header("Location: classes.php");
    exit();
}	

$stmt = $conn->prepare("SELECT COUNT(*) AS enrolled FROM class_members WHERE class_id = ?");
$stmt->bind_param("i", $class_id);
$stmt->execute();
$result = $stmt->get_result();
$enrolled = $result->fetch_assoc()['enrolled'];
$stmt->close();


$stmt = $conn->prepare("SELECT Id, First_name, Last_name FROM members");
$stmt->execute();
$result = $stmt->get_result();
$members = [];
while($row = $result->fetch_assoc()){
	$members[]= $row;
}
$stmt->close();



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$member_id = intval($_POST["member_id"]);
	$enrollment_date = date('Y-m-d');
	
	if($enrolled >= $class["max_capacity"]) {
		$message = "Class is Full !";
		$message_type = "danger";
	}else {
		$stmt =$conn->prepare("SELECT * FROM class_members WHERE class_id = ? AND member_id = ?");
		$stmt->bind_param("ii", $class_id, $member_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$existe = $result->num_rows > 0;
		$stmt->close();
		
		if($existe) {
			$message = "Member already enrolled in class!";
			$message_type = "danger";
		}else{
		$stmt =$conn->prepare("INSERT INTO class_members  (class_id, member_id, enrollment_date, attendance_status)
		VALUES(?, ?, ?, 'Booked')");
		$stmt->bind_param("iis", $class_id, $member_id, $enrollment_date);
		if($stmt->execute()) {
			$message = "Member enrolled Succesfully :)";
			$message_type = "success";
			$enrolled++;
		}else {
			$message = "Error: ".$stmt->error;
			$message_type = "danger";
		}
		$stmt->close();
		}
	}

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
    <h1 class = "text-primary">Enroll in Class</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>
	
	<div style = "text-align: center;" class="mt-4 p-5 bg-info rounded">
			  
			  <h5><?php echo htmlspecialchars($class['class_name']);?></h5>
			  <h5>Trainer id: <?php echo $class["trainer_id"];?></h5>
			  
			  <h5>Room: <?php echo $class['room'];?></h5>
			  <h5>Time: <?php echo $class['start_time']. " - ". $class['end_time']; ?></h5>
			  <h5>Capacity: <?php echo $enrolled. "/". $class['max_capacity']; ?></h5>
			  

    </div>
	
	<?php if ($enrolled < $class["max_capacity"]): ?>

<form method = "post">

  <br>
  <br>


  <label><h5>Member:</h5></label>
  <select name="member_id" required>
    <option value="">Select Member</option>
	<?php foreach ($members as $member): ?>
    <option value="<?php echo $member["Id"];?>">
	<?php echo htmlspecialchars($member['First_name']. ' '. $member['Last_name']);?>
	</option>
	<?php endforeach;?>
  </select>  
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Enroll</button>
<a href="classes.php" class="btn btn-secondary btn-lg">Return</a>

</form>

<?php else: ?>

<div class="alert alert-danger">This class is full!</div>
    <a href="classes.php" class="btn btn-secondary">Return</a>
    <?php endif; ?>
</div>
</body>
</html>

<?php $conn->close();?>