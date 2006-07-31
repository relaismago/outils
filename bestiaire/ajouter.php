<?
include_once('../inc_connect.php3');
include_once('../inc_authent.php3');
include_once('../head.php3');

global $db_bestiaire;

?>
<title>Ajout d'un monstre au bestiaire</title> <!-- ' -->

</head>
<body>
<?
$msg = "";

while (list($key, $val) = each($HTTP_POST_VARS)) { 
	$msg .= "$key : $val\n"; 
} 

$recipient = "monstres@tele2.fr";
$subject = "R&M - Enrichir le Bestiaire";
$mailheaders = "From: RelaiMago\n";

if($valider){
  if ($NOM == ''){
    echo "<br>Indiquez un nom de monstre SVP.<br><br><b>Merci pour votre compréhension !</b>";
    echo "<html><meta http-equiv=\"refresh\" content=\"3; url=enrichir.php\"></html>";
  }
  else{
    if ((($PV != '?')||($ATT != '?')||($ESQ != '?')||($DEG != '?')||($REG != '?')||($ARM != '?')||($VUE != '?'))&&(($PV == '?')||($ATT == '?')||($ESQ == '?')||($DEG == '?')||($REG == '?')||($ARM == '?')||($VUE == '?'))){
      $PV = '?'; $ATT = '?'; $ESQ = '?'; $DEG = '?'; $REG = '?'; $ARM = '?'; $VUE = '?';
    }
    if(($PV == '?')&&($ATT == '?')&&($ESQ == '?')&&($DEG == '?')&&($REG == '?')&&($ARM == '?')&&($VUE == '?')&&($NIVEAU == '?')&&($ATTDLA == '?')&&($DLA == '?')&&($FAMILLE == '?')&&($POUVOIR == '?')&&($MALUS == '?')&&($RM == '?')&&($MM == '?')&&($DUREE == '?')&&($DIST1 == '?')&&($DIST2 == '?')&&($SEP == '?')&&($ZON == '?')&&($POUVOIR2 == '?')&&($MALUS2 == '?')&&($DUREE2 == '?')&&($DIST21 == '?')&&($DIST22 == '?')&&($SEP2 == '?')&&($ZON2 == '?')){
      echo "<br>Ne renseignez que des CdMs complètes SVP.<br><br><b>Merci pour votre compréhension !</b>";
      echo "<html><meta http-equiv=\"refresh\" content=\"3; url=enrichir.php\"></html>";
    }
    else{

      // Récupération de la date jj/mm/aaaa
      $DateDuJour=date("d/m/Y");
      
      // Récupération de la race
      $query = "SELECT Race FROM monstres GROUP BY Race";
      $guilde = mysql_query($query,$db_bestiaire);
      $Race1 = '?';
      while($ligne = mysql_fetch_array($guilde)){
	if (eregi($ligne['Race'],$NOM)){
	  if (strlen($ligne['Race']) > strlen($Race1)){
	    $Race1 = $ligne['Race'];
	  }
	}
      }

      $query = "SELECT ATTDLA,Pouvoir,Descript,Duree,Auto,Zone,Pouvoir2,Descript2,Duree2,Auto2,Zone2,DLA,Famille FROM monstres WHERE Race='".$Race1."'";
      $guilde = mysql_query($query);
      if($ligne = mysql_fetch_array($guilde)){
	if ($ATTDLA == '?'){
	  $ATTDLA = $ligne['ATTDLA'];
	}
	if ($POUVOIR == ''){
	  $POUVOIR = $ligne['Pouvoir'];
	}
	if ($MALUS == ''){
	  $MALUS = $ligne['Descript'];
	  if (((!eregi("Distance",$MALUS))&&($MALUS != "Aucun"))&&(($DIST1 != '?')||($DIST2 != '?'))){
	    $MALUS = $MALUS." Distance : ".$DIST1." (N=".$DIST2.")";
	    $POUVOIR = "Attaque à Distance + ".$POUVOIR;
	  }
	  else{
	    if (((!eregi("Distance",$MALUS))&&($MALUS == "Aucun"))&&(($DIST1 != '?')||($DIST2 != '?'))){
	      $MALUS = "Distance : ".$DIST1." (N=".$DIST2.")";
	      $POUVOIR = "Attaque à Distance";
	    }
	  }
	}
	if ($DUREE == '?'){
	  $DUREE = $ligne['Duree'];
	}
	if ($SEP == '?'){
	  $SEP = $ligne['Auto'];
	}
	if ($ZON == '?'){
	  $ZON = $ligne['Zone'];
	}
	if ($POUVOIR2 == ''){
	  $POUVOIR2 = $ligne['Pouvoir2'];
	}
	if ($MALUS2 == ''){
	  $MALUS2 = $ligne['Descript2'];
	  if (((!eregi("Distance",$MALUS2))&&($MALUS2 != "Aucun"))&&(($DIST21 != '?')||($DIST22 != '?'))){
	    $MALUS2 = $MALUS2." Distance : ".$DIST21." (N=".$DIST22.")";
	    $POUVOIR2 = "Attaque à Distance + ".$POUVOIR2;
	  }
	  else{
	    if (((!eregi("Distance",$MALUS2))&&($MALUS2 == "Aucun"))&&(($DIST21 != '?')||($DIST22 != '?'))){
	      $MALUS2 = "Distance : ".$DIST21." (N=".$DIST22.")";
	      $POUVOIR2 = "Attaque à Distance";
	    }
	  }
	}
	if ($DUREE2 == '?'){
	  $DUREE2 = $ligne['Duree2'];
	}
	if ($SEP2 == '?'){
	  $SEP2 = $ligne['Auto2'];
	}
	if ($ZON2 == '?'){
	  $ZON2 = $ligne['Zone2'];
	}
	if ($DLA == ''){
	  $DLA = $ligne['DLA'];
	}
	if ($FAMILLE == '?'){
	  $FAMILLE = $ligne['Famille'];
	}		
      }

      // Vérification de l'existence de cette CdM puis modification de la date et de la source si CdM déjà répertoriée
      $query = "SELECT * FROM monstres WHERE Nom='".$NOM."' AND PV='".$PV."' AND ATT='".$ATT."' AND ESQ='".$ESQ."' AND DEG='".$DEG."' AND REG='".$REG."' AND ARM='".$ARM."' AND VUE='".$VUE."'";
      $guilde = mysql_query($query);
      if($ligne = mysql_fetch_array($guilde)){
	$query = "UPDATE monstres SET Date='".$DateDuJour."', Source='G' WHERE n='".$ligne['n']."'";
	if(mysql_query($query)==FALSE){
	  mysql_close();
	  echo "<br>Impossible d'enregistrer les modifications.<br><br>Contactez <b>kkwet / troll n°13424</b>";
	  echo "<html><meta http-equiv=\"refresh\" content=\"3; url=enrichir.php\"></html>";
	}
	else{
	  mysql_close();
	  echo "<b>Monstre mis à jour dans le bestiaire</b><br><br>Merci beaucoup pour votre soutien<br><br>Vous allez être redirigé automatiquement.";
	  echo "<html><meta http-equiv=\"refresh\" content=\"3; url=enrichir.php\"></html>";
	}
      }
      else{
	// Insertion dans la Base de Données
	$query = "INSERT INTO monstres(Race,Nom,Date,Source,Niv,ATTDLA,PV,ATT,ESQ,DEG,REG,ARM,VUE,MM,RM,Pouvoir,Descript,Duree,Auto,Zone,Pouvoir2,Descript2,Duree2,Auto2,Zone2,DLA,Famille) VALUES('".$Race1."','".$NOM."','".$DateDuJour."','G','".$NIVEAU."','".$ATTDLA."','".$PV."','".$ATT."','".$ESQ."','".$DEG."','".$REG."','".$ARM."','".$VUE."','".$MM."','".$RM."','".$POUVOIR."','".$MALUS."','".$DUREE."','".$SEP."','".$ZON."','".$POUVOIR2."','".$MALUS2."','".$DUREE2."','".$SEP2."','".$ZON2."','".$DLA."','".$FAMILLE."');";
	if(mysql_query($query)==FALSE){
	  mysql_close();
	  echo "<br>Impossible d'enregistrer les modifications.<br><br><b>Essayez plus tard ou Signalez le à l'équipe R&M</b>";
	  echo "<html><meta http-equiv=\"refresh\" content=\"3; url=enrichir.php\"></html>";
	}
	else{
	  mysql_close();
	  // envoi d'un mail pour permettre de vérifier les données
	  mail($recipient, $subject, $msg, $mailheaders);
	  echo "<b>Monstre ajouté au bestiaire</b><br><br>Merci beaucoup pour votre soutien<br><br>Vous allez être redirigé automatiquement.";
	  echo "<html><meta http-equiv=\"refresh\" content=\"3; url=enrichir.php\"></html>";
	}
      }
    }
  }
}
else{
  // Retour à la page enrichir
  echo "<html><meta http-equiv=\"refresh\" content=\"1; url=enrichir.php\"></html>";
}
?>
</body>
</html>
