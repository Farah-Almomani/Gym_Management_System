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
	
	$First_name = test_input($_POST["First_name"]);
    $Last_name = test_input($_POST["Last_name"]);
    $Gender = test_input($_POST["Gender"]);
    $Email = test_input($_POST["Email"]);
    $Phone = test_input($_POST["Phone"]);
    $birth_date = test_input($_POST["birth_date"]);
    $join_date = test_input($_POST["join_date"]);
    $status = test_input($_POST["status"]);
	
	$target_dir = "uploads/";
	$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$newFileName = uniqid() . '.' . $imageFileType;
	
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		$uploadOk = 1;		
	} else {
		$message = "File is not an image.";
		$message_type = "danger";
		$uploadOk = 0;
	}
	
	if($_FILES["fileToUpload"]["size"] > 500000) {
	$message = "Sorry, your file is too large.";
	$message_type = "danger";
	$uploadOk = 0;
	}
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	$message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$message_type = "danger";
	$uploadOk = 0;
	}
	
	if($uploadOk == 0) {
		$message = "Sorry, your file was not uploaded.";
		$message_type = "danger";
		}elseif ($uploadOk == 1) {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$message = "The image was uploaded successfully :)";
				$message_type = "success";
			} else {
				$message = "An error occurred while uploading the image :(";
				$message_type = "danger";
				$uploadOk = 0;
			}
		} 
		
		if ($uploadOk == 1){
			$profile_image = $target_file;
			
			$stmt =$conn->prepare("INSERT INTO members (First_name, Last_name, Gender, Email, Phone, birth_date, join_date, status, profile_image)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssssss", $First_name, $Last_name, $Gender, $Email, $Phone, $birth_date, $join_date, $status, $profile_image);
			
			if ($stmt->execute()) {
				$message = "Member added successfully :)";
				$message_type = "success";
			} else {
				$message = "An error occurred while adding: " . $stmt->error;
				$message_type = "danger";
			}
			$stmt->close();
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
    <h1 class = "text-primary">Add New Member</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype = "multipart/form-data">

  <br>
  <label><h5>First Name:</h5></label>
  <input type = "text" name = "First_name" required>
  <br>
  
  <br>
  <label><h5>Last Name:</h5></label>
  <input type = "text" name = "Last_name" required>
  <br>
  
  <br>
  <label><h5>Gender:</h5></label>
  <select name="Gender" required>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
  <br>
  
  <br>
  <label><h5>Email:</h5></label>
  <input type = "email" name = "Email" required>
  <br>
  
  <br>
  <label><h5>Phone:</h5></label>
  <input type = "text" name = "Phone" required>
  <br>
  
  <br>
  <label><h5>Birth Date:</h5></label>
  <input type = "date" name = "birth_date" required>
  <br>
  
  <br>
  <label><h5>Join Date:</h5></label>
  <input type = "date" name = "join_date" required>
  <br>
  
  <br>
  <label><h5>Status:</h5></label>
  <select name="status" required>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
  </select>
  <br>
  
  <br>
  
  <label><h5>Profile Image</h5></label>
  <input type="file" name="fileToUpload" required>
  
  <br>
  <br>
  
<button type="submit" name="submit" class="btn btn-primary btn-lg">Add Member</button>
<a href="members.php" class="btn btn-secondary btn-lg">Return</a>

</form>
</div>
</body>
</html>

<?php
$conn->close();
?>