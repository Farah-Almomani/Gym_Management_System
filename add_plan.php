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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$plan_name = test_input($_POST["plan_name"]);
	$type_id = test_input($_POST["type_id"]);
    $duration_months = test_input($_POST["duration_months"]);
    $Price = test_input($_POST["Price"]);
    $is_active = test_input($_POST["is_active"]);
	
		
			$stmt =$conn->prepare("INSERT INTO membership_plans (plan_name, type_id, duration_months, Price, is_active)
			VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("sssss", $plan_name, $type_id, $duration_months, $Price, $is_active);
			
			if ($stmt->execute()) {
				$message = "Plan added successfully :)";
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
    <h1 class = "text-primary">Add New Plan</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype = "multipart/form-data">

  <br>

  <label><h5>plan_name:</h5></label>
  <input type = "text" name = "plan_name" required>
  
  <br>
  <br>
  
  <label><h5>type_id:</h5></label>
  <input type = "number" name = "type_id" min = "1" max = "3" required>
  
  <br>
  <br>
  
  <label><h5>duration_months:</h5></label>
  <input type = "number" name = "duration_months" min = "1" max = "12" required>
  
  <br>
  <br>
 
  <label><h5>Price:</h5></label>
  <input type = "text" name = "Price" required>
  
  
  <br>
  <br>
  
  <label><h5>is_active:</h5></label>
  <select name="is_active" required>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
  </select>
  
  <br>
  <br>
  
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Add Plan</button>
<a href="membership_plans.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php
$conn->close();
?>