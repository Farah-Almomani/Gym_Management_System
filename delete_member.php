<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: members.php");
    exit();
}	

$id = intval($_GET['id']);
$stmt =$conn->prepare("SELECT Id FROM members WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
			
if($result->num_rows > 0) {
	$stmt->close();
	$stmt =$conn->prepare("DELETE FROM members WHERE Id = ?");
	$stmt->bind_param("i", $id);
	
	if ($stmt->execute()) {
		$_SESSION["message"] = "Member deleted successfully :)";
		$_SESSION["message_type"] = "success";
	} else {
		$_SESSION["message"] = "Error occurred while deleting: " . $stmt->error;
		$_SESSION["message_type"] = "danger";
	}
	$stmt->close();
}else{
	 $stmt->close();
	$_SESSION["message"] = "Member Not Found!";
	$_SESSION["message_type"] = "danger";
}
			
header("Location: members.php");
exit();

?>