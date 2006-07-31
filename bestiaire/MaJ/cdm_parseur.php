<?PHP
/******************************************************************************
*                                                                             *
* Bestiaire - fichier principal pour l'affichage du bestiaire                 *
* Copyright (C) 2004  Subigard                                                *
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
require_once ("../../head.php3"); // quelques fonctions

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
    }
    if(eregi('[ \t]*Le monstre.+:(.+)\((.+)\[(.+)\].-.[Nn]°[0-9]+\)',$lignes[$i],$resultat)){
      $cdm_famille  = trim($resultat[1]);
      $cdm_template = trim($resultat[2]);
      $cdm_age      = trim($resultat[3]);
    }
    else if(eregi('[ \t]*Le monstre.+:(.+)\((.+).-.[Nn]°[0-9]+\)',$lignes[$i],$resultat)){
      $cdm_famille  = trim($resultat[1]);
      $cdm_template = trim($resultat[2]);
      $cdm_age      = '';
    }
    if(eregi('[ \t]*Niveau.:.(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_niv_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    : $cdm_niv_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur': $cdm_niv_val = '<'.$mot[2];break;
      case 'supérieur': $cdm_niv_val = '>'.$mot[2];break;
      }
    }
    if(eregi('[ \t]*Points.+:.(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_pv_com = trim($resultat[1]);
      $mot	  = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'     :  $cdm_pv_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur' :  $cdm_pv_val = '<'.$mot[2]	   ;break;
      case 'supérieur' :  $cdm_pv_val = '>'.$mot[2] 	   ;break;
      }
    }
    if(eregi('[ \t]*D.s.+attaque.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_att_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'     :  $cdm_att_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur' :  $cdm_att_val = '<'.$mot[2]	    ;break;
      case 'supérieur' :  $cdm_att_val = '>'.$mot[2] 	    ;break;
      }
    }
    if(eregi('[ \t]*D.s.+esquive.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_esq_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    :  $cdm_esq_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_esq_val	= '<'.$mot[2]	     ;break;
      case 'supérieur':  $cdm_esq_val	= '>'.$mot[2] 	     ;break;
      }
    }
    if(eregi('[ \t]*D.s.+d.g.t.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_deg_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    :  $cdm_deg_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_deg_val	= '<'.$mot[2]	     ;break;
      case 'supérieur':  $cdm_deg_val	= '>'.$mot[2] 	     ;break;
      }
    }
    if(eregi('[ \t]*D.s.+R.g.n.ration.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_reg_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    :  $cdm_reg_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_reg_val	= '<'.$mot[2]	     ;break;
      case 'supérieur':  $cdm_reg_val	= '>'.$mot[2] 	     ;break;
      }
    }
    if(eregi('[ \t]*Armure.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_arm_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch(trim($mot[0])){
      case 'entre'    :  $cdm_arm_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur':  $cdm_arm_val	= '<'.$mot[2]	     ;break;
      case 'supérieur':  $cdm_arm_val	= '>'.$mot[2] 	     ;break;
      }
    }
    if(eregi('[ \t]*Vue.+:(.+)\((.+)\)',$lignes[$i],$resultat)){
      $cdm_vue_com = trim($resultat[1]);
      $mot         = explode(' ',$resultat[2]);
      switch (trim($mot[0])){
      case 'entre'    : $cdm_vue_val = $mot[1].'-'.$mot[3];break;
      case 'inférieur': $cdm_vue_val = '<'.$mot[2]        ;break;
      case 'supérieur': $cdm_vue_val = '>'.$mot[2]        ;break;
      }
    }
    if(eregi('[ \t]*Capacit.+:(.+) - Aff.+: (.+)',$lignes[$i],$resultat)){
      $cdm_capacite = trim($resultat[1]);
      $cdm_affecte  = trim($resultat[2]);
    }
    $i++;
  }
  
  print("<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>");
  print("<tr class='mh_tdtitre'><td>");
  print("<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'><tbody>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> TROLL	</b></td><td width='33%'>".$cdm_troll_nom."</td><td width='34%'>".$cdm_troll_id."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> FAMILLE	</b></td><td width='33%'>".$cdm_famille."</td><td width='34%'>&nbsp;</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> MONSTRE	</b></td><td width='33%'>".$cdm_template."</td><td width='34%'>".$cdm_age."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> NIVEAU	</b></td><td width='33%'>".$cdm_niv_val."</td><td width='34%'>".$cdm_niv_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> PV		</b></td><td width='33%'>".$cdm_pv_val."</td><td width='34%'>".$cdm_pv_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ATT		</b></td><td width='33%'>".$cdm_att_val."</td><td width='34%'>".$cdm_att_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ESQ		</b></td><td width='33%'>".$cdm_esq_val."</td><td width='34%'>".$cdm_esq_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> DEG		</b></td><td width='33%'>".$cdm_deg_val."</td><td width='34%'>".$cdm_deg_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> REG		</b></td><td width='33%'>".$cdm_reg_val."</td><td width='34%'>".$cdm_reg_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ARM		</b></td><td width='33%'>".$cdm_arm_val."</td><td width='34%'>".$cdm_arm_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> VUE 		</b></td><td width='33%'>".$cdm_vue_val."</td><td width='34%'>".$cdm_vue_com."</td></tr>");
  print("<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> CAPACITE	</b></td><td width='33%'>".$cdm_capacite."</td><td width='34%'>".$cdm_affecte."</td></tr>");
  print("</tbody></table>");
  print("</td></tr>");
  print("</table>");
  print("<br>");
}

print("<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>");
print("<tr class='mh_tdtitre'><td>");
print("<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>");
print("<form action='confirmparsecdm.php' method='post'>");

print("<tr valign='middle' class='mh_tdtitre'>");
print("<td align='center' bgcolor='#F75007'>Analyseur de CDM</td>");
print("</tr>");
print("<tr align='center'>");
print("<td height='35' width='100%' align='center' ><font color='#FFFFFF'>Données MH<br>Faire un copier coller du message BOT du CdM</font></TD>");
print("</tr>");

print("<tr valign='middle' class='mh_tdpage'>");
print("<td width='100%' align='center'>");
print("&nbsp;<br><textarea rows='10' cols='75' name='copiercoller'></textarea><br>&nbsp;");
print("</td>");
print("</tr>");

print("<tr valign='middle' class='mh_tdpage'>");
print("<TD align='center'>");
print("&nbsp;<br><INPUT TYPE='submit' NAME='soumettre' VALUE='On parse le zinzin...' CLASS='mh_form_submit'><br>&nbsp;");
print("</td>");
print("</tr>");

print("</form>");
print("</table>");
print("</td></tr>");

print("</table>");

print("</body>");
print("</html>");
?>
