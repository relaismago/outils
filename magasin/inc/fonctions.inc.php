<?php
//attention à bien avoir inclus le fichier des constantes avant !

include_once("./inc/tresor.inc.php");

function isGGT()
//indique si le troll connecté est gestionnaire des grandes tanières
{
	return in_array($_SESSION['AuthTroll'],explode(',',GGT));
}

function getTresors($idTaniere)
//renvoie tous les trésors dans une tanière donnée
{
	$query = "
			SELECT DISTINCT
			id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids,
			priorite_composant
			FROM stock_tresors
			LEFT JOIN composants ON compo=1 AND LOCATE(id_race_composant,nom)=LENGTH(nom)-LENGTH(id_race_composant)
			WHERE invisible=0 AND absent=0 AND id_taniere=".$idTaniere."
			ORDER BY nom_type, nom, template, description, id_tresor;
			";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();

	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;
}

function getEquipement($idTaniere)
//renvoie tous l'équipement dans une tanière donnée
{
	$query = "
			SELECT
			id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids
			FROM stock_tresors WHERE invisible=0 AND absent=0 AND id_taniere=".$idTaniere." AND compo=0
			ORDER BY nom_type, nom, template, description, id_tresor;
			";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();

	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;
}

function getEquipementPublic($idTaniere)
//renvoie uniquement l'équipement en vente à tous les trolls dans une tanière donnée
{
	$query = "
			SELECT
			id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids
			FROM stock_tresors WHERE invisible=0 AND absent=0 AND id_taniere=".$idTaniere." AND compo=0 AND en_vente_troll=0
			ORDER BY nom_type, nom, template, description, id_tresor;
			";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();

	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;
}

function getCompos($idTaniere)
//renvoie tous les compos et champis dans une tanière donnée
{
	$query = "
			SELECT DISTINCT
			id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids,
			priorite_composant
			FROM stock_tresors
			LEFT JOIN composants ON compo=1 AND LOCATE(id_race_composant,nom)=LENGTH(nom)-LENGTH(id_race_composant)
			WHERE invisible=0 AND absent=0 AND id_taniere=".$idTaniere." AND compo=1
			ORDER BY nom_type, nom, template, description, id_tresor;
			";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();

	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;
}




function getAllTresors($idTaniere)
//renvoie tous les trésors (même absents et invisibles) dans une tanière donnée
{
	$query = "
			SELECT DISTINCT
			id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids,
			priorite_composant
			FROM stock_tresors
			LEFT JOIN composants ON compo=1 AND LOCATE(id_race_composant,nom)=LENGTH(nom)-LENGTH(id_race_composant)
			WHERE id_taniere=".$idTaniere."
			ORDER BY nom_type, nom, template, description, id_tresor;
			";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();


	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;
}

function getAllEquipement($idTaniere)
//renvoie tout l'équipement (même absents et invisibles) dans une tanière donnée
{
	$query = "
			SELECT
			id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids
			FROM stock_tresors WHERE id_taniere=".$idTaniere." AND compo=0
			ORDER BY nom_type, nom, template, description, id_tresor;
			";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();


	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;
}

function getAllCompos($idTaniere)
//renvoie tous les champis/compos (même absents et invisibles) dans une tanière donnée
{
	$query = "
			SELECT DISTINCT
			id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids, 
			priorite_composant
			FROM stock_tresors
			LEFT JOIN composants ON compo=1 AND LOCATE(id_race_composant,nom)=LENGTH(nom)-LENGTH(id_race_composant)
			WHERE id_taniere=".$idTaniere." AND compo=1
			ORDER BY nom_type, nom, template, description, id_tresor;
			";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();


	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;
}

function nettoyerTresors($idTaniere)
//supprime tous les trésors marqués comme absents d'une tanière donnée
{
	$query = '
			DELETE FROM stock_tresors 
			WHERE id_taniere='.$idTaniere.' AND absent=1
			';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
}


//FIXME ne marche plus depuis modif
function parseTexte($copiercoller) {
//parse le contenu d'une tanière pour en faire en tableau, qui sera passé à majTable()
	list($utile,$trash) = explode("\n[Contact : dm@mountyhall.com]",$copiercoller);
	list($trash,$utile) = explode("Réf. Nom",$utile);

	$contenu_tab = explode("\n",$utile);
	$contenu_tab = array_slice($contenu_tab,1);
	$result = array();

	foreach($contenu_tab as $ligne)
	{
		if (strlen(trim($ligne))==0) continue;

		$ligne_tab = explode("\t",$ligne);

		$isObjet = preg_match("/(.*)dentifié \[(\d*)\] (.*) Etat : (.*)/",$ligne_tab[0],$tab1);
		if ($isObjet==0) continue;

		list($trash, $trash, $id, $description, $etat)=$tab1;
		$tab['id'] = trim($id);
		$tab['description'] = trim($description);
		$tab['type'] = trim($ligne_tab[1]);
		$tab['etat'] = trim($etat);

		//ne marche plus depuis modif sur MH, le prix en GG est dans un input et donc non recopié par le copier/coller
		/*
		if (trim($ligne_tab[2])=="GG") {
			preg_match("/(\d*) GG/",$ligne_tab[2],$tab2);
			list($trash, $enVentePrix)=$tab2;
		} else {
			$tab['enVentePrix'] = "";
		}
		*/
		$tab['enVentePrix'] = "";
		
		$switch = trim($ligne_tab[3]);
		if ($switch=="n°") {
			$tab['enVenteTrollNom'] = "";
			$tab['enVenteTroll'] = -1;	
		}
		else if ($switch=="n° Tous les trolls") {
			$tab['enVenteTroll']=0;
			$tab['enVenteTrollNom']="Tous les trolls";
		}
		else {
			preg_match("/n° (.*)/",$ligne_tab[3],$tab3);
			$tab['enVenteTrollNom']=trim($tab3[1]);
			$tab['enVenteTroll']=-2;//marque qu'on doit chercher le numéro
		}

		$result[]=$tab;
	}

	return $result;
}


//FIXME ne marche plus depuis modif
function majTable($tab, $taniere, $isCompo) {
	
	$dateMaj = date("YmdHis");

	//mise à jour
	foreach($tab as $ligne) {
		$temp = new Tresor();
		$temp->initAjout($taniere, $ligne['id'], $ligne['description'], $ligne['type'], $ligne['enVentePrix'], $ligne['enVenteTroll'], $ligne['enVenteTrollNom'], $isCompo, $dateMaj);

		$temp->updater();
	}

	//on marque comme absents les trésors non mis à jour
	$query = '
	UPDATE stock_tresors
	SET absent=1
	WHERE date_maj!=\''.$dateMaj.'\' AND id_taniere='.$taniere.' AND compo=\''.$isCompo.'\'
	;';

	global $db_vue_rm;
	mysql_query($query, $db_vue_rm);
}

//renvoie tous les types possibles
function getTypes()
{
	$query = 'SELECT DISTINCT nom_type FROM stock_tresors ORDER BY nom_type;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();

	while ( $row = mysql_fetch_array($query_result) )
		$result[] = $row['nom_type'];

	return $result;
}

function getTanieres()
//renvoie toutes les tanières gérées
{
	$query = 'SELECT DISTINCT id_taniere FROM stock_tresors ORDER BY id_taniere;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();

	while ( $row = mysql_fetch_array($query_result) )
		$result[] = $row['id_taniere'];

	return $result;
}

function recherche($tresor) {

	$result = array();
	if ($tresor->id=="0") return $result;

	$query = "
		SELECT DISTINCT
		id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids,
		priorite_composant
		FROM stock_tresors 
		LEFT JOIN composants ON compo=1 AND LOCATE(id_race_composant,nom)=LENGTH(nom)-LENGTH(id_race_composant)
		WHERE invisible=0 AND absent=0 ";
	$criteres="";

	if (isset($tresor->taniere) && is_numeric($tresor->taniere)) {
		$criteres.= " AND ";
		$criteres.= ' id_taniere=\''.$tresor->taniere.'\' ';
	}
	if (isset($tresor->id) && is_numeric($tresor->id)) {
		$criteres.= " AND ";
		$criteres.= ' id_tresor=\''.$tresor->id.'\' ';
	}
	if (isset($tresor->type) && $tresor->type!="") {
		$criteres.= " AND ";
		$criteres.= ' nom_type=\''.$tresor->type.'\' ';
	}
	if (isset($tresor->bloque) && is_numeric($tresor->bloque)) {
		$criteres.= " AND ";
		$criteres.= ' bloque=\''.$tresor->bloque.'\' ';
	}
	if (isset($tresor->reserve) && is_numeric($tresor->reserve)) {
		$criteres.= " AND ";
		$criteres.= ' reserve=\''.$tresor->reserve.'\' ';
	}
	if (isset($tresor->confirme) && is_numeric($tresor->confirme)) {
		$criteres.= " AND ";
		$criteres.= ' confirme=\''.$tresor->confirme.'\' ';
	}
	if (isset($tresor->enVente) && is_numeric($tresor->enVente)) {
		$criteres.= " AND ";
		$criteres.= ' en_vente=\''.$tresor->enVente.'\' ';
	}
	/*if (isset($tresor->description) && $tresor->description!="") {
		$tab = explode(';',$tresor->description);
		foreach($tab as $unCritere) {
			$criteres.= " AND ";
			$criteres.= ' description LIKE \'%'.addslashes($unCritere).'%\' ';
		}
	}*///FIXME
	if (isset($tresor->isCompo) && $tresor->isCompo==0) {
		$criteres.= " AND ";
		$criteres.= ' compo=\'0\' ';
	}
	if (isset($tresor->reserveTrollNom) && $tresor->reserveTrollNom==0) {
		//correspond aux potions et parchos, nulle part ailleurs pour le stocker
		$criteres.= ' AND nom_type!=\'Parchemin\' ';
		$criteres.= ' AND nom_type!=\'Potion\' ';
	}


	$query.=$criteres." ORDER BY nom_type, nom, template, description, id_taniere, id_tresor";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;

}

function rechercheAdmin($tresor) {

	$query = "
		SELECT DISTINCT
		id_tresor, nom_type, id_taniere, date_arrivee, invisible, bloque, absent, date_maj, reserve, confirme, reserve_troll, reserve_troll_nom, DATE_FORMAT(reserve_date,'%d/%m/%y') AS reserve_date, en_vente, en_vente_prix, en_vente_troll, en_vente_troll_nom, nom, template, description, poids,
		priorite_composant
		FROM stock_tresors
		LEFT JOIN composants ON compo=1 AND LOCATE(id_race_composant,nom)=LENGTH(nom)-LENGTH(id_race_composant)
		WHERE 1 ";
	$criteres="";

	if (isset($tresor->taniere) && is_numeric($tresor->taniere)) {
		$criteres.= " AND ";
		$criteres.= ' id_taniere=\''.$tresor->taniere.'\' ';
	}
	if (isset($tresor->id) && is_numeric($tresor->id)) {
		$criteres.= " AND ";
		$criteres.= ' id_tresor=\''.$tresor->id.'\' ';
	}
	if (isset($tresor->type) && $tresor->type!="") {
		$criteres.= " AND ";
		$criteres.= ' nom_type=\''.$tresor->type.'\' ';
	}
	if (isset($tresor->invisible) && is_numeric($tresor->invisible)) {
		$criteres.= " AND ";
		$criteres.= ' invisible=\''.$tresor->invisible.'\' ';
	}
	if (isset($tresor->bloque) && is_numeric($tresor->bloque)) {
		$criteres.= " AND ";
		$criteres.= ' bloque=\''.$tresor->bloque.'\' ';
	}
	if (isset($tresor->absent) && is_numeric($tresor->absent)) {
		$criteres.= " AND ";
		$criteres.= ' absent=\''.$tresor->absent.'\' ';
	}
	if (isset($tresor->reserve) && is_numeric($tresor->reserve)) {
		$criteres.= " AND ";
		$criteres.= ' reserve=\''.$tresor->reserve.'\' ';
	}
	if (isset($tresor->confirme) && is_numeric($tresor->confirme)) {
		$criteres.= " AND ";
		$criteres.= ' confirme=\''.$tresor->confirme.'\' ';
	}
	if (isset($tresor->enVente) && is_numeric($tresor->enVente)) {
		$criteres.= " AND ";
		$criteres.= ' en_vente=\''.$tresor->enVente.'\' ';
	}

	/*
	if (isset($tresor->description) && $tresor->description!="") {
		$tab = explode(';',$tresor->description);
		foreach($tab as $unCritere) {
			$criteres.= " AND ";
			$criteres.= ' description LIKE \'%'.addslashes($unCritere).'%\' ';
		}
	}*/

	if (isset($tresor->isCompo) && $tresor->isCompo==0) {
		$criteres.= " AND ";
		$criteres.= ' compo=\'0\' ';
	}
	if (isset($tresor->reserveTrollNom) && $tresor->reserveTrollNom==0) {
		//correspond aux potions et parchos, nulle part ailleurs pour le stocker
		$criteres.= ' AND nom_type!=\'Parchemin\' ';
		$criteres.= ' AND nom_type!=\'Potion\' ';
	}


	$query.=$criteres." ORDER BY nom_type, nom, template, description, id_taniere, id_tresor";

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$result = array();

	while ( $row = mysql_fetch_array($query_result) )
	{
		$temp = new Tresor();
		$temp->initBDD($row);
		$result[] = $temp;
	}

	return $result;

}


function appelScript($login,$password) {

	global $db_vue_rm;

	//on vérifie le nombre d'appels au script
	
	$date=date("Y-m-d H-i-s");	
	$date_less_24=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));

	$query = "DELETE FROM variables WHERE nom='REFRESH_MAGASIN' AND valeur_date<'$date_less_24';";
	$query_result = mysql_query($query, $db_vue_rm);
	
	$query = "SELECT COUNT(*) FROM variables WHERE nom='REFRESH_MAGASIN';";
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row) {
		list($nb) = $row;
		if ($nb >= NB_REFRESH_MAGASIN_BY_GUILDE)
			die("La guilde a utilisé ".$nb." fois le script public dans les dernières 24 heures, pour ".NB_REFRESH_MAGASIN_BY_GUILDE." fois max.");	
	}

	$query="INSERT INTO variables(nom, valeur_date, valeur_txt) VALUES('REFRESH_MAGASIN','$date','".getNomTroll($login)."');";
	$query_result = mysql_query($query, $db_vue_rm);

	
	
	//appel au script
	
	$url = 'http://sp.mountyhall.com/SP_GrandesTanieres.php?Numero='.$login.'&Motdepasse='.$password;
	//$url='C:\\temp\\GTMountyhall.txt';
	$ressource = fopen($url,'r');



	//parsing du retour du script

	$result = array();
	$taniere=0;

	while ($line = fgets($ressource)) {

		//echo("<!--".$line."-->\n");
		
		if (trim($line)=="") continue;

		if ($line{0}=='#') {
			if (strpos($line,'#DEBUT')==0) {
				$temp = explode(';',$line);
				$taniere = substr($temp[0],21);
			}
			continue;
		}

		$temp = explode(';',$line);
		
		$tab['id']=$temp[0];
		$tab['type']=$temp[2];
		$tab['identifie']=$temp[3];
		$tab['nom']=$temp[4];
		$tab['template']=$temp[5];		
		$tab['description']=$temp[6];
		$tab['poids']=$temp[7];
		$tab['enVenteTroll']=$temp[8];
		$tab['enVentePrix']=$temp[9];
		$tab['taniere']=$taniere;

		$result[]=$tab;
	}

	return $result;
}


function majTableAuto($tab) {
	
	$dateMaj = date("YmdHis");
	
	//echo("<!-- Date : ".$dateMaj." -->\n");

	//mise à jour
	foreach($tab as $ligne) {
		$temp = new Tresor();
		
		$temp->initAjout($ligne['taniere'], $ligne['id'], $ligne['type'], $ligne['nom'], $ligne['template'], $ligne['description'], $ligne['poids'], $ligne['enVentePrix'], $ligne['enVenteTroll'], $dateMaj);

		$temp->updater();
	}

	//on marque comme absents les trésors non mis à jour
	$query = "
	UPDATE stock_tresors
	SET absent=1
	WHERE date_maj!='$dateMaj';";

	global $db_vue_rm;
	mysql_query($query, $db_vue_rm);
}


function getDerniereMaj() {

	global $db_vue_rm;

	$query = "SELECT valeur_date, valeur_txt FROM variables WHERE nom='REFRESH_MAGASIN' ORDER BY valeur_date DESC";
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);

	$tab['troll']=$row['valeur_txt'];
	$tab['date']=$row['valeur_date'];

	return $tab;
}



?>
