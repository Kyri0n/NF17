<html>
<head>
  <title>Exercice</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
  <h1>Population par département</h1>
  <table border="1">
    <tr><th>Numéro</th><th>Nom</th><th>Population</th></tr>
<?php
  $vHost="tuxa.sme.utc";
  $vDbname="dbnf17p012";
  $vPort="5432";
  $vUser="nf17p012";
  $vPassword="9akNMUyA";
  $vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
  $vSql ="SELECT * FROM dpt2";
  $vQuery=pg_query($vConn, $vSql);
  while ($vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH)) {
    echo "<tr>";
    echo "<td>$vResult[0]</td>";
    echo "<td>$vResult[1]</td>";
    echo "<td>$vResult[2]</td>";
    echo "</tr>";
  }
?>
  </table>
  <ul>
<?php
  $vSql ="SELECT departement, nbhabitants FROM dpt2 WHERE nbhabitants =  (SELECT MAX(nbhabitants) FROM dpt2);
";
  $vQuery=pg_query($vConn, $vSql);
  $vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH);
  echo "<li>Département le plus peuplé : <b>$vResult[departement]</b> (<i>$vResult[1]</i>)</li>";

  $vSql ="SELECT departement, nbhabitants FROM dpt2 WHERE nbhabitants =  (SELECT MIN(nbhabitants) FROM dpt2);
";
  $vQuery=pg_query($vConn, $vSql);
  $vResult = pg_fetch_array($vQuery, null, PGSQL_BOTH);
  echo "<li>Département le moins peuplé : <b>$vResult[departement]</b> (<i>$vResult[1]</i>)</li>";
?>
  </ul>
</body>
</html>
