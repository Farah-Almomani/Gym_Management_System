<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: trainers.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM trainers WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$trainer = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$trainer) {
    header("Location: trainers.php");
    exit();
}

$classes = [];
$stmt = $conn->prepare("SELECT * FROM classes WHERE trainer_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$classes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
    <h1>Trainer Details</h1>
    
	
	<div style = "text-align: center;" class="mt-4 p-5 bg-info rounded">
		
			  <img src = "<?php echo $trainer['profile_image']?>" width = "250" height = "200" class="rounded-circle">
			  <h5>Id: <?php echo $trainer["Id"];?></h5>
			  <h5>Trainer name: <?php echo $trainer['first_name']. " ". $trainer['last_name'];?></h5>
			  
			  <h5>Gender: <?php echo $trainer['gender'];?></h5>
			  <h5>Phone: <?php echo $trainer['phone']; ?></h5>
			  <h5>Email: <?php echo $trainer['email']; ?></h5>
			  <h5>Specialization: <?php echo $trainer['specialization']; ?></h5>
			  <h5>trains_gender: <?php echo $trainer['trains_gender']; ?></h5>
			  <h5>experience_years: <?php echo $trainer['experience_years'];?></h5>

    </div>
	<br>
	<br>
	<div>
    <h3>Trainer Class</h3>
    <?php if (count($classes) > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>Id</th>
                    <th>Class name</th>
                    <th>Session type</th>
                    <th>Gender specific</th>
                    <th>Start time</th>
                    <th>End time</th>
					<th>Max capacity</th>
					<th>Room</th>
					<th>Is_active</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class): ?>
                <tr>
                    <td><?php echo $class['Id']; ?></td>
                    <td><?php echo $class['class_name']; ?></td>
                    <td><?php echo $class['session_type']; ?></td>
                    <td><?php echo $class['gender_specific']; ?></td>
                    <td><?php echo $class['start_time']; ?></td>
                    <td><?php echo $class['end_time']; ?></td>
					<td><?php echo $class['max_capacity']; ?></td>
                    <td><?php echo $class['room']; ?></td>
                    <td><?php echo $class['is_active']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No classes found.</p>
    <?php endif; ?>
	</div>
	

    <a href="trainers.php" class="btn btn-secondary btn-lg">Return</a>
</div>
</body>
</html>
<?php $conn->close(); ?>