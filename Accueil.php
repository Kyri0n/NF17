<!DOCTYPE html>
<html>
	<head>
		<title>Gestion d'espace de coworking | Accueil |</title>
		<meta charset="utf-8" />
	</head>
	
	<body>
		<fieldset>
			<legend>Connexion à l'espace coworker</legend>
			<form method="post" action="ConnectEsp.php">
				<p>Login:  
				<input type="text" name="mail" placeholder="toto@wanadoo.fr">
				<input type="submit">
			</form>
		</fieldset>
		<fieldset>
			<legend>Inscription d'un nouveau coworker</legend>
			<form method="post" action="AjouterCoworker.php"><table>
				<tr><td>Email:</td>
				<td><input type="text" name="mail" placeholder="new@coworker.fr"></td></tr>
				<tr><td>Nom:</td>  
				<td><input type="text" name="nom"></td></tr>
				<tr><td>Prénom:</td>  
				<td><input type="text" name="prenom"></td></tr>
				<tr><td>Age:</td>  
				<td><input type="text" name="Age"></td></tr>
				<tr><td>Situation professionelle:</td>  
				<td><select name="situation">
					<option value="entrepreneur">entrepreneur</option>
					<option value="freelance">freelance</option>
					<option value="autre">autre</option>
				</select></td></tr>
				<tr><td>Presentation:</td>  
				<td><input type="text" name="Presentation" placeholder="Je pense, donc je suis"></td></tr>
				<tr><td>Domaine:</td>  
				<td><select name="domaine">
				<?php
					include "connect.php";
					$vConn = fConnect();
					$vSql="SELECT * FROM domaines_activite";
					$vQuery=pg_query($vConn, $vSql);
					while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
    			echo "<option value='$vResult[0]'>$vResult[1]</option>";
  }
				?>
				</select></td></tr>
				</table><p>
				<input type="submit">
			</form>
		</fieldset>
		<fieldset>
			<legend>Formulaires d'insertion de données</legend>
			<p> Sélectionnez le type d'information que vous désirez entrer dans la base de données : <p>
			<form method="post" action="Insert.php">
				<select name="choix">
					<option value="Manager">Manager</option>
					<option value="Intervenant">Intervenant</option>
					<option value="Coworker">Coworker</option>
					<option value="Domaine activite">Domaine d'activité</option>
					<option value="Espace">Espace</option>
					<option value="Element Descripteur">Element Descripteur</option>
					<option value="Salle Collective">Salle Collective</option>
					<option value="Actualité">Actualité</option>
					<option value="Formule Limitee">Formule Limitée</option>
					<option value="Formule Illimitee">Formule Illimitée</option>
					<option value="Conference">Conférence</option>
				</select>
				<input type="submit">
			</form>
		</fieldset>
	</body>
</html>
