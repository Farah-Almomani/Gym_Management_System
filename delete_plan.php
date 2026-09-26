<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: membership_plans.php");
    exit();
}	

$id = intval($_GET['id']);
$stmt =$conn->prepare("SELECT Id FROM membership_plans WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
			
if($result->num_rows > 0) {
	$stmt->close();
	$stmt =$conn->prepare("DELETE FROM membership_plans WHERE Id = ?");
	$stmt->bind_param("i", $id);
	
	if ($stmt->execute()) {
		$_SESSION["message"] = "Plan deleted successfully :)";
		$_SESSION["message_type"] = "success";
	} else {
		$_SESSION["message"] = "Error occurred while deleting: " . $stmt->error;
		$_SESSION["message_type"] = "danger";
	}
	$stmt->close();
}else{
	 $stmt->close();
	$_SESSION["message"] = "Plan Not Found!";
	$_SESSION["message_type"] = "danger";
}
			
header("Location: membership_plans.php");
exit();

?>