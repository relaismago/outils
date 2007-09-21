<?PHP
session_start();
include('../../functions_auth.php');
include('../secure_bestiaire.php');

/******************************************************************************
*                                                                             *
* enregistrecdm - enregistrement d'une nouvelle cdm dans la base              *
* Copyright (C) 2005  Cormyr (cormyr@cat-the-psion.net)                       *
*                                                                             *
* This program is free software; you can redistribute it and/or               *
* modify it under the terms of the GNU General Public License                 *
* as published by the Free Software Foundation; either version 2              *
* of the License, or (at your option) any later version.                      *
*                                                                             *
* This program is distributed in the hope that it will be useful,             *
* but WITHOUT ANY WARRANTY; without even the implied warranty of              *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               *
* GNU General Public License for more details.                                *
*                                                                             *
* You should have received a copy of the GNU General Public License           *
* along with this program; if not, write to the Free Software                 *
* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. *
*                                                                             *
*******************************************************************************/

require_once ("../../inc_connect.php3"); // connexion � la base
require_once ("../DB/inc_initdata.php");     // recup des donn�es statiques
require_once ("../Libs/inc_affichage.php");     // recup des donn�es statiques

// les deux variables suivantes servent � noter que les caracs ont �t� r�ajust�es 
// et qu'une mise � jour de la base est n�cessaire.
// $monstrechange=false; 
// $cdmchange    =false;


$pcdm=array();
$pcdm['monstre']=stripslashes($_POST['MONSTRE']);
$pcdm['id_mh']=stripslashes($_POST['ID_MH']);
$pcdm['race']=stripslashes($_POST['RACE']);
$pcdm['genre_race']=stripslashes($_POST['GENRE_RACE']);
$pcdm['id_race']=stripslashes($_POST['ID_RACE']);
$pcdm['template']=stripslashes($_POST['TEMPLATE']);
$pcdm['id_template']=stripslashes($_POST['ID_TEMPLATE']);
$pcdm['age']=stripslashes($_POST['AGE']);
$pcdm['id_age']=stripslashes($_POST['ID_AGE']);
$pcdm['famille']=stripslashes($_POST['FAMILLE']);
$pcdm['id_famille']=stripslashes($_POST['ID_FAMILLE']);
$pcdm['nivmin']=stripslashes($_POST['NIVMIN']);
$pcdm['nivmax']=stripslashes($_POST['NIVMAX']);
$pcdm['pdvmin']=stripslashes($_POST['PDVMIN']);
$pcdm['pdvmax']=stripslashes($_POST['PDVMAX']);
$pcdm['blessure']=stripslashes($_POST['BLESSURE']);
$pcdm['attmin']=stripslashes($_POST['ATTMIN']);
$pcdm['attmax']=stripslashes($_POST['ATTMAX']);
$pcdm['esqmin']=stripslashes($_POST['ESQMIN']);
$pcdm['esqmax']=stripslashes($_POST['ESQMAX']);
$pcdm['degmin']=stripslashes($_POST['DEGMIN']);
$pcdm['degmax']=stripslashes($_POST['DEGMAX']);
$pcdm['regmin']=stripslashes($_POST['REGMIN']);
$pcdm['regmax']=stripslashes($_POST['REGMAX']);
$pcdm['armmin']=stripslashes($_POST['ARMMIN']);
$pcdm['armmax']=stripslashes($_POST['ARMMAX']);
$pcdm['vuemin']=stripslashes($_POST['VUEMIN']);
$pcdm['vuemax']=stripslashes($_POST['VUEMAX']);
$pcdm['mmmin']=stripslashes($_POST['MMMIN']);
$pcdm['mmmax']=stripslashes($_POST['MMMAX']);
$pcdm['rmmin']=stripslashes($_POST['RMMIN']);
$pcdm['rmmax']=stripslashes($_POST['RMMAX']);
$pcdm['nbatt']=stripslashes($_POST['NBATT']);
$pcdm['vitdep']=stripslashes($_POST['VITDEP']);
$pcdm['vlc']=stripslashes($_POST['VLC']);
$pcdm['attdist']=stripslashes($_POST['ATTDIST']);
$pcdm['dlamin']=stripslashes($_POST['DLAMIN']);
$pcdm['dlamax']=stripslashes($_POST['DLAMAX']);
$pcdm['capspe']=stripslashes($_POST['CAPSPE']);
$pcdm['affecte']=stripslashes($_POST['AFFECTE']);
$pcdm['date']=stripslashes($_POST['DATE']);
$pcdm['troll_nom']=stripslashes($_POST['SOURCE']);
$pcdm['troll_id']=stripslashes($_POST['IDSOURCE']);
if($_POST['AUTOSOURCE']=="oui") $auto=true; else $auto=false;
$suite=stripslashes($_POST['SUITE']);

if ($pcdm['mmmax']=="") $pcdm['mmmax']=99999;
if ($pcdm['rmmax']=="") $pcdm['rmmax']=99999;
if ($pcdm['dlamax']=="") $pcdm['dlamax']=99;

//
// on recherche d'abord si ce monstre (race template [age]) est d�j� dans la
// base des monstres
//
$pcdm['monstre']=$pcdm['monstre']." [".$pcdm['age']."]";
$monstre=array();
$sql="SELECT * FROM `best_monstres` WHERE `nom_monstre`=\"".$pcdm['monstre']."\""; // la requ�te permettant de les r�cup�rer
$query=mysql_query($sql,$db_vue_rm);
if(!$query) die("Erreur recherche du monstre :".$sql);
if(mysql_num_rows($query)>0){ // monstre trouv�
  //print("DEBUG: Monstre trouv�<br>");
  $monstre=mysql_fetch_array($query); // on r�cup�re les donn�es
  // on regarde alors si il poss�de des infos sur ses pouvoirs
  $sql="SELECT * FROM `best_capspe` WHERE `id_monstre_capspe`=\"".$monstre['id_monstre']."\""; // la requ�te permettant de les r�cup�rer
  $query=mysql_query($sql,$db_vue_rm);
  if(!$query) die("Erreur recherche sur les capacit�s sp�ciale du monstre :".$sql);
  if(mysql_num_rows($query)>0) $capspe=mysql_fetch_array($query); // capspe trouv�e : on r�cup�re les donn�es
  else                         $capspe=false; // pas de capspe
  //print("DEBUG: capspe=".$capspe['nom_capspe']."<br>");  
  // on regarde enfin si il poss�de des caracs autres (RM par ex)
  $sql="SELECT * FROM `best_caracs` WHERE `id_monstre_caracs`=\"".$monstre['id_monstre']."\""; // la requ�te permettant de les r�cup�rer
  $query=mysql_query($sql,$db_vue_rm);
  if(!$query) die("Erreur recherche sur les caracs du monstre :".$sql);
  if(mysql_num_rows($query)>0) $caracs=mysql_fetch_array($query); // capspe trouv�e : on r�cup�re les donn�es
  else                         $caracs=false; // pas de capspe
}
else{ // ce monstre n'a jamais �t� examin�
  //print("DEBUG: nouveau monstre<br>");
  // on ins�re les donn�es de la cdm dans la base afin de r�cup�rer le nouvel id
  $sql="INSERT INTO best_monstres(id_race_monstre,id_template_monstre,id_age_monstre,nom_monstre) VALUES(\"".$pcdm['id_race']."\",\"".$pcdm['id_template']."\",\"".$pcdm['id_age']."\",\"".$pcdm['monstre']."\")";
  if(!mysql_query($sql,$db_vue_rm)) die("l'insertion du monstre a �chou�<br>$sql<br>");
  // on va rechercher ces informations afin d'avoir l'id notamment
  $sql="SELECT * FROM `best_monstres` WHERE `nom_monstre`=\"".$pcdm['monstre']."\""; 
  if($query=mysql_query($sql,$db_vue_rm)){ // monstre retrouv�
    $monstre=mysql_fetch_array($query); // on r�cup�re les donn�es
  }
  else die("impossible de r�cup�rer le monstre nouvellement ins�r�<br>$sql<br>");
  // on regarde si la cdm indique une capacit� sp�ciale
  // dans ce cas, on va ins�rer une nouvelle capspe dans la base
  //print("DEBUG: test capspe<br>");
  if($pcdm['capspe']!=""){ // y a une capspe � enregistrer
    //print("DEBUG: capspe<br>");
    $sql="INSERT INTO best_capspe(id_monstre_capspe,id_race_capspe,id_template_capspe,id_age_capspe,nom_capspe,affecte_capspe,source_capspe) VALUES(\"".$monstre['id_monstre']."\",\"".$monstre['id_race_monstre']."\",\"".$monstre['id_template_monstre']."\",\"".$monstre['id_age_monstre']."\",\"".$pcdm['capspe']."\",\"".$pcdm['affecte']."\",\"".$pcdm['troll_nom']."\")";
    if(!mysql_query($sql,$db_vue_rm)) die("l'insertion du monstre a �chou�<br>$sql<br>");
    // on va rechercher les infos pour les stocker dans capspe
    $sql="SELECT * FROM `best_capspe` WHERE `id_monstre_capspe`=\"".$monstre['id_monstre']."\"";
    if($query=mysql_query($sql,$db_vue_rm)){ // capsp� retrouv�e
      $capspe=mysql_fetch_array($query); // on r�cup�re les donn�es
    }
    else die("impossible de r�cup�rer les capacit�s sp�ciales du monstre nouvellement ins�r�es<br>$sql<br>");
  }
  else $capspe=false; // pas de capspe
  $caracs=false;      // pas de caracs puisque celles-ci ne peuvent �tre rentr�es qu'� la main 
  // reste � v�rifier si le couple template/race a d�j� �t� examin� et enregistr�
  $sql="SELECT * FROM `best_racetemplate` WHERE `id_race_racetemplate`=\"".$monstre['id_race_monstre']."\" AND `id_template_racetemplate`=\"".$monstre['id_template_monstre']."\"";
  if($query=mysql_query($sql,$db_vue_rm)){ // requ�te ok
    if(mysql_numrows($query)==0){ // le couple n'existe pas encore, il faut le cr�er
      $sql="INSERT INTO best_racetemplate(id_race_racetemplate,id_template_racetemplate) VALUES(\"".$monstre['id_race_monstre']."\",\"".$monstre['id_template_monstre']."\")";
      if(!($query=mysql_query($sql,$db_vue_rm))) die("l'insertion du couple ".$monstre['id_race_monstre']."/".$monstre['id_template_monstre']." a �chou� :".mysql_error());
    }
  }
  else die("impossible de r�cup�rer l'association race/template<br/>$sql<br/>");
}

//
// On commence par v�rifier qu'une cdm pour cette entit� n'a pas d�j� �t� rentr�
//
$cdm=array();
$sql="SELECT * FROM `best_cdms` WHERE `id_mh`=\"".$pcdm['id_mh']."\" AND `id_age_cdm`=\"".$pcdm['id_age']."\";"; // la requ�te permettant de les r�cup�rer
$query=mysql_query($sql,$db_vue_rm);
if(!$query) die("Erreur recherche cdm : ".$sql);
if(mysql_num_rows($query)==0){ // cdm non trouv�e
  // on r�cup�re les donn�es de la cdm analys�e
  $cdm['id_mh']           	= $pcdm['id_mh'];
  $cdm['id_race_cdm']     	= $pcdm['id_race'];
  $cdm['id_template_cdm'] 	= $pcdm['id_template'];
  $cdm['id_age_cdm']      	= $pcdm['id_age'];
  $cdm['id_monstre_cdm']  	= $monstre['id_monstre'];
  $cdm['nivmin_cdm']      	= $pcdm['nivmin'];
  $cdm['nivmax_cdm']      	= $pcdm['nivmax'];
  $cdm['pdvmin_cdm']       	= $pcdm['pdvmin'];
  $cdm['pdvmax_cdm']       	= $pcdm['pdvmax'];
  $cdm['blessure_cdm']      = $pcdm['blessure'];
  $cdm['attmin_cdm']	  	= $pcdm['attmin'];
  $cdm['attmax_cdm']	  	= $pcdm['attmax'];
  $cdm['esqmin_cdm']	  	= $pcdm['esqmin'];
  $cdm['esqmax_cdm']	  	= $pcdm['esqmax'];
  $cdm['degmin_cdm']	  	= $pcdm['degmin'];
  $cdm['degmax_cdm']	  	= $pcdm['degmax'];
  $cdm['regmin_cdm']	  	= $pcdm['regmin'];
  $cdm['regmax_cdm']	  	= $pcdm['regmax'];
  $cdm['armmin_cdm']	  	= $pcdm['armmin'];
  $cdm['armmax_cdm']	  	= $pcdm['armmax'];
  $cdm['vuemin_cdm']	  	= $pcdm['vuemin'];
  $cdm['vuemax_cdm']	  	= $pcdm['vuemax'];
  $cdm['mmmin_cdm']         = $pcdm['mmmin'];
  $cdm['mmmax_cdm']         = $pcdm['mmmax'];
  $cdm['rmmin_cdm']         = $pcdm['rmmin'];
  $cdm['rmmax_cdm']         = $pcdm['rmmax'];
  $cdm['nbatt_cdm']         = $pcdm['nbatt'];
  $cdm['vitdep_cdm']        = $pcdm['vitdep'];
  $cdm['vlc_cdm']      	    = $pcdm['vlc'];
  $cdm['attdist_cdm']       = $pcdm['attdist'];
  $cdm['dlamin_cdm']        = $pcdm['dlamin'];
  $cdm['dlamax_cdm']        = $pcdm['dlamax'];
  $cdm['capspe_cdm']        = $pcdm['capspe'];
  $cdm['affecte_cdm']     	= $pcdm['affecte'];
  $cdm['source_cdm']      	= $pcdm['troll_nom'];
  
  // on ins�re cette nouvelle cdm
  $sql="INSERT INTO best_cdms(id_mh,id_race_cdm,id_template_cdm,id_age_cdm,id_monstre_cdm,nivmin_cdm,nivmax_cdm,pdvmin_cdm,pdvmax_cdm,blessure_cdm,attmin_cdm,attmax_cdm,esqmin_cdm,esqmax_cdm,degmin_cdm,degmax_cdm,regmin_cdm,regmax_cdm,armmin_cdm,armmax_cdm,vuemin_cdm,vuemax_cdm,mmmin_cdm,mmmax_cdm,rmmin_cdm,rmmax_cdm,nbatt_cdm,vitdep_cdm,vlc_cdm,attdist_cdm,dlamin_cdm,dlamax_cdm,capspe_cdm,affecte_cdm,source_cdm) VALUES(\"".$cdm['id_mh']."\",\"".$cdm['id_race_cdm']."\",\"".$cdm['id_template_cdm']."\",\"".$cdm['id_age_cdm']."\",\"".$cdm['id_monstre_cdm']."\",\"".$cdm['nivmin_cdm']."\",\"".$cdm['nivmax_cdm']."\",\"".$cdm['pdvmin_cdm']."\",\"".$cdm['pdvmax_cdm']."\",\"".$cdm['blessure_cdm']."\",\"".$cdm['attmin_cdm']."\",\"".$cdm['attmax_cdm']."\",\"".$cdm['esqmin_cdm']."\",\"".$cdm['esqmax_cdm']."\",\"".$cdm['degmin_cdm']."\",\"".$cdm['degmax_cdm']."\",\"".$cdm['regmin_cdm']."\",\"".$cdm['regmax_cdm']."\",\"".$cdm['armmin_cdm']."\",\"".$cdm['armmax_cdm']."\",\"".$cdm['vuemin_cdm']."\",\"".$cdm['vuemax_cdm']."\",\"".$cdm['mmmin_cdm']."\",\"".$cdm['mmmax_cdm']."\",\"".$cdm['rmmin_cdm']."\",\"".$cdm['rmmax_cdm']."\",\"".$cdm['nbatt_cdm']."\",\"".$cdm['vitdep_cdm']."\",\"".$cdm['vlc_cdm']."\",\"".$cdm['attdist_cdm']."\",\"".$cdm['dlamin_cdm']."\",\"".$cdm['dlamax_cdm']."\",\"".$cdm['capspe_cdm']."\",\"".$cdm['affecte_cdm']."\",\"".$cdm['source_cdm']."\")";
  if(!mysql_query($sql,$db_vue_rm)){
    die("l'insertion de la cdm a �chou�<br>$sql<br>");
  }
  
  // on ins�re les nouvelles moyennes des caracs pour ce monstre
  // pdv
  recoup_monstre_insert ("pdv",999);
  
  // l'attaque
  recoup_monstre_insert ("att",99);
  
  // l'esquive
  recoup_monstre_insert ("esq",99);
  
  // les d�g�ts
  recoup_monstre_insert ("deg",99);
  
  // la regen
  recoup_monstre_insert ("reg",99);
  
  // l'armure
  recoup_monstre_insert ("arm",99);
  
  // la vue
  recoup_monstre_insert ("vue",99);
  
  // la MM
  recoup_monstre_insert ("mm",99999);
  
  // la RM
  recoup_monstre_insert ("rm",99999);
  
  // la DLA
  recoup_monstre_insert ("dla",99);
  
  $sql="UPDATE `best_monstres` SET `pdvsom_monstre`=\"".$monstre['pdvsom_monstre']."\", `pdvnbr_monstre`=\"".$monstre['pdvnbr_monstre']."\", `attsom_monstre`=\"".$monstre['attsom_monstre']."\", `attnbr_monstre`=\"".$monstre['attnbr_monstre']."\", `esqsom_monstre`=\"".$monstre['esqsom_monstre']."\", `esqnbr_monstre`=\"".$monstre['esqnbr_monstre']."\", `degsom_monstre`=\"".$monstre['degsom_monstre']."\", `degnbr_monstre`=\"".$monstre['degnbr_monstre']."\", `regsom_monstre`=\"".$monstre['regsom_monstre']."\", `regnbr_monstre`=\"".$monstre['regnbr_monstre']."\", `armsom_monstre`=\"".$monstre['armsom_monstre']."\", `armnbr_monstre`=\"".$monstre['armnbr_monstre']."\", `vuesom_monstre`=\"".$monstre['vuesom_monstre']."\", `vuenbr_monstre`=\"".$monstre['vuenbr_monstre']."\",`mmsom_monstre`=\"".$monstre['mmsom_monstre']."\", `mmnbr_monstre`=\"".$monstre['mmnbr_monstre']."\", `rmsom_monstre`=\"".$monstre['rmsom_monstre']."\", `rmnbr_monstre`=\"".$monstre['rmnbr_monstre']."\", `dlasom_monstre`=\"".$monstre['dlasom_monstre']."\", `dlanbr_monstre`=\"".$monstre['dlanbr_monstre']."\", `date_monstre`=NOW(  )  WHERE `id_monstre`=".$monstre['id_monstre']." LIMIT 1 ";
  if(!mysql_query($sql,$db_vue_rm)){
    die("la modification des caract�ristiques du monstre a �chou�<br>$sql<br>");
  }
  
}
else
{ // une cdm pour cette cr�ature existe d�j�
  $cdm=mysql_fetch_array($query); // on r�cup�re les donn�es
  
  //
  // on va ajuster les donn�es de la cdm pour cette entit� et enregistrer dans la
  // table des monstres toute donn�e calcul�e exactement
  //
  // le niveau
  $niv_race_change=false;
  $niv_temp_change=false;
  if($pcdm['nivmin']>=$cdm['nivmin_cdm']){
    $cdm['nivmin_cdm']=$pcdm['nivmin'];
    $cdmchange=$caracchange=true;
  }
  if($pcdm['nivmax']<=$cdm['nivmax_cdm']){
    $cdm['nivmax_cdm']=$pcdm['nivmax'];
    $cdmchange=$caracchange=true;
  }
  if($caracchange){ // si la carac vient d'�tre calcul�e
    if($cdm['nivmin_cdm']==$cdm['nivmax_cdm']){ // et que c'est une valeur exacte
      $monstre['nivsom_monstre']+=$cdm['nivmin_cdm']; // c'est donc une nouvelle cdm
      $monstre['nivnbr_monstre']++;// qui confirme la valeur et donc doit �tre compt�e
      $monstrechange=true;
      // il faut calculer le modificateur de niveau du template
      $niv_temp=round($monstre['nivsom_monstre']/$monstre['nivnbr_monstre']);
      //print("DEBUG: niveau moyen monstre = ".$niv_temp."<br>");
      $niv_temp-=$best_ages[$cdm['id_age_cdm']]['ordre_age'];
      //print("DEBUG: niveau moyen template = ".$niv_temp."<br>");
      if($best_races[$pcdm['race']]['niv_base']!=0){ // niveau de base de la race connu
		//print("DEBUG: niveau de base de la race connu<br>");
		$niv_temp-=$best_races[$pcdm['race']]['niv_base'];
		//print("DEBUG: �cart de niveau = ".$niv_temp."<br>");
		if($best_templates[$cdm['id_template_cdm']]['modif_niveau_template']==0) {
	  		//print("DEBUG: on connait pas le modif de template<br>");
	  		$best_templates[$cdm['id_template_cdm']]['modif_niveau_template']=$niv_temp;
	  		//print("DEBUG: modif niveau template[".$cdm['id_template_cdm']."] = ".$niv_temp."<br>");
	  		$niv_temp_change=true; // on a calcul� le niveau du template
		}
		else{ // niveau d�j� calcul� pr�c�demment, on v�rifie
	  		//print("DEBUG: niveau d�j� calcul� pr�c�demment, on v�rifie<br>");
	  		if($nivtemp!=$best_templates[$cdm['id_template_cdm']]['modif_niveau_template']){
	    		//print("DEBUG:  on ne touche � rien mais on le note<br>");
	    		// probl�me les niveaux ne sont pas les m�mes alors qu'ils auraient du l'�tre
	    		// on ne touche � rien mais on le note
	    		$sql="INSERT INTO best_niv_race_template(`id_race_niv`,`id_template_niv`,`niv_race_niv`,`niv_template_niv`) VALUES(\"".$cdm['id_race_cdm']."\",\"".$cdm['id_template_cdm']."\",\"".$best_templates[$cdm['id_template_cdm']]['modif_niveau_template']."\",\"".$best_races[$pcdm['race']]['niv_base']."\")";
	    		$query=mysql_query($sql,$db_vue_rm);
	  		}
		}
      }
      else{ // niveau de base de la race inconnu
		//print("DEBUG: niveau de base de la race inconnu<br>");
		if($best_templates[$cdm['id_template_cdm']]['modif_niveau_template']!=0){ // on connait celui du template
	  		//print("DEBUG: on connait celui du template<br>");
	  		$niv_temp-=$best_templates[$cdm['id_template_cdm']]['modif_niveau_template'];
	  		//print("DEBUG: niveau base race = ".$niv_temp."<br>");
	  		$best_races[$pcdm['race']]['niv_base']=$niv_temp;
	  		$niv_race_change=true; // on a calcul� le niveau de la race
		} // sinon on ne peut rien calculer ou v�rifier
      }
    }
  }
  
  // les pdv
  recoup_monstre_update ("pdv",999);
  
  // l'attaque
  recoup_monstre_update ("att",99);
  
  // l'esquive
  recoup_monstre_update ("esq",99);
  
  // les d�g�ts
  recoup_monstre_update ("deg",99);
  
  // la regen
  recoup_monstre_update ("reg",99);
  
  // l'armure
  recoup_monstre_update ("arm",99);
  
  // la vue
  recoup_monstre_update ("vue",99);
  
  // la MM
  recoup_monstre_update ("mm",99999);
  
  // la RM
  recoup_monstre_update ("rm",99999);
  
  // la DLA
  recoup_monstre_update ("dla",99);
  
  // nombre d'attaque
  if($pcdm['nbatt']!="" && $pcdm['nbatt']!=$cdm['nbatt_cdm']){
	$cdm['nbatt_cdm']=$pcdm['nbatt'];
	$cdmchange=true;
  }
  
  // Vitesse deplacement
  if($pcdm['vitdep']!="" && $pcdm['vitdep']!=$cdm['vitdep_cdm']){
	$cdm['vitdep_cdm']=$pcdm['vitdep'];
	$cdmchange=true;
  }
	
  // Voir le cach�
  if($pcdm['vlc']!="" && $pcdm['vlc']!=$cdm['vlc_cdm']){
	$cdm['vlc_cdm']=$pcdm['vlc'];
	$cdmchange=true;
  }

  // Attaque distante
  if($pcdm['attdist']!="" && $pcdm['attdist']!=$cdm['attdist_cdm']){
	$cdm['attdist_cdm']=$pcdm['attdist'];
	$cdmchange=true;
  }

  if($pcdm['blessure']!=$cdm['blessure_cdm']){
	$cdm['blessure_cdm']=$pcdm['blessure'];
	$cdmchange=true;
  }

  $cdm['capspe_cdm']           =$pcdm['capspe'];
  $cdm['affecte_cdm']          =$pcdm['affecte'];
  $cdm['source_cdm']           =$pcdm['troll_nom'];
  $monstre['capspe_monstre']   =$pcdm['capspe'];
  $monstre['affecte_monstre']  =$pcdm['affecte'];
  if($cdmchange){ // la cdm a �t� ajust�e, il faut modifier les donn�es dans la base
    $sql="UPDATE `best_cdms` SET `id_mh`=\"".$cdm['id_mh']."\",`id_race_cdm`=\"".$cdm['id_race_cdm']."\",`id_template_cdm`=\"".$cdm['id_template_cdm']."\",`id_age_cdm`=\"".$cdm['id_age_cdm']."\",`id_monstre_cdm`=\"".$cdm['id_monstre_cdm']."\",`nivmin_cdm`=\"".$cdm['nivmin_cdm']."\",`nivmax_cdm`=\"".$cdm['nivmax_cdm']."\",`pdvmin_cdm`=\"".$cdm['pdvmin_cdm']."\",`pdvmax_cdm`=\"".$cdm['pdvmax_cdm']."\",`blessure_cdm`=\"".$cdm['blessure_cdm']."\",`attmin_cdm`=\"".$cdm['attmin_cdm']."\",`attmax_cdm`=\"".$cdm['attmax_cdm']."\",`esqmin_cdm`=\"".$cdm['esqmin_cdm']."\",`esqmax_cdm`=\"".$cdm['esqmax_cdm']."\",`degmin_cdm`=\"".$cdm['degmin_cdm']."\",`degmax_cdm`=\"".$cdm['degmax_cdm']."\",`regmin_cdm`=\"".$cdm['regmin_cdm']."\",`regmax_cdm`=\"".$cdm['regmax_cdm']."\",`armmin_cdm`=\"".$cdm['armmin_cdm']."\",`armmax_cdm`=\"".$cdm['armmax_cdm']."\",`vuemin_cdm`=\"".$cdm['vuemin_cdm']."\",`vuemax_cdm`=\"".$cdm['vuemax_cdm']."\",`mmmin_cdm`=\"".$cdm['mmmin_cdm']."\",`mmmax_cdm`=\"".$cdm['mmmax_cdm']."\",`rmmin_cdm`=\"".$cdm['rmmin_cdm']."\",`rmmax_cdm`=\"".$cdm['rmmax_cdm']."\",`dlamin_cdm`=\"".$cdm['dlamin_cdm']."\",`dlamax_cdm`=\"".$cdm['dlamax_cdm']."\",`nbatt_cdm`=\"".$cdm['nbatt_cdm']."\",`vitdep_cdm`=\"".$cdm['vitdep_cdm']."\",`vlc_cdm`=\"".$cdm['vlc_cdm']."\",`attdist_cdm`=\"".$cdm['attdist_cdm']."\",`capspe_cdm`=\"".$cdm['capspe_cdm']."\",`affecte_cdm`=\"".$cdm['affecte_cdm']."\",`source_cdm`=\"".$cdm['source_cdm']."\" WHERE `id_cdm`=".$cdm['id_cdm']." LIMIT 1 ";
    if(!mysql_query($sql,$db_vue_rm)){
      die("la modification de la cdm a �chou�<br>$sql<br>");
    }
  }
  if($monstrechange){ // certaines caracs du monstres ont �t� ajust�es, il faut les modifier dans la base
    $sql="UPDATE `best_monstres` SET `nivsom_monstre`=\"".$monstre['nivsom_monstre']."\", `nivnbr_monstre`=\"".$monstre['nivnbr_monstre']."\", `pdvsom_monstre`=\"".$monstre['pdvsom_monstre']."\", `pdvnbr_monstre`=\"".$monstre['pdvnbr_monstre']."\", `attsom_monstre`=\"".$monstre['attsom_monstre']."\", `attnbr_monstre`=\"".$monstre['attnbr_monstre']."\", `esqsom_monstre`=\"".$monstre['esqsom_monstre']."\", `esqnbr_monstre`=\"".$monstre['esqnbr_monstre']."\", `degsom_monstre`=\"".$monstre['degsom_monstre']."\", `degnbr_monstre`=\"".$monstre['degnbr_monstre']."\", `regsom_monstre`=\"".$monstre['regsom_monstre']."\", `regnbr_monstre`=\"".$monstre['regnbr_monstre']."\", `armsom_monstre`=\"".$monstre['armsom_monstre']."\", `armnbr_monstre`=\"".$monstre['armnbr_monstre']."\", `vuesom_monstre`=\"".$monstre['vuesom_monstre']."\", `vuenbr_monstre`=\"".$monstre['vuenbr_monstre']."\",`mmsom_monstre`=\"".$monstre['mmsom_monstre']."\", `mmnbr_monstre`=\"".$monstre['mmnbr_monstre']."\", `rmsom_monstre`=\"".$monstre['rmsom_monstre']."\", `rmnbr_monstre`=\"".$monstre['rmnbr_monstre']."\", `dlasom_monstre`=\"".$monstre['dlasom_monstre']."\", `dlanbr_monstre`=\"".$monstre['dlanbr_monstre']."\", `date_monstre`=NOW(  )  WHERE `id_monstre`=".$monstre['id_monstre']." LIMIT 1 ";
    if(!mysql_query($sql,$db_vue_rm)){
      die("la modification des caract�ristiques du monstre a �chou�<br>$sql<br>");
    }
  }
  if($niv_temp_change){ // le modificateur de niveau du template a �t� ajust�, il faut l'enregistrer
    $sql="UPDATE `best_templates` SET `modif_niveau_template`=\"".$best_templates[$cdm['id_template_cdm']]['modif_niveau_template']."\" WHERE `id_template`=".$cdm['id_template_cdm']." LIMIT 1";
    if(!mysql_query($sql,$db_vue_rm)){
      die("la modification du modificateur de niveau du template a �chou�<br>$sql<br>");
    }
  }
  else if($niv_race_change){ // le niveau de la base a �t� ajust�, il faut l'enregistrer
    $sql="UPDATE `best_races` SET `niv_base`=\"".$best_races[$pcdm['race']]['niv_base']."\" WHERE `id_race`=".$cdm['id_race_cdm']." LIMIT 1";
    if(!mysql_query($sql,$db_vue_rm)){
      die("la modification du niveau de base de la race a �chou�<br>$sql<br>");
    }
  }
}

//
// une nouvelle cdm a �t� entr�e par un troll, il faut le noter
//
// ce troll est-il d�j� r�pertori� ?
$sql="SELECT * FROM `best_trolls` WHERE `id_troll`=".$pcdm['troll_id'];
if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de la requ�te sur les trolls : ".$sql."->".mysql_error());

if(mysql_num_rows($query)==0){ // aucun troll avec cet id existe, on le rajoute
  $sql="INSERT INTO best_trolls(`id_troll`,`nom_troll`) VALUES(\"".$pcdm['troll_id']."\",\"".$pcdm['troll_nom']."\")";
  if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de la requ�te sur les trolls : ".$sql."->".mysql_error());
}
else{
  if($pcdm['troll_id']!=0){ // si il existe et que ce n'est pas le troll anonyme
    if($auto){ // si l'id a �t� donn� par le parser directement, on remplace le nom
      $sql="UPDATE `best_trolls` SET `nom_troll`=\"".$pcdm['troll_nom']."\" WHERE `id_troll`=".$pcdm['troll_id']." LIMIT 1";
      if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de la requ�te sur les trolls : ".$sql."->".mysql_error());
    } // sinon on ne touche pas au nom
  }
}

// maintenant on peut enregistrer l'entr�e de la cdm pour ce troll dans les sources
$sql="SELECT * FROM `best_sources` WHERE `id_troll_source`=".$pcdm['troll_id']." AND `id_mh_source`=".$pcdm['id_mh'];
if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de la requ�te sur les sources : ".$sql."->".mysql_error());
if(mysql_num_rows($query)==0){ // aucun source de ce troll pour cette cdm n'a d�j� �t� enregistr�e
  $sql="INSERT INTO best_sources(id_troll_source,id_mh_source) VALUES(\"".$pcdm['troll_id']."\",\"".$pcdm['id_mh']."\")";
  if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de la requ�te sur les sources : ".$sql."->".mysql_error());
}
else{
  $source=mysql_fetch_array($query);
  $source['nbr_cdms_source']+=1;
  $sql="UPDATE `best_sources`SET `nbr_cdms_source`=\"".$source['nbr_cdms_source']."\" WHERE `id_troll_source`=".$pcdm['troll_id']." AND  `id_mh_source`=".$pcdm['id_mh']." LIMIT 1";
  if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de la requ�te sur les sources : ".$sql."->".mysql_error());
}

$monstre['monstre']=$cdm['monstre']=$pcdm['monstre'];
$monstre['race']   =$cdm['race']   =$pcdm['race'];
$monstre['famille']=$cdm['famille']=$pcdm['famille'];
$monstre['age']    =$cdm['age']    =$pcdm['age'];


if($suite=="Bestiaire")
  $js="document.location.href='../bestiaire.php?Race=".urlencode($cdm['race'])."&Template=".$cdm['id_template_cdm']."&IDAge=".$cdm['id_age_cdm']."&MH=".$cdm['id_mh']."';";
else
  $js="document.location.href='../cdm_parser.php';";

print("<html><head><title>CdM</title></head>");
print("<script language='JavaScript'>$js</script>");
print("</body></html>");


function recoup_monstre_update ($carac,$max)
{
// Si les car max de la nouvelle cdm sont inf�rieures � l'ancienne
  global $monstrechange,$cdm,$cdmchange,$pcdm,$monstre;
  $caracchange = false;
  $carmch = false;	
  if($pcdm[$carac.'max'] < $cdm[$carac.'max_cdm'])
  {
  	//on met � jour la table des monstres
  	if ($cdm[$carac.'max_cdm'] != $max )
  	{
  		// on enl�ve de la somme la pr�c�dente cdm
  		$monstre[$carac.'som_monstre']-=$cdm[$carac.'min_cdm']+$cdm[$carac.'max_cdm'];
  		$carmch=true;
  	}
  	else
  	{
  		// on rajoute les nouvelles caracs
  		$monstre[$carac.'som_monstre']+=$pcdm[$carac.'max']+$pcdm[$carac.'min'];
  		$monstre[$carac.'nbr_monstre']=$monstre[$carac.'nbr_monstre']+2;
  	}
  	// recoupement de la cdm
    $cdm[$carac.'max_cdm']=$pcdm[$carac.'max'];
    $cdmchange=$caracchange=$monstrechange=true;
  }
  
  if( $pcdm[$carac.'min'] > $cdm[$carac.'min_cdm'] )
  {
  	// Si on n'a pas d�j� modifi� les sommes et si on connait le max de la carac
  	if ( !$caracchange && $cdm[$carac.'max_cdm'] != $max )
  	{
  		$monstre[$carac.'som_monstre']-=$cdm[$carac.'min_cdm']+$cdm[$carac.'max_cdm'];
		$carmch=true;
  		$monstrechange=true;
  	}
  	// recoupement de la cdm
    $cdm[$carac.'min_cdm']=$pcdm[$carac.'min'];
    $cdmchange=true;
  }
  if ($carmch)
    	$monstre[$carac.'som_monstre']+=$cdm[$carac.'min_cdm']+$cdm[$carac.'max_cdm'];
}

function recoup_monstre_insert ($carac,$max)
{
  global $cdm,$monstre;
  if ($cdm[$carac.'max_cdm'] != $max)
  {
  	$monstre[$carac.'som_monstre'] += $cdm[$carac.'max_cdm'] + $cdm[$carac.'min_cdm'];
	$monstre[$carac.'nbr_monstre'] = $monstre[$carac.'nbr_monstre'] + 2;  	
  }
}
  
?>
