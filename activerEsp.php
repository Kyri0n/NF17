<?php
include "connect.php";
$vConn = fConnect();
$toggle=$_POST["toggle"];
$mail=$_POST["mail"];
$vSql="UPDATE Espace SET Actif = Not Actif where idEspace='$toggle'";

$vQuery=pg_query($vConn, $vSql);
echo "<meta charset='utf-8' />Modification terminée avec succès";
echo "<meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/manager.php?mail=$mail'>";
?>
