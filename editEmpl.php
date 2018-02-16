<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>Voir employé</title>
		<meta name="description" content="">
		<meta name="author" content="Adam Charane">
		
		<link rel="shortcut icon" href="/favicon.ico">
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/styles.css">
		
	</head>

	<body>
		<?php
			if(!isset($_GET['id'])){
				header("Location: allEmpls.php");	
			}
		?>
		<?php
			include 'navbar.html';
			require_once('DB.php');
			$conn = connexion();
			$sql = "SELECT `numServ`, `designationServ` FROM `Services`";
			
			$result = $conn->query($sql);
			$services = array();
			while($row = $result->fetch_assoc()) {
				$services[$row["numServ"]] = $row["designationServ"];
		    }
			$gender = array('M', 'F');
			
			
			$sql = "SELECT * FROM `Employes` WHERE `code` = ".$_GET['id'];
			// SELECT `code`, `nom`, `prenom`, `sexe`, `adresse`, `dateNaissance`, `numServ` FROM `Employes` WHERE 1
			$result = $conn->query($sql);
			$employes = array();
		    while($row = $result->fetch_assoc()) {
				$code = $row["code"];
				$nom = $row["nom"];
				$prenom = $row["prenom"];
				$sexe = $gender[$row["sexe"]];
				$adresse = $row["adresse"];
				$dateNaissance = $row["dateNaissance"];
				$serv = $row["numServ"];
				$numServ = $services[$serv];
				$emp = array($code, $nom, $prenom, $sexe, $adresse, $dateNaissance, $serv, $numServ);
				array_push($employes, $emp);
		    }
			$conn->close();
			$emp = null;
			if(!empty($employes)) $emp = $employes[0];
		?>
		
		<div class="container" style="margin-top: 70px;">
			<form action="updateEmpl.php" method="post">
				<div class="form-group row">
				  <label for="nom" class="col-2 col-form-label">Nom</label>
				  <div class="col-10">
				    <input name="nom" class="form-control" type="text" placeholder="Entrer votre nom" id="nom" value=<?= $emp[2] ?>>
				  </div>
				</div>
				<div class="form-group row">
				  <label for="prenom" class="col-2 col-form-label">Prénom</label>
				  <div class="col-10">
				    <input name="prenom" class="form-control" type="text" placeholder="Entrer votre prénom" id="prenom" value=<?= $emp[1] ?>>
				  </div>
				</div>
				<div class="form-group row">
				    <label for="adresse" class="col-2 col-form-label">Adresse</label>
				    <div class="col-10">
				    	<textarea name="adresse" class="form-control" id="adresse" rows="3"><?= $emp[4] ?></textarea>
				    </div>
				  </div>
				<div class="form-group row">
				  <label for="sexe" class="col-2 col-form-label">Sexe</label>
				  <div class="col-10">
				    <div class="form-check col-5">
					  <input class="form-check-input" type="radio" name="sexe" id="defaultCheck1" value="0" <?php if($emp[3] == "M") echo "checked"; ?>>
					  <label class="form-check-label" for="defaultCheck1">
					    M
					  </label>
					</div>
					<div class="form-check col-5">
					  <input class="form-check-input" type="radio" name="sexe" id="defaultCheck2" value="1" <?php if($emp[3] == "F") echo "checked"; ?>>
					  <label class="form-check-label" for="defaultCheck2">
					    F
					  </label>
					</div>
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-date-input" class="col-2 col-form-label">Date de naissance</label>
				  <div class="col-10">
				    <input name="date" class="form-control" type="date" value="<?= $emp[5] ?>" id="example-date-input">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="service" class="col-2 col-form-label">Service</label>
				  <div class="col-10">
				  	<select class="form-control" id="service" name="service">
				  		<?php
				  			echo "<option value='".$emp[6]."'>".$emp[7]."</option>";
				  			foreach ($services as $key => $value) {
				  				if($value != $emp[7]){
				  					echo "<option value='".$key."'>".$value."</option>";
				  				}
							}
				  		?>
				      </select>
				  </div>
				</div>
				<div class="form-group row">
					<div class="col-2"></div>
					  <div class="col-10">
					  	<input name='id' type='hidden' value="<?= $_GET['id']; ?>">
					  	<input type="submit" class="btn btn-primary" value="Enregistrer modifications"></button>
					  </div>
				</div>
			</form>
		</div>
		
	<script src="../js/jquery.min.js"></script>
    <script src="../js/tether.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	</body>
</html>
