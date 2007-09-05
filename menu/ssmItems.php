<?
session_start();

include_once('../functions_auth.php');

function addItemMenu($rm_only,$is_parent,$pos,$name,$tip, $link="", $target="")
{

	$flag = true;
	
	if ($rm_only){
		if ( userIsGuilde() )
			$flag=false;
	} else {
		$flag = false;
	}

		if (!$flag){
	if (!$is_parent) {
			echo "menu.addSubItem('$pos','$name','$name','$link','$target');";
			//echo "menu.addSubItem('$pos','$name','$tip','$link','$target');";
			
			//echo "ssmItems[$pos]=[\"$name\", \"$link\", \"$target\", \"$colspan\", \"$endrow\"];";
		//	$pos++;
	} else {
		//echo "menu.addItem('$pos', '$name', '$tip',  null, null);";
		echo "menu.addItem('$pos', '$name', '$name',  null, null);";
	}
		}
	return $pos;
}
?>

function showToolbar()
{
// AddItem(id, text, hint, location, alternativeLocation);
// AddSubItem(idParent, text, hint, location, linktarget);

  menu = new Menu();
<?
	
	$pos = addItemMenu(false,true,'jouer',"Jouer","Jouer");
  $pos = addItemMenu(true,false,$pos,"Forum","Accès au Forum Interne R&M", "http://relaismago.forumactif.com/");

	if ( userIsGuilde() ) 
	  $pos = addItemMenu(true,false,$pos,"Cockpit","Mix vue2d, Recherchator, Radar", "/cockpit.php?id_troll=$_SESSION[AuthTroll]");
	else
  	$pos = addItemMenu(false,false,$pos,"Vue2d","Vue2d Relais&Mago Publique", "/public.php","jouer");
		
  $pos = addItemMenu(false,false,$pos,"Bestiaire","Le Bestiaire", "/bestiaire2/");
  $pos = addItemMenu(true,false,$pos,"GPS","Le GPS Relais&Mago", "/gps_advanced.php3");
  $pos = addItemMenu(true,false,$pos,"GGC","Le Gestionnaire de Groupe de Chasse", "/ggc/accueil.php");
  //$pos = addItemMenu(true,false,$pos,"Magasin","Les boutiques R&M", "/magasin/");
  $pos = addItemMenu(true,false,$pos,"Trolliaire","Stockage des Ananlyses Anatomiques", "/anatomique/anatomique.php?id_troll=list");

	$pos = addItemMenu(false,true,'rengene',"Renseignements Généraux","Renseignements Généraux");
  $pos = addItemMenu(true,false,$pos,"Baronnies", "Les Baronnies chez les Relais&Mago", "/engine_view.php?baronnie=liste");
  $pos = addItemMenu(true,false,$pos,"Tani&egrave;res RM", "Les tanières des Relais&Mago", "/engine_view.php?taniere=cadastre");
  $pos = addItemMenu(true,false,$pos,"Gowaps RM", "Les Gowaps des Relais&Mago", "/engine_view.php?gowap=liste");
  $pos = addItemMenu(true,false,$pos,"Composants", "Les composants prioritaires",  "/engine_view.php?composant=liste");
  $pos = addItemMenu(true,false,$pos,"Guildes", "Les guildes du Hall", "/engine_view.php?guilde=liste");
  $pos = addItemMenu(true,false,$pos,"Recherche", "Recherches diverses dans les outils", "/engine_view.php?recherche=new");
  $pos = addItemMenu(true,false,$pos,"Trolls", "Les trolls du Hall", "/engine_view.php?troll=liste");
  $pos = addItemMenu(false,false,$pos,"Wanted", "Les wanted Relais&Mago", "/wanted.php?id=viewall");
	
  $pos = addItemMenu(false,true,'outils',"Autres outils","Autres outils");

  $pos = addItemMenu(false,false,$pos,"Analyseur", "Analyseur de troll", "/pratique/analyseur.php");
  $pos = addItemMenu(false,false,$pos,"Calculs", "Calculs diverses", "/pratique/calculs.php");
  $pos = addItemMenu(false,false,$pos,"Changement de mot de passe", "Changer le mot de passe dans les outils", "/change_password.php");
  $pos = addItemMenu(true,false,$pos,"Chat", "Discussions en direct", "http://relaismago.forumactif.com/Forum-Prive-des-RM-c1/Les-Outils-f9/Tchat-Yakalike-plugin-Firefox-t1028.htm");
  $pos = addItemMenu(true,false,$pos,"Options", "Mes options", "/options.php");
  $pos = addItemMenu(false,false,$pos,"Pack Graphique", "Le pack graphique Officiel", "/pack_graphique/Pack_graphique.zip");
  $pos = addItemMenu(false,false,$pos,"Statistiques", "La concentration trollienne du Hall", "/statistiques.php");
  $pos = addItemMenu(false,false,$pos,"Trombinoscope", "Les tronches des Relais&Mago", "/trombinoscope.php");
  $pos = addItemMenu(true,false,$pos,"VTT", "Le Visiotrollotron", "/vtt/vtt.php");
  $pos = addItemMenu(true,false,$pos,"Narcissotron", "Suis-je le plus fort ?", "/vtt/stats_perso.php");

  $pos = addItemMenu(false,true,'pratique',"Pratique", "Pratique");
  $pos = addItemMenu(false,false,$pos,"Abréviations", "Les Abréviations du Hall", "/pratique/abreges.php");
  $pos = addItemMenu(false,false,$pos,"Didacticiel", "Didacticiel", "/didacticiel/accueil.php");
  $pos = addItemMenu(false,false,$pos,"Effets", "Explications sur les effets", "/pratique/effets.php");
  $pos = addItemMenu(true,false,$pos,"Firemago", "Les outils intégrés à MountyHall", "/firemago/tutorial/tutorial.php");
  $pos = addItemMenu(true,false,$pos,"Liens", "Liens pratiques", "/pratique/liens.php");
  $pos = addItemMenu(false,false,$pos,"Quincaillerie", "La quincaillerie du Hall", "/pratique/quincaillerie.php");
  $pos = addItemMenu(false,false,$pos,"Ustensiles", "Les ustensiles du Hall", "/pratique/ustensils.php");
	$pos = addItemMenu(false,false,$pos,"PartagePX", "Partage des PX du groupe", "/partagepx/partage.php");
	
  $pos = addItemMenu(false,true,'special',"Spécial", "Spécial");
  $pos = addItemMenu(false,false,$pos,"Miss Mountyhall 2005!", "Miss Mountyhall 2005!", "/miss/miss.php");
  //$pos = addItemMenu(false,false,$pos,"Miss Relais&Mago 2005!", "Miss Relais&Mago 2005!", "/miss/miss.php");
/*  $pos = addItemMenu(true,false,$pos,"VPG", "La Vengeance pour Grognon", "/histoires/la_vpg.php");*/
  $pos = addItemMenu(false,false,$pos,"La Liche", "L'assaut de la Liche ", "/histoires/la_liche.php");
  $pos = addItemMenu(false,false,$pos,"Retour des Monstres", "Le retour des Monstres ", "/histoires/retour_monstres.php");
  $pos = addItemMenu(false,false,$pos,"Le Complot", "Le Complot ", "/histoires/complot.php");

  $pos = addItemMenu(false,true,'horsjeux',"Hors-Jeux","Hors-Jeux");
  $pos = addItemMenu(false,false,$pos,"Bugtrack", "Le Bugtrack des outils Relais&Mago", "/bugs.php");
  $pos = addItemMenu(false,false,$pos,"Sources", "Les sources des outils Relais&Mago", "http://code.google.com/p/relaismago/");
	
	if ($_SESSION[admin] == "authenticated") {
	  $pos = addItemMenu(true,true,'administration',"Administration","Administration");
	  $pos = addItemMenu(true,false,$pos,"Avatars","", "/engine_view.php?avatar=liste");
	  $pos = addItemMenu(true,false,$pos,"BDD", "","/engine_view.php?bdd=choix");
	  $pos = addItemMenu(true,false,$pos,"Distinctions", "","/engine_view.php?distinction=liste");
	  $pos = addItemMenu(true,false,$pos,"Ftp Maj", "","/engine_view.php?info_ftp_files=oui");
	  $pos = addItemMenu(true,false,$pos,"Loteries", "","/loteries/loterie.php?admin=liste");
	  $pos = addItemMenu(true,false,$pos,"Mots de passe","", "/engine_view.php?change_password=new");
	  $pos = addItemMenu(true,false,$pos,"Passe erreur", "","/engine_view.php?list_pass_error=oui");
	  $pos = addItemMenu(true,false,$pos,"Stats Manual Refresh","", "/engine_view.php?list_manual_refresh=oui");
	  $pos = addItemMenu(true,false,$pos,"Stats Vue Publique", "","/engine_view.php?stats_vue_publique=oui");
	  $pos = addItemMenu(true,false,$pos,"Stats Refresh auto", "","/engine_view.php?stats_refresh_auto=oui");
	  $pos = addItemMenu(true,false,$pos,"Stats Visites", "","/engine_view.php?stats_connection=oui");
	}
?>
  menu.showMenu();
}
