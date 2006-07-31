<?PHP
/******************************************************************************
*                                                                             *
* majcdm - fichier pour gérer les maj des cdms existantes                     *
* Copyright (C) 2004  Cormyr (cormyr@cat-the-psion.net)                       *
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
include_once('../../inc_connect.php3');
include_once('../../inc_authent.php3');

require_once ("../Libs/functions.php"); // quelques fonctions

global $db_bestiaire;

if(isset($_POST['soumettre'])){    
  $copiercoller=$_POST['copiercoller'];
  $lignes = explode("\n", htmlspecialchars(stripslashes($copiercoller)));
  $i=0;
  $j=0;
  while ($lignes[$i]){	
    if(eregi('[ \t]*Tr.ll.+[nN]°(.+):(.+)',$lignes[$i],$resultat)){
      $cdm_troll_nom = trim($resultat[2]);
      $cdm_troll_id  = trim($resultat[1]);
      $Troll = $cdm_troll_nom;
    }
    if(eregi('[ \t]*Le monstre.+:(.+)\((.+)\[(.+)\].-.[Nn]°[0-9]+\)',$lignes[$i],$resultat)){
      $cdm_famille  = trim($resultat[1]);
      $cdm_template = trim($resultat[2]);
      $cdm_age      = trim($resultat[3]);
      $Famille = $cdm_famille;
      $Monstre = $cdm_template;
      $Age     = $cdm_age;
    }
    else if(eregi('[ \t]*Le monstre.+:(.+)\((.+).-.[Nn]°[0-9]+\)',$lignes[$i],$resultat)){
      $cdm_famille  = trim($resultat[1]);
      $cdm_template = trim($resultat[2]);
      $cdm_age      = '';
      $Famille = $cdm_famille;
      $Monstre = $cdm_template;
      $Age     = $cdm_age;
    }
    if(eregi('[ \t]*Niveau.:.(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_niv_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    : $cdm_niv_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur': $cdm_niv_val = '< '.$mot[2];break;
      case 'supérieur': $cdm_niv_val = '> '.$mot[2];break;
      }
      $Niv=$cdm_niv_val;
    }
    if(eregi('[ \t]*Points.+:.(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_pv_com = trim($resultat[1]);
      $mot	  = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'     :  $cdm_pv_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur' :  $cdm_pv_val = '< '.$mot[2]	   ;break;
      case 'supérieur' :  $cdm_pv_val = '> '.$mot[2] 	   ;break;
      }
      $Pdv=$cdm_pv_val;
    }
    if(eregi('[ \t]*D.s.+attaque.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_att_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'     :  $cdm_att_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur' :  $cdm_att_val = '< '.$mot[2]	    ;break;
      case 'supérieur' :  $cdm_att_val = '> '.$mot[2] 	    ;break;
      }
      $Att=$cdm_att_val;
    }
    if(eregi('[ \t]*D.s.+esquive.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_esq_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    :  $cdm_esq_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_esq_val	= '< '.$mot[2]	     ;break;
      case 'supérieur':  $cdm_esq_val	= '> '.$mot[2] 	     ;break;
      }
      $Esq=$cdm_esq_val;
    }
    if(eregi('[ \t]*D.s.+d.g.t.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_deg_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    :  $cdm_deg_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_deg_val	= '< '.$mot[2]	     ;break;
      case 'supérieur':  $cdm_deg_val	= '> '.$mot[2] 	     ;break;
      }
      $Deg=$cdm_deg_val;
    }
    if(eregi('[ \t]*D.s.+R.g.n.ration.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_reg_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    :  $cdm_reg_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_reg_val	= '< '.$mot[2]	     ;break;
      case 'supérieur':  $cdm_reg_val	= '> '.$mot[2] 	     ;break;
      }
      $Reg=$cdm_reg_val;
    }
    if(eregi('[ \t]*Armure.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_arm_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch(trim($mot[0])){
      case 'entre'    :  $cdm_arm_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_arm_val	= '< '.$mot[2]	     ;break;
      case 'supérieur':  $cdm_arm_val	= '> '.$mot[2] 	     ;break;
      }
      $Arm=$cdm_arm_val;
    }
    if(eregi('[ \t]*Vue.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_vue_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    : $cdm_vue_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur': $cdm_vue_val = '< '.$mot[2]        ;break;
      case 'supérieur': $cdm_vue_val = '> '.$mot[2]        ;break;
      }
      $Vue=$cdm_vue_val;
    }
    if(eregi('[ \t]*Capacit.+:(.+) - Aff.+: (.+)',$lignes[$i],$resultat)){
      $cdm_capacite = trim($resultat[1]);
      $cdm_affecte  = trim($resultat[2]);
      $Cap=$cdm_capacite;
      $Aff=$cdm_affecte;
    }
    $i++;
  }

  $sql="SELECT Race FROM `monstres` WHERE `Monstre`=\"$Monstre\";";
  $query=mysql_query($sql,$db_bestiaire);
  $ret=mysql_fetch_array($query);
  $Race=$ret['Race'];

  //
  // remplissage du tableau des races (sert à la construction du SELECT des races
  //
  $races=array();
  $sql="SELECT * FROM `races` ORDER by `race` ASC;"; // récupérer toutes les races
  $query=mysql_query($sql,$db_bestiaire);
  while($ret=mysql_fetch_array($query)){ // stocker toutes les races dans le
    $races[$ret[0]]=$ret;                // tableau $races 
  }
  $image=$races[$Race]['image'];// nom de l'image représentant la race
  $Famille=$races[$Race]['Famille'];// nom de la famille de la race.
  $genre=$races[$Race]['genre'];

  $MonstreAge=makeMonsterName($Monstre,$Age);
  
//   print("<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>");
//   print("<tr class='mh_tdtitre'><td>");
//   print("<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'><tbody>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> TROLL	</b></td><td width='33%'>".$cdm_troll_nom."</td><td width='34%'>".$cdm_troll_id."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> FAMILLE	</b></td><td width='33%'>".$cdm_famille."</td><td width='34%'>&nbsp;</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> MONSTRE	</b></td><td width='33%'>".$cdm_template."</td><td width='34%'>".$cdm_age."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> NIVEAU	</b></td><td width='33%'>".$cdm_niv_val."</td><td width='34%'>".$cdm_niv_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> PV		</b></td><td width='33%'>".$cdm_pv_val."</td><td width='34%'>".$cdm_pv_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ATT		</b></td><td width='33%'>".$cdm_att_val."</td><td width='34%'>".$cdm_att_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ESQ		</b></td><td width='33%'>".$cdm_esq_val."</td><td width='34%'>".$cdm_esq_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> DEG		</b></td><td width='33%'>".$cdm_deg_val."</td><td width='34%'>".$cdm_deg_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> REG		</b></td><td width='33%'>".$cdm_reg_val."</td><td width='34%'>".$cdm_reg_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ARM		</b></td><td width='33%'>".$cdm_arm_val."</td><td width='34%'>".$cdm_arm_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> VUE 		</b></td><td width='33%'>".$cdm_vue_val."</td><td width='34%'>".$cdm_vue_com."</td></tr>");
//   print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> CAPACITE	</b></td><td width='33%'>".$cdm_capacite."</td><td width='34%'>".$cdm_affecte."</td></tr>");
//   print("</tbody></table>");
//   print("</td></tr>");
//   print("</table>");
//   print("<br>");
}
?>
