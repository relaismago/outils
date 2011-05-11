<?
##################################################################
#                                                                # 
#  Vue publique de la guilde RELAIS&MAGO                         # 
#                                                                # 
#  Ce code source est librement redistribuable et modifiable;    #
#  dans le cadre de la license GPL                               #  
#  que vous trouverez à :                                        #
#             http://clx.anet.fr/spip/article.php3?id_article=7  #
#                                                                #
# Fonctions utilisées par la vue                                 #
#                                                                #
##################################################################
#
# Ce script utilise les fichiers "Public_*.txt" sur
# ftp.mountyhall.com
#$Id: functions.php3,v 1.10 2006/04/29 10:06:49 bodega Exp $

global $TROLL,  $DEV;

include_once("inc_define_vars.php");
include_once("inc_connect.php");
include_once("functions_dev.php");
include_once("admin_functions_db.php");
include_once("functions_image.php");

//require_once("bestiaire2/DB/inc_connect_best.php");
require_once("bestiaire2/DB/inc_initdata.php");
require_once("bestiaire2/Libs/functions.php");

########################## Init des variables. 
# pour éviter qu'elles soit positionnées via l'URL
# et pour les mettre à 0, tout simplement ;-)
#

$X=0; $Y=0; $Z=0; 
unset($trolls); unset($lieux); unset($streums); unset($came);
unset($objetsProches);

if ($TROLL<1) $TROLL=0;

########################## Déclaration des fonctions ##################################


###########################################
# Rafraichi la Bdd avec les scripts publiques de MH
###########################################
function refreshVue($id, $auto=false)
{
	if (strlen($id) == 0) 
		die("refreshVue : Pas d'id de troll");

	global $db_vue_rm, $error, $DEV;

	unset($refresh_by_me);

	if ($DEV) echo "DEBUG refreshVue($id) entré<br>\n";

	$date=date("Y-m-d H-i-s");	
	$date_less_24=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));
	$date_less_10_min=date("Y-m-d H-i-s", mktime(date("H"), date("i")-10, date("s"), date("m")  , date("d"), date("Y")));
	

	if ($_SESSION["AuthTroll"] != $id)
	  $refresh_by_me = "non";
	else
	  $refresh_by_me = "oui";
		
	if ($refresh_by_me == "non") {
		$sql = "SELECT COUNT(*) FROM refresh_count";
		$sql .= " WHERE date_refresh >= '$date_less_24'";
		$sql .= " AND id_troll_refresh = $id";
		$sql .= " AND by_me_refresh = '$refresh_by_me'";
		$sql .= " AND categorie_refresh = 'classiques'";
  	$sql .= " AND script_name_refresh = 'SP_Vue2'";
	
		if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
		$result=mysql_query($sql,$db_vue_rm);

		echo mysql_error();
	
		if (mysql_affected_rows() >0)
		 	list($nb) = mysql_fetch_array($result);
		else
			$nb = 0;
	
		if ($DEV) echo "DEBUG refreshVue() nb refresh par la guilde (autre que par  le troll en question)";
		if ($DEV) echo " en moins de 24 heures : $nb <br>";

		// Si le script public a été utilisé 24 fois en moins de 24 heures, alors on ne continues pas
		if ($nb >=NB_REFRESH_VUE_2D_BY_GUILDE)
			die("La guilde a déjà rafraichit plus de ".NB_REFRESH_VUE_2D_BY_GUILDE." fois en moins de 24 heures");
	}	else {
		/* si c'est le troll lui meme qui met à jour sa vue */
		$sql = "UPDATE trolls set date_last_refresh_manual_troll='$date' WHERE id_troll=$id";
		if ($DEV) echo "DEBUG refreshVue() $sql <br>";
		mysql_query($sql,$db_vue_rm);
		echo mysql_error();
	}

	/* on regarde si la vue n'est pas en cours de refresh */
	$sql = "SELECT date_last_refresh_himself_troll, lock_refresh_troll ";
	$sql .= " FROM trolls ";
	$sql .= " WHERE id_troll=$id";
	$sql .= " AND lock_refresh_troll = 'oui'";
	$sql .= " AND date_last_refresh_himself_troll > '$date_less_10_min'";

  if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result = mysql_query($sql,$db_vue_rm);
	echo mysql_error();
	
	if (mysql_affected_rows() > 0) 
		die("<h1>Un refresh du troll $id est en activité. Attendez 10 min et ré-essayez.</h1>refresh_auto()");

	/* On récupère le mot de passe */
	$sql =" SELECT pass_troll";
	$sql .= " FROM trolls WHERE id_troll=$id";
	
  if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result=mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	if (mysql_affected_rows() > 0) 
		list($passw) = mysql_fetch_array($result); 

	$pass=rawurlencode(stripslashes($passw)); # on "échape" les caractères spéciaux

  /* On vérifie le nombre de fois que le script public à été utilisé en moins de 24 heures */
	$sql = "SELECT COUNT(*) FROM refresh_count";
	$sql .= " WHERE date_refresh >= '$date_less_24'";
	$sql .= " AND id_troll_refresh = $id";
	$sql .= " AND categorie_refresh = 'classiques'";
  $sql .= " AND script_name_refresh = 'SP_Vue2'";
	
	if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result=mysql_query($sql,$db_vue_rm);

	echo mysql_error();
	
	list($nb) = mysql_fetch_array($result);
	
	/* Si le script public a été utilisé NB_REFRESH_VUE_2D_BY_TROLL fois en moins de 24 heures, alors on ne continue pas */
	if ($nb >= NB_REFRESH_VUE_2D_BY_TROLL)
		die("Vous avez utilisé plus de ".NB_REFRESH_VUE_2D_BY_TROLL." fois le script public en moins de 24 heures.");
	
  # Subtilité: par défaut en php, les " et ' sont backslashés. Il faut donc enlever les \
	unset($error);unset($ente);unset($deb);

	if ($DEV) echo "DEBUG refreshVue() http://sp.mountyhall.com/SP_Vue2.php?Numero=$id&Motdepasse=$pass&Tresors=1&Lieux=1&Champignons=1";

	$fp = "http://sp.mountyhall.com/SP_Vue2.php?Numero=$id&Motdepasse=$pass&Tresors=1&Lieux=1&Champignons=1";
	/*if ($fp == FALSE)
		die ("Erreur lors de l'appel du fichier public. Procédure de refresh stoppée");*/
	$vue = html_entity_decode(file_get_contents($fp));	
	
	if ( preg_match( "#.*Erreur 1 : paramètres incorrects .*#", $vue ) )
		die( "<h1 style='color:red;'>Paramètres incorrects</h1><p>Mais... qu'est-ce que vous avez donc tapé ? Envoyez-moi un mail avec vos paramètres, je tenterais de débugguer le truc.</p>");
	
	if ( preg_match( "#.*Erreur 3 : mot de passe incorrect.*#", $vue ) ){
		
		$date=date("Y-m-d H-i-s");
		$tmpfile=fopen ("vues/list_mdp_error.txt","a");
		fwrite($tmpfile,$date.": Troll n° ".$id."\n");
		fclose($tmpfile);
		die("<br><b class=red>Erreur de mot de passe.</b><br>");		
		
	}	
	
	if ( preg_match( "#Erreur (4|5)#", $vue ) )
		die("<h1 style='color:red;'>Erreur du serveur.</h1><p>Il est encore en vrac. Il faudra repasser plus tard	quand les DM l'auront remis enroute...</p>");

	preg_match( "@.*#DEBUT ORIGINE(.*)#FIN ORIGINE.*@s", $vue, $origine );

	list($nCasesVue, $X, $Y, $Z) = explode(";",trim($origine[1]));
		
	$v2 = fopen("vues/$id","w");
	fwrite($v2, $vue);
	
	//fclose($fp);
	fclose($v2);	

	// Le troll doit exister dans la base de données !
	$troll = getTroll($id); 

  // On met à jour le mot de passe du troll car c'est un RM
	if ($troll[6] == ID_GUILDE) {
		$sql = "UPDATE trolls set pass_troll='$pass' WHERE id_troll=$id";
		if ($DEV) echo "DEBUG refreshVue() $sql <br>";
		mysql_query($sql,$db_vue_rm);
		echo mysql_error();
	}

	// On rajoute le fait que le troll à utilisé la vue publique
	// mais on détermine avant si c'est le troll lui-même ou qq'1 d'autre de la guilde
	$date=date("Y-m-d H-i-s");	

	$sql = "INSERT INTO refresh_count";
	$sql .= " (id_troll_refresh, date_refresh, by_me_refresh, categorie_refresh,script_name_refresh)";
	$sql .= " VALUES ($id, '$date','$refresh_by_me','classiques','SP_Vue2')"; 
	
	if ($DEV) echo "DEBUG refreshVue() $sql <br>";
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	// Puis on supprime les accès qui date de plus de 24 heures
	// de toutes les entrées qui sont dans la table refresh_count
	$sql = "DELETE FROM refresh_count";
	$sql .= " WHERE date_refresh <= '$date_less_24'"; 
	
	if ($DEV) echo "DEBUG refreshVue() $sql <br>";
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	if ($DEV) echo "DEBUG : on parse depuis refreshVue <br>";
	
	parseFile2($id,$auto, $X,$Y,$Z,$nCasesVue,"s_public");
	exit;
}

###########################
# Retourne le temps passé depuis un datetime
###########################
function calcElapsedTime($time)
{
	// calculate elapsed time (in seconds!)
	$diff = time()-$time;
	$daysDiff = 0; $hrsDiff = 0; $minsDiff = 0; $secsDiff = 0;

	$sec_in_a_day = 60*60*24;
	while($diff >= $sec_in_a_day){$daysDiff++; $diff -= $sec_in_a_day;}
	$sec_in_an_hour = 60*60;
	while($diff >= $sec_in_an_hour){$hrsDiff++; $diff -= $sec_in_an_hour;}
	$sec_in_a_min = 60;
	while($diff >= $sec_in_a_min){$minsDiff++; $diff -= $sec_in_a_min;}
	$secsDiff = $diff;
	if ($daysDiff<10) { $daysDiff="0$daysDiff"; }
	if ($hrsDiff<10) { $hrsDiff="0$hrsDiff"; }
	if ($minsDiff<10) { $minsDiff="0$minsDiff"; }

	return ($daysDiff.'j '.$hrsDiff.'h'.$minsDiff.'\'');
}


########################################
# Recherche d'un nom de guilde à partir de son ID
# dans les fichiers publics -> cache
########################################
function getGuildeInFile($id)
{
	global $DEV;

	if ($DEV) echo "DEBUG getGuildeInFile($id) entré<br>\n";

  $Id=0;
  $fichguilde=fopen("Public_Guildes.txt","r");
  while (($id>$Id) && ($line = fgets($fichguilde, 1024))) {
    $liste=split (";",$line);
    # list($Id, $nom, $size) = split (";",$line);
    $Id=$liste[0];
  }
  fclose($fichguilde);

  return $liste;
}


##########################################
# Mise à jour de champignon dans la base de données
##########################################
function updateSeenChampi($sub_sql,$sub_sql_list,$sub_sql_update,$date)
{
  global $db_vue_rm, $DEV;
  
	if ($DEV) echo "DEBUG updateSeenChampi() entré <br>\n";

	if ( $sub_sql_list ){
		$sql = "DELETE FROM champignons WHERE";
		$sql .= " id_champi = $sub_sql_list";
		mysql_query($sql,$db_vue_rm);	
		echo mysql_error(); 
	}
	
	if ( $sub_sql ){
		$sql = "INSERT INTO champignons";
		$sql .= " (id_champi, nom_champi, x_champi, y_champi, z_champi, date_champi, is_seen_champi)";
		$sql .= " VALUES $sub_sql";
		mysql_query($sql,$db_vue_rm);	
		echo mysql_error(); 
	}
	
	if ($sub_sql_update) {
		$sql = "UPDATE champignons";
		$sql .= " SET date_champi = '$date', is_seen_champi='oui' ";
		$sql .= " WHERE id_champi = $sub_sql_update";
		if ($DEV) echo "DEBUG updateSeenChampi() UPDATE $sql <br>";
		mysql_query($sql,$db_vue_rm);	
		echo mysql_error(); 		
	}
}


########################################
# Update la position d'un troll
# dans la table objets, ainsi que sa vue
# dans la table trolls
#######################################
function updateSeenTroll($id,$x,$y,$z,$date, $nCasesVue=-1, $malade='-', $auto, $refresh)
{
  global $db_vue_ok, $db_vue_rm, $DEV;

	if ($DEV) echo "DEBUG updateSeenTroll($id,$x,$y,$z,$date, $nCasesVue, $malade) entré<br>";
	$grpspec = 'non';
	if ( userIsGroupSpec() || $auto != "" || $refresh != "" ){
		$sql = "select groupe_spec_troll from trolls WHERE id_troll =$id";
		$query=mysql_query($sql,$db_vue_rm);
		echo mysql_error();
		$res = mysql_fetch_array($query);
		if ($res[0] == 'oui') {
			$grpspec = 'oui';
		}
	}
	
	$sql = "UPDATE trolls SET ";
	if ($nCasesVue != -1)
		$sql .= " vue_troll=$nCasesVue,";
		
	$sql .= " x_troll=$x, y_troll=$y, z_troll=$z, is_seen_troll='oui',";
	$sql .= " date_troll='$date',";
	$sql .= " maj_groupe_spec_troll='$grpspec',";
	$sql .= " malade_troll='$malade' WHERE id_troll =$id";
		
	if ($DEV) echo "DEBUG updateSeenTroll() $sql <br>";
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

}


########################################
# Update ou ajoute la position d'un monstre
# dans la table objets, ainsi que
# son nom dans la tables monstres 
#######################################
function updateSeenStreum($sub_sql, $sub_sql_list)
{
  global $db_vue_rm, $DEV;

 	if ($DEV) echo "DEBUG updateSeenStreum() entré<br>";

	$sql = "DELETE FROM monstres WHERE";
	$sql .= " id_monstre = $sub_sql_list";
	
	if ($DEV) echo "DEBUG updateSeenStreum() $sql <br>";

  mysql_query($sql,$db_vue_rm);	
  echo mysql_error(); 

	$sql = "INSERT INTO monstres (id_monstre, nom_monstre, age_monstre,";
	$sql .= " x_monstre, y_monstre, z_monstre, date_monstre, is_seen_monstre)";
	$sql .= " VALUES $sub_sql";
	
	if ($DEV) echo "DEBUG updateSeenStreum() $sql <br>";

  mysql_query($sql,$db_vue_rm);	
  echo mysql_error(); 
}

#############################################
# Update un Gowap RM
#############################################
function updateGowapRMView($x, $y, $z, $id, $nom, $age ,$date)
{
  global $db_vue_rm, $DEV;

  if ($DEV) echo "DEBUG updateGowapRMView($x, $y, $z, $id, $nom, $age ,$date) entré<br>";

  $sql =" UPDATE monstres";
  $sql .= " SET nom_monstre='".addslashes($nom)."',";
  $sql .= " age_monstre='".addslashes($age)."',";
  $sql .= " x_monstre=$x,";
  $sql .= " y_monstre=$y,";
  $sql .= " z_monstre=$z,";
  $sql .= " date_monstre='$date',";
  $sql .= " is_seen_monstre='oui'";
  $sql .= " WHERE id_monstre=$id";

  if ($DEV) echo "DEBUG updateGowapRMView() $sql <br>";
  mysql_query($sql,$db_vue_rm); 

  if (mysql_affected_rows()==0) {
    $sql = "INSERT INTO monstres(id_monstre, nom_monstre, age_monstre,";
    $sql .= " x_monstre, y_monstre, z_monstre, date_monstre, is_seen_monstre)";
    $sql .= " VALUES($id, '".addslashes($nom)."', '".addslashes($age)."',";
    $sql .= " $x, $y, $z, '$date','oui')";

    if ($DEV) echo "DEBUG updateGowapRMView() $sql <br>";
    mysql_query($sql,$db_vue_rm); 
  }
  echo mysql_error();
}


########################################
# Update ou ajoute la position d'un tresor
# dans la table objets, ainsi que
# son nom dans la tables tresors
#######################################
function updateSeenTresor($sub_sql,$sub_sql_list)
{
	global $db_vue_ok, $db_vue_rm, $DEV;
	
 	if ($DEV) echo "DEBUG updateSeenTresor() entré<br>";

	$sql = "DELETE FROM tresors WHERE";
	$sql .= " id_tresor = $sub_sql_list";

	if ($DEV) echo "DEBUG updateSeenTresor() $sql <br>";

  mysql_query($sql,$db_vue_rm);	
  echo mysql_error(); 

	$sql = "INSERT INTO tresors(id_tresor, nom_tresor, x_tresor, y_tresor, z_tresor, date_tresor)";
	$sql .= " VALUES $sub_sql";

	if ($DEV) echo "DEBUG updateSeenTresor() $sql <br>";
  mysql_query($sql,$db_vue_rm);	
  echo mysql_error();

}


########################################
# Update ou ajoute la position d'un lieu
# dans la table objets, ainsi que
# son nom dans la tables lieux 
#######################################
function updateSeenLieu($sub_sql, $sub_sql_list)
{
	global $db_vue_ok, $db_vue_rm, $DEV;
  	
	if ($DEV) echo "DEBUG updateSeenLieu() entré<br>\n";

	$sql = "DELETE FROM lieux WHERE";
	$sql .= " id_lieu = $sub_sql_list";

	if ($DEV) echo "DEBUG updateSeenLieu() $sql <br>";

  mysql_query($sql,$db_vue_rm);	
  echo mysql_error(); 

	$sql = "INSERT INTO lieux(id_lieu, nom_lieu, x_lieu, y_lieu, z_lieu, date_lieu)";
	$sql .= " VALUES $sub_sql";

	if ($DEV) echo "DEBUG updateSeenLieu() $sql <br>";
  mysql_query($sql,$db_vue_rm);	
  echo mysql_error();
}


#################################
# Update une zone à non vues avant la mise à jour 
# uniquement utiliser pour les trolls et les champi et les monstres
# (pour les gowaps RM)
#################################
function updateDb_zone_to_not_view($type, $miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ, $date )
{
	
	global $db_vue_rm, $DEV;
	
	if ($type == "troll") { $table = "trolls"; }
	if ($type == "monstre") { $table = "monstres"; }
	if ($type == "champi") { $table = "champignons"; }	
	
	$date_less_5d = date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-5, date("Y")));

	// On update tous les Trolls/Monstres/Champignons de la zone comme étant non vus
	// mais uniquement s'ils étaient vus avant.
	$sql = " UPDATE $table";
	$sql .= " SET is_seen_$type='non',";
	$sql .= " date_$type='$date'";
	$sql .= " WHERE";

	$sql .= " (x_$type >= $miniX";
	$sql .= " AND x_$type <= $maxiX";
	$sql .= " AND y_$type >= $miniY";
	$sql .= " AND y_$type <= $maxiY";
	$sql .= " AND z_$type >= $miniZ";
	$sql .= " AND z_$type <= $maxiZ";
	$sql .= " AND is_seen_$type = 'oui')";
	$sql .= " OR (date_$type < '$date_less_5d');";
	
	if ($DEV) echo "DEBUG updateDb_zone_to_not_view() $sql <br>";
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();
	
}

#############################################
# Supprime tous les objets d'une zone avant la mise à jour
#############################################
function deleteDb_zone($type, $miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ, $tabRM="")
{
	global $db_vue_rm, $DEV;

	if ($DEV) echo "Debug deleteDb_zone($type, $miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ, $tabRM) entré <br>"; 
	
	if ($type == "lieu") { $table = "lieux"; $deleteWithDate = false; }
	if ($type == "tresor") { $table = "tresors"; $deleteWithDate = true; }
	if ($type == "monstre") { $table = "monstres"; $deleteWithDate = true; }
	if ($type == "champi") { $table = "champignons"; $deleteWithDate = true; }
	
	$sql = "SELECT id_$type as id FROM $table WHERE";
	$sql .= " (x_$type>=$miniX";
	$sql .= " AND x_$type<=$maxiX";
	$sql .= " AND y_$type>=$miniY";
	$sql .= " AND y_$type<=$maxiY";
	$sql .= " AND z_$type>=$miniZ";
	$sql .= " AND z_$type<=$maxiZ";

	// On ne doit pas supprimer les gowaps RM/tanieres RM
	if ( !empty($tabRM) ) {
		
		if( $type == "monstre")
			foreach( $tabRM  as $gowap )
				if ( is_numeric($gowap["id_gowap"]) )
					$sql .= " AND id_monstre != ".$gowap["id_gowap"];
		
		if ( $type=="lieu" ) 
			foreach( $tabRM  as $taniere )
				if ( is_numeric($taniere["id_taniere"]) )
					$sql .= " AND id_lieu != ".$taniere["id_taniere"];
		
	}
	
	$sql .= ")";
	
	if ( $deleteWithDate ){
		
		$date_less_5d = date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-5, date("Y")));
		
		$sql .= " OR (date_$type < '$date_less_5d'";
		
		if( $type == "monstre")
			foreach( $tabRM  as $gowap )
				if ( is_numeric($gowap["id_gowap"]) )
					$sql .= " AND id_monstre != ".$gowap["id_gowap"];		
		
		$sql .= ")";		
		
	}	

	if ($DEV) echo "Debug deleteDb_zone(): $sql <br>"; 

	$result = mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	$sub_sql = "";
	if ( mysql_num_rows($result)> 0 ){
		
		while ( $res = mysql_fetch_array($result) ) 
			$sub_sql .= "id_$type = ".$res["id"]." OR ";

		$sub_sql = substr($sub_sql,0,-4);
		$sql = "DELETE FROM $table";
		$sql .= " WHERE $sub_sql;";
	
		mysql_query($sql,$db_vue_rm);
		echo mysql_error();
		if ($DEV) echo "Debug deleteDb_zone(): $sql <br>"; 
		
	}
	
}

###########################################
# Recherche d'un troll à partir de son ID
##########################################
function getTroll($id)
{
  global $db_vue_rm, $db_vue_ok, $DEV;

	if ($DEV) echo "DEBUG getTroll($id) entré <br>\n";

  $sql = "SELECT t.id_troll, t.nom_troll, t.race_troll, t.niveau_troll,"; 
  $sql .= " t.nbkills_troll, t.nbdead_troll, t.guilde_troll, t.nbmouches_troll,";
  $sql .= " g.nom_guilde guilde,";
  $sql .= " g.statut_guilde diplomatie, t.vue_troll, UNIX_TIMESTAMP(date_troll) as date_troll,";
	$sql .= " t.is_tk_troll, t.is_wanted_troll, t.is_venge_troll,nom_image_troll,";
	$sql .= " x_troll, y_troll, z_troll";
  $sql .= " FROM trolls t, guildes g";
  $sql .= " WHERE id_troll = $id";
  $sql .= " AND t.guilde_troll = g.id_guilde";

	if ($DEV) echo "DEBUG getTroll() $sql <br>";
  $result=mysql_query($sql,$db_vue_rm);
  echo mysql_error();
  
	return mysql_fetch_array($result);
}


###########################################
# Recherche d'un nom de troll à partir de son ID
##########################################
function getNomTroll($id)
{
  global $db_vue_rm, $db_vue_ok, $DEV;

	if ($DEV) echo "DEBUG getTroll($id) entré <br>\n";

	$sql = "SELECT nom_troll";
	$sql .= " FROM trolls";
	$sql .= " WHERE id_troll = $id;";


	$result=mysql_query($sql,$db_vue_rm);
 	$row = mysql_fetch_array($result);
	
	return $row['nom_troll'];
	
}


##################################
# Affichage de la liste des trolls qui ont demandé leur vue
# dans une liste déroulante (définie en dehors)
# On recherche tous les trolls dans la base de données.
##################################
function showListeCache($id_troll="",$hidden=false)
{
  global $db_vue_rm, $TROLL, $AuthGuilde;

	$sql = "SELECT id_troll, nom_troll, x_troll, y_troll, z_troll,nom_image_troll";
	$sql .= " FROM trolls";
	$sql .= " WHERE guilde_troll=".ID_GUILDE;
	$sql .= " ORDER BY nom_troll";
	
  $result=mysql_query($sql, $db_vue_rm);
  echo mysql_error();
 	
	if ($id_troll == -1) $sel="selected";
  echo "<option value='-1' $sel></option>";

 	if ($hidden)
 		$input_hidden .= "<input type='hidden' name='-1' id='-1' value='|||| '> ";

	if (mysql_num_rows($result)>0) {
		while ($troll = mysql_fetch_array($result)) {
			if ($troll[id_troll] == $id_troll) $selected = "selected";
			else $selected="";

			echo "<option value='$troll[id_troll]' $selected>";
			echo htmlentities(stripslashes($troll[nom_troll]));
			echo " ($troll[id_troll])</option>\n";
			
			if ($hidden)
	  		$input_hidden .= "<input type='hidden' name='$troll[id_troll]' id='$troll[id_troll]' ";
				$input_hidden .= "value='$troll[x_troll]|$troll[y_troll]|$troll[z_troll]|$troll[id_troll]|$troll[nom_image_troll]'>\n";
		}
	}
	if ($hidden)
		return $input_hidden;
}


function updateQuadrillage($maj_troll_id,$miniX,$maxiX,$miniY,$maxiY,$miniZ,$maxiZ,$date)
{
	global $db_vue_rm;

	$sql = "DELETE FROM quadrillage";
	$sql .= " WHERE id_troll_quad = $maj_troll_id";
				
	if ($DEV) echo "Debug updateQuadrillage : $sql <br>"; 
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	$sql = "INSERT INTO quadrillage (";
	$sql .=	"id_troll_quad,x_min_quad, x_max_quad, y_min_quad, y_max_quad, ";
	$sql .= "z_min_quad, z_max_quad, last_seen_quad) ";
	$sql .= "VALUES ($maj_troll_id,$miniX,$maxiX,$miniY,$maxiY,$miniZ,$maxiZ,'$date')";

	if ($DEV) echo "Debug updateQuadrillage : $sql <br>"; 
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

}

#############################################
# Ce fonction permet de paser une zone donnée
# à partir de la base de données !
# on doit resortir avec les array : $trolls, $streums, $lieux, $came, $champi de remplis! 
#############################################
function parseZone($id_troll,$cX='',$cY='',$cZ='',$nCasesVue='', $taille_distance_pa="",$trolls_disparus)
{
	global $db_vue_rm;
	global $DEV, $quadrillage, $quadrillage_delai_max ;

	if ($DEV) echo "DEBUG parseZone($id_troll,$cX,$cY,$cZ,$nCasesVue,$taille_distance_pa,$trolls_disparus) entré<br>\n";

	if ( ($taille_distance_pa == "") || ($nCasesVue > $taille_distance_pa) ){
		$taille = $nCasesVue;
	} else {
		$taille = $taille_distance_pa;
	}

	if ($cZ=='') {
		$sql = "SELECT x_troll, y_troll, z_troll, maj_groupe_spec_troll";
		$sql .= " FROM trolls";
		$sql .= " WHERE id_troll=$id_troll";

		if ($DEV) echo "DEBUG parseZone() $sql <br>";
		$res=mysql_query($sql, $db_vue_rm);
		echo mysql_error();

		if ($res!='')
			list($X,$Y,$Z,$grpspec)=mysql_fetch_array($res);
		if ($DEV) echo "DEBUG parseZone() Le troll à la position $X,$Y,$Z<br>\n";
		if ($grpspec=='oui' && !userIsGroupSpec()){
			$X=0;
			$Y=0;
			$Z=0;
		}
	} else { 
		$X=$cX;
		$Y=$cY;
		$Z=$cZ;
	}

	$miniX=$X-$taille;
	$maxiX=$X+$taille;
	$miniY=$Y-$taille;
	$maxiY=$Y+$taille;
	$miniZ=$Z-ceil($taille/2);
	$maxiZ=$Z+ceil($taille/2);

	$miniXv=$X-$nCasesVue;
	$maxiXv=$X+$nCasesVue;
	$miniYv=$Y-$nCasesVue;
	$maxiYv=$Y+$nCasesVue;
	$miniZv=$Z-ceil($nCasesVue/2);
	$maxiZv=$Z+ceil($nCasesVue/2);

	/* Brouillard de guerre */
	#$sql = "SELECT id_troll_quad, UNIX_TIMESTAMP(last_seen_quad) last_seen_quad, ";
	#$sql .= " TO_DAYS(NOW()) - TO_DAYS(last_seen_quad) delais, x_min_quad, x_max_quad, y_min_quad,";
	#$sql .= " y_max_quad ,	z_min_quad ,	z_max_quad";
	#$sql .= " FROM quadrillage";
	#$sql .= " WHERE ";
	#$sql .= " x_min_quad <= $maxiX";
	#$sql .= " AND x_max_quad >= $miniX";
	#$sql .= " AND y_min_quad <= $maxiY";
	#$sql .= " AND y_max_quad >= $miniY";
	#$sql .= " AND z_min_quad <= $maxiZ";
	#$sql .= " AND z_max_quad >= $miniZ";

	#if ($DEV) echo "DEBUG parseZone() QUADRILLAGE $sql <br>";

	#$res=mysql_query($sql, $db_vue_rm);
	#echo mysql_error();
	
	#if ($nCasesVue <= 10)	{
#		while ($objet = mysql_fetch_assoc($res)) {
#			for ($i=$miniXv; $i<=$maxiXv; $i++) {
#				for ($j=$miniYv; $j<=$maxiYv; $j++) {
#					for ($k=$miniZv; $k<=$maxiZv; $k++) {
#						$flag = false;
#	
#						if ( ($objet['x_min_quad'] <= $i) &&  ($objet['x_max_quad'] >= $i)
#							 &&($objet['y_min_quad'] <= $j) &&  ($objet['y_max_quad'] >= $j)
#							 &&($objet['z_min_quad'] <= $k) &&  ($objet['z_max_quad'] >= $k) 
#							 )
#					  {
#					
#								if ($quadrillage[$i][$j][$k]['delais'] == "") {
#									$flag = true;
#								} elseif ($quadrillage[$i][$j][$k]['last_seen'] <= $objet['last_seen_quad']) {
#									$flag = true;
#								}
#								if ($flag) {
#									$quadrillage[$i][$j][$k]['delais'] = $objet['delais'];
#									$quadrillage[$i][$j][$k]['last_seen'] = $objet['last_seen_quad'];
#									$quadrillage[$i][$j][$k]['id_troll'] = $objet['id_troll_quad'];
#								}
#						 }
#					}
#				}	
#			}
#		}
#	}

  # TROLLS
	$date_less_5days=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-5, date("Y")));
	// statut_guilde 'neutre','tk','ennemie','amie','alliée'
	$sql = "SELECT x_troll, y_troll, z_troll, ";
	$sql .= " id_troll, nom_troll, race_troll, niveau_troll, guilde_troll,";
	$sql .= " malade_troll, nom_guilde, statut_guilde,";
	$sql .= " is_tk_troll, is_wanted_troll, is_seen_troll, UNIX_TIMESTAMP(date_troll) as date_troll";
	$sql .= " FROM trolls,guildes";
	$sql .= " WHERE x_troll >= $miniX";
	$sql .= " AND x_troll <= $maxiX";
	$sql .= " AND y_troll >= $miniY";
	$sql .= " AND y_troll <= $maxiY";
	$sql .= " AND z_troll >= $miniZ";
	$sql .= " AND z_troll <= $maxiZ";
	$sql .= " AND guilde_troll = id_guilde";
	if ($trolls_disparus == "oui") {
		$sql .= " AND (is_seen_troll = 'oui'";
		$sql .= " OR (is_seen_troll = 'non' AND date_troll >'$date_less_5days'))";
	} else {
		$sql .= " AND is_seen_troll = 'oui'";
	}
	/*if (!userIsGroupSpec()){
		$sql .= " AND maj_groupe_spec_troll <> 'oui'";
	}*/

	if ($DEV) echo "DEBUG parseZone() TROLLS $sql <br>";
	$res=mysql_query($sql, $db_vue_rm);
	echo mysql_error();

	while (list($tX, $tY, $tZ, $tId, $nom, $race, $level, 
							$IdGuilde, $malade,
							$nom_guilde, $diplomatie, $is_tk, $is_wanted, $is_seen, $date_troll)=mysql_fetch_array($res))
	{
    if ($malade == '-')
			$malade = "";

    $distance_pa = calcPA($X,$Y,$Z,$tX,$tY,$tZ);

		$objet=array(id => $tId, nom=>$nom, z => $tZ, race => $race, 
								 level => $level, guilde => $nom_guilde, x => $tX, y => $tY, 
								 tk => $is_tk, wanted => $is_wanted, malade => $malade, 
								 diplomatie => $diplomatie, guilde_troll => $IdGuilde, is_seen => $is_seen,
								 date_troll => $date_troll, distance_pa => $distance_pa );

		$trolls[$tX+100][$tY+100][]=$objet;
	}

  # STREUMS 
	$sql = "SELECT x_monstre, y_monstre, z_monstre, ";
	$sql .= " id_monstre, nom_monstre";
	$sql .= " FROM monstres";
	$sql .= " WHERE x_monstre	 >= $miniX";
	$sql .= " AND x_monstre <= $maxiX";
	$sql .= " AND y_monstre >= $miniY";
	$sql .= " AND y_monstre <= $maxiY";
	$sql .= " AND z_monstre >= $miniZ";
	$sql .= " AND z_monstre <= $maxiZ";
	$sql .= " AND is_seen_monstre = 'oui'";
	
	if ($DEV) echo "DEBUG parseZone() MONSTRES $sql <br>";
	$res=mysql_query($sql, $db_vue_rm);
	echo mysql_error();

	while (list($mX, $mY, $mZ, $mId, $mNom)=mysql_fetch_array($res))
	{
		unset($monstre);

		$mNom = stripslashes(stripslashes($mNom));
		$tab = getInfoFromMonstre($mNom);
		$monstre[famille] = $tab['famille'];
		$monstre[race] = $tab['race'];
		$monstre[niveau] = $tab['niv']; // niveau estimé

		$infos_monstre = $tab;
			$caracs_moyennes = SelectCaracMoyMonstre($tab['id_race'],$tab['id_template'],$tab['id_age']);

			//if($caracs_moyennes['niv']!='?' && $caracs_moyennes['niv']!='') 
			//	$monstre[niveau]=$caracs_moyennes['niv']; // niveau calculé
			//else
			//	$monstre[niveau] = $tab['niv']; // niveau estimé / Juste pour info ici

			$tab_cdm = "";	
			$monstre[connu] = 'non';

			if (( $infos_monstre[id_template] != "" ) && ($infos_monstre[id_age] != "") ) {
				$tab_cdm = SelectCdMs($infos_monstre[race],$infos_monstre[id_template],$infos_monstre[id_age],"-1","-1", true);

				if (count($tab_cdm) > 0)
					$monstre[connu] = 'oui';

				if ($taille <= 15) {
					$monstre[tab_cdm] = $tab_cdm;
					$capacites_speciales = SelectCapSpe($tab['id_race'],$tab['id_template'],$tab['id_age']);
				}
			}


		$id_troll_gowap="";
		$nom_troll="";

		// On regarde si le monstre est un gowap de la guilde
		if (preg_match("/Gowap/",$mNom)) {

			$sql = " SELECT nom_troll, id_troll_gowap";
			$sql .= " FROM gowaps, trolls";
			$sql .= " WHERE id_troll_gowap = id_troll";
			$sql .= " AND id_gowap = $mId";
			
			if ($DEV) echo "DEBUG MONSTRES $sql <br>";
			$result2=mysql_query($sql,$db_vue_rm);
			echo mysql_error();
	
			if (mysql_num_rows($result2)>0) {
				$res2 = mysql_fetch_assoc($result2);
				$id_troll_gowap= $res2[id_troll_gowap];
				$nom_troll= $res2[nom_troll];
			}		
		}

		// On regarde si le monstre est recherché (composant)
		$recherche = "";
		
		$sql = " SELECT id_composant, priorite_composant, id_race_composant";
		$sql .= " FROM composants";
		$sql .= " WHERE id_race_composant = '".addslashes($monstre[race])."'";
		
		if ($DEV) echo "DEBUG MONSTRES $sql <br>";
		$result2=mysql_query($sql,$db_vue_rm);
		echo mysql_error();
		if (mysql_num_rows($result2)>0) {
			$res2 = mysql_fetch_assoc($result2);
			$recherche = $res2[priorite_composant];
		}
		
		$distance_pa = calcPA($X,$Y,$Z,$mX,$mY,$mZ);

		$objet=array(id => $mId, 
								 nom=>$mNom, 
								 z => $mZ, 
							 	 x => $mX,
								 y => $mY, 
								 race => $monstre[race], 
								 famille => $monstre[famille], 
								 niveau => $monstre[niveau],
								 connu => $monstre[connu],
								 recherche => $recherche,
								 id_troll_gowap => $id_troll_gowap,
								 nom_troll => $nom_troll,
								 infos_monstre => $infos_monstre,
								 caracs_moyennes => $caracs_moyennes,
								 capacites_speciales => $capacites_speciales,
								 tab_cdm => $monstre[tab_cdm],
								 distance_pa => $distance_pa);
								 
		$streums[$mX+100][$mY+100][]=$objet;
	}
  
  # Mythiques
  	
  	$sql = "SELECT x_monstre, y_monstre, z_monstre, ";
	$sql .= " id_monstre, nom_monstre";
	$sql .= " FROM monstres, best_races";
	$sql .= " WHERE nom_monstre like CONCAT('%',nom_race,'%')";
	$sql .= " AND commentaire like 'Mythique'";
	$sql .= " AND is_seen_monstre = 'oui'";
	
	if ($DEV) echo "DEBUG parseZone() MYTHIQUES $sql <br>";
	$res=mysql_query($sql, $db_vue_rm);
	echo mysql_error();
	
	while (list($oX, $oY, $oZ, $oId, $oNom )=mysql_fetch_array($res))
	{

		$distance_pa = calcPA($X,$Y,$Z,$oX,$oY,$oZ);

		$objet=array(id => $oId, 
								 nom=>$oNom, 
								 z => $oZ, 
							 	 x => $oX,
								 y => $oY,
								 distance_pa => $distance_pa);
								 
		$mythiques[$oX+100][$oY+100][]=$objet;
	}
	
  # CAME
	$sql = "SELECT x_tresor, y_tresor, z_tresor, ";
	$sql .= " id_tresor, nom_tresor";
	$sql .= " FROM tresors";
	$sql .= " WHERE x_tresor >= $miniX";
	$sql .= " AND x_tresor <= $maxiX";
	$sql .= " AND y_tresor >= $miniY";
	$sql .= " AND y_tresor <= $maxiY";
	$sql .= " AND z_tresor >= $miniZ";
	$sql .= " AND z_tresor <= $maxiZ";
	
	if ($DEV) echo "DEBUG parseZone() TRESOR $sql <br>";
	$res=mysql_query($sql, $db_vue_rm);
	echo mysql_error();

	while (list($oX, $oY, $oZ, $oId, $oNom )=mysql_fetch_array($res))
	{

		$distance_pa = calcPA($X,$Y,$Z,$oX,$oY,$oZ);

		$objet=array(id => $oId, 
								 nom=>$oNom, 
								 z => $oZ, 
							 	 x => $oX,
								 y => $oY,
								 distance_pa => $distance_pa);
								 
		$came[$oX+100][$oY+100][]=$objet;
	}
	
  # LIEUX
	$sql = "SELECT x_lieu, y_lieu, z_lieu,";
	$sql .= " id_lieu, nom_lieu";
	$sql .= " FROM lieux";
	$sql .= " WHERE x_lieu >= $miniX";
	$sql .= " AND x_lieu <= $maxiX";
	$sql .= " AND y_lieu >= $miniY";
	$sql .= " AND y_lieu <= $maxiY";
	$sql .= " AND z_lieu >= $miniZ";
	$sql .= " AND z_lieu <= $maxiZ";
	
	if ($DEV) echo "DEBUG parseZone() LIEU $sql <br>";
	$res=mysql_query($sql, $db_vue_rm);
	echo mysql_error();

	while (list($lX, $lY, $lZ, $lId, $lNom )=mysql_fetch_array($res))
	{
		$id_info = ""; 
		$nom_info = "";
		$statut_info = "";
		$type_info = "";

		// On regarde si la taniere est une tanière de la guilde
		//		if (preg_match("/Tani.re de/",$lNom)) {
		if (preg_match("/.*\((\d+)\)/",$lNom,$match)) {
			if (is_numeric($match[1])) {
				$sql = " SELECT nom_guilde, statut_guilde";
				$sql .= " FROM guildes";
				$sql .= " WHERE id_guilde = $match[1]";
	
				$result2=mysql_query($sql,$db_vue_rm);
				echo mysql_error();
		
				if (mysql_num_rows($result2)>0) {
					$res2 = mysql_fetch_assoc($result2);
					$id_info = $match[1];
					$nom_info = $res2[nom_guilde];
					$statut_info = $res2[statut_guilde];
					if ($match[1] == ID_GUILDE )	
						$statut_info = "guilde";
					else
						$statut_info = $res2[statut_guilde];
					$type_info = "guilde";
				}		
			}
		}

		// Recherche du statut dans les trolls
		if (preg_match("/Tani.re de .*\((\d+)\)/",$lNom,$match)) {
			if (is_numeric($match[1])) {
				$sql = " SELECT nom_troll, id_troll, statut_troll, statut_guilde";
				$sql .= " FROM trolls, guildes";
				$sql .= " WHERE id_troll = $match[1]";
				$sql .= " AND guilde_troll = id_guilde";
	
				$result2=mysql_query($sql,$db_vue_rm);
				echo mysql_error();
		
				if (mysql_num_rows($result2)>0) {
					$res2 = mysql_fetch_assoc($result2);
					$id_info = $res2[id_troll];
					$nom_info = $res2[nom_troll];
					if ($res2[statut_troll] != "")
						$statut_info = $res2[statut_troll];
					else
						$statut_info = $res2[statut_guilde];
					$type_info = "troll";
				}		
			}
		}
		
		// Recherche dans les tanières de guildes
		if (preg_match("/Tani.re de/",$lNom)) {

			$sql = " SELECT nom_troll, id_troll_taniere";
			$sql .= " FROM tanieres, trolls";
			$sql .= " WHERE id_troll_taniere = id_troll";
			$sql .= " AND id_taniere = $lId";

			if ($DEV) echo "DEBUG LIEUX tanieres  $sql <br>";
			$result2=mysql_query($sql,$db_vue_rm);
			echo mysql_error();
	
			if (mysql_num_rows($result2)>0) {
				$res2 = mysql_fetch_assoc($result2);
				$id_info = $res2[id_troll_taniere];
				$nom_info = $res2[nom_troll];
				$statut_info = "guilde";
				$type_info = "troll";
			}		
		}

		$distance_pa = calcPA($X,$Y,$Z,$lX,$lY,$lZ);

		$objet=array(id => $lId, 
								 nom=>$lNom, 
								 z => $lZ, 
							 	 x => $lX,
								 y => $lY,
								 id_info => $id_info,
								 nom_info => $nom_info,
								 statut_info => $statut_info,
								 is_guilde => $is_guilde,
								 type_info => $type_info,
								 distance_pa => $distance_pa
								 );

		$lieux[$lX+100][$lY+100][]=$objet;
	}

  # CHAMPIGNONS
	$sql = "SELECT x_champi, y_champi, z_champi,";
	$sql .= " id_champi, nom_champi";
	$sql .= " FROM champignons";
	$sql .= " WHERE x_champi >= $miniX";
	$sql .= " AND x_champi <= $maxiX";
	$sql .= " AND y_champi >= $miniY";
	$sql .= " AND y_champi <= $maxiY";
	$sql .= " AND z_champi >= $miniZ";
	$sql .= " AND z_champi <= $maxiZ";
	$sql .= " AND is_seen_champi ='oui'";

	if ($DEV) echo "DEBUG parseZone() CHAMPI $sql <br>";
	$res=mysql_query($sql, $db_vue_rm);
	echo mysql_error();

	while (list($cX, $cY, $cZ, $cId, $cNom )=mysql_fetch_array($res))
	{
		$objet=array(id => $cId, 
								 nom=>$cNom, 
								 z => $cZ, 
							 	 x => $cX,
								 y => $cY);
								 
    $champi[$cX+100][$cY+100][]=array(id => $cId, nom => $cNom, z => $cZ);
	}

  # BARONNIES
  /*
	$sql = "SELECT x_deb_baronnie, y_deb_baronnie, z_deb_baronnie,";
	$sql .= " x_fin_baronnie, y_fin_baronnie, z_fin_baronnie,";
	$sql .= " x_trone_baronnie, y_trone_baronnie, z_trone_baronnie,";
	$sql .= " nom_baronnie, id_baron_baronnie, id_baronnie,nom_troll as nom_baron, ";
	$sql .= " img_drapeau_baronnie, img_mini_blason_baronnie";
	$sql .= " FROM baronnies,trolls";
	$sql .= " WHERE x_fin_baronnie >= $miniX";
	$sql .= " AND x_deb_baronnie <= $maxiX";
	$sql .= " AND y_fin_baronnie >= $miniY";
	$sql .= " AND y_deb_baronnie <= $maxiY";
	$sql .= " AND z_fin_baronnie >= $miniZ";
	$sql .= " AND z_deb_baronnie <= $maxiZ";
	$sql .= " AND id_troll = id_baron_baronnie";

	if ($DEV) echo "DEBUG parseZone() BARONNIE $sql <br>";
	$res=mysql_query($sql, $db_vue_rm);
	echo mysql_error();

	while (list(
				$x_deb_baronnie, $y_deb_baronnie, $z_deb_baronnie,
				$x_fin_baronnie, $y_fin_baronnie, $z_fin_baronnie,
				$x_trone_baronnie, $y_trone_baronnie, $z_trone_baronnie,
				$nom_baronnie, $id_baron_baronnie, $id_baronnie, $nom_baron,
				$img_drapeau_baronnie, $img_mini_blason_baronnie
	 			)=mysql_fetch_array($res))
	{

		$distance_pa = calcPA($X,$Y,$Z,$x_trone_baronnie,$y_trone_baronnie,$z_trone_baronnie);

		$objet=array(
				x_deb_baronnie=>$x_deb_baronnie, y_deb_baronnie=>$y_deb_baronnie, z_deb_baronnie=>$z_deb_baronnie,
				x_fin_baronnie=>$x_fin_baronnie, y_fin_baronnie=>$y_fin_baronnie, z_fin_baronnie=>$z_fin_baronnie,
				x_trone_baronnie=>$x_trone_baronnie, y_trone_baronnie=>$y_trone_baronnie, z_trone_baronnie=>$z_trone_baronnie,
				nom_baronnie=>$nom_baronnie, id_baron_baronnie=>$id_baron_baronnie, id_baronnie=>$id_baronnie,
				nom_baron=>$nom_baron, img_drapeau_baronnie=>$img_drapeau_baronnie, 
				img_mini_blason_baronnie=>$img_mini_blason_baronnie,
				distance_pa=>$distance_pa
		);
								 
    $baronnies[$x_trone_baronnie+100][$y_trone_baronnie+100][]=$objet;
	}
    */
	/* On retourne la position et le numéro */
	$tab[t_quadrillage] = $quadrillage;
	$tab[t_trolls] = $trolls;
	$tab[t_monstres] = $streums;
	$tab[t_mythiques] = $mythiques;
	$tab[t_lieux] = $lieux;
	$tab[t_tresors] = $came;
	$tab[t_champignons] = $champi;
	//$tab[t_baronnies] = $baronnies;
	$tab[max_pa] = $taille_distance_pa;
	$tab[taille_vue] = $nCasesVue;
	$tab[x_position] = $X;
	$tab[y_position] = $Y;
	$tab[z_position] = $Z;
	$tab[trolls_disparus] = $trolls_disparus;
	if ($id_troll !="")
		$tab[myTroll]=getTroll($id_troll);

	return $tab;
}


function parseFile2($TROLL,$auto, $cX='',$cY='',$cZ='',$taille='',$refresh)
{
	global $lt,$lm, $ll, $lc, $lo, $trolls, $champi, $came;
	global $streums, $lieux, $nCasesVue, $X, $Y, $Z, $db_vue_rm ;
	global $DEV, $date, $quadrillage;
	
	if ($DEV) echo "DEBUG parseFile($TROLL,$auto,$cX,$cY,$cZ,$taille) entré<br>\n";

	$vert = "<b><font color=gree>Fait</font></b>  ";

	$date=date("Y-m-d H-i-s");	
	$date_less_5_min=date("Y-m-d H-i-s", mktime(date("H"), date("i")-5, date("s"), date("m")  , date("d"), date("Y")));

	/* on regarde si la vue n'est pas en cours de refresh */
	$sql = "SELECT date_last_refresh_himself_troll, lock_refresh_troll ";
	$sql .= " FROM trolls ";
	$sql .= " WHERE id_troll=$TROLL";
	$sql .= " AND lock_refresh_troll = 'oui'";
	$sql .= " AND date_last_refresh_himself_troll > '$date_less_5_min'";

  if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result=mysql_query($sql,$db_vue_rm);
	echo mysql_error();
	
	/* on place le lock dans la base et la datetime */
	$sql = "UPDATE trolls SET ";
	$sql .= " date_last_refresh_himself_troll='$date', ";
	$sql .= " lock_refresh_troll='oui' ";
	$sql .= " WHERE id_troll=$TROLL";
	if ($DEV) echo "DEBUG parseFile2() $sql <br>";

	mysql_query($sql,$db_vue_rm);
	echo mysql_error();
	
	if (!$auto) {
//		ob_end_flush();
		echo "<center>";
		echo "<br><br><h1>Mise à jour du vue en cours </h1><br>";
		echo "<h1><font color=red><b>Ne fermez pas votre navigateur</b></font></h1>";
	
		echo "Fichier Récupéré $vert<br>";
		echo "Mise à jour de la base en cours<br>";
		echo "</center>";
/*		flush();
		ob_flush();*/
	}

	if (file_exists("vues/$TROLL")) {
		if ($cZ=='') {
			die('ERREUR PARSEFILE 1 contactez Bodga');
		} elseif ($taille=='') {
			die('ERREUR PARSEFILE 2 contactez Bodega');
		} else {
			$X=$cX;
			$Y=$cY;
			$Z=$cZ;
			$taille=$taille; // Pour info uniquement ! :)
		}

		if ($DEV) echo "DEBUG parseFile X=$X Y=$Y Z=$Z taille=$taille<br>";

		setlocale(LC_ALL, "fr_FR");
		$mtime=filemtime("vues/$TROLL");
		$date=date ("Y-m-d H-i-s", $mtime);
		// On va pas prendre la date du fichier public qui
		// n'est pas mis à jour en cas de DEV = TRUE
		// il faut donc changer la $date !
		if ($DEV) {$date=date("Y-m-d H-i-s");echo "DEBUG DEV parseFile() : changement de date=$date";}

		$miniX=$X-$taille;
		$maxiX=$X+$taille;
		$miniY=$Y-$taille;
		$maxiY=$Y+$taille;
		$miniZ=$Z-ceil($taille/2);
		$maxiZ=$Z+ceil($taille/2);

		if ($DEV) echo "DEBUG parseFile minX=$miniX, maxX=$maxiX, minY=$miniY, maxY=$maxiY, minZ=$miniZ, maxZ=$maxiZ<br>";
		
		updateDb_zone_to_not_view('troll',$miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ, $date );
		
		// puis pour les monstres, mais c'est utile que Pour les gowaps RM
		// On met tous les monstres à non vus sur la zone (gowaps et les autres compris)
		// sachant qu'ensuite la table monstres verra tous les monstres, sauf les gowaps RM) de supprimés de 
		// la zone
		updateDb_zone_to_not_view('monstre',$miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ, $date );

		$lesGowaps = selectDbGowaps();

		$lesTanieres = selectDbTanieres();

		deleteDb_zone('monstre',$miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ, $lesGowaps);
		deleteDb_zone('tresor',$miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ);
		deleteDb_zone('champi',$miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ);
		deleteDb_zone('lieu',$miniX, $maxiX, $miniY, $maxiY, $miniZ, $maxiZ, $lesTanieres);
			
		$lien = "sequence_refresh.php?auto=$auto&state=1&maj_troll_id=$TROLL&refresh=$refresh";
		$_SESSION['state'] = 1;
		if (!$auto) {
			echo "<script language='JavaScript'>";
			echo "document.location.href='$lien'";
			echo "</script>";
			echo "<a href='$lien'>Cliquez ici si vous ne passez pas à la page suivante automatiquement</a>";
		} else {
			header("Location:$lien");
		}
	} else {
		echo "Erreur Survenue. Avez-vous bien copié toute votre vue depuis MH (Ctrl+A) ?<br>";
		echo "Si oui, contactez Bodéga pour voir ce qu'il se passe.<br>";
	}
}

function maj_vue_refresh($auto,$state,$maj_troll_id,$refresh)
{
	global $db_vue_rm;

	$_SESSION['state'] .= " EN= $state ";
	setlocale(LC_ALL, "fr_FR");

	if ($state == 71)
		return ;
	
	$mtime=filemtime("vues/$maj_troll_id");
	$date=date ("Y-m-d H-i-s", $mtime);
	$view = fopen("vues/$maj_troll_id","r");
	
	if (!file_exists("vues/$maj_troll_id"))
		die ("Erreur : PAS DE FICHIER state=$state. Veuillez signaler cette erreur à glupglup. $_SESSION[state] Merci <br>");


  while ( $line = fgets($view, 1024) ) {
		# On parcourt le script
		$line=chop($line);
		if ($DEV) echo "DEBUG parseFile <br>$state : $line <br>";

		if ($line == "#FIN") {
			die('ERREUR maj_vue_refresh() prévenir Bodéga');
			$state=100;
		} elseif (preg_match("/^#COPYPASTE (.*)/",$line,$parts)) {
			//echo "<b class=red>Généré par un copier coller par $parts[1]</b><br>";
		} elseif (($line == "#DEBUT TROLLS") && ($state < 20)) {
			$state=20;
		} elseif (($line == "#FIN TROLLS")  && ($state < 21)){
			$state=21;
			break; // next séquence
		} elseif (($line == "#DEBUT MONSTRES") && ($state == 21)) {
			$sub_sql_streum = "";
			$sub_sql_streum_del = "";
			$nb_streum = 0;
			$state=30;
		} elseif (($line == "#FIN MONSTRES") && ($state == 30))  {
			if ($sub_sql_streum != "") {
				$sub_sql_streum=substr($sub_sql_streum,0,strlen($substr)-1);
				$sub_sql_streum_list_id=substr($sub_sql_streum_list_id,0,strlen($substr)-15);
				updateSeenStreum($sub_sql_streum,$sub_sql_streum_list_id);
			}
			$state=31;
			break;// next séquence
		} elseif (($line == "#DEBUT TRESORS") && ($state == 31)){
			$sub_sql_tresor = "";
			$sub_sql_tresor_del = "";
			$nb_tresor = 0;
			$state=40;
		} elseif (($line == "#FIN TRESORS")  && ($state == 40)){
			if ($sub_sql_tresor != "") {	
				$sub_sql_tresor=substr($sub_sql_tresor,0,strlen($substr)-1);
				$sub_sql_tresor_list_id=substr($sub_sql_tresor_list_id,0,strlen($substr)-14);
				updateSeenTresor($sub_sql_tresor,$sub_sql_tresor_list_id);
			}
			$state=41;
			break;// next séquence
		} elseif (($line == "#DEBUT LIEUX") && ($state == 41)){ 
			$sub_sql_lieux = "";
			$sub_sql_lieux_del = "";
			$state=50;
		} elseif (($line == "#FIN LIEUX")  && ($state == 50)){      
			if ($sub_sql_lieux != "") {	
				$sub_sql_lieux=substr($sub_sql_lieux,0,strlen($substr)-1);
				$sub_sql_lieux_list_id=substr($sub_sql_lieux_list_id,0,strlen($substr)-12);
				updateSeenLieu($sub_sql_lieux,$sub_sql_lieux_list_id);
			}
			$state=51;
			break;// next séquence
		} elseif (($line == "#DEBUT CHAMPIGNONS" ) && ($state == 51)){ 
			$sub_sql_champi="";
			$sub_sql_champi_list_id="";
			$state=60;
		} elseif (($line == "#FIN CHAMPIGNONS" ) && ($state == 60)){   
			if ( ($sub_sql_champi != "") ||	
		       ($sub_sql_champi_update != "") ) {	
				$sub_sql_champi = substr($sub_sql_champi,0,strlen($substr)-1);
				$sub_sql_champi_list_id = substr($sub_sql_champi_list_id,0,strlen($substr)-15);			
				$sub_sql_champi_update = substr($sub_sql_champi_update,0,strlen($substr)-15);
				updateSeenChampi($sub_sql_champi,$sub_sql_champi_list_id,$sub_sql_champi_update,$date);
			}
			$state=61;
		} elseif (($line == "#DEBUT ORIGINE")  && ($state == 61)) {
			$state=70;
		} elseif (($line == "#FIN ORIGINE") && ($state == 70)) {
			$state=71;
		} elseif (strpos($line,"Erreur 3")!=false) {
			echo "<br><b class=red>Erreur de mot de passe.</b><br>";
			echo "Ressaisissez votre mot de passe en cochant la case \"Rafraîchir\"";
			echo "pour tenter une nouvelle récupération.<br>\n";
			break;
    } elseif (preg_match("/Erreur (4|5)/",$line)) {
			echo "<br><b class=red>Erreur du serveur MounthyHall.</b><br>";
			echo "Il est encore en vrac. Il faudra repasser plus tard, ";
			echo "quand les DM l'auront remis en route...<br>\n";
			break;
    } elseif (strpos($line,"Erreur 1")!=false) {
			echo "<br><b class=red>Paramètres incorrects</b><br>";
			echo "Mais... qu'est-ce que vous avez donc tapé ? ";
			echo "Envoyez-moi un mail avec vos paramètres, je tenterais de débugguer le truc.<br>\n";
			break;
    } else { # Datas
      $line=preg_replace('/"/',"\"",$line);
  
			switch ($state) {
			# TROLLS
				case 20: 
					list($tId, $tX, $tY, $tZ, $malade) = split (";",$line);
					updateSeenTroll($tId,$tX,$tY,$tZ,$date,-1,$malade,$auto,$refresh);
					break;

			 # STREUMS 
				case 30:
					list($mId, $nom, $mX, $mY, $mZ) = split (";",$line);

					preg_match("/(.+)? \[(.+)\]/",$nom,$resultat);
					$nom_streum = $resultat[0];
					$age_streum = $resultat[1];

					$isGowapRm = false;
					// On regarde si le gowap ne fait pas parti d'un gowap RM
					if (preg_match("/Gowap/",$nom)) {
					  for($i=1;$i<=$nbGowaps;$i++) {
				  	  $res = $lesGowaps[$i];
							if ($res['id_gowap'] == $mId) {
								updateGowapRMView($mX, $mY, $mZ, $mId, $nom_streum, $age_streum ,$date);
								if ($DEV) echo "DEBUG parseFile() : le Gowap $mId est RM<br>";
								$isGowapRm = true;
								break;
							}
					  }
					}
					// Si ce n'est pas un Gowap RM
					if (!$isGowapRm) {
						$sub_sql_streum .= "($mId, '".addslashes($nom_streum)."','".addslashes($age_streum)."',
																 $mX, $mY, $mZ, '$date','oui'),";
						$sub_sql_streum_list_id .= "$mId OR id_monstre=";
						$nb_streum ++;
					}

					if ($nb_streum >= 100) {
						$sub_sql_streum=substr($sub_sql_streum,0,strlen($substr)-1);
						$sub_sql_streum_list_id=substr($sub_sql_streum_list_id,0,strlen($substr)-15);
						updateSeenStreum($sub_sql_streum,$sub_sql_streum_list_id);

						$sub_sql_streum = "";						
						$sub_sql_streum_list_id ="";
						$nb_streum = 0;
					}

					break;

				case 40: # TRESOR 
					list($oId, $nom, $oX, $oY, $oZ) = split (";",$line);	
					$sub_sql_tresor .= "($oId, '".addslashes($nom)."', $oX, $oY, $oZ, '$date'),";
					$sub_sql_tresor_list_id .= "$oId OR id_tresor=";

					$nb_tresor++;

					if ($nb_tresor >= 100) {
						$sub_sql_tresor=substr($sub_sql_tresor,0,strlen($substr)-1);
						$sub_sql_tresor_list_id=substr($sub_sql_tresor_list_id,0,strlen($substr)-14);
						updateSeenTresor($sub_sql_tresor,$sub_sql_tresor_list_id);
						$sub_sql_tresor="";
						$sub_sql_tresor_list_id ="";
						$nb_tresor = 0;
					}
					break;

				case 50: # LIEUX
		      list($oId, $nom, $oX, $oY, $oZ) = split (";",$line);	

					$isTaniereRm = false;
					// On regarde si c'est une tanière RM
		//			if (preg_match("/Tani.re de/",$nom)) {
					  for($i=1;$i<=$nbTanieres;$i++) {
				  	  $res = $lesTanieres[$i];
							if ($res['id_taniere'] == $oId) {
								$isTaniereRm = true;
								if ($DEV) echo "DEBUG parseFile() : la taniere $oId est RM<br>";
								break;
							}
					  }
			//		}
					// Si ce n'est pas une Tanière RM
					if (!$isTaniereRm) {
						if ((is_numeric($oX)) && (is_numeric($oY)) && (is_numeric($oZ))) {
							$sub_sql_lieux .= "($oId, '".addslashes($nom)."', $oX, $oY, $oZ, '$date'),";
							$sub_sql_lieux_list_id .= "$oId OR id_lieu=";
						} else {
							if (!$auto) {
								echo " Erreur = sub_sql_lieux .= $oId, '".addslashes($nom)."', $oX, $oY, $oZ, '$date') line=$line<br>";
							}
						}
					}
		      break;

				case 60: # CHAMPIGNONS
					list($nombre, $nom, $oX, $oY, $oZ) = split (";",$line);

					/* si le libellé n'est pas champi, on regarde si le champi est dans la base déjà */
					if (preg_match("/Champignon.*inconnu/",$nom) ||
					    preg_match("/champi/",$nom)) {
						$sql = "SELECT id_champi, nom_champi";
						$sql .= " FROM champignons WHERE x_champi = $oX AND y_champi = $oY AND z_champi = $oZ;";
	
						if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
						$result = mysql_query($sql,$db_vue_rm);
						echo mysql_error();
						
						/* Si le champi existe dans la base */
						if (mysql_affected_rows() > 0) {
							list($id_champ, $nom_champi) = mysql_fetch_array($result); 
							/* on met à jour la date */
							if ($DEV) echo "DEBUG refreshVue() Update du champi $nom_champi $oId $oX, $oY, $oZ , Nom Champi connu<br>\n";
							$sub_sql_champi_update .= " $id_champ OR id_champi =";
						} else {
							/* si le champi n'existe pas dans la base, on l'ajoute */
							$sub_sql_champi .= "('', '".addslashes($nom)."', $oX, $oY, $oZ, '$date', 'oui'),";
						}
					}
					break;

				case 70: # POSITION
					list($nCasesVue, $X, $Y, $Z) = split (";",$line);
					updateSeenTroll($maj_troll_id,$X,$Y,$Z,$date, $nCasesVue,'-',$auto, $refresh);

					$miniX=$X-$nCasesVue;
					$maxiX=$X+$nCasesVue;
					$miniY=$Y-$nCasesVue;
					$maxiY=$Y+$nCasesVue;
					$miniZ=$Z-ceil($nCasesVue/2);
					$maxiZ=$Z+ceil($nCasesVue/2);

					#updateQuadrillage($maj_troll_id,$miniX,$maxiX,$miniY,$maxiY,$miniZ,$maxiZ,$date);
					$tab[maj_x_troll] = $X;
					$tab[maj_y_troll] = $Y;
					$tab[maj_z_troll] = $Z;
					break;
					
				default:
					if ($DEV) echo "DEBUG parseFile() : $state : $line <br>\n";
        } // Fin switch()
      } // fin if ($line == "#FIN")
    } // fin while ()
  fclose ($view);
	$_SESSION['state'] .=" - ".$state;
	if ( ($state == 21) || ($state == 31) || ($state == 41) || ($state == 51)) {
		afficheNextSequence($auto,$state,$maj_troll_id,$maj_x_troll,$maj_y_troll,$maj_z_troll,$refresh);
	}
	return $tab;
}

function afficheNextSequence($auto,$state,$maj_troll_id,$maj_x_troll,$maj_y_troll,$maj_z_troll,$refresh)
{
	$lien = "sequence_refresh.php?auto=$auto&state=$state&refresh=$refresh&";
	$lien .= "maj_troll_id=$maj_troll_id&maj_x_troll=$maj_x_troll&maj_y_troll=$maj_y_troll&maj_z_troll=$maj_z_troll";

	if (!$auto) {
		?>
		<script language='JavaScript'>
		function goNextSequence(){
			document.location.href='<? echo $lien ?>';
		}
		</script>";
		<?
	} else {
		header("Location:$lien");
	}
}

function update_traitement($code,$etat) {
    global $db_vue_rm;
    $date=date("Y-m-d H-i-s");
    $sql = "UPDATE traitements SET ";
    $sql .= " date_traitement= '$date', ";
    $sql .= " etat_traitement= '$etat'";
    $sql .= " WHERE code_traitement='$code'"; 

    mysql_query($sql,$db_vue_rm);
    echo mysql_error();
}

function getTraitement($code)
{
  global $db_vue_rm;

  $sql = "SELECT date_traitement, etat_traitement";
  $sql .= " FROM traitements";
  $sql .= " WHERE code_traitement='$code'";


	$result=mysql_query($sql,$db_vue_rm);
 	$row = mysql_fetch_array($result);
	
	$date_less_5days=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-5, date("Y")));	
	
	if ( $row['date_traitement'] < $date_less_5days) {
		$rouge = "<font color='red'> (&ccedil;a fait longtemps !) ";	
	} else {
		$rouge = "<font color='green'>";	
	}

	return $rouge.$row['date_traitement'].":".$row['etat_traitement']."</font>";
}
?>
