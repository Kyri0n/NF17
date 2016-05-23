<html>
<head>
  <title>Inscription Soutenance NF17</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
  <h1>Inscriptions à la soutenance de NF17</h1>
<?php
/* Connexion à la base de données */
	include "connect.php";
	include "inscription_param.php";
	$vConn = fConnect();
	/* Récupération des variables passées par le fomulaire */
	$vLogin=$_POST['login'];
	$vChoix=$_POST['session'];
	/* Inscription */
	$vSql="UPDATE tGroupe SET session = $vChoix WHERE pkLogin='$vLogin'";
	$vQuery=pg_query($vConn, $vSql);
	echo "<p>Inscription de $vLogin à la session $vChoix validée</p>";
?>
  <hr/>
  <p><a href="inscription1.php">Retour</a></p>
</body>
</html>
