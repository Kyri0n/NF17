<!DOCTYPE html>
<html>
  <head>
    <title>Attribution d'une salle</title>
     <meta  charset="utf-8">
  </head>
<?php
include "connect.php";
$vConn = fConnect();
$conference=$_POST["conference"];
$confTitreDate = explode(',', $conference);
$titre=$confTitreDate[0];
$date=$confTitreDate[1];
$idEsp=$_POST["idEsp"];
$mail=$_POST["mail"];
$vSql="UPDATE conference SET id_espace=$idEsp
  WHERE titre='$titre' and datec='$date'";
$vQuery=pg_query($vConn,$vSql);

$vSql="SELECT adresse FROM espace WHERE idEspace=$idEsp";
$vQuery=pg_query($vConn,$vSql);
$salle = pg_fetch_row($vQuery)[0];

$Info = "Conférence $titre: $salle";
$vSql="INSERT INTO Actualites values('$date','$idEsp','$Info')";
$vQuery=pg_query($vConn,$vSql);
echo"La salle $salle a été attribuée à la conférence $titre du $date, un rappel a été mis sur le fils d'actualités";
echo "<html><meta http-equiv='refresh' content='2;URL=http://tuxa.sme.utc/~nf17p012/manager.php?mail=$mail'></html>"
?>
</html>
