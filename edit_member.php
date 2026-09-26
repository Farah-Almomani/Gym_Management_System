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
$stmt =$conn->prepare("SELECT * FROM members WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();



if (!$member) {
    header("Location: members.php");
    exit();
}	

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	
	$First_name = test_input($_POST["First_name"]);
    $Last_name = test_input($_POST["Last_name"]);
    $Gender = test_input($_POST["Gender"]);
    $Email = test_input($_POST["Email"]);
    $Phone = test_input($_POST["Phone"]);
    $birth_date = test_input($_POST["birth_date"]);
    $status = test_input($_POST["status"]);
	
	$stmt =$conn->prepare("UPDATE members SET First_name = ?, Last_name = ?, 
	Gender = ?, Email = ?, Phone = ?, birth_date = ?, status = ? WHERE Id = ?");
	$stmt->bind_param("sssssssi", $First_name, $Last_name, $Gender, $Email, $Phone, $birth_date, $status, $id);
	
	if ($stmt->execute()) {
		
				$message = "Member updated successfully :)";
				$message_type = "success";
				
				$member["First_name"] = $First_name;
				$member["Last_name"] = $Last_name;
				$member["Gender"] = $Gender;
				$member["Email"] = $Email;
				$member["Phone"] = $Phone;
				$member["birth_date"] = $birth_date;
				$member["status"] = $status;
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
    <h1 class = "text-primary">Edit Member Details	</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post">

  <br>
  <label><h5>First Name:</h5></label>
  <input type = "text" name = "First_name" value = "<?php echo $member["First_name"]?>" required>
  <br>
  
  <br>
  <label><h5>Last Name:</h5></label>
  <input type = "text" name = "Last_name" value = "<?php echo $member["Last_name"]?>" required>
  <br>
  
  <br>
  <label><h5>Gender:</h5></label>
  <select name="Gender" required>
    <option value="Male" <?php echo ($member['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
    <option value="Female" <?php echo ($member['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
  </select>
  <br>
  
  <br>
  <label><h5>Email:</h5></label>
  <input type = "email" name = "Email" value="<?php echo $member['Email']; ?>" required>
  <br>
  
  <br>
  <label><h5>Phone:</h5></label>
  <input type = "text" name = "Phone" value="<?php echo $member['Phone']; ?>" required>
  <br>
  
  <br>
  <label><h5>Birth Date:</h5></label>
  <input type = "date" name = "birth_date" value="<?php echo $member['birth_date']; ?>" required>
  <br>
  
  <br>
  <label><h5>Status:</h5></label>
  <select name="status" required>
    <option value="Active" <?php echo ($member['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
    <option value="Inactive" <?php echo ($member['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
  </select>
 
  <br>
  <br>
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
<a href="members.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php $conn->close();?>