<html>
 
<head>
  
	<title>Inscription Soutenance NF17</title>
<meta charset="UTF-8">
</head>

<body>
	<h1>Inscriptions � la soutenance de NF17</h1>


<?php
/* Connexion � la base de donn�es*/
include "connect.php";
$vConn = fConnect();

/* R�cup�ration des variables pass�es par le fomulaire */
$vLogin=$_POST[login];
$vPassword=$_POST[password];
$vChoix=$_POST[session];

/* Inscription 
	NB : si aucun login n'est pass�, c'est que la page est appel� uniquement pour avoir la liste des inscrits
		sans proc�der � une nouvelle inscrition*/
if ($vLogin) { 
	include "inscription_lib.php";
	echo "<p><blink><b>".fInscrire($vLogin, $vPassword, $vChoix, $vConn)."</b></blink></p>";
	echo "<hr/>";
}
?>

	<h2>Liste des groupes inscrits</h2>
	<table border="1">
		<tr>
			<td width="100pt">
				<b>Groupe</b>
			</td>
			<td width="100pt">
				<b>Session</b>
			</td>
			<td width="100pt">
				<b>Date et heure</b>
			</td>				
		</tr>

<?php 
$vSql ="SELECT G.pkLogin as login, G.session as session, S.deb as deb FROM tSession S, tGroupe G WHERE G.session=S.num ORDER BY S.deb";

$vQuery=pg_query($vConn, $vSql);

while ($vResult = pg_fetch_array($vQuery)) {       
	echo "<tr>
			<td width='100pt'>
				<b>$vResult[login]</b>
			</td>
			<td width='100pt'>
				<b>$vResult[session]</b>
			</td>
			<td width='100pt'>
				<b>$vResult[deb]</b>
			</td>				
		</tr>";
}
pg_close($vConn);
?>
	</table>
	<hr/>
	<p><a href="inscription1.php">Retour</a></p>
</body>

</html>


