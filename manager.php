<!DOCTYPE html>
<html>
<head>
	<title>
		manager
		<meta charset="utf-8">
	</title>
</head>
<body>
	<?php		
	include "connect.php";
	$vConn = fConnect();
	$mail=$_GET["mail"];
	$vSql="SELECT adresse, suface, nb_bureau_individuel,CASE WHEN actif='true' THEN 'Oui' ELSE 'Non' END FROM espace where id=(SELECT idmanager FROM manager where mail='$mail'";
	$vQuery=pg_query($vConn, $vSql);	
	echo '<table border='1' ';
	echo '<tr><th></th><th>Adresse</th><th>Surface</th><th>nombre de bureaux individuels</th><th>actif ?</th><th>Date fin</th><th>Type</th></tr>';
	while($result=pg_fetch_array($vQuery,NULL,PGSQL_BOTH)){
		echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td>";
	}
	echo '</table>';
	?>
</body>
</html>