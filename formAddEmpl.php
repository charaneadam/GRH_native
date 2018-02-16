<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>Voir les employés</title>
		<meta name="description" content="">
		<meta name="author" content="Adam Charane">
		
		<link rel="shortcut icon" href="/favicon.ico">
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/styles.css">
		
	</head>
	<body>
		
		<?php include 'navbar.html'; ?>
		
		<div class="jumbotron">
			<div class="container">
				<h1 class="display-3">Bienvenue Admin</h1>
				<p class="lead">Ajouter un employé</p>
			</div>
		</div>
		
		<div class="container">
			<form action="valAddEmpl.php" method="post">
				<div class="form-group row">
				  <label for="nom" class="col-2 col-form-label">Nom</label>
				  <div class="col-10">
				    <input name="nom" class="form-control" type="text" placeholder="Entrer votre nom" id="nom">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="prenom" class="col-2 col-form-label">Prénom</label>
				  <div class="col-10">
				    <input name="prenom" class="form-control" type="text" placeholder="Entrer votre prénom" id="prenom">
				  </div>
				</div>
				<div class="form-group row">
				    <label for="adresse" class="col-2 col-form-label">Adresse</label>
				    <div class="col-10">
				    	<textarea name="adresse" class="form-control" id="adresse" rows="3"></textarea>
				    </div>
				  </div>
				<div class="form-group row">
				  <label for="sexe" class="col-2 col-form-label">Sexe</label>
				  <div class="col-10">
				    <div class="form-check col-5">
					  <input class="form-check-input" type="radio" name="sexe" id="defaultCheck1" value="0">
					  <label class="form-check-label" for="defaultCheck1">
					    M
					  </label>
					</div>
					<div class="form-check col-5">
					  <input class="form-check-input" type="radio" name="sexe" id="defaultCheck2" value="1">
					  <label class="form-check-label" for="defaultCheck2">
					    F
					  </label>
					</div>
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-date-input" class="col-2 col-form-label">Date de naissance</label>
				  <div class="col-10">
				    <input name="date" class="form-control" type="date" value="1995-08-19" id="example-date-input">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="service" class="col-2 col-form-label">Service</label>
				  <div class="col-10">
				  	<select class="form-control" id="service" name="service">
				  		<?php
				  			require_once('DB.php');
							$conn = connexion();
							$sql = "SELECT `numServ`, `designationServ` FROM `Services` WHERE 1";
							$result = $conn->query($sql);
							$conn->close();
							while($row = $result->fetch_assoc()) {
								echo "<option value='".$row["numServ"]."'>".$row["designationServ"]."</option>";
						    }
				  		?>
				      </select>
				  </div>
				</div>
				<div class="form-group row">
					<div class="col-2"></div>
					  <div class="col-10">
					  	<input type="submit" class="btn btn-primary" value="ajouter employé"></button>
					  </div>
				</div>
			</form>
		</div>
		<?php include 'scripts.html'; ?>
	</body>
</html>