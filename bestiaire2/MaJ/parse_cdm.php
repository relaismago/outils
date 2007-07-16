<?PHP

/******************************************************************************
*                                                                             *
* parse_cdm - analyse automatique d'une cdm                                   *
*                                                                             *
* Copyright (C) 2004  Subigard                                                *
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

require_once ("../../inc_connect.php3"); // connexion à la base
require_once ("../DB/inc_initdata.php");     // recup des données statiques
require_once ("../Libs/functions.php");  // fonction d'affichage du résultat du parsing
require_once ("../Libs/inc_affichage.php");  // fonction d'affichage du résultat du parsing

include('../../top.php');
include('../secure_bestiaire.php');
global $db_vue_rm, $best_templates, $best_races, $best_ages_nom, $best_ages_id, $best_ages, $best_familles;


if(isset($_POST['soumettre'])){
  $pcdm=array(); // parsed cdm
  $copiercoller=$_POST['copiercoller'];
  $lignes = explode("\n", htmlspecialchars(stripslashes($copiercoller)));
  $i=0;
  $j=0;
  $max_carac=99;
  $max_pdv=999;
  $max_mag=99999;
  
  
  while ($lignes[$i]){	
    if(eregi('[ \t]*Tr.ll.+[nN]°(.+):(.+)',$lignes[$i],$resultat)){
      $pcdm['troll_nom'] = trim($resultat[2]);
      $pcdm['troll_id']  = trim($resultat[1]);
    }
    if(eregi('[ \t]*Le monstre.+:(.+)\((.+)\[(.*)\].-.[Nn]°([0-9]+)\)',$lignes[$i],$resultat)){
      $pcdm['famille'] = trim($resultat[1]);
      $pcdm['monstre'] = trim($resultat[2]);
      $pcdm['age']     = trim($resultat[3]);
      $pcdm['id_mh']     = trim($resultat[4]);
    }
    else if(eregi('[ \t]*Le monstre.+:(.+)\((.+).-.[Nn]°([0-9]+)\)',$lignes[$i],$resultat)){
      $pcdm['famille'] = trim($resultat[1]);
      $pcdm['monstre'] = trim($resultat[2]);
      $pcdm['age']     = '';
      $pcdm['id_mh']     = trim($resultat[3]);
    }
    if(eregi('[ \t]*Niveau.:.(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['nivcom'] = trim($resultat[1]);
      $mot = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'    : $pcdm['nivmin']=$mot[1]; $pcdm['nivmax']=$mot[3]; break;
      	case 'inférieur': $pcdm['nivmin']=0;       $pcdm['nivmax']=$mot[2]; break;
      	case 'supérieur': $pcdm['nivmin']=$mot[2]; $pcdm['nivmax']=$max_carac; break;
		case 'égal': $pcdm['nivmin']=$mot[2]; $pcdm['nivmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*Points.+:.(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['pdvcom'] = trim($resultat[1]);
      $mot = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'     :  $pcdm['pdvmin']=$mot[1]; $pcdm['pdvmax']=$mot[3] ;break;
      	case 'inférieur' :  $pcdm['pdvmin']=0;       $pcdm['pdvmax']=$mot[2] ;break;
      	case 'supérieur' :  $pcdm['pdvmin']=$mot[2]; $pcdm['pdvmax']=$max_pdv; break;
	  	case 'égal' :  $pcdm['pdvmin']=$mot[2]; $pcdm['pdvmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*Blessure.+:.(.+).%',$lignes[$i],$resultat)){
    	$pcdm['blessure'] = trim($resultat[1]);
    }
  	if(eregi('(.+).%',$lignes[$i],$resultat) && $pcdm['blessure']==""){
    	$pcdm['blessure'] = trim($resultat[1]);
    }
    if(eregi('[ \t]*D.s.+attaque.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['attcom'] = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'     :  $pcdm['attmin']=$mot[1]; $pcdm['attmax']=$mot[3];break;
      	case 'inférieur' :  $pcdm['attmin']=0;       $pcdm['attmax']=$mot[2]; break;
      	case 'supérieur' :  $pcdm['attmin']=$mot[2]; $pcdm['attmax']=$max_carac; break;
	  	case 'égal' :  $pcdm['attmin']=$mot[2]; $pcdm['attmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*D.s.+esquive.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['esqcom'] = trim($resultat[1]);
      $mot  = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'    :  $pcdm['esqmin']=$mot[1]; $pcdm['esqmax']=$mot[3]; break;
      	case 'inférieur':  $pcdm['esqmin']=0;       $pcdm['esqmax']=$mot[2]; break;
      	case 'supérieur':  $pcdm['esqmin']=$mot[2]; $pcdm['esqmax']=$max_carac; break;
		case 'égal':  $pcdm['esqmin']=$mot[2]; $pcdm['esqmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*D.s.+d.g.t.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['degcom'] = trim($resultat[1]);
      $mot = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'    :  $pcdm['degmin']=$mot[1]; $pcdm['degmax']=$mot[3]; break;
      	case 'inférieur':  $pcdm['degmin']=0;       $pcdm['degmax']=$mot[2]; break;
      	case 'supérieur':  $pcdm['degmin']=$mot[2]; $pcdm['degmax']=$max_carac; break;
		case 'égal':  $pcdm['degmin']=$mot[2]; $pcdm['degmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*D.s.+R.g.n.ration.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['regcom'] = trim($resultat[1]);
      $mot = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'    :  $pcdm['regmin']=$mot[1]; $pcdm['regmax']=$mot[3]; break;
      	case 'inférieur':  $pcdm['regmin']=0;       $pcdm['regmax']=$mot[2]; break;
      	case 'supérieur':  $pcdm['regmin']=$mot[2]; $pcdm['regmax']=$max_carac; break;
		case 'égal':  $pcdm['regmin']=$mot[2]; $pcdm['regmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*Armure :(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['armcom'] = trim($resultat[1]);
      $mot = explode(' ',$resultat[2]);
      switch(trim($mot[0])){
      	case 'entre'    :  $pcdm['armmin']=$mot[1]; $pcdm['armmax']=$mot[3]; break;
      	case 'inférieur':  $pcdm['armmin']=0;       $pcdm['armmax']=$mot[2]; break;
      	case 'supérieur':  $pcdm['armmin']=$mot[2]; $pcdm['armmax']=$max_carac; break;
		case 'égal':  $pcdm['armmin']=$mot[2]; $pcdm['armmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*Vue :(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['vuecom'] = trim($resultat[1]);
      $mot = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'    : $pcdm['vuemin']=$mot[1]; $pcdm['vuemax']=$mot[3]; break;
      	case 'inférieur': $pcdm['vuemin']=0;       $pcdm['vuemax']=$mot[2]; break;
      	case 'supérieur': $pcdm['vuemin']=$mot[2]; $pcdm['vuemax']=$max_carac; break;
		case 'égal': $pcdm['vuemin']=$mot[2]; $pcdm['vuemax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*Capacit.+:(.+) - Aff.+: (.+)',$lignes[$i],$resultat)){
      $pcdm['capspe'] = trim($resultat[1]);
      $pcdm['affecte']  = trim($resultat[2]);
    }

	if(eregi('[ \t]*Capacit.+:(.+) - Aff.+: (.+)Maitrise',$lignes[$i],$resultat)){
	  $pcdm['capspe'] = trim($resultat[1]);
	  $pcdm['affecte']  = trim($resultat[2]);
	}

	if(eregi('[ \t]*Maitrise Magique.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $pcdm['mmcom'] = trim($resultat[1]);
      $mot = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      	case 'entre'    : $pcdm['mmmin']=$mot[1]; $pcdm['mmmax']=$mot[3]; break;
      	case 'inférieur': $pcdm['mmmin']=0;       $pcdm['mmmax']=$mot[2]; break;
        case 'supérieur': $pcdm['mmmin']=$mot[2]; $pcdm['mmmax']=$max_mag; break;
		case 'égal': $pcdm['mmmin']=$mot[2]; $pcdm['mmmax']=$mot[2]; break;
      }
    }
    if(eregi('[ \t]*R.sistance.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
    	$pcdm['rmcom'] = trim($resultat[1]);
		$mot = explode(' ',$resultat[2]);
		switch (trim($mot[0])){
			case 'entre'    : $pcdm['rmmin']=$mot[1]; $pcdm['rmmax']=$mot[3]; break;
			case 'inférieur': $pcdm['rmmin']=0;       $pcdm['rmmax']=$mot[2]; break;
			case 'supérieur': $pcdm['rmmin']=$mot[2]; $pcdm['rmmax']=$max_mag; break;
			case 'égal': $pcdm['rmmin']=$mot[2]; $pcdm['rmmax']=$mot[2]; break;
		}
	}
	if(eregi('[ \t]*Nombre.+:(.+)',$lignes[$i],$resultat)){
		$pcdm['nbatt'] = trim($resultat[1]);
	}
	if(eregi('[ \t]*Vitesse.+:(.+)',$lignes[$i],$resultat)){
		$pcdm['vitdep'] = trim($resultat[1]);
	}
	if(eregi('[ \t]*Voir le Cach.+:(.+)',$lignes[$i],$resultat)){
     	$pcdm['vlc'] = trim($resultat[1]);
	}
	if(eregi('[ \t]*Attaque . dist.+:(.+)',$lignes[$i],$resultat)){
		$pcdm['attdist'] = trim($resultat[1]);
	}
	if(eregi('[ \t]*Dur.e DLA :(.+)\((.+)\)',$lignes[$i],$resultat)){
	  	$pcdm['dlacom'] = trim($resultat[1]);
		$mot = explode(' ',$resultat[2]);
		switch (trim($mot[0])){
			case 'entre'    : $pcdm['dlamin']=$mot[1]; $pcdm['dlamax']=$mot[3]; break;
			case 'inférieur': $pcdm['dlamin']=0;       $pcdm['dlamax']=$mot[2]; break;
			case 'supérieur': $pcdm['dlamin']=$mot[2]; $pcdm['dlamax']=$max_carac; break;
			case 'égal': $pcdm['dlamin']=$mot[2]; $pcdm['dlamax']=$mot[2]; break;
		}
	}
    
	$i++;
  }

	/* Si la cdm est directement envoyée par Firemago
	   on prend le troll connecté */
  if ($pcdm['troll_id'] == "") {
		$pcdm['troll_id'] = $_SESSION[AuthTroll];
		$pcdm['troll_nom'] = $_SESSION[AuthNomTroll]; 
  }		


  // 
  // Recherche de la race et du template
  //
  
  // on applique chaque template au nom du monste trouvé et on vérifie si une
  // race correspond.
  $trouve=false;
  // prend le libellé d'un monstre (sans l'âge) et en extrait la race et le template
  $trouve=($desc_template=splitmonstre_racetemplate($pcdm['monstre'],$pcdm['race']));
  if(!$trouve) die("Race inconnue");
  else $trouve=true;
  
  // récupération du genre de la race pour calculer l'âge
  $pcdm['genre_race']=$best_races[$pcdm['race']]['genre_race'];
  // vérification du nom de la famille
  $trouve=$trouve&&array_key_exists($pcdm['famille'],$best_familles);
  if(!$trouve) die("Famille inconnue");
  
  // vérification de la correspondance famille/race
  $id_famille=$best_familles[$pcdm['famille']]['id_famille'];
  $trouve=$trouve&&($id_famille==$best_races[$pcdm['race']]['id_famille_race']);
  if(!$trouve) die("la famille ne correspond pas à la race");

  // vérification du nom de l'âge
  // on cherche si l'âge indiqué correspond
  $trouve=$trouve&&in_array($pcdm['age'],$best_ages_nom[$id_famille][$pcdm['genre_race']]);
  if(!$trouve) die("l'âge ne correspond pas à la famille : ".$pcdm['age']."/".$pcdm['famille']." (".$id_famille.")");

  // Tout est ok, on récupère les clefs
  $pcdm['id_race']    =$best_races[$pcdm['race']]['id_race'];
  $pcdm['id_template']=$desc_template['id_template'];;
  $pcdm['template']   =$desc_template['nom_template'];
  $pcdm['id_famille'] =$id_famille;
  $pcdm['id_age']     =$best_ages_id[$id_famille][$pcdm['age']];

  print("<center>");
  print("<form name=\"valid_cdm_bestiaire\" action=\"enregistrecdm.php\" method=\"POST\" >");
  //
  affiche_cdm_parsed($pcdm);
  //
  print("<INPUT TYPE=HIDDEN NAME=\"MONSTRE\" VALUE=\"".$pcdm['monstre']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ID_MH\" VALUE=\"".$pcdm['id_mh']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"RACE\" VALUE=\"".$pcdm['race']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"GENRE_RACE\" VALUE=\"".$pcdm['genre_race']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ID_RACE\" VALUE=\"".$pcdm['id_race']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"TEMPLATE\" VALUE=\"".$pcdm['template']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ID_TEMPLATE\" VALUE=\"".$pcdm['id_template']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"AGE\" VALUE=\"".$pcdm['age']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ID_AGE\" VALUE=\"".$pcdm['id_age']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"FAMILLE\" VALUE=\"".$pcdm['famille']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ID_FAMILLE\" VALUE=\"".$pcdm['id_famille']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"NIVMIN\" VALUE=\"".$pcdm['nivmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"NIVMAX\" VALUE=\"".$pcdm['nivmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"PDVMIN\" VALUE=\"".$pcdm['pdvmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"PDVMAX\" VALUE=\"".$pcdm['pdvmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"BLESSURE\" VALUE=\"".$pcdm['blessure']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ATTMIN\" VALUE=\"".$pcdm['attmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ATTMAX\" VALUE=\"".$pcdm['attmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ESQMIN\" VALUE=\"".$pcdm['esqmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ESQMAX\" VALUE=\"".$pcdm['esqmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"DEGMIN\" VALUE=\"".$pcdm['degmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"DEGMAX\" VALUE=\"".$pcdm['degmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"REGMIN\" VALUE=\"".$pcdm['regmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"REGMAX\" VALUE=\"".$pcdm['regmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ARMMIN\" VALUE=\"".$pcdm['armmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ARMMAX\" VALUE=\"".$pcdm['armmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"VUEMIN\" VALUE=\"".$pcdm['vuemin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"VUEMAX\" VALUE=\"".$pcdm['vuemax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"MMMIN\" VALUE=\"".$pcdm['mmmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"MMMAX\" VALUE=\"".$pcdm['mmmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"RMMIN\" VALUE=\"".$pcdm['rmmin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"RMMAX\" VALUE=\"".$pcdm['rmmax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"NBATT\" VALUE=\"".$pcdm['nbatt']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"VITDEP\" VALUE=\"".$pcdm['vitdep']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"VLC\" VALUE=\"".$pcdm['vlc']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"ATTDIST\" VALUE=\"".$pcdm['attdist']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"DLAMIN\" VALUE=\"".$pcdm['dlamin']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"DLAMAX\" VALUE=\"".$pcdm['dlamax']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"CAPSPE\" VALUE=\"".$pcdm['capspe']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"AFFECTE\" VALUE=\"".$pcdm['affecte']."\"></INPUT>");
  print("<INPUT TYPE=HIDDEN NAME=\"DATE\" VALUE=\"".$pcdm['date']."\"></INPUT>");
//   print("<INPUT TYPE=HIDDEN NAME=\"SOURCE\" VALUE=\"".$pcdm['troll_nom']."\"></INPUT>");
  print("<INPUT TYPE=submit NAME=\"SUITE\" VALUE=\"Bestiaire\" class='mh_form_submit'></input>");
  print("<INPUT TYPE=submit NAME=\"SUITE\" VALUE=\"Autre CdM\" class='mh_form_submit'></input>");
  print("</form>");
  print("<br>");
  print("</center>");
  print("</body></html>");
  
}
else die("Accès interdit");

include('../../foot.php');

?>
