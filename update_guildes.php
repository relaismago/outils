<?
include_once("inc_connect.php");
include_once("inc_define_vars.php");

global $db_vue_rm ;

function getGuildeInFile($id)
{
  global $db_vue_rm;

  echo "Traitement du fichier des guildes pour mettre à jour la bdd<br>";
  update_traitement("GUILDES", "EN_COURS");

	/* Détection fichier ftp trolls vide */
	$i = 0;
  $fichtroll=fopen("vues/Public_Guildes.txt","r");
	while (($line = fgets($fichtroll, 1024))) {
  	$i++;
	}
	/* s'il y a moins de 100 guildes dans le fichier */	
	if ($i <100) {
		update_traitement("GUILDES", "KO : moins de 100 guildes dans le fichier"); 
		die("Erreur Fichier FTP des Guildes<br>");
	}
	fclose($fichtroll);

  $Id=0;
  $fichtroll=fopen("vues/Public_Guildes.txt","r");
	
	$i = 0;
  while (($line = fgets($fichtroll, 1024))) {
    #$liste=split (";",$line);
    list($Id, $nom, $size) = split (";",$line);
    #$Id=$liste[0];
    //$nom = htmlentities($nom);
	$sql = "SELECT id_guilde FROM guildes WHERE id_guilde=$Id";	

    $result=mysql_query($sql,$db_vue_rm);
    echo mysql_error();

    if (mysql_num_rows($result)<=0 ) {
			$sql = "INSERT INTO guildes (id_guilde, nom_guilde) VALUES ('$Id','".addslashes($nom)."')";
      mysql_query($sql, $db_vue_rm);
    } else {
			$sql = "UPDATE guildes SET nom_guilde='".addslashes($nom)."' WHERE id_guilde ='$Id'";
      mysql_query($sql,$db_vue_rm);
    }
    echo mysql_error();
	}
	fclose($fichtroll);
	# On ajoute le troll à l'index
	if ($id != $Id) {
		$line="$id;?;?\n";
	}
	echo "Fin Traitement du fichier des guildes<br>\n";
	# On ajoute au cache

 	update_traitement("GUILDES", "OK");
	return $liste;
}

function getTrollInFile($id)
{
  global $db_vue_rm;

	echo "Traitement du fichier des trolls pour mettre à jour la bdd<br>\n";

  update_traitement("TROLLS", "EN_COURS");

	/* Détection fichier ftp trolls vide */
	$i = 0;
	$fichtroll=fopen("vues/Public_Trolls.txt","r");
	while (($line = fgets($fichtroll, 1024))) {
  	$i++;
	}
	/* s'il y a moins de 4000 trolls dans le fichier */	
	if ($i <4000) {
  		update_traitement("TROLLS", "KO : moins de 4000 trolls dans le fichier");
		die("Erreur Fichier FTP<br>");
	}
	fclose($fichtroll);


	/* on met tous les trolls pnj */
	$sql = "UPDATE trolls SET is_pnj_troll = '1'";
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	// On sélectionne tous les trolls RelaisMago
	$sql = " SELECT id_troll, niveau_troll FROM trolls WHERE guilde_troll=".ID_GUILDE;

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
  } else {
    while ($rmt_a = mysql_fetch_assoc($result)) {
			$id_troll= $rmt_a[id_troll];
      $rm_list[$id_troll][niveau_troll] = $rmt_a[niveau_troll];
    }
  }

	$Id = 0;
	$i = 0;
	$fichtroll = fopen("vues/Public_Trolls.txt","r");

	while ($line = fgets($fichtroll, 1024)) {
		#$liste=split (";",$line);
		list($Id, $nom, $race, $level, $nKills, $nDead, $IdGuilde, $Mouches) = split (";",$line);
		#$Id=$liste[0];
		$sql ="SELECT id_troll FROM trolls WHERE id_troll=$Id";

		if (mysql_num_rows(mysql_query($sql,$db_vue_rm)) <= 0 ) {
			$sql = "INSERT INTO trolls ";
			$sql .= "(id_troll, guilde_troll, nom_troll, race_troll, niveau_troll, ";
			$sql .= "nbkills_troll, nbdead_troll, nbmouches_troll,is_pnj_troll,nom_image_troll) VALUES ";
			$sql .= "('$Id','$IdGuilde','".addslashes($nom)."','$race','$level',";
			$sql .= "'$nKills','$nDead','$Mouches','non','inconnu')";

	  	mysql_query($sql,$db_vue_rm);

		} else {
			$sql = "UPDATE trolls SET guilde_troll='$IdGuilde', ";
			$sql .= "nom_troll='".addslashes($nom)."', niveau_troll='$level', ";
			$sql .= "nbkills_troll='$nKills', nbdead_troll='$nDead', ";
			$sql .= "nbmouches_troll='$Mouches', race_troll='$race', is_pnj_troll = '0' WHERE id_troll ='$Id'";
			mysql_query($sql,$db_vue_rm);
			echo mysql_error();
		}

		// Si c'est un relaismago, on renseigne la table vtt
		if ($IdGuilde == ID_GUILDE) {
			// update du profil public
			update_profil($Id);
			
			$lesRM[$i] = $Id;
			$i++;

			if (mysql_num_rows(mysql_query("SELECT No FROM vtt WHERE No=$Id",$db_vue_rm))<=0 ) {

				$sql = "INSERT INTO `vtt` ( `No` , `DateTrash` , `DateMaj` , `Race` , ";
				$sql .= "`VUE` , `VUEB` , `Niveau` , `PVs` , `REG` , `REGB` , `ATT` , ";
				$sql .= "`ATTB` , `ESQ` , `ESQB` , `DEG` , `DEGB` , `ARM` , `ARMB` , ";
				$sql .= "`KILLs` , `DEADs` , `RM` , `RMB` , `MM` , `MMB` , `Joueur` , ";
				$sql .= "`AgeJoueur` , `VilleJoueur` , `MSN` , `ICQ` , `EMail` , `Divers` ";
				$sql .= ", `DLAH` , `DLAM`, `Comps` , `Sorts` , `NbSorts` ) ";
		
				$sql .= " VALUES ($Id,  NOW( ) , '20050311180907', NULL , NULL , NULL , NULL";
				$sql .= ", NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , ";
				$sql .= "NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , ";
				$sql .= "NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , '0' );";

				mysql_query($sql,$db_vue_rm);
				echo mysql_error();
			}

			if (mysql_num_rows(mysql_query("SELECT id_troll_option FROM options WHERE id_troll_option=$Id",$db_vue_rm))<=0 ) {

				$sql = "INSERT INTO options (id_troll_option) ";
				$sql .= " VALUES ($Id);";

				mysql_query($sql,$db_vue_rm);
				echo mysql_error();
			}

			
			if ($level >1 ) {// si le niveau du troll est supérieur à 1 
				update_mouches($Id);	// mise à jours des mouches
			}
			/*$sql = "SELECT id_troll_mouche FROM mouches WHERE id_troll_mouche=$Id";

			$upd_mouche = false;
			$last_level = $rm_list[$Id][niveau_troll];

			if ($level >1 ) {// si le niveau du troll est supérieur à 1 
				// et qu'il n'est pas dans la table mouches
				if (mysql_num_rows(mysql_query($sql,$db_vue_rm))<=0 ) { 
					$upd_mouche = true;
					
				// s'il vient de changer de niveau 
				} elseif ($level > $last_level) {
					$upd_mouche = true;
				}
				if ($upd_mouche) {
					update_mouches($Id);	// mise à jours des mouches
				}
			}*/
		}
	}
	fclose($fichtroll);

	echo "Epuration des RM de la table Trolls<br>\n";

	// On sélectionne tous les trolls RelaisMago
	$sql = " SELECT id_troll FROM trolls WHERE guilde_troll=".ID_GUILDE;

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
  } else {
    $i=1;
    while ($rmt = mysql_fetch_assoc($result)) {
			$flag = false;
			
			for ($j=0; $j<=count($lesRM); $j++)
	      if ($rmt[id_troll] == $lesRM[$j])
					$flag = true;

			if (!$flag){
				$sql = "update trolls set guilde_troll = 0 where id_troll = $rmt[id_troll]";
    		mysql_query($sql,$db_vue_rm);
    		echo "$rmt[id_troll] n'est plus RM<br>\n";
			}
		}
    $i++;
  }

	echo "Mise à jour de la diplo des PNJ de la table Trolls<br>";
	$sql = " UPDATE trolls set statut_troll = 'neutre' , is_wanted_troll='non',";
	$sql .= "is_venge_troll='non', is_tk_troll='non' where is_pnj_troll='oui'";

	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	echo "Épuration des tables tk_griefs et tk_vengeances<br>\n";
	$sql = " SELECT id_troll FROM trolls WHERE is_pnj_troll='oui'";
  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
  } else {
    while ($troll = mysql_fetch_assoc($result)) {
			$sql = "delete from tk_griefs where tk_id = $troll[id_troll]";
   		mysql_query($sql,$db_vue_rm);

			$sql = "delete from tk_vengeances where tk_id = $troll[id_troll]";
   		mysql_query($sql,$db_vue_rm);
		}
  }

 	update_traitement("TROLLS", "OK");
	return $liste;
}

function getFilePublicTrolls()
{
  echo "Récupération du fichier des trolls<br>";

  $fp=fopen("http://www.mountyhall.com/ftp/Public_Trolls.txt","r");
  if ($fp == FALSE) {
    update_traitement("TROLLS", "KO : erreur lors de l''appel du fichier public sur le serveur FTP");
    die ("Erreur lors de l'appel du fichier public sur le serveur FTP. Procédure de refresh stoppée");
  }

  $v2=fopen("vues/Public_Trolls.txt","w");

  if ($v2 == FALSE) {
    update_traitement("TROLLS", "KO : erreur lors de l''ecriture du fichier FTP");
    die ("Erreur lors de l'ecriture du fichier Public_Trolls. Procédure de refresh stoppée");
  }

  while ( $line=fgets($fp) ){
    fputs ($v2, $line);
  }
  fclose($fp);
  fclose($v2);
  echo "Fin de la récupération du fichier des trolls<br>";
  return ;
}

function getFilePublicGuildes()
{
  echo "recuperation du fichier des guildes<br>";
  $fp = fopen("http://www.mountyhall.com/ftp/Public_Guildes.txt","r");
  if ($fp == FALSE) {
    update_traitement("GUILDES", "KO : erreur lors de l''appel du fichier du public");
    die ("Erreur lors de l'appel du fichier public sur le serveur FTP. Procédure de refresh stoppée");
  }

  $v2 = fopen("vues/Public_Guildes.txt","w");
  if ($v2 == FALSE) {
    update_traitement("GUILDES", "KO : erreur lors de l''ecriture du fichier FTP");
    die ("Erreur lors de l'écriture du fichier Public_Guildes. Procédure de refresh stoppée");
  }

  while ( $line=fgets($fp) ){
    fputs ($v2, $line);
  }
  fclose($fp);
  fclose($v2);
  echo "Fin de la récupération du fichier des guildes<br>";
  return ;
}


function update_profil($id_troll)
{

  global $db_vue_rm;

	$date_less_24=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));

	/* On regarde si la limite des script equipement n'est pas atteinte */
	$sql = "SELECT COUNT(*) FROM refresh_count";
	$sql .= " WHERE date_refresh >= '$date_less_24'";
	$sql .= " AND id_troll_refresh = $id_troll";
	$sql .= " AND categorie_refresh = 'classiques'";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
		return ;
	}
	echo mysql_error();

	list($nb)=mysql_fetch_array($result);

	if ($nb >= NB_MAX_CLASSIQUES)
		return ; // nb d'utilisation des scripts de catégorie equipement atteinte

 /* On récupère le mot de passe */
	$sql =" SELECT pass_troll";
	$sql .= " FROM trolls WHERE id_troll=$id_troll";

	$result=mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	if (mysql_affected_rows() > 0)
		list($passw) = mysql_fetch_array($result);

	$pass=rawurlencode(stripslashes($passw)); # on "échape" les caractères spéciaux
	
	/* On appel le script public des mouches */

	$fp=fopen("http://sp.mountyhall.com/SP_ProfilPublic.php?Numero=$id_troll&Motdepasse=$pass","r");

	if ($fp == FALSE) {
		echo "Erreur lors de l'appel du fichier public. Procédure de refresh du profil public stoppée";
		return ;
	}

	$deb = 0;
	$error = false;

	$sql_add = "";
  while ( ($line=fgets($fp,4096)) && (!$error) ){
    $line = html_entity_decode($line);
    if ($deb < 1) {
      if (strpos($line,"Erreur")!==false) {
        $error=true;
        if (strpos($line,"Erreur 3")!==false) {

          $date=date("Y-m-d H-i-s");
          $tmpfile=fopen ("vues/list_mdp_error.txt","a");
          fwrite($tmpfile,$date.": Troll n° ".$id_troll."\n");
          fclose($tmpfile);

          $error = "<br><b class=red>Erreur de mot de passe.</b><br>";
          break;
        } elseif (preg_match("/Erreur (4|5)/",$line)) {
          $error = "<br><b class=red>Erreur du serveur.</b><br>";
          break;
        } elseif (strpos($line,"Erreur 1")!==false) {
          $error = "<br><b class=red>Paramètres incorrects</b><br>";
          break;
        }
        $error = "erreur";
        break;
      } else {
				// nothing
      }
    }
    $deb++;

    list($numero_troll, $is_pnj_troll, $niveau_troll , $date_inscription_troll , $email_troll , $blason_troll , $intangible_troll , $nb_mouches_troll , $nb_kills_troll, $nb_morts_troll, $num_rang_troll, $nom_rang_troll, $distinction_troll , $equipement2_troll) = split (";",$line);

		$nom_rang_troll = addslashes($nom_rang_troll);
		$equipement2_troll = addslashes($equipement2_troll);
		$distinction_troll = addslashes($distinction_troll);
		if (trim($line) != "") {
			$sql_upd = "is_pnj_troll = '$is_png_troll',";
			$sql_upd .= "date_inscription_troll = '$date_inscription_troll',";
			$sql_upd .= "email_troll = '$_troll',";
			$sql_upd .= "blason_troll = '$blason_troll',";
			$sql_upd .= "intangible_troll = '$intangible_troll',";
			$sql_upd .= "nb_mouches_troll = '$nb_mouches_troll',";
			$sql_upd .= "nb_kills_troll = '$nb_kills_troll',";
			$sql_upd .= "nb_morts_troll = '$nb_morts_troll',";
			$sql_upd .= "num_rang_troll = '$num_rang_troll',";
			$sql_upd .= "nom_rang_troll = '$nom_rang_troll',";
			$sql_upd .= "distinction_troll = '$distinction_troll',";
			$sql_upd .= "equipement2_troll = '$equipement2_troll' ";
			$sql_upd .= " WHERE id_troll = $id_troll";

		}
	}

	/* Si une erreur a été détecté, on retourne */
	if ($error != false)
		return ;

	/* on renseigne la base de l'utilisation du script public */
  $date = date("Y-m-d H-i-s");

  $sql = "INSERT INTO refresh_count";
  $sql .= " (id_troll_refresh, date_refresh, by_me_refresh, categorie_refresh,script_name_refresh)";
  $sql .= " VALUES ($id_troll, '$date','non','classiques','SP_ProfilPublic')";

  mysql_query($sql,$db_vue_rm);
  echo mysql_error();

	$sql = " UPDATE trolls set ";
	$sql .= $sql_upd;

  mysql_query($sql,$db_vue_rm);
  echo mysql_error();

	echo "Mise à jour du profil pour le troll $id_troll effectuée<br>\n";
	
	return;
}


function update_mouches($id_troll)
{

  global $db_vue_rm;

	$date_less_24=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));

	/* On regarde si la limite des script equipement n'est pas atteinte */
	$sql = "SELECT COUNT(*) FROM refresh_count";
	$sql .= " WHERE date_refresh >= '$date_less_24'";
	$sql .= " AND id_troll_refresh = $id_troll";
	$sql .= " AND categorie_refresh = 'equipement'";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
		return ;
	}
	echo mysql_error();

	list($nb)=mysql_fetch_array($result);

	if ($nb >= NB_MAX_EQUIPEMENT)
		return ; // nb d'utilisation des scripts de catégorie equipement atteinte

 /* On récupère le mot de passe */
	$sql =" SELECT pass_troll";
	$sql .= " FROM trolls WHERE id_troll=$id_troll";

	$result=mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	if (mysql_affected_rows() > 0)
		list($passw)=mysql_fetch_array($result);

	$pass=rawurlencode(stripslashes($passw)); # on "échape" les caractères spéciaux
	
	/* On appel le script public des mouches */

	$fp=fopen("http://sp.mountyhall.com/SP_Mouche.php?Numero=$id_troll&Motdepasse=$pass","r");

	if ($fp == FALSE) {
		echo "Erreur lors de l'appel du fichier public. Procédure de refresh des mouches stoppée";
		return ;
	}

	$deb = 0;
	$error = false;

	$sql_add = "";
  while ( ($line=fgets($fp,4096)) && (!$error) ){
    $line = html_entity_decode($line);
    if ($deb < 1) {
      if (strpos($line,"Erreur")!==false) {
        $error=true;
        if (strpos($line,"Erreur 3")!==false) {

          $date=date("Y-m-d H-i-s");
          $tmpfile=fopen ("vues/list_mdp_error.txt","a");
          fwrite($tmpfile,$date.": Troll n° ".$id_troll."\n");
          fclose($tmpfile);

          $error = "<br><b class=red>Erreur de mot de passe.</b><br>";
          break;
        } elseif (preg_match("/Erreur (4|5)/",$line)) {
          $error = "<br><b class=red>Erreur du serveur.</b><br>";
          break;
        } elseif (strpos($line,"Erreur 1")!==false) {
          $error = "<br><b class=red>Paramètres incorrects</b><br>
               Mais... qu'est-ce que vous avez donc tapé ? Envoyez-moi un mail avec vos paramètres,
               je tenterais de débugguer le truc.<br>";
          break;
        }
        $error = "erreur";
        break;
      } else {
				// nothing
      }
    }
    $deb++;
    list($id_mouche, $nom_mouche, $type_mouche, $age_mouche, $presence_mouche) = split (";",$line);

		$nom_mouche = addslashes($nom_mouche);
		if (trim($line) != "")
			$sql_add .= "($id_mouche,$id_troll,'".$nom_mouche."','".$type_mouche."','".$age_mouche."','".$presence_mouche."'),";
	}

	/* Si une erreur a été détecté, on retourne */
	if ($error != false)
		return ;

	/* on renseigne la base de l'utilisation du script public */
  $date = date("Y-m-d H-i-s");

  $sql = "INSERT INTO refresh_count";
  $sql .= " (id_troll_refresh, date_refresh, by_me_refresh, categorie_refresh,script_name_refresh)";
  $sql .= " VALUES ($id_troll, '$date','non','equipement','SP_Mouche')";

  mysql_query($sql,$db_vue_rm);
  echo mysql_error();

	/* suppression de toutes les mouches du trolls */
  $sql = "DELETE FROM mouches WHERE";
  $sql .= " id_troll_mouche = $id_troll";

  mysql_query($sql,$db_vue_rm);
  echo mysql_error();

	/* puis ajout */
	$sql_add = substr($sql_add, 0, -1);
  $sql = "INSERT INTO mouches ";
  $sql .= " (id_mouche,id_troll_mouche,nom_mouche,type_mouche,age_mouche,presence_mouche)";
  $sql .= " VALUES $sql_add";

  mysql_query($sql,$db_vue_rm);
  echo mysql_error();

	echo "Mise à jour des mouches pour le troll $id_troll effectuée<br>\n";
	
	return;
}

###################################
# Supprime les anciens trolls RM du vtt
###################################
function epurerVtt()
{
  global $db_vue_rm;

	echo "Epuration de la table VTT<br>";

	// On sélectionne tous les trolls RelaisMago
	$sql = " SELECT id_troll FROM trolls WHERE guilde_troll=".ID_GUILDE;

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
  } else {
    $i=1;
    while ($rmt = mysql_fetch_assoc($result)) {
      $lesRM[$i][id_troll] = $rmt[id_troll];
      $i++;
    }
  }

	// On sélectionne tous les trolls du VTT
	$sql = " SELECT No FROM vtt";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
  } else {
    $j=1;
    while ($vtt = mysql_fetch_assoc($result)) {
      $lesVtt[$j][No] = $vtt[No];
      $j++;
    }
  }

	$sub_sql_list = "";

	for ($k=1;$k<=count($lesVtt);$k++) {
		$flag=false;
		$id=$lesVtt[$k]['No'];
		
		for ($m=1;$m<=count($lesRM);$m++) {
			if ($lesVtt[$k]['No'] == $lesRM[$m]['id_troll'])
				$flag=true;
		}
		if (!$flag) {
			echo "le Troll $id n'est plus un Relais&Mago<br>";
			$sub_sql_list .= $id." OR No=";
		}
	}
	
	if ($sub_sql_list != "") {
		$sub_sql_list=substr($sub_sql_list,0,strlen($substr)-7);
		$sql = "DELETE FROM vtt";
		$sql .= " WHERE No = $sub_sql_list";
		echo "Epuration du VTT avec : $sql <br>";
		mysql_query($sql,$db_vue_rm);
		echo mysql_error();
	}

}

function update_traitement($code,$etat) {
    global $db_vue_rm ;
    $date=date("Y-m-d H-i-s");
    $sql = "UPDATE traitements SET ";
    $sql .= " date_traitement= '$date', ";
    $sql .= " etat_traitement= '$etat' ";
    $sql .= " WHERE code_traitement='$code'";

    mysql_query($sql,$db_vue_rm);
    echo mysql_error();
}

if (md5($_REQUEST['pass']) == MD5_PASS_EXTERNE) {
	getFilePublicGuildes();
	getGuildeInFile(1);

} else {
	echo "Accès non autorisé<br>";
}
@mysql_close($db_vue_rm);
?>



