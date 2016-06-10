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

	  $vSql="SELECT es.adresse, es.surface, es.nb_bureau_individuel,CASE WHEN actif='true' THEN 'Oui' ELSE 'Non' END,
		e.info,es.idEspace FROM espace es,Elements_descripteurs e,description d
		where es.idespace=d.id and d.descrip=e.idelement and
		es.id=(SELECT idmanager FROM manager where mail='$mail')";
	  $vQuery=pg_query($vConn, $vSql);
		echo "<form action='activerEsp.php' method='Post'>";
		echo "<input type='hidden' name='mail' value='$mail'/>";
	  echo "<table border='1' ";
	  echo '<tr><th>ID</th><th>Adresse</th><th>Surface</th><th>Nombre de bureaux individuels</th><th>actif ?</th><th>Description</th><th>Aciver/Désactiver</th></tr>';
	  while($result=pg_fetch_array($vQuery,NULL,PGSQL_BOTH)){
		  echo "<tr><td>$result[5]</td><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td><td>$result[3]</td><td>$result[4]</td>";
			echo "<td><input type='radio' name='toggle' value='$result[5]'></td></tr>";
	  }
			echo '</table>';
			echo "<input type='submit'>";
			echo "</form>";
	  ?>
</fieldset><br>
<fieldset>
	<legend> Actualité </legend>
	<?php
	$vSql="SELECT DISTINCT e.idEspace, a.Info, to_char(a.date, 'DD Mon YYYY') from Actualites a, Espace e
	WHERE a.date>=current_date and a.ID_Espace=e.idEspace and e.Actif=True
	and e.id=(SELECT idmanager FROM manager where mail='$mail' ORDER BY a.date)";
	$vQuery=pg_query($vConn, $vSql);
	echo "<table border='1'>";
	echo '<tr><th>ID Espace</th><th>Actualites</th><th>Date</th></tr>';
	while($result=pg_fetch_array($vQuery,NULL,PGSQL_BOTH)){
		echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td>";
		echo "</tr>";
	}
		echo '</table>';
		echo "</form>";
	?>
<br>
	<fieldset>
		<legend> Ajout d'une actualité </legend>
	<form action="ajouterActualite.php" method="post">
	<table>
		<tr> <td> <label for="Date"> Date : </label> </td>
		<td> <input type="text" name="Date" id="Date" placeholder="aaaa-mm-jj Vide pour aujourd'hui"/> </td> </tr>
		<tr> <td> <label for="idEspace"> Espace : </label> </td>
		<td> <input type="text" name="idEspace" id="idEspace"/> </td> </tr>
		<tr> <td> <label for="Info"> Info : </label> </td>
		<td> <textarea name="Info" id="Info"></textarea> </td> </tr>
	</table>
	<?php
		echo "<input type='hidden' name='mail' value='$mail'/>";
	?>
	<input type="submit">
	</form>
	</fieldset>
</fieldset><br>


<fieldset>
	  <legend>Gestionnaire de formules </legend>
	<?php
	$vSql="SELECT e.adresse,f.nom,e.idEspace, CASE WHEN Formule_Active='true' THEN 'Oui' ELSE 'Non' END
	 FROM espace e JOIN assoc_propose a ON e.idespace=a.id_espace JOIN formule f ON f.nom=a.nom_formule WHERE
	 e.id=(SELECT idmanager FROM manager where mail='$mail') ORDER BY e.adresse";
	 $vQuery=pg_query($vConn,$vSql);
	 echo "<form action='activerFormule.php' method='Post'>";
	 echo "<input type='hidden' name='mail' value='$mail'/>";

	 	echo "<table border='1' ";
		echo '<tr><th>Espace</th><th>Formule</th><th>Active </th><th>Aciver/Désactiver</th></tr>';
	 while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
	  echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[3]</td>";
		echo "<input type='hidden' name='ID_Espace' value='$result[2]'/>";
		echo "<td><input type='radio' name='toggle' value='$result[1]'></td></tr>";
	 }
	 	echo '</table>';
		echo "<input type='submit'>";
		echo " </form>";
	?>
	</fieldset><br>
	<fieldset>
	  <legend> Attribution de salle pour les conférences</legend>
		<form method="post" action="modifierConference.php">
	  <?php
	$vSql="SELECT titre,datec,resume FROM conference WHERE id_espace IS NULL";
	 $vQuery=pg_query($vConn,$vSql);
	 echo "<table border='1' ";
	echo '<tr><th>Titre</th><th>Date</th><th>Résumé</th><th></th></tr>';
	 while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
		echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td>
				<td><input type='radio' name='conference' value='$result[0],$result[1]'></td></tr>";
	 }
	 echo "<input type='hidden' name='mail' value='$mail'/>";
?>
</table>
<SELECT name='idEsp'>
<?php
$vSql="SELECT e.adresse,e.idEspace
 FROM espace e WHERE
 e.id=(SELECT idmanager FROM manager where mail='$mail') ORDER BY e.adresse";
 $vQuery=pg_query($vConn,$vSql);
 while($result=pg_fetch_array($vQuery,NULL,PGSQL_BOTH)){
	 echo "<OPTION value=$result[1]>$result[0]</OPTION>";
 }
?>

 <input type="submit" value="Attribuer la salle"/>
	</fieldset><br>

	<fieldset>
	  <legend>Conférences ouvertes dans les autres espaces</legend>
		<form action="ouvrirConference.php" method="post">
	  <?php
			$vSql="SELECT c.titre,c.datec,c.resume,e.adresse FROM conference c,espace e WHERE c.id_espace=e.idEspace and c.id_espace NOT IN (SELECT es.idEspace
			FROM espace es where es.id=(SELECT idmanager FROM manager where mail='$mail') )";
			 $vQuery=pg_query($vConn,$vSql);
			 echo "<table border='1' ";
			echo '<tr><th>Titre</th><th>Date</th><th>Résumé</th><th>Espace</th><th></th></tr>';
			 while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
			  echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td><td>$result[3]</td>
						<td><input type='radio' name='conference' value='$result[0],$result[1]'></td></tr>";
			 }
			 echo "<input type='hidden' name='mail' value='$mail'/>";
	?>
	</table>
	<SELECT name='idEsp'>
	<?php
	$vSql="SELECT e.adresse,e.idEspace
	 FROM espace e WHERE
	 e.id=(SELECT idmanager FROM manager where mail='$mail') ORDER BY e.adresse";
	 $vQuery=pg_query($vConn,$vSql);
	 while($result=pg_fetch_array($vQuery,NULL,PGSQL_BOTH)){
		 echo "<OPTION value=$result[1]>$result[0]</OPTION>";
	 }
	?>
	<input type="submit" value="Ouvrir"/>
 </form>

	</fieldset><br>

	<fieldset>
	  <legend>STAT</legend>
	  <fieldset>
  	  <legend>Mois actuel</legend>
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
				$tauxOccupation = number_format($tauxOccupation,2);
				$vSql="SELECT COUNT(ac.coworker)*f.Tarif FROM Assoc_Propose ap,Assoc_CoworkerFormule ac,formule f where ID_Espace='$espResult[0]' and
					ac.Nom_Formule=ap.Nom_Formule and EXTRACT(MONTH FROM ac.DateCF)=EXTRACT(MONTH FROM now()) GROUP BY f.tarif,ac.Nom_Formule";
			 	$chiffreAffaire=pg_fetch_row(pg_query($vConn,$vSql));
				echo "<tr><td>$espResult[0]</td><td>$espResult[1]</td><td>$nbFormuleActANDnbCoworker[0]</td>
				<td>$tauxOccupation%</td><td>$chiffreAffaire[0]</td></tr>";
		 	}
			echo "</table>";
			?>
		</fieldset><br>
		<fieldset>
			<legend>Année actuelle</legend>
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
				$tauxOccupation = $nbFormuleActANDnbCoworker[1]/$placeMax[0]*100;
				$tauxOccupation = number_format($tauxOccupation,2);
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
