<!DOCTYPE html>
<html>
	<head>
		<title> Coworker</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<fieldset>
		<legend>Actualités sur les espaces auxquels vous avez accès</legend>
		<?php
			include "connect.php";
	    $vConn = fConnect();
	    $mail=$_GET["mail"];
		  $vSql="SELECT f.nom,f.nb_jours,f.datefin FROM formule f
			JOIN assoc_coworkerformule ac ON f.nom=ac.nom_formule JOIN Coworker c ON c.idcoworker=ac.coworker
			WHERE idcoworker=(SELECT idcoworker FROM coworker WHERE mail='$mail') and
			EXTRACT(MONTH FROM ac.DateCF)=EXTRACT(MONTH FROM now()) ";
		?>
			<table border="1">
		  <tr><th>Formule</th><th>Durée</th><th>Date de fin</th></tr>
		  <?php
		  $vQuery=pg_query($vConn,$vSql);
		  while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
		   echo"<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td>";
		  }
			echo "</table>";
			if(pg_num_rows($vQuery)==0){
				echo "Vous n'avez souscrit à aucune formule ce mois.";
			}
		  //après réflexion cette requête serait une raison valable de dénormaliser notre schéma, à cause du fait qu'il faille demander l'accord du client et par manque de temps nous ne le ferons pas
		  $vSql="SELECT DISTINCT f.nom,a.info,to_char(a.date, 'DD Mon YYYY'),a.date FROM actualites a JOIN espace e ON e.idespace=a.id_espace
				JOIN assoc_propose ap ON ap.id_espace=e.idespace JOIN formule f ON ap.nom_formule=f.nom
				JOIN Assoc_CoworkerFormule ac ON ac.Nom_Formule=f.nom JOIN Coworker c ON c.idcoworker=ac.coworker
				WHERE a.date>=current_date and idcoworker=(SELECT idcoworker FROM coworker WHERE mail='$mail') ORDER BY a.date,f.nom";
		  $vQuery=pg_query($vConn,$vSql);
			echo "<table border='1'>";
		  echo "<tr><th>Formule</th><th>Actu</th><th>Date</th></tr>";
		  while($result=pg_fetch_array($vQuery,null,PGSQL_BOTH)){
		   echo "<tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td>";
		  }
		  ?>
		</table>
	</fieldset><br>

<fieldset>
			<legend>Souscription</legend>
	<?php
	$vSql="SELECT * FROM Coworker where mail='$mail'";
	$vQuery=pg_query($vConn, $vSql);
	$result=pg_fetch_row($vQuery);
	$idcoworker=$result[0];
	$vSql="SELECT f.nom,f.tarif,f.nb_jours,
	CASE WHEN bureau_individuel='f' then 'Non' ELSE 'Oui' END,datefin,type,e.Adresse FROM formule f, Assoc_Propose ap, espace e
	 WHERE f.nom=ap.Nom_Formule AND Formule_Active=True and ap.ID_Espace=e.idEspace";
	$vQuery=pg_query($vConn, $vSql);

	echo "<form method='post' action='Souscrire.php?mail=$mail'>";
	?>
	<table border="1">
	  <tr><th></th><th>Nom</th><th>Tarif</th><th>Durée</th><th>Bureau Individuel</th><th>Date fin</th><th>Type</th><th>Espace Adresse</th></tr>
	<?php
    while ($result = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
    			echo "<tr><td><input type='checkbox' name='formule' value='$result[0]'></td><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td><td>$result[3]</td><td>$result[4]</td><td>$result[5]</td><td>$result[6]</td></tr>";
    }
    echo "<input type='hidden' name='idcoworker' value='$idcoworker'>";
  	?>
	</table>

	<input type="submit" value='souscrire'>
	</form>
</fieldset><br>
<fieldset>
			<legend>Modifier votre profil</legend>
	<?php
	$mail=$_GET["mail"];
	$vSql="SELECT * FROM Coworker where mail='$mail'";
	$vQuery=pg_query($vConn, $vSql);
	$result=pg_fetch_row($vQuery);
	?>
	<form method="post" action="AjouterCoworker.php">
			<input type='hidden' name='id' value='<?php echo "$result[0]"?>'>
			<table>
				<tr><td>Email:</td>
				<td><input type="text" name="mail" value='<?php echo "$result[1]"?>' placeholder="new@coworker.fr"></td></tr>
				<tr><td>Nom:</td>
				<td><input type="text" name="nom" value='<?php echo "$result[2]"?>'></td></tr>
				<tr><td>Prénom:</td>
				<td><input type="text" name="prenom" value='<?php echo "$result[3]"?>'></td></tr>
				<tr><td>Age:</td>
				<td><input type="text" name="age" value='<?php echo "$result[4]"?>'></td></tr>
				<tr><td>Situation professionelle:</td>
				<td><select name="situation" value='<?php echo "$result[5]"?>'>
					<option value="entrepreneur">entrepreneur</option>
					<option value="freelance">freelance</option>
					<option value="autre">autre</option>
				</select></td></tr>
				<tr><td>Presentation:</td>
				<td><input type="text" name="presentation" value='<?php echo "$result[6]"?>'></td></tr>
				<tr><td>Domaine:</td><td>
					<table>
					<?php
						$coworkid = $result[0];
						$vSql="SELECT * from domaines_activite where iddomaine in (SELECT info_domaine FROM assoc_coworkerdomaine where coworker=$coworkid)";
						$vQuery=pg_query($vConn, $vSql);
						$vQuerypourDomaines = $vQuery;
						while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
							echo "<tr><td>$vResult[1]</td></tr>";
	  					}
					?>
					</table>
				</td></tr>
				<tr><td>
				<?php
					$vSql="SELECT * from domaines_activite where iddomaine not in (SELECT info_domaine FROM assoc_coworkerdomaine where coworker=$coworkid)";
					$vQuery=pg_query($vConn, $vSql);
					echo "<tr><td>Ajout d'un domaine</td>";
					echo "<td><SELECT name='ajoutDomaine'><option disabled selected value> -- select un domaine -- </option>";
					while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
						echo "<option value='$vResult[0]'>$vResult[1]</option>";
					}
					echo "</select></td></tr>";
					echo "<tr><td>Suppression d'un domaine</td>";
					echo "<td><SELECT name='supprimeDomaine'><option disabled selected value> -- selecte un domaine -- </option>";
					$vSql="SELECT * from domaines_activite where iddomaine in (SELECT info_domaine FROM assoc_coworkerdomaine where coworker=$coworkid)";
					$vQuerypourDomaines=pg_query($vConn, $vSql);
					while ($vResult = pg_fetch_array($vQuerypourDomaines, null, PGSQL_BOTH)) {
						echo "<option value='$vResult[0]'>$vResult[1]</option>";
					}
					echo "</select></td></tr>";

				?>
				</td></tr>
				</table><p>
<input type="hidden" name="modifier" value="True">
				<input type="submit" value='modifier'>
				</form>
</fieldset><br>
<fieldset>
	<legend> Ajout d'une Conférence </legend>
	<table>
		<form action="AjouterConference.php" method="post">
			<?php
				echo "<input type='hidden' name='idcoworker' value='$idcoworker'>";
				echo "<input type='hidden' name='mail' value='$mail'>";
			?>
			<tr> <td> <label for="Titre"> Titre : </label> </td>
			<td> <input type="text" name="Titre" id="Titre"/> </td> </tr>
			<tr> <td> <label for="DateC"> Date : </label> </td>
			<td> <input type="date" name="DateC" id="DateC" placeholder="yyyy-mm-dd"/></td> </tr>
			<tr> <td> <label for="Resume"> Résumé : </label> </td>
			<td> <textarea name="Resume" id="Resume"/></textarea> </td> </tr>
	</table>
			<input type="submit">
		</form>
</fieldset><br>

<fieldset>
<legend> Effectifs </legend>
<fieldset>
<legend>Par Espace:</legend>
<table>
			<?php
				$vSql="SELECT DISTINCT c.mail,c.nom,c.prenom,c.Situation_Professionelle, e.adresse, m.nom, m.prenom, m.mail
				 FROM coworker c,espace e,Assoc_Propose ap, Assoc_CoworkerFormule ac, Manager m
				WHERE e.idEspace=ap.ID_Espace and ap.Nom_Formule=ac.Nom_Formule and e.id=m.idManager and
				ac.Coworker=c.idCoworker ORDER BY e.adresse,c.mail";
				$vQuery=pg_query($vConn, $vSql);
				$tmp='';
				while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
					if($tmp!=$vResult[4]){
						echo"</table><br>$vResult[4]
						<p>Manager: $vResult[5] $vResult[6]  $vResult[7]</p>
						<table border='1'><tr><th>Mail</th><th>Nom</th><th>Prenom</th><th>Situation</th></tr>";
					}
					echo "<tr><td>$vResult[0]</td><td>$vResult[1]</td><td>$vResult[2]</td><td>$vResult[3]</td></tr>";
					$tmp=$vResult[4];
				}
			?>
	</table>
	</fieldset>
	<fieldset>
<legend>Par situation professionnelle:</legend>
<table border="1">
			<?php
				$vSql="SELECT DISTINCT c.mail,c.nom,c.prenom,c.Situation_Professionelle
				 FROM coworker c ORDER BY c.Situation_Professionelle,c.mail";
				$vQuery=pg_query($vConn, $vSql);
				while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
					echo "<tr><td>$vResult[0]</td><td>$vResult[1]</td><td>$vResult[2]</td><td>$vResult[3]</td></tr>";
				}
			?>
	</table>
</fieldset><br>
<fieldset>
<legend>Par domaine d'activité:</legend>
<table>
			<?php
				$vSql="SELECT DISTINCT c.mail,c.nom,c.prenom,c.Situation_Professionelle, d.Info
				 FROM coworker c,Assoc_CoworkerDomaine ac,Domaines_activite d
				WHERE c.idCoworker=ac.Coworker and ac.Info_Domaine=d.idDomaine
				ORDER BY d.Info,c.mail";
				$vQuery=pg_query($vConn, $vSql);
				$tmp='';
				while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
					if($tmp!=$vResult[4]){
						echo"</table><br>$vResult[4]<br>
						<table border='1'><tr><th>Mail</th><th>Nom</th><th>Prenom</th><th>Situation</th></tr>";
					}
					echo "<tr><td>$vResult[0]</td><td>$vResult[1]</td><td>$vResult[2]</td><td>$vResult[3]</td></tr>";
					$tmp=$vResult[4];
				}
			?>
	</table>
</fieldset>
</fieldset><br>
	</body>
</html>
