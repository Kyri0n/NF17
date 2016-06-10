<!DOCTYPE html>
<html>
  <head>
    <title>Attribution d'une salle</title>
     <meta charset="utf-8">
  </head>
<?php
include "connect.php";
$vConn = fConnect();
$titre=$_POST["titre"];
$date=$_POST["date"];
$salle=$_POST["salle"];
$mail=$_POST["mail"];
$vSql="UPDATE conference SET id_espace=(SELECT idespace FROM espace WHERE adresse='$salle')
  WHERE titre='$titre' and datec='$date' RETURNING id_espace";
$vQuery=pg_query($vConn,$vSql);
$id_espace = pg_fetch_row($vQuery)[0];
$Info = "Conférence $titre: $salle";
$vSql="INSERT INTO Actualites values('$date','$id_espace','$Info')";
$vQuery=pg_query($vConn,$vSql);
echo"La salle $salle a été attribuée à la conférence $titre du $date, un rappel a été mis sur le fils d'actualités";
echo "<html><meta http-equiv='refresh' content='2;URL=http://tuxa.sme.utc/~nf17p012/manager.php?mail=$mail'></html>"
?>
</html>
