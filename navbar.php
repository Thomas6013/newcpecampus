<script type="text/javascript" src="../js/search.js"></script>
<link rel="stylesheet" href="../css/navsearch.css" type="text/css">
<?php 
	session_start(); 
	if(isset($_POST['username']) && isset($_POST['password'])){	
		require_once("../model/db.php");
		$username = $_POST['username'];
		$password = sha1($_POST['password']); // https://www.sha1.fr/
		// $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		// $query = mysqli_query($db, $sql);
		// $row = mysqli_fetch_assoc($query); //Je veux que ce soit un tableau
		//var_dump($row); // Affichage des informations recupérées via bdd
		$inter = $username;
		/* Crée une requête préparée http://php.net/manual/fr/mysqli.prepare.php */ 
		if ($stmt = mysqli_prepare($db, "SELECT id,username,password,index_right FROM users WHERE username=? LIMIT 1")) {
			/* Lecture des marqueurs */
			mysqli_stmt_bind_param($stmt, "s", $inter);
			/* Exécution de la requête */
			mysqli_stmt_execute($stmt);
			/* Lecture des variables résultantes */
			mysqli_stmt_bind_result($stmt, $id, $username, $db_password,$index_right);
			/* Récupération des valeurs */
			mysqli_stmt_fetch($stmt);

		if($password == $db_password) {
			$_SESSION['username'] = $username; // Variable de Session
			$_SESSION['id'] = $id;
			$_SESSION['index_right'] = $index_right;
			
			header("Location: ../docs/pv.php"); // Renvoi à ...
		} else {
				print("<div class=\"text-center\"><h4>Pseudo / Mot de passe incorrect !</div>");
		}
		/* Fermeture du traitement */
			mysqli_stmt_close($stmt);
		}
		/* Fermeture de la connexion */
		   // mysqli_close($db);
		// Système qui écrit dans le modal mot de passe incorrect sans afficher le mdp :D 
	}
	?>
<!--<a href="../vues/accueil.php"><img src="../img/NCC.png" class="img-fluid"></a>-->

    <style>
        @-webkit-keyframes Gradient {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        @-moz-keyframes Gradient {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }

        @keyframes Gradient {
            0% {
                background-position: 0% 50%
            }
            50% {
                background-position: 100% 50%
            }
            100% {
                background-position: 0% 50%
            }
        }


    </style>

<div style="
background-image: linear-gradient(141deg, #9fb8ad 0%, #3c3f41 51%, rgba(225,212,89,0.66) 75%);
background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 5s ease infinite;">
    <div style=" background: url('../img/NCC.png') no-repeat center;background-size: contain;height: 20vh; width: 100%;box-shadow: 0px 0px 5px #fff;"
         onclick="window.location='../vues/accueil.php'"></div>
</div>
<div class="sticky-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="../vues/accueil.php"><i class="fa fa-home mr-sm-2"></i>Accueil</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">

		  <li class="nav-item">
			<a class="nav-link" href="../vues/3ETI.php">3-ETI</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="../vues/3CGP.php">3-CGP</a>
		  </li>
		  <li class="nav-item">
			<li class="nav-item">
			  <a class="nav-link" href="../vues/4ETI.php">4-ETI</a>
			</li>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="../vues/4CGP.php">4-CGP</a>
		  </li>
		   <li class="nav-item">
			<a class="nav-link" href="../vues/assos.php">Associations</a>
		  </li>
		   <li class="nav-item">
			<a class="nav-link" href="../vues/bde.php">Historique BDE</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="../vues/tchat.php"><span class="badge badge-secondary">New</span>    Live Tchat</a>
		  </li></ul>
		  <ul class="navbar-nav">
			 <li class="nav-item"> <!-- Se connecter -> ajouter une alerte si mdp faux-->
				<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#login" title=""> <i class="fa fa-user mr-sm-2"></i>Connexion</button>
			 </li>
		  </ul>
			<!-- Button trigger modal -->
			<!-- Modal -->
			<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Connexion</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<form method="post">
					  <div class="form-group">
						<label for="Username0">Pseudo</label>
						<input type="text" class="form-control" id="Username0" aria-describedby="userhelp" name="username" placeholder="Entre ton Pseudo">
						<!--<small id="userhelp" class="form-text text-muted">...</small>-->
					  </div>
					  <div class="form-group">
						<label for="Password0">Password</label>
						<input type="password" class="form-control" id="Password0" name="password" placeholder="Entre ton Password">
					  </div>
					  <div class="form-group form-check" style="display:none;">Utilisateur / Mot de passe incorrect !</div>
					  </div>
					  <div class="modal-footer">
					  <button  class="btn btn-primary" name="login">Se Connecter</button>
					  </div>
					</form>
				</div>
			  </div>
			</div>
		  <!--<form class="form-inline my-2 my-lg-0" id="auto-suggest" action="#" method="post">
			<!--<input class="form-control mr-sm-2" type="search" placeholder="Recherche une asso..." aria-label="Search">
			<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
		<input type="text" class="search" name="search" value="Rechercher..." onfocus="if(this.value=='Rechercher...')this.value=''" onblur="if(this.value=='')this.value='Rechercher...'" autocomplete="off"/>
		<ul class="suggestions">
		</ul>
		  </form>-->
	  </div>
	</nav>
</div>
<br/>
<?php		
	require_once("../model/db.php");
	$today = gmdate("Y-m-d",time() + 3600*2); 
	$today0 = gmdate("Y-m-d",time() + 3600*2 + 7 *86400);  
	$today1 = gmdate("Y-m-d",time() + 3600*2 + 120 *86400);  
	$sql0 = "SELECT name,HHs2 FROM assos WHERE HHs2 >= \"$today \" AND HHs2 < \"$today0\" "; //METTRE HHs2 pour Semestre 2
	$sql1 = "SELECT name,evenements,desceve FROM assos WHERE evenements >= \"$today \" AND evenements < \"$today1\" ";
	$sql2 = "SELECT name,foyer FROM assos WHERE foyer >= \"$today \" AND foyer < \"$today0\" ";

	$query0 = mysqli_query($db, $sql0);
	$row0 = mysqli_fetch_assoc($query0);
	$query1 = mysqli_query($db, $sql1);
	$row1 = mysqli_fetch_assoc($query1);
	$query2 = mysqli_query($db, $sql2);
	$row2 = mysqli_fetch_assoc($query2);

	list($annee,$mois,$jour)=explode('-',$row0['HHs2']); //On remet les dates à l'endroit
	$HHs10 = $jour.'-'.$mois.'-'.$annee;
	list($annee,$mois,$jour)=explode('-',$row2['foyer']); //On remet les dates à l'endroit
	$foyer1 = $jour.'-'.$mois.'-'.$annee;
	list($annee,$mois,$jour)=explode('-',$row1['evenements']); //On remet les dates à l'endroit
	$evenements0 = $jour.'-'.$mois.'-'.$annee;

		print("<div class=\"row justify-content-center\">
		<div class=\"col-8\">
			<div class=\"card border-primary mb-1\" style=\"max-width: 40rem;\">");
			if(($row0['HHs2']) != NULL){ //Entête annonces
				print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/HH.gif\"> <strong>".utf8_encode($row0['name'])."");
				while ($row0 = mysqli_fetch_assoc($query0)) {
					list($annee,$mois,$jour)=explode('-',$row0['HHs2']);
					$HHs10 = $jour.'-'.$mois.'-'.$annee;
					print(" et " .utf8_encode($row0['name'])."");
				}
				print("</strong> organise un HH le : ".$HHs10."</div>");
				}
			else{
				//print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/HH.gif\"> <strong>Pas de HH cette semaine</strong></div>");
				print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/HH.gif\"> <strong>HH BDE <3</strong></div>");
			}
			if(($row2['foyer']) != NULL){
				print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/foyer.png\"> <strong>".utf8_encode($row2['name'])."");
				while ($row2 = mysqli_fetch_assoc($query2)) {
					list($annee,$mois,$jour)=explode('-',$row2['foyer']);
					$foyer1 = $jour.'-'.$mois.'-'.$annee;
					print(" et " .utf8_encode($row2['name'])."");
				}
				print("</strong> organise un repas au foyer le : ".$foyer1."</div>");
			}
			else{
				print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/foyer.png\"><strong> Pas de repas au foyer cette semaine</strong></div>");
			}
			if(($row1['evenements']) != NULL){
				print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/eve.png\"> <strong> ".utf8_encode($row1['name'])." </strong> organise le ".$evenements0." ".utf8_encode($row1['desceve'])."</div>");
				// print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/eve.png\"> <strong>Autres évenements :</strong> Le ".utf8_encode($row1['name'])." se déroule le ".$evenements0."</div>");
			}
			else{
				//print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/eve.png\"><strong> Pas d'évenements prévu</strong></div>");
				print("<div class=\"card-header text-primary\"><img width=\"20px\" height=\"20px\" src=\"../img/ico/eve.png\"><strong> Amphi de révélation 07/02/19 </strong></div>");
			}
			print("</div>
		</div>
		</div></br>");
?>