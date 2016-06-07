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
		<form method="post" action="modifierConference.php">
		Titre de la conférence <input type="text" name="titre" id="titre"/>
		Date de la conférence <input type="text" name="date" id="date"/>
    Salle à attribuer <input type="text" name="salle" id="salle"/>
   <?php echo "<input type='hidden' name='mail' value='$mail'/>"; ?>
   <input type="submit" name="Attribuer la salle"/>
	</form>
	</fieldset>

	<fieldset>
	  <legend>STAT</legend>
	  <fieldset>
  	  <legend>Mois actualle</legend>
		  <?php
			$vSql="SELECT idEspace, adresse FROM espace where id=(SELECT idmanager FROM manager where mail='$mail')";
		 	$esp=pg_query($vConn,$vSql);
			echo "<table border='1'><tr><th>idEspace</th><th>Adresse</th>
			<th>Nb coworker</th><th>Taux d'occupation</th>
			<th>Chiffre d'affaire</th></tr>";
		 	while($espResult=pg_fetch_array($esp,null,PGSQL_BOTH)){
				$vSql="SELECT COUNT(ap.Nom_Formule),COUNT(ac.coworker) FROM Assoc_Propose ap,Assoc_CoworkerFormule ac
					where ap.ID_Espace='$espResult[0]' and
					ac.Nom_Formule=ap.Nom_Formule  and EXTRACT(MONTH FROM ac.DateCF)=EXTRACT(MONTH FROM now())";
			 	$nbFormuleActANDnbCoworker=pg_fetch_array(pg_query($vConn,$vSql));

				$vSql="SELECT SUM(e.nb_bureau_individuel)+SUM(sc.Nb_Place) FROM espace e, assoc_propose a,Salles_Collectives sc
					WHERE e.idespace= a.id_espace and a.ID_Espace='$espResult[0]' AND sc.ID_Espace=a.id_espace";
				$placeMax=pg_fetch_row(pg_query($vConn, $vSql));
				$tauxOccupation  = $nbFormuleActANDnbCoworker[1]/$placeMax[0]*100;
				$vSql="SELECT COUNT(ac.coworker)*f.Tarif FROM Assoc_Propose ap,Assoc_CoworkerFormule ac,formule f where ID_Espace='$espResult[0]' and
					ac.Nom_Formule=ap.Nom_Formule and EXTRACT(MONTH FROM ac.DateCF)=EXTRACT(MONTH FROM now()) GROUP BY f.tarif,ac.Nom_Formule";
			 	$chiffreAffaire=pg_fetch_row(pg_query($vConn,$vSql));
				echo "<tr><td>$espResult[0]</td><td>$espResult[1]</td><td>$nbFormuleActANDnbCoworker[0]</td>
				<td>$tauxOccupation%</td><td>$chiffreAffaire[0]</td></tr>";
		 	}
			echo "</table>";
			?>
		</fieldset>
		<fieldset>
			<legend>Année actualle</legend>
			<?php
			$vSql="SELECT idEspace, adresse FROM espace where id=(SELECT idmanager FROM manager where mail='$mail')";
			$esp=pg_query($vConn,$vSql);
			echo "<table border='1'><tr><th>idEspace</th><th>Adresse</th>
			<th>Nb coworker</th><th>Taux d'occupation</th>
			<th>Chiffre d'affaire</th></tr>";
			while($espResult=pg_fetch_array($esp,null,PGSQL_BOTH)){
				$vSql="SELECT COUNT(ap.Nom_Formule),COUNT(ac.coworker) FROM Assoc_Propose ap,Assoc_CoworkerFormule ac
					where ap.ID_Espace='$espResult[0]' and
					ac.Nom_Formule=ap.Nom_Formule  and EXTRACT(YEAR FROM ac.DateCF)=EXTRACT(YEAR FROM now())";
				$nbFormuleActANDnbCoworker=pg_fetch_array(pg_query($vConn,$vSql));

				$vSql="SELECT SUM(e.nb_bureau_individuel)+SUM(sc.Nb_Place) FROM espace e, assoc_propose a,Salles_Collectives sc
					WHERE e.idespace= a.id_espace and a.ID_Espace='$espResult[0]' AND sc.ID_Espace=a.id_espace";
				$placeMax=pg_fetch_row(pg_query($vConn, $vSql));
				$tauxOccupation  = $nbFormuleActANDnbCoworker[1]/$placeMax[0]*100;
				$vSql="SELECT COUNT(ac.coworker)*f.Tarif FROM Assoc_Propose ap,Assoc_CoworkerFormule ac,formule f where ID_Espace='$espResult[0]' and
					ac.Nom_Formule=ap.Nom_Formule and EXTRACT(YEAR FROM ac.DateCF)=EXTRACT(YEAR FROM now()) GROUP BY f.tarif,ac.Nom_Formule";
				$chiffreAffaire=pg_fetch_row(pg_query($vConn,$vSql));
				echo "<tr><td>$espResult[0]</td><td>$espResult[1]</td><td>$nbFormuleActANDnbCoworker[0]</td>
				<td>$tauxOccupation%</td><td>$chiffreAffaire[0]</td></tr>";
			}
			echo "</table>";
			?>
		</fieldset>
	</fieldset>
</body>
</html>
