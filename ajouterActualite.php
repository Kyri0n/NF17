<?php
include "connect.php";
$vConn = fConnect();
$Info=$_POST["Info"];
$idEspace=$_POST["idEspace"];
$Date=$_POST["Date"];
$mail=$_POST["mail"];

if($Date){
  $vSql="INSERT INTO Actualites values('$Date','$idEspace','$Info')";
}else{
  $Info="[URGENT] $Info";
  $vSql="INSERT INTO Actualites values('now()','$idEspace','$Info')";
}

$vQuery=pg_query($vConn, $vSql);
echo "<meta charset='utf-8' />Actualité ajoutée";
echo "<meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/manager.php?mail=$mail'>";
?>
