<?php

	require_once('DB.php');
	$conn = connexion();
	echo "string";
	
	$sql = "DELETE FROM `Employes` WHERE `code` = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("d", $_GET['id']);
	$stmt->execute();
	$conn->close();
	
	header("Location: allEmpls.php");
	exit();
