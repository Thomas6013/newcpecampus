<?php
	session_start();
	if(($_SESSION['index_right'] == 10)){ // A la place d'index_right mettre un nombre binaire sur 3 bits et mettre tout à 1 si on veut avoir accès à tout! 111 = 7 // 100 = 4
		require_once("./contenulogs.php");
	}
	elseif(($_SESSION['index_right'] == 5)){
		require_once("./upload.php");
	}
	elseif(($_SESSION['index_right'] == 3)){
		require_once("./revisions.php");
	}
	else{
		header('Location : ../vues/accueil.php');
	}
?>						