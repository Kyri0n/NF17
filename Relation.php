<html>
	<head>
		<title>Gestion d espace de coworking | Formulaire Relation |</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<form method="post" action="Accueil.php">
			<fieldset>
				<table>
					<?php if($_POST['choix'] == 'Description'):?>
						<legend> Description d'un espace </legend>
						<tr> <td> <label for="idEspace"> ID Espace : </label> </td>
						<td> <input type="number" name="idEspace" id="idEspace"/> </td> </tr>
						<tr> <td> <label for="idDescription"> ID Description : </label> </td>
						<td> <input type="number" name="idDescription" id="idDescription"/> </td> </tr>
					<?php endif; ?>
					<?php if($_POST['choix'] == 'EspaceConference'):?>
						<legend> Conférence dans un espace ouvert </legend>
						<tr> <td> <label for="TitreConf"> Titre de la conférence : </label> </td>
						<td> <input type="text" name="TitreConf" id="TitreConf"/> </td> </tr>
						<tr> <td> <label for="DateConf"> Date de la conférence : </label> </td>
						<td> <input type="date" name="DateConf" id="DateConf"/> </td> </tr>
						<tr> <td> <label for="idEspace"> ID Espace : </label> </td>
						<td> <input type="number" name="idEspace" id="idEspace"/> </td> </tr>
					<?php endif; ?>
					<?php if($_POST['choix'] == 'EspaceFormule'):?>
						<legend> Formule proposée par un espace </legend>
						<tr> <td> <label for="idEspace"> ID Espace : </label> </td>
						<td> <input type="number" name="idEspace" id="idEspace"/> </td> </tr>
						<tr> <td> <label for="NomFormule"> Nom de la formule : </label> </td>
						<td> <input type="text" name="NomFormule" id="NomFormule"/> </td> </tr>
						<tr> <td> <input type="radio" name="Etat" id="Actif"/>
						<label for="Actif"> Formule Active </label> </td>
						<td> <input type="radio" name="Etat" id="Inactif"/>
						<label for="Inactif"> Formule Inactive </label> </td> </tr>
					<?php endif; ?>
					<?php if($_POST['choix'] == 'CoworkerFormule'):?>
						<legend> Formule souscrite par un Coworker </legend>
						<tr> <td> <label for="DateFormule"> Date Formule : </label> </td>
						<td> <input type="date" name="DateFormule" id="DateFormule"/> </td> </tr>
						<tr> <td> <label for="NomFormule"> Nom de la Formule : </label> </td>
						<td> <input type="number" name="NomFormule" id="NomFormule"/> </td> </tr>
						<tr> <td> <label for="idCoworker"> ID Coworker : </label> </td>
						<td> <input type="number" name="idCoworker" id="idCoworker"/> </td> </tr>
					<?php endif; ?>
					<?php if($_POST['choix'] == 'CoworkerDomaine'):?>
						<legend> Domaine d'activité d'un Coworker </legend>
						<tr> <td> <label for="idDomaine"> ID Domaine : </label> </td>
						<td> <input type="number" name="idDomaine" id="idDomaine"/> </td> </tr>
						<tr> <td> <label for="idCoworker"> ID Coworker : </label> </td>
						<td> <input type="number" name="idCoworker" id="idCoworker"/> </td> </tr>
					<?php endif; ?>
				</table>
				<input type="submit">
			</fieldset>
		</form>
	</body>
</html>