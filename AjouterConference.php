<?php
include "connect.php";
$vConn = fConnect();
$Titre=$_POST["Titre"];
$DateC=$_POST["DateC"];
$Resume=$_POST["Resume"];
$idIntervenant=$_POST["id"];
$idcoworker=$_POST["idcoworker"];
if($idIntervenant){
    $vSql="INSERT INTO Conference(Titre,DateC,Resume,Intervenant) values('$Titre','$DateC','$Resume',$idIntervenant)";
}else{
    $vSql="INSERT INTO Conference(Titre,DateC,Resume,Coworker) values('$Titre','$DateC','$Resume',$idcoworker)";
}

$vQuery=pg_query($vConn, $vSql);
echo "<meta charset='utf-8' />Ajout terminé avec succès";
?>
