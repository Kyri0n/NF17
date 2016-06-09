<?php
include "connect.php";
$vConn = fConnect();
$toggle=$_POST["toggle"];
$mail=$_POST["mail"];
$ID_Espace = $_POST["ID_Espace"];
$vSql="UPDATE Assoc_Propose SET Formule_Active = Not Formule_Active where ID_Espace='$ID_Espace' and Nom_Formule='$toggle'";

$vQuery=pg_query($vConn, $vSql);
echo "<meta charset='utf-8' />Modification terminée avec succès";
echo "<meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/manager.php?mail=$mail'>";
?>
