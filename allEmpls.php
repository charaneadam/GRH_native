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
				<p class="lead">Voici la liste des employés</p>
			</div>
		</div>
		
		<div class="container">
			

			
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Prenom</th>
						<th scope="col">Nom</th>
						<th scope="col">Sexe</th>
						<th scope="col">Adresse</th>
						<th scope="col">Date naissance</th>
						<th scope="col">Service</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
						require_once('DB.php');
						$conn = connexion();
						
						$sql = "SELECT `numServ`, `designationServ` FROM `Services` WHERE 1";
						$result = $conn->query($sql);
						$services = array();
						while($row = $result->fetch_assoc()) {
							$services[$row["numServ"]] = $row["designationServ"];
					    }
						$gender = array('M', 'F');
						$sql = "SELECT * FROM `Employes`";
						$result = $conn->query($sql);
						$employes = array();
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						    	// `code`, `nom`, `prenom`, `sexe`, `adresse`, `dateNaissance`, `numServ`
								$code = $row["code"];
								$nom = $row["nom"];
								$prenom = $row["prenom"];
								$sexe = $gender[$row["sexe"]];
								$adresse = $row["adresse"];
								$dateNaissance = $row["dateNaissance"];
								$numServ = $services[$row["numServ"]];
								
								$emp = array($code, $nom, $prenom, $sexe, $adresse, $dateNaissance, $numServ);
								array_push($employes, $emp);
						    }
						}
						$conn->close();
					
						$len = count($employes);
						for($x=0; $x<$len; $x++){
							echo "
								<tr>
									<th scope='row'>".($x+1)."</th>
									<td>".$employes[$x][2]."</td>
									<td>".$employes[$x][1]."</td>
									<td>".$employes[$x][3]."</td>
									<td>".$employes[$x][4]."</td>
									<td>".$employes[$x][5]."</td>
									<td>".$employes[$x][6]."</td>
									<td><a href='editEmpl.php?id=".$employes[$x][0]."'><i class='fa fa-eye'></i> Voir</a> | 
										<a href='#' data-href='delEmpl.php?id=".$employes[$x][0]."'
											data-toggle='modal' data-target='#confirm-delete' data-whatever='".$employes[$x][2].' '.$employes[$x][1]."'>
											<i class='fa fa-remove' style='font-size:20px;color:red'></i> Supprimer
										</a>
									</td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
			
			<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                Confirmer la suppression
			            </div>
			            <div id="confirmerSuppression" class="modal-body">
			                
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			                <a class="btn btn-danger btn-ok">Delete</a>
			            </div>
			        </div>
			    </div>
			</div>
			
			<?php include 'scripts.html'; ?>
			<script type="text/javascript">
		    	$('#confirm-delete').on('show.bs.modal', function(e) {
		    		var button = $(e.relatedTarget);
		    		var recipient = button.data('whatever');
		    		$("#confirmerSuppression").html("Etes vous sûre de vouloir supprimer "+recipient+" ?");
				    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				    
				});
		    </script>
		</body>