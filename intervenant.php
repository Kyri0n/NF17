<!DOCTYPE html>
<html>
<head>
	<title>
		Intervenant
		<meta charset="utf-8">
	</title>
</head>
<body>
    <form action="AjouterConference.php" method="post">
    <?php
        include "connect.php";
        $vConn = fConnect();
        $mail=$_GET["mail"];
        $vSql="SELECT * FROM Intervenant where mail='$mail'";
        $vQuery=pg_query($vConn, $vSql);
        $result=pg_fetch_row($vQuery);
        $idIntervenant=$result[0];
        echo "<input type='hidden' name='id' value='$idIntervenant'>";
        pg_close($vConn);
    ?>

    <fieldset>
        <table>
            <legend> Ajout d'une Conférence </legend>
                <tr> <td> <label for="Titre"> Titre : </label> </td>
                <td> <input type="text" name="Titre" id="Titre"/> </td> </tr>
                <tr> <td> <label for="DateC"> Date : </label> </td>
                <td> <input type="date" name="DateC" id="DateC" placeholder="yyyy-mm-dd"/> </td> </tr>
                <tr> <td> <label for="Resume"> Résumé : </label> </td>
                <td> <textarea name="Resume" id="Resume"/></textarea></td> </tr>
        </table>
                <input type="submit">
            </form>
    </fieldset>
</body>
</html>
