<!DOCTYPE html>
<html>
	<head>
		<title>Gestion d'espace de coworking | Accueil |</title>
		<meta charset="utf-8" />
	</head>
	<body>
<fieldset>
			<legend>Souscription</legend>
	<?php
	include "connect.php";
	$vConn = fConnect();
	$mail=$_GET["mail"];
	$vSql="SELECT * FROM Coworker where mail='$mail'";
	$vQuery=pg_query($vConn, $vSql);
	$result=pg_fetch_row($vQuery);
	$idcoworker=$result[0];
	$vSql="SELECT nom,tarif,nb_jours,
	CASE WHEN bureau_individuel='f' then 'Non' ELSE 'Oui' END,datefin,type FROM formule";
	$vQuery=pg_query($vConn, $vSql);

	echo "<form method='post' action='Souscrire.php?mail=$mail'>";
	?>
	<table border="1">
	  <tr><th></th><th>Nom</th><th>Tarif</th><th>Durée</th><th>Bureau Individuel</th><th>Date fin</th><th>Type</th></tr>
	<?php
    while ($result = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
    			echo "<tr><td><input type='checkbox' name='formule' value='$result[0]'></td><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td><td>$result[3]</td><td>$result[4]</td><td>$result[5]</td></tr>";
    }
    echo "<input type='hidden' name='idcoworker' value='$idcoworker'>";
  	?>
	</table>

	<input type="submit" value='souscrire'>
	</form>
</fieldset>
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
					pg_close($vConn);
				?>
				</td></tr>
				</table><p>
<input type="hidden" name="modifier" value="True">
				<input type="submit" value='modifier'>
				</form>
</fieldset>
	</body>
</html>
