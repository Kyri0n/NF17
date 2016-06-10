<?php
include "connect.php";
$vConn = fConnect();
$mail=$_POST["mail"];
$Titre=$_POST["Titre"];
$DateC=$_POST["DateC"];
$Resume=$_POST["Resume"];
$idIntervenant=$_POST["idIntervenant"];
$idcoworker=$_POST["idcoworker"];
if($idIntervenant){
    $vSql="INSERT INTO Conference(Titre,DateC,Resume,Intervenant) values('$Titre','$DateC','$Resume',$idIntervenant)";
}else{
    $vSql="INSERT INTO Conference(Titre,DateC,Resume,Coworker) values('$Titre','$DateC','$Resume',$idcoworker)";
}

$vQuery=pg_query($vConn, $vSql);
echo "<meta charset='utf-8' />Ajout terminé avec succès";
if($idIntervenant){
  echo "<meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/intervenant.php?mail=$mail'>";
}else{
   echo "<meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.php?mail=$mail'>";
}
?>
