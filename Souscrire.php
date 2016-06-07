<?php
/* Connexion à la base de données */
	include "connect.php";
	$vConn = fConnect();
	/* Récupération des variables passées par le fomulaire */
	$idcoworker=$_POST["idcoworker"];
	$formule=$_POST["formule"];
	$mail=$_GET["mail"];
  

  $vSql="SELECT count(*) FROM assoc_coworkerformule  WHERE nom_formule='$formule' ";
	$vQuery=pg_query($vConn, $vSql);
	$nbPlacesActuel=pg_fetch_row($vQuery);
	
	$vSql="SELECT e.nb_bureau_individuel FROM espace e JOIN assoc_propose a ON e.idespace= a.id_espace WHERE a.nom_formule='$formule'";
	$vQuery=pg_query($vConn, $vSql);
	$nbPlacesMax=pg_fetch_row($vQuery);
	echo "$nbPlacesActuel[0]";
	echo "$nbPlacesMax[0]";
	
	
	if($nbPlacesActuel[0] >=$nbPlacesMax[0]){
	  echo "<meta charset='utf-8' />Cette formule n'a plus de place, veuillez souscrire à une autre formule.";
	  echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.php?mail=$mail'></html>";
	  
	}else{
	  //cette requete permet de vérifier que le coworker n'est pas déjà inscrit, on pourrait le faire par un trigger mais le temps manque un peu quand on est 3...
	  $vSql="Select count(*) FROM assoc_coworkerformule WHERE nom_formule='$formule' and coworker='$idcoworker'";
	  $vQuery=pg_query($vConn,$vSql);
	  $result=pg_fetch_row($vQuery);
	  if($result[0]>0){
	    echo "<meta charset='utf-8' />Vous avez déjà souscrit à cette formule !";
	    echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.php?mail=$mail'></html>";
	  }else{

	  $vSql= "INSERT INTO assoc_coworkerformule VALUES ('now()','$formule', $idcoworker)";
	  $vQuery=pg_query($vConn, $vSql);
	  $result=pg_fetch_row($vQuery);
    }
  }
	pg_close($vConn);
	echo "<meta charset='utf-8' />Souscription terminée avec succès";
	echo "<html><meta http-equiv='refresh' content='1;URL=http://tuxa.sme.utc/~nf17p012/coworker.php?mail=$mail'></html>"

?> 
