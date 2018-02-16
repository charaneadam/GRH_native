<?php
	
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$adresse = $_POST['adresse'];
	$sexe = $_POST['sexe'];
	$date = date('Y-m-d', strtotime($_POST['date']));
	$service = $_POST['service'];
	require_once('DB.php');
	
	$conn = connexion();
	$sql = "UPDATE `Employes` SET`nom`=?,`prenom`=?,`sexe`=?,`adresse`=?,`dateNaissance`=?,`numServ`=? WHERE  `code`=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssdssdd", $nom, $prenom, $sexe, $adresse, $date, $service, $id);
	$stmt->execute();
	$conn->close();
	header("Location: allEmpls.php");
	exit();
