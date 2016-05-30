<?php
/* Connexion à la base de données */
	include "connect.php";
	$vConn = fConnect();
	/* Récupération des variables passées par le fomulaire */
	$id=$_POST["id"];
	$mail=$_POST["mail"];
	$nom=$_POST["nom"];
	$age=$_POST["age"];
	$prenom=$_POST["prenom"];
	$situation=$_POST["situation"];
	$presentation=$_POST["presentation"];
	$domaine=$_POST["domaine"];
	$modifier=$_POST["modifier"];
	if($modifier=='True'){
			$vSql="UPDATE coworker SET mail='$mail',nom='$nom',prenom='$prenom',age=$age,situation_professionelle='$situation',presentation='$presentation' where idcoworker=$id";
	$vQuery=pg_query($vConn, $vSql);
	$result=pg_fetch_row($vQuery);
	pg_close($vConn);
	echo "<meta charset='utf-8' />Modification terminée avec succès";
	/*echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.html'></html>";
*/	
}else{
	$vSql="INSERT INTO coworker(mail,nom,prenom,age,situation_professionelle,presentation) VALUES ('$mail', '$nom', '$prenom', '$age', '$situation','$presentation') RETURNING idcoworker";
	$vQuery=pg_query($vConn, $vSql);
	$result=pg_fetch_row($vQuery);

	$vSql="INSERT INTO assoc_coworkerdomaine values ($domaine,$result[0] )";
	$vQuery=pg_query($vConn, $vSql);
	pg_close($vConn);
	echo "<meta charset='utf-8' />Inscription terminée avec succès";
	echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.php?mail=$mail'></html>";
}

?>
