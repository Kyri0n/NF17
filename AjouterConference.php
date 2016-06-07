<?php
include "connect.php";
$vConn = fConnect();
$Titre=$_POST["Titre"];
$DateC=$_POST["DateC"];
$Resume=$_POST["Resume"];
$id=$_POST["id"];

$mail=$_GET["mail"];
$vSql="SELECT type FROM vPersonne WHERE mail='$mail'";
$vQuery=pg_query($vConn, $vSql);
$vResult = pg_fetch_array($vQuery);
if($vResult[0]=="coworker"){
	$vSql="INSERT INTO Conference(Titre,DateC,Resume,coworker) values('$Titre','$DateC','$Resume',$id)";
	$vQuery=pg_query($vConn, $vSql);
	echo "<meta charset='utf-8' />Ajout terminé avec succès";
	echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.php?mail=$mail'></html>";

}else if($vResult[0]=="Intervenant"){
	$vSql="INSERT INTO Conference(Titre,DateC,Resume,Intervenant) values('$Titre','$DateC','$Resume',$id)";
	$vQuery=pg_query($vConn, $vSql);
	echo "<meta charset='utf-8' />Ajout terminé avec succès";
	echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/intervenant.php?mail=$mail'></html>";
}else{
	echo "<meta charset='utf-8' />Erreur: vous n'êtes pas autorisé à ajouter une conférence !";
	echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/ConnectEsp.php?mail=$mail'></html>";

}
?>
