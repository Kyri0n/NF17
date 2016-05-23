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
	echo "Un peu de patience :)";
	if  ($vResult[0]=='intervenant'){
		echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/intervenant.html'></html>";
	}elseif($vResult[0]=='manager'){
		echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/manager.html'></html>";
	}elseif($vResult[0]=='coworker'){
		echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.html'></html>";
	}
?>
