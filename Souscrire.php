<?php
/* Connexion à la base de données */
	include "connect.php";
	$vConn = fConnect();
	/* Récupération des variables passées par le fomulaire */
	$idcoworker=$_POST["idcoworker"];
	$formule=$_POST["formule"];

	$vSql="INSERT INTO assoc_coworkerformule VALUES ('now()','$formule', $idcoworker)";
	$vQuery=pg_query($vConn, $vSql);
	$result=pg_fetch_row($vQuery);

	pg_close($vConn);
	echo "<meta charset='utf-8' />Souscription terminée avec succès";
	

?> 
