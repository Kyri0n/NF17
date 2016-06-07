<!DOCTYPE html>
<html>
<head>
	<title>
		manager
	</title>
	<meta charset="utf-8">
</head>
<body>
<fieldset>
			<legend>Gestionnaire d'espaces</legend>
	  <?php
	  include "connect.php";
	  $vConn = fConnect();
	  $mail=$_GET["mail"];
	  $vSql="SELECT adresse, surface, nb_bureau_individuel,CASE WHEN actif='true' THEN 'Oui' ELSE 'Non' END FROM espace where id=(SELECT idmanager FROM manager where mail='$mail')";
	  $vQuery=pg_query($vConn, $vSql);
	  echo "<table border='1' ";
	  echo '<tr><th>Adresse</th><th>Surface</th><th>nombre de bureaux individuels</th><th>actif ?</th></tr>';
	  while($result=pg_fetch_array($vQuery,NULL,PGSQL_BOTH)){
		  echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td><td>$result[3]</td></tr>";
	  }
	   	echo '</table>';
	  ?>
</fieldset>
<fieldset>
	  <legend>Gestionnaire de formules </legend>
	<?php
	$vSql="SELECT e.adresse,f.nom FROM espace e JOIN assoc_propose a ON e.idespace=a.id_espace JOIN formule f ON f.nom=a.nom_formule WHERE
	 e.id=(SELECT idmanager FROM manager where mail='$mail') ORDER BY e.adresse";
	 $vQuery=pg_query($vConn,$vSql);
	 echo "<table border='1' ";
	echo '<tr><th>Adresse</th><th>Formule</th></tr>';
	 while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
	  echo "<tr><td>$result[0]</td><td>$result[1]</td></tr>";
	 }
	 	echo '</table>';
	?>
	</fieldset>
	<fieldset>
	  <legend> Attribution de salle pour les conférences</legend>
	  <?php
	$vSql="SELECT titre,datec,resume FROM conference WHERE id_espace IS NULL";
	 $vQuery=pg_query($vConn,$vSql);
	 echo "<table border='1' ";
	echo '<tr><th>Titre</th><th>Date</th><th>Résumé</th></tr>';
	 while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
	  echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td></tr>";
	 }

	?>
	</table>
	<table>
		<form method="post" action="modifierConference.php">
		<tr><td>Titre de la conférence</td><td> <input type="text" name="titre" id="titre"/></td></tr>
		<tr><td>Date de la conférence</td><td> <input type="text" name="date" id="date"/></td></tr>
    <tr><td>Salle à attribuer</td><td> <input type="text" name="salle" id="salle"/></td></tr>
   </table>
   <?php echo "<input type='hidden' name='mail' value='$mail'/>"; ?>
   <input type="submit" name="Attribuer la salle"/>
	</form>
	</fieldset>
	
	
	
	<fieldset>
	  <legend>STAT</legend>
	  <?php
	    $vSql="SELECT nom_formule,COUNT(coworker) FROM assoc_coworkerformule GROUP BY nom_formule";
	    $vQuery=pg_query($vConn,$vSql);
	    echo "<table border='1' ";
	    echo '<tr><th>Formule</th><th>Nb coworker</th></tr>';
	    while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
	     echo "<tr><td>$result[0]</td><td>$result[1]</td></tr>";
	    }

  	?>
	</table>

	</fieldset>
</body>
</html>
