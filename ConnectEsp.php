<?php
/* Connexion à la base de données */
	include "connect.php";
	$vConn = fConnect();
	/* Récupération des variables passées par le fomulaire */
	$mail=$_POST["mail"];
	/* login */
	$vSql="SELECT type FROM vPersonne WHERE mail='$mail'";
	$vQuery=pg_query($vConn, $vSql);
	$vResult = pg_fetch_array($vQuery);
	
	if  ($vResult[0]=='intervenant'){
		echo "Un peu de patience :)";
		echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/intervenant.php?mail=$mail'></html>";
	}elseif($vResult[0]=='manager'){
		echo "Un peu de patience :)";
		echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/manager.php?mail=$mail'></html>";
	}elseif($vResult[0]=='coworker'){
		echo "Un peu de patience :)";
		echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.php?mail=$mail'></html>";
	}else{
		echo ": ( Vous n'avez pas encore incrit";
		echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/Accueil.php'></html>";
	}
?>
