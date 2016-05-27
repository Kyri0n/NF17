<?php
function fConnect () {
  $vHost="tuxa.sme.utc";
  $vDbname="dbnf17p012";
  $vPort="5432";
  $vUser="nf17p012";
  $vPassword="9akNMUyA";
  $vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
 return $vConn;

}

?>
