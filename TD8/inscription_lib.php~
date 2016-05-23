<?php

function fLogin ($pLogin, $pPassword, $pConn) {
  $vSql ="SELECT * FROM tGroupe WHERE pkLogin='$pLogin' AND aPassword='$pPassword'";
  $vQuery=pg_query($pConn,$vSql);
  $vResult = pg_fetch_array($vQuery);
  return $vResult[0];
}

function fSession ($pChoix, $pConn) {  
  $vSql="SELECT * FROM tSession WHERE num = $pChoix";
  $vQuery=pg_query($pConn, $vSql);
  $vResult = pg_fetch_array($vQuery);  
  // Si la session existe, on vérifie qu'il reste de la place
  if (empty($vResult)){
    return -10; //non existe
  }else{
	$vSql="SELECT COUNT(G.session) FROM tSession S, tGroupe G WHERE S.num=$pChoix and G.session=S.num GROUP BY G.session";
  	$vQuery=pg_query($pConn, $vSql);
  	$vResult = pg_fetch_array($vQuery); 
	echo "$vResult[0]";
	if ($vResult[0]<6) {
            return 10;
        }else {
            return -1;
        }
  }
}

function fInscrire($pLogin, $pPassword, $pChoix, $pConn) {
  include "inscription_param.php";
	echo'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
  if (fLogin($pLogin, $pPassword, $pConn)) {
    if (empty($pChoix) || $pChoix==' ') {      
      $vSql="UPDATE tGroupe SET session = NULL WHERE pkLogin='$pLogin'";
      $vQuery=pg_query($pConn, $vSql);
      return "Désinscription de $pLogin effectuée";
    }
    $vSession=fSession($pChoix, $pConn);
    if ($vSession==10) {
      $vSql="UPDATE tGroupe SET session = $pChoix WHERE pkLogin='$pLogin'";
      $vQuery=pg_query($pConn, $vSql);
      return "Inscription de $pLogin à la session $pChoix validée";
    }
    elseif ($vSession==-1) {
      return "Il n'y a plus de créneaux disponibles dans la session $pChoix";
    }
    elseif ($vSession==-10) {
      return "La session $pChoix n'existe pas";
    }
  }else {
    return "Mot de passe ou login incorrect";
  }  
}
?>
