<!DOCTYPE html>
<html>
	<head>
		<title>Gestion d'espace de coworking | Accueil |</title>
		<meta charset="utf-8" />
	</head>
	
	<body>
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
		</fieldset> <br/>
		<fieldset>
			<legend>Formulaires de liaison d'objets</legend>
			<p> Sélectionnez le type de liaison que vous désirez établir </p>
			<form method="post" action="Relation.php">
				<select name="choix">
					<option value="Description">Description d'un espace</option>
					<option value="EspaceConference">Conférence dans un espace ouvert</option>
					<option value="EspaceFormule">Formule proposée par un espace</option>
					<option value="CoworkerFormule">Formule souscrite par un Coworker</option>
					<option value="CoworkerDomaine">Domaine d'activité d'un Coworker</option>
				</select>
				<input type="submit">
			</form>
		</fieldset>
	</body>
</html>
