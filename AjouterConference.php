<?php
include "connect.php";
$vConn = fConnect();
$Titre=$_POST["Titre"];
$DateC=$_POST["DateC"];
$Resume=$_POST["Resume"];
$id=$_POST["id"];

$mail=$_GET["mail"];
$vSql="INSERT INTO Conference(Titre,DateC,Resume,Intervenant) values('$Titre','$DateC','$Resume',$id)";
$vQuery=pg_query($vConn, $vSql);
echo "<meta charset='utf-8' />Ajout terminé avec succès";
?>
