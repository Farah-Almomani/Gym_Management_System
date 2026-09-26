<?php
session_start();

include "database.php";

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
	
$CFlag = "";
$UserName = "";
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$UserName = test_input($_POST['UserName']);
	$Password = $_POST['Password'];
	
	if (empty($UserName)) {
		$CFlag = "UserName Missing !!! ";
		
	}elseif(empty($Password)) {
			$CFlag = "Password Missing !!! ";
		}else{
			$stmt = $conn->prepare("SELECT Id, username, password, role FROM users WHERE username = ?");
			$stmt->bind_param("s", $UserName);
			$stmt->execute();
			$result = $stmt->get_result();
			$user = $result->fetch_assoc();
			$stmt->close();
			
			if ($user) {
				$password_correct = false;
				
				if(password_verify($Password, $user['password'])) {
					$password_correct = true;
				}elseif($Password === $user['password']) {
					$password_correct = true;
					
					$new_hash = password_hash($Password, PASSWORD_DEFAULT);
					$updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE Id = ?");
					$updateStmt->bind_param("si", $new_hash, $user['Id']);
					$updateStmt->execute();
					$updateStmt->close();
				}
				if($password_correct) {
					$_SESSION['user_id'] = $user['Id'];
					$_SESSION['username'] = $user['username'];
					$_SESSION['role'] = $user['role'];
					
					$updateStmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE Id = ?");
					$updateStmt->bind_param("i", $user['Id']);
					$updateStmt->execute();
					$updateStmt->close();
					
					header("Location: dashboard.php");
					exit();
				} else{
					$CFlag = "Password Not Correct :(";
				}
				
				
				
			} else {
				$CFlag = "UserName or Password Not Correct :(";
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

<div style = "text-align: center;" class = "container mt-3">

  <img src = "MyGym Logo.png" class = "rounded-circle" alt = "MyGym loge" width = "250" height = "200">
  <br>
  <br>
  <br>
  
   <?php if ($CFlag): ?>
       <div class="alert alert-danger w-50 mx-auto"><?php echo $CFlag; ?></div>
   <?php endif; ?>
		
		
  <form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  <label>UserName: </label>
  <input type = "text" name = "UserName">
  <br>
  <br>
  <label>Password: </label>
  <input type = "password" name = "Password">
  <br>
  <br>
  <button type="submit" name="Login" class="btn btn-primary text-light btn-lg">Login</button>
  </form>
</div>

</body>
</html>