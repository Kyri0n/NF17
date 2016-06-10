<?php
include "connect.php";
$vConn = fConnect();
$conference=$_POST["conference"];
$confTitreDate = explode(',', $conference);
$mail=$_POST["mail"];
$idEsp=$_POST["idEsp"];
$vSql="INSERT INTO Assoc_Espace_Ouvert_Conference values('$confTitreDate[0]','$confTitreDate[1]','$idEsp')";
$vQuery=pg_query($vConn, $vSql);

echo " <meta charset='utf-8' />Conférence ajoutée";
echo "<meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/manager.php?mail=$mail'>";
?>
