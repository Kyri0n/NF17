<html>
<head>
  <title>Inscription Soutenance NF17</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body> 
  <h1>Inscriptions à la soutenance de NF17</h1>
  <h2>Liste des créneaux horaires</h2> 
  <table border="1"> 
    <tr>
      <td width="100pt"><b>Session</b></td> 
      <td width="100pt"><b>Début</b></td> 
      <td width="100pt"><b>Fin</b></td> 
      <td width="100pt"><b>Places disponibles</b></td> 
    </tr> 
<?php
	include "connect.php";
	include "inscription_param.php";
	$vConn = fConnect();
	$vSql ="SELECT num,deb,fin,COUNT(G.session) FROM tSession S LEFT OUTER JOIN tGroupe G ON G.session=S.num GROUP BY s.num ORDER BY s.num";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
		$tmp = $CST_DISPO_SESSION-$vResult[3];
		echo "<tr>";
		echo "<td>Session $vResult[num]</td>";
		echo "<td>$vResult[deb]</td>";
		echo "<td>$vResult[fin]</td>";
		echo "<td>$tmp</td>";
		echo "</tr>";
	}
?> 
  </table>
  <hr/>
  <a href="inscription2.html">S'inscrire</a>
</body> 
</html>
