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
$stmt =$conn->prepare("SELECT * FROM trainers WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$trainer = $result->fetch_assoc();



if (!$trainer) {
    header("Location: trainers.php");
    exit();
}	

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$first_name = test_input($_POST["first_name"]);
    $last_name = test_input($_POST["last_name"]);
    $gender = test_input($_POST["gender"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $specialization = test_input($_POST["specialization"]);
    $experience_years = test_input($_POST["experience_years"]);
	
	$stmt =$conn->prepare("UPDATE trainers SET first_name = ?, last_name = ?, 
	gender = ?, email = ?, phone = ?, specialization = ?, experience_years = ? WHERE Id = ?");
	$stmt->bind_param("sssssssi", $first_name, $last_name, $gender, $email, $phone, $specialization, $experience_years, $id);
	
	if ($stmt->execute()) {
		
				$message = "Trainer updated successfully :)";
				$message_type = "success";
				
				$trainer["first_name"] = $first_name;
				$trainer["last_name"] = $last_name;
				$trainer["gender"] = $gender;
				$trainer["email"] = $email;
				$trainer["phone"] = $phone;
				$trainer["specialization"] = $specialization;
				$trainer["experience_years"] = $experience_years;
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
    <h1 class = "text-primary">Edit Trainer Details	</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post">

  <br>
  <label><h5>First Name:</h5></label>
  <input type = "text" name = "first_name" value = "<?php echo $trainer["first_name"]?>" required>
  <br>
  
  <br>
  <label><h5>Last Name:</h5></label>
  <input type = "text" name = "last_name" value = "<?php echo $trainer["last_name"]?>" required>
  <br>
  
  <br>
  <label><h5>Gender:</h5></label>
  <select name="gender" required>
    <option value="Male" <?php echo ($trainer['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
    <option value="Female" <?php echo ($trainer['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
  </select>
  <br>
  
  <br>
  <label><h5>Email:</h5></label>
  <input type = "email" name = "email" value="<?php echo $trainer['email']; ?>" required>
  <br>
  
  <br>
  <label><h5>Phone:</h5></label>
  <input type = "text" name = "phone" value="<?php echo $trainer['phone']; ?>" required>
  <br>
  
  <br>
  <label><h5>Specialization:</h5></label>
  <input type = "text" name = "specialization" value = "<?php echo $trainer["specialization"]?>" required>
  <br>
  
  <br>
  <label><h5>Experience Years:</h5></label>
  <input type = "number" name="experience_years" value = "<?php echo $trainer["experience_years"]?>" min="0" max="30" required>
  
  <br>
  <br>
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
<a href="trainers.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php $conn->close();?>