<html>
	<head>
		<title>Gestion d espace de coworking | Formulaire Objet |</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<form method="post" action="Accueil.php">
			<?php if($_POST['choix'] == 'Manager'):?>
				<fieldset>
					<table>
						<legend> Manager </legend>
						<tr> <td> <label for="idManager"> idManager : </label> </td>
						<td> <input type="number" name="idManager" id="idManager"/> </td> </tr>
						<tr> <td> <label for="Mail"> Mail : </label> </td>
						<td> <input type="email" name="Mail" id="Mail"/> </td> </tr>
						<tr> <td> <label for="Nom"> Nom : </label> </td>
						<td> <input type="text" name="Nom" id="Nom"/> </td> </tr>
						<tr> <td> <label for="Prénom"> Prénom : </label> </td>
						<td> <input type="text" name="Prenom" id="Prénom"/> </td> </tr>
						<tr> <td> <label for="Age"> Age : </label> </td>
						<td> <input type="number" name="Age" id="Age"/> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Intervenant'):?>
				<fieldset>
					<table>
						<legend> Intervenant </legend>
						<tr> <td> <label for="idIntervenant"> idIntervenant : </label> </td>
						<td> <input type="number" name="idIntervenant" id="idIntervenant"/> </td> </tr>
						<tr> <td> <label for="Mail"> Mail : </label> </td>
						<td> <input type="email" name="Mail" id="Mail"/> </td> </tr>
						<tr> <td> <label for="Nom"> Nom : </label> </td>
						<td> <input type="text" name="Nom" id="Nom"/> </td> </tr>
						<tr> <td> <label for="Prénom"> Prénom : </label> </td>
						<td> <input type="text" name="Prenom" id="Prénom"/> </td> </tr>
						<tr> <td> <label for="Age"> Age : </label> </td>
						<td> <input type="number" name="Age" id="Age"/> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Coworker'):?>
				<fieldset>
					<table>
						<legend> Coworker </legend>
						<tr> <td> <label for="idCoworker"> idCoworker : </label> </td>
						<td> <input type="number" name="idCoworker" id="idCoworker"/> </td> </tr>
						<tr> <td> <label for="Mail"> Mail : </label> </td>
						<td> <input type="email" name="Mail" id="Mail"/> </td> </tr>
						<tr> <td> <label for="Nom"> Nom : </label> </td>
						<td> <input type="text" name="Nom" id="Nom"/> </td> </tr>
						<tr> <td> <label for="Prénom"> Prénom : </label> </td>
						<td> <input type="text" name="Prenom" id="Prénom"/> </td> </tr>
						<tr> <td> <label for="Age"> Age : </label> </td>
						<td> <input type="number" name="Age" id="Age"/> </td> </tr>
						<tr> <td> <label for="Presentation"> Présentation : </label> </td>
						<td> <textarea name="Presentation" id="Age"></textarea> </td> </tr>
						<tr> <td> Situation Professionelle : </td>
						<td> 	<select name="situationP">
									<option value="Entrepreneur">Entrepreneur</option>
									<option value="Freelance">Freelance</option>
									<option value="Autre">Autre</option>
								</select> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Domaine activite'):?>
				<fieldset>
					<table>
						<legend> Domaine d'activité </legend>
						<tr> <td> <label for="idDomaine"> idDomaine : </label> </td>
						<td> <input type="number" name="idDomaine" id="idDomaine"/> </td> </tr>
						<tr> <td> <label for="Info"> Info : </label> </td>
						<td> <textarea name="Info" id="Info"></textarea> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Espace'):?>
				<fieldset>
					<table>
						<legend> Espace </legend>
						<tr> <td> <label for="idEspace"> idEspace : </label> </td>
						<td> <input type="number" name="idEspace" id="idEspace"/> </td> </tr>
						<tr> <td> <label for="Adresse"> Adresse : </label> </td>
						<td> <input type="text" name="Adresse" id="Adresse"/> </td> </tr>
						<tr> <td> <label for="Surface"> Surface : </label> </td>
						<td> <input type="number" name="Surface" id="Surface"/> </td> </tr>
						<tr> <td> <label for="NbBI"> Nombre de Bureaux Individuels : </label> </td>
						<td> <input type="number" name="NbBI" id="NbBI"/> </td> </tr>
						<tr> <td> <label for="Manager"> Manager : </label> </td>
						<td> <input type="text" name="Manager" id="Manager"/> </td> </tr>
						<tr> <td> <input type="radio" name="Etat" id="Actif"/>
						<label for="Actif"> Actif </label> </td>
						<td> <input type="radio" name="Etat" id="Inactif"/>
						<label for="Inactif"> Inactif </label> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Element Descripteur'):?>
				<fieldset>
					<table>
						<legend> Element Descripteur </legend>
						<tr> <td> <label for="idElement"> idElement : </label> </td>
						<td> <input type="number" name="idElement" id="idElement"/> </td> </tr>
						<tr> <td> <label for="Info"> Info : </label> </td>
						<td> <textarea name="Info" id="Info"></textarea> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Salle Collective'):?>
				<fieldset>
					<table>
						<legend> salle Collective </legend>
						<tr> <td> <label for="idSalle"> idSalle : </label> </td>
						<td> <input type="number" name="idSalle" id="idSalle"/> </td> </tr>
						<tr> <td> <label for="Espace"> Espace : </label> </td>
						<td> <input type="text" name="Espace" id="Espace"/> </td> </tr>
						<tr> <td> <label for="NbPlace"> Nombre de Places : </label> </td>
						<td> <input type="number" name="NbPlace" id="NbPlace"/> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Actualité'):?>
				<fieldset>
					<table>
						<legend> Actualité </legend>
						<tr> <td> <label for="DateA"> Date : </label> </td>
						<td> <input type="date" name="DateA" id="DateA"/></code> </td> </tr>
						<tr> <td> <label for="Espace"> Espace : </label> </td>
						<td> <input type="text" name="Espace" id="Espace"/> </td> </tr>
						<tr> <td> <label for="NbPlace"> Nombre de Places : </label> </td>
						<td> <input type="number" name="NbPlace" id="NbPlace"/> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Formule Limitee'):?>
				<fieldset>
					<table>
						<legend> Formule Limitée </legend>
						<tr> <td> <label for="Nom"> Nom : </label> </td>
						<td> <input type="text" name="Nom" id="Nom"/></code> </td> </tr>
						<tr> <td> <label for="Tarif"> Tarif : </label> </td>
						<td> <input type="number" name="Tarif" id="Tarif"/> </td> </tr>
						<tr> <td> <label for="NbJours"> Nombre de Jours : </label> </td>
						<td> <input type="number" name="NbJours" id="NbJours"/> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Formule Illimitee'):?>
				<fieldset>
					<table>
						<legend> Formule Illimitée </legend>
						<tr> <td> <label for="Nom"> Nom : </label> </td>
						<td> <input type="text" name="Nom" id="Nom"/></code> </td> </tr>
						<tr> <td> <label for="Tarif"> Tarif : </label> </td>
						<td> <input type="number" name="Tarif" id="Tarif"/> </td> </tr>
						<tr> <td> <label for="DateFin"> Date de fin : </label> </td>
						<td> <input type="date" name="DateFin" id="DateFin"/></code> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
			<?php if($_POST['choix'] == 'Conference'):?>
				<fieldset>
					<table>
						<legend> Conférence </legend>
						<tr> <td> <label for="Titre"> Titre : </label> </td>
						<td> <input type="text" name="Titre" id="Titre"/></code> </td> </tr>
						<tr> <td> <label for="DateC"> Date : </label> </td>
						<td> <input type="date" name="DateC" id="DateC"/></code> </td> </tr>
						<tr> <td> <label for="Resume"> Résumé : </label> </td>
						<td> <textarea name="Resume" id="Resume"/></textarea></code> </td> </tr>
						<tr> <td> <label for="Intervenant"> Intervenant : </label> </td>
						<td> <input type="number" name="Intervenant" id="Intervenant"/> </td> </tr>
						<tr> <td> <label for="Coworker"> Coworker : </label> </td>
						<td> <input type="number" name="Coworker" id="Coworker"/> </td> </tr>
						<tr> <td> <label for="Espace"> Espace : </label> </td>
						<td> <input type="number" name="Espace" id="Espace"/> </td> </tr>
					</table>
					<input type="submit">
				</fieldset>
			<?php endif; ?>
		</form>
		<p> <a href="Accueil.php">Accueil</a> </p>
	</body>
</html>
