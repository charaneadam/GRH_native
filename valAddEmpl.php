<?php
	
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$adresse = $_POST['adresse'];
	$sexe = $_POST['sexe'];
	$date = date('Y-m-d', strtotime($_POST['date']));
	$service = $_POST['service'];
	require_once('DB.php');
	
	$conn = connexion();
	$sql = "INSERT INTO `Employes`(`nom`, `prenom`, `sexe`, `adresse`, `dateNaissance`, `numServ`) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssdssd", $nom, $prenom, $sexe, $adresse, $date, $service);
	$stmt->execute();
	$conn->close();
	header("Location: formAddEmpl.php");
	exit();
