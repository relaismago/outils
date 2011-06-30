<?PHP

/******************************************************************************
*                                                                             *
* inc_affichage - fichier contenant les fonctions d'affichage                 *
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

require_once("functions.php");


//*****************************************************************************
//*****************************************************************************
//*
//* Fonctions d'affichage des éléments de la page du bestiaire
//*
//*****************************************************************************
//*****************************************************************************


// ShowListFamille($famille)
// Input $famille  : nom de la famille pré-sélectionnée
// Return : une chaine html décrivant toutes les options d'un SELECT pour la
//          sélection d'une famille
//
function ShowListFamilles($famille)
{
  global $best_familles;
  if(($famille=="-1")||($famille=='')) $famille="Animal"; // pas de famille pré-selectionnée, on prend la première
  $option="<option label=\"Animal\" value=\"allraces.php?Famille=-1";
  foreach($best_familles as $key=>$idfamille)
  {
    if($key==$famille) $option.="<option label=\"$key\" value=\"allraces.php?Famille=$key\" selected>$key</option>";
    else               $option.="<option label=\"$key\" value=\"allraces.php?Famille=$key\">$key</option>";
  }
  return $option;
}

// ShowListRaces($race,$template,$idage)
// Input $race     : la race pré-sélectionnée
//       $template : id du template pré-selectionné
//       $idage    : id de l'âge pré-sélectionné
// Return : une chaine html décrivant toutes les options d'un SELECT pour la
//          sélection d'une race
//
function ShowListRaces($race,$template,$idage)
{
  global $best_races;
  if($race=="-1") $race=$best_races['Abishaii Bleu']['nom_race']; // pas de race pré-selectionnée, on prend la première
  $option="<option label=\"-1\" value=\"bestiaire.php?Race=-1&Template=-1&IDAge=-1\" selected>?</option>";
  foreach($best_races as $key=>$trace)
  {
    if($key==$race) $option.="<option label=\"$key\" value=\"bestiaire.php?Race=$key&Template=$template&IDAge=$idage\" selected>$key</option>";
    else            $option.="<option label=\"$key\" value=\"bestiaire.php?Race=$key&Template=$template&IDAge=$idage\">$key</option>";
  }
  return $option;
}

// ShowListTemplates($races,$name)
// Input $race     : nom de la race dont il faut afficher les templates
//       $template : id du template pré-sélectionné
//       $idage    : id de l'âge pré-sélectionné
// Return : une chaine html décrivant toutes les options d'un SELECT pour la
//          sélection d'un template de race $race
//
function ShowListTemplates($race,$template,$idage)
{
  global $best_races, $best_templates,$best_racetemplate;
  if($race=="-1") $race='Abishaii Bleu'; // pas de race pré-selectionnée, on prend la première
  $option="<option label=\"-1\" value=\"bestiaire.php?Race=".$race."&Template=-1&IDAge=".$idage;
  if($template=="-1") $option.="\" selected >";
  else               $option.="\">";
  $option.="?</option>";  
  $tab_templates=$best_racetemplate[$best_races[$race]['id_race']];
  foreach($tab_templates as $id_template)
  {
    $option.="<option label=\"".$best_templates[$id_template]['id_template']."\" value=\"bestiaire.php?Race=".$race."&Template=".$id_template."&IDAge=".$idage;
    if($id_template==$template) $option.="\" selected >";
    else                        $option.="\">";
    // normalement pas d'erreur possible de makeTemplateName puisqu'on s'appuie sur les race/templates rentrés depuis
    // des cdms (table best_racetemplate). On vérifie quand même par acquis de conscience
    $monstrename=makeTemplateName($race,$id_template); 
    if($monstrename) $option.=$monstrename."</option>";
    else             $option.=$race."</option>";
  }
  return $option;
}
  
// ShowListAges($races,$age)
// Input $race     : nom de la race dont on doit afficher les âges
//       $template : id du template pré-selectionné
//       $idage    : id de l'âge pré-sélectionné
//       $age      : nom de l'âge pré-sélectionné
// Return : une chaine html décrivant toutes les options d'un SELECT pour la
//          sélection d'un age de la race $race
//
function ShowListAges($race,$template,$idage,$age)
{
  global $best_races,$best_ages_nom,$best_ages_id;
  if($race=="-1") $race='Abishaii Bleu'; // pas de race pré-selectionnée, on prend la première
  $option="<option label=\"-1\" value=\"bestiaire.php?Race=".$race."&Template=".$template."&IDAge=-1";
  if($isage=="-1") $option.="\" selected >";
  else             $option.="\">";
  $option.="?</option>";
  $id_famille=$best_races[$race]['id_famille_race'];
  $tab_ages_nom=$best_ages_nom[$id_famille][$best_races[$race]['genre_race']];
  foreach($tab_ages_nom as $ordre=>$nom_age)
  {
    $id_age=$best_ages_id[$id_famille][$nom_age];
    $option.="<option label=\"".$id_age."\" value=\"bestiaire.php?Race=".$race."&Template=".$template."&IDAge=".$id_age;
    // si pas d'âge pré-selectionnée, on prend le premier celui d'ordre 0
    if($id_age==$idage) $option.="\" selected >";
    else                $option.="\">";
    $option.=$ordre." - ".$nom_age."</option>";
  }
  return $option;
}


function afficheMenuBestiaire($niv,$fam)
{
  if($niv!='') $niv="?Niv=$niv";
  if($fam!='') $fam="?Famille=$fam";

	?>
		<table class='mh_tdborder' width='60%'>
			<tr class='mh_tdpage'>
				<td align='center'><a href='bestiaire.php'>Bestiaire</a> </td>
				<? if (userIsGuilde()) {
						echo "<td align='center'><a href='cdm_parser.php'>Nouvelle CdM</a> </td>";
					}
				?>
				<td align='center'><a href='allniv.php<?echo $niv; ?>'>Monstres/Niveau</a> </td>
				<td align='center'><a href='allraces.php<?echo $fam; ?>'>Races/Famille</a> </td>
			</tr>
		</table>
	<?
}


//
// afficheTitreMonstre($Race,$IDTemplate,$IDAge,$Famille)
// Affiche le nom complet du monstre, son îcone et son niveau estimé si possible
// 
//
function afficheTitreMonstre($Race,$IDTemplate,$Age,$Famille,$Niv)
{
  global $best_templates;
  if($IDTemplate!="-1") $Template=$best_templates[$IDTemplate]['nom_template'];
  else                  $Template="?";
  if($Age=="-1")        $Age="?";
  // normalement l'IDTemplate est bon car il a du être calculé d'après la table best_racetemplate
  // Par acquis de conscience on teste quand même
  $MonstreAge=makeMonsterName($Race,$IDTemplate,$Age);
  if(!$MonstreAge) $MonstreAge=$Race." [$Age]"; // le template n'était pas compatible avec la race, on l'ignore
  print("<div align=center>");
  print("<table border=\"1\" cellspacing=\"0\" class='mh_tdborder'> <!-- table race/nom -->");
  print("  <tr class='mh_tdtitre'>");
  print("    <td colspan=2 align=center><b><font size=+1>$MonstreAge</font></b></td>");
  print("  </tr>");
  print("  <tr align=center  class='mh_tdpage'>");
  print("    <td align=left>Niveau estimé: $Niv&nbsp;</td>");
  print("    <td rowspan=5>");
  print("      <img src=\"Images/".nommh2gif($Race)."\" alt=\"Demon.gif\"/>");
  print("    </td>");
  print("  </tr>");  
  print("  <tr align=left  class='mh_tdpage'>");
  print("    <td>Race: ".$Race."&nbsp;</td>");
  print("  </tr>");
  print("  <tr align=left  class='mh_tdpage'>");
  print("    <td>Template: ".$Template."&nbsp;</td>");
  print("  </tr>");
  print("  <tr align=left  class='mh_tdpage'>");
  print("    <td>Age: ".$Age."&nbsp;</td>");
  print("  </tr>");
  print("  <tr align=center  class='mh_tdpage'>");
  print("    <td>$Famille</td>");
  print("  </tr>");
  print("</table>");
  print("</div>");
}

//
// afficheSelecteursMonstre($Race,$IDTemplate,$IDAge,$Age,$Famille)
// affiche les 3 sélecteurs Race / Template / Age permettant de déterminer 
// de quel monstre on veut afficher les caractéristiques
//
function afficheSelecteursMonstre($Race,$IDTemplate,$IDAge,$Age)
{
  print("<div align=center>");
  print("<form name=\"select_cdm\" method=\"GET\" action=\"bestiaire.php\">");
  print("  <input type=\"hidden\" name=\"Race\"  value=\"$Race\"/>");
  print("  <input type=\"hidden\" name=\"Template\"  value=\"$MonstreTemplate\"/>");
  print("  <input type=\"hidden\" name=\"IDAge\"  value=\"$IDAge\"/>");
  print("  <input type=\"hidden\" name=\"Age\"  value=\"$Age\"/>");
  //
  print("<table border=\"0\" cellspacing=\"0\" class='mh_tdborder'> <!-- table race/nom -->");
  print("  <tr align=\"center\" class='mh_tdtitre'>");
  print("    <td width=\"33%\" align=center><font size=\"+0\">Race</font></td>");
  print("    <td width=\"33%\" align=center><font size=\"+0\">Template</font></td>");
  print("    <td width=\"33%\" align=center><font size=\"+0\">Âge</font></td>");
  print("  </tr>");
  print("  <tr align=\"center\" class='mh_tdpage'>");
  print("    <td align=center>");
  print("      <select name=\"race_streum\" onChange=\"CdmSelectMenu();\">");
  print(          showListRaces($Race,$IDTemplate,$IDAge)); // liste des options du menu Race
  print("      </select>");
  print("    </td>");
  print("    <td align=center>");
  print("      <select name=\"template_streum\" onChange=\"CdmSelectMenu()\">");
  print(          showListTemplates($Race,$IDTemplate,$IDAge));
  print("      </select>");
  print("    </td>");
  print("    <td align=center>");
  print("      <select name=\"age_streum\" onChange=\"CdmSelectMenu()\">");
  print(          showListAges($Race,$IDTemplate,$IDAge,$Age));
  print("      </select>");
  print("    </td>");
  print("  </tr>");
  print("</table> <!-- fin table race/nom -->");
  print("</form>");
  print("</div>");
}


function afficheCalculateurPX($niv_default)
{
	?>
  <form name="calc_px">
  <table border="1" cellspacing="0" class='mh_tdborder'>
  <tr align="center" class='mh_tdtitre'>
    <td colspan=4>calculateur de px</td>
  </tr>
  <tr align="center" class='mh_tdpage'>
    <td align=right>Niveau du monstre :</td>
    <td align=left><input name="mniv" type="text" size="8" value="<? echo $niv_default; ?>"></input></td>
    <td rowspan=2 align=center><INPUT onclick="calcPx()"; type="button" value="==>>" class='mh_form_submit'></INPUT></td>
    <td rowspan=2 align=center id="px" width="66">&nbsp;</td>
  </tr>
  <tr align=center class='mh_tdpage'>
    <td align=right>Niveau du troll :</td>
    <td align=left><input name="tniv" type="text" size="8" value="1"></input></td>
  </tr>
  </table> <!-- fin table race/nom -->
  </form>
	<?
}

//*****************************************************************************
//*****************************************************************************
//*
//* Fonctions affichant les résultats de l'analyse des cdms
//*
//*****************************************************************************
//*****************************************************************************

//
// affiche plusieurs cdms les unes sous les autres
// $tabcdm : tableau contenant des cdms, chaque cdm étant elle-même un tableau 
//         respectant la structure de la table des cdms et complété par:
//         $tabcdm['monstre']=nom complet du monstre
//         $tabcdm['nom_race']=nom de la raceA
// Ajout Bodéga : display
// 				 $display = true, affiche les résultats
// 				 $display = false, retourne les résultats
//
function affiche_liste_cdms(&$tab_cdm,$display=true)
{
  $td="td colspan=2 width=40 align=center";
  $text .= "<table border=1 cellpadding=0 cellspacing=1 align=center class=mh_tdborder width=80%>";
  $text .= "<tr class=mh_tdtitre>";
  $text .= "  <td>MH</td><td>Nom</td>";
  $text .= "  <$td>Niv</td><$td>PdV</td><$td>Att</td><$td>Esq</td>";
  $text .= "  <$td>Deg</td><$td>Reg</td><$td>Arm</td><$td>Vue</td>";
	$text .= "  <$td>MM</td><$td>RM</td><td align=center>NB ATT</td><td align=center>Vit Dep</td>";
	$text .= "  <td align=center>VLC</td><td align=center>ATT Dist</td><$td>DLA</td>";
  $text .= "  <td align=center>date</td><td align=center>source</td>";
  $text .= "</tr>";
	if (!$display)
		$quote = "";
		//$quote = "\\";

  foreach($tab_cdm as $cdm)
  {
    $text .= "<tr class=mh_tdpage>";
 
    $libelle_monstre="<a href=$quote'/bestiaire2/bestiaire.php?Race=".urlencode($cdm['nom_race'])."&Template=".$cdm['id_template_cdm']."&IDAge=".$cdm['id_age_cdm']."$quote'>".$cdm['monstre']."</a>";
    $libelle_mh="<a href=$quote'/bestiaire2/bestiaire.php?IDAge=".$cdm['id_age_cdm']."&MH=".$cdm['id_mh']."$quote'>".$cdm['id_mh']."</a>";

    if($cdm['capspe_cdm']=="") 
      $text .= "  <td>&nbsp;".$libelle_mh."&nbsp;</td><td>&nbsp;".$libelle_monstre."&nbsp;</td>";
    else 
      $text .= "  <td rowspan=2>&nbsp;".$libelle_mh."&nbsp;</td><td rowspan=2>&nbsp;".$libelle_monstre."&nbsp;</td>";
    $td="td align=center";
		$text .= "  <$td>".$cdm['nivmin_cdm']."</td><$td>".$cdm['nivmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['pdvmin_cdm']."</td><$td>".$cdm['pdvmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['attmin_cdm']."</td><$td>".$cdm['attmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['esqmin_cdm']."</td><$td>".$cdm['esqmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['degmin_cdm']."</td><$td>".$cdm['degmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['regmin_cdm']."</td><$td>".$cdm['regmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['armmin_cdm']."</td><$td>".$cdm['armmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['vuemin_cdm']."</td><$td>".$cdm['vuemax_cdm']."</td>";
		$text .= "  <$td>".$cdm['mmmin_cdm']."</td><$td>".$cdm['mmmax_cdm']."</td>";
		$text .= "  <$td>".$cdm['rmmin_cdm']."</td><$td>".$cdm['rmmax_cdm']."</td>";
		$text .= "  <$td>";
		if ($cdm['nbatt_cdm']!="0") $text.= $cdm['nbatt_cdm'];
		else $text.= "&nbsp;";
		$text .= "</td>";
		$text .= "<$td>".$cdm['vitdep_cdm']."</td>";
		$text .= "  <$td>".$cdm['vlc_cdm']."</td><$td>".$cdm['attdist_cdm']."</td>";
		$text .= "  <$td>".$cdm['dlamin_cdm']."</td><$td>".$cdm['dlamax_cdm']."</td>";
		$text .= "  <$td>".mysqltimestamp_date($cdm['date_cdm'])."</td><$td>".$cdm['source_cdm']."</td>";
		$text .= "</tr>";
	  if($cdm['capspe_cdm']!=""){
			$text .= "<tr class=mh_tdpage>";
			$text .= "  <td colspan=28 align=center>".$cdm['capspe_cdm']."&nbsp;";
			$text .= "  &nbsp;<em>affecte</em>&nbsp;";
			$text .= "  &nbsp;".$cdm['affecte_cdm']."</td>";
			$text .= "</tr>";
    } 
  }
 $text .= "</table>";

	if ($display)
		echo $text;
	else
		return $text;
}


//
// affiche le résultat d'un parsing de cdm
// $pcdm : tableau contenant le résultat de l'analyse d'une cdm
//         (cf la fonction pour le détail du tableau)
function affiche_cdm_parsed(&$pcdm)
{
  print("<table border='1' cellpadding='0' cellspacing='1' align='center' class='mh_tdborder'>");
  print("<tr><td class='mh_tdpage' colspan='4' align='center'><b>Résultat de l'analyse</b><br>(cliquez sur \"bestiaire\" ou \"autre cdm\" pour valider)</td></tr>");
  $saisie=($pcdm['troll_nom']=='')||($pcdm['troll_id']=='');
  
  if($saisie)
    print("<INPUT TYPE=HIDDEN NAME=\"AUTOSOURCE\" VALUE=non></INPUT>");
  else
    print("<INPUT TYPE=HIDDEN NAME=\"AUTOSOURCE\" VALUE=oui></INPUT>");
  print("<tr><td class='mh_tdtitre'><b>TROLL</b></td><td class='mh_tdpage'>");
  if(!$saisie){
    print("<input type=hidden name=SOURCE VALUE=\"".$pcdm['troll_nom']."\"></input>".$pcdm['troll_nom']);
    print("</td><td colspan=2 class='mh_tdpage'>");
    print("<input type=hidden name=IDSOURCE VALUE=\"".$pcdm['troll_id']."\"></input>".$pcdm['troll_id']);
  }
  else
  {
	$nom_troll = "Anonyme"; 
	$id_troll = 0;
    print("<input type=text width=60 name=SOURCE Value=\"$nom_troll\"></input>");
    print("</td><td colspan=2 class='mh_tdpage'>");
    print("<input type=text width=15 name=IDSOURCE VALUE=$id_troll></input>");
  }
  print("</td></tr>");
  //
  print("<tr><td class='mh_tdtitre'><b>FAMILLE</b></td><td class='mh_tdpage'>".$pcdm['famille']."</td><td colspan=2 class='mh_tdpage'>".$pcdm['id_famille']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>MONSTRE</b></td><td class='mh_tdpage'>".$pcdm['monstre']."</td><td class='mh_tdpage'>".$pcdm['age']."</td><td class='mh_tdpage'>".$pcdm['id_age']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>RACE</b></td><td class='mh_tdpage'>".$pcdm['race']."</td><td class='mh_tdpage'>".$pcdm['genre_race']."</td><td class='mh_tdpage'>".$pcdm['id_race']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>TEMPLATE</b></td><td class='mh_tdpage'>".$pcdm['template']."</td><td class='mh_tdpage'>".$pcdm['id_template']."</td><td class='mh_tdpage'>".$pcdm['id_mh']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>NIVEAU</b></td><td class='mh_tdpage'>".$pcdm['nivcom']."</td><td class='mh_tdpage'>".$pcdm['nivmin']."</td><td class='mh_tdpage'>".$pcdm['nivmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>PDV   </b></td><td class='mh_tdpage'>".$pcdm['pdvcom']."</td><td class='mh_tdpage'>".$pcdm['pdvmin']."</td><td class='mh_tdpage'>".$pcdm['pdvmax']." </td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Blessure</b></td><td class='mh_tdpage' colspan='4'>".$pcdm['blessure']." %</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>ATT	  </b></td><td class='mh_tdpage'>".$pcdm['attcom']."</td><td class='mh_tdpage'>".$pcdm['attmin']."</td><td class='mh_tdpage'>".$pcdm['attmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>ESQ	  </b></td><td class='mh_tdpage'>".$pcdm['esqcom']."</td><td class='mh_tdpage'>".$pcdm['esqmin']."</td><td class='mh_tdpage'>".$pcdm['esqmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>DEG	  </b></td><td class='mh_tdpage'>".$pcdm['degcom']."</td><td class='mh_tdpage'>".$pcdm['degmin']."</td><td class='mh_tdpage'>".$pcdm['degmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>REG	  </b></td><td class='mh_tdpage'>".$pcdm['regcom']."</td><td class='mh_tdpage'>".$pcdm['regmin']."</td><td class='mh_tdpage'>".$pcdm['regmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>ARM	  </b></td><td class='mh_tdpage'>".$pcdm['armcom']."</td><td class='mh_tdpage'>".$pcdm['armmin']."</td><td class='mh_tdpage'>".$pcdm['armmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>VUE	  </b></td><td class='mh_tdpage'>".$pcdm['vuecom']."</td><td class='mh_tdpage'>".$pcdm['vuemin']."</td><td class='mh_tdpage'>".$pcdm['vuemax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>MM    </b></td><td class='mh_tdpage'>".$pcdm['mmcom']."</td><td class='mh_tdpage'>".$pcdm['mmmin']."</td><td class='mh_tdpage'>".$pcdm['mmmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>RM    </b></td><td class='mh_tdpage'>".$pcdm['rmcom']."</td><td class='mh_tdpage'>".$pcdm['rmmin']."</td><td class='mh_tdpage'>".$pcdm['rmmax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>NB Att</b></td><td class='mh_tdpage' colspan='3'>".$pcdm['nbatt']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Vitesse</b></td><td class='mh_tdpage' colspan='3'>".$pcdm['vitdep']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Voir le caché</b></td><td class='mh_tdpage' colspan='3'>".$pcdm['vlc']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Att distance</b></td><td class='mh_tdpage' colspan='3'>".$pcdm['attdist']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>DLA  </b></td><td class='mh_tdpage' colspan='3'>".$pcdm['etat_dla']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Durée DLA  </b></td><td class='mh_tdpage'>".$pcdm['dlacom']."</td><td class='mh_tdpage'>".$pcdm['dlamin']."</td><td class='mh_tdpage'>".$pcdm['dlamax']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Chargement  </b></td><td class='mh_tdpage' colspan='3'>".$pcdm['charge']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Bonus Malus  </b></td><td class='mh_tdpage' colspan='3'>".$pcdm['BM']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>CAPACITE</b></td><td class='mh_tdpage'>".$pcdm['capspe']."</td><td colspan=2 class='mh_tdpage'>".$pcdm['affecte']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Port&eacute;e  </b></td><td class='mh_tdpage' colspan='3'>".$pcdm['portee']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Vole  </b></td><td class='mh_tdpage' colspan='3'>".$pcdm['vole']."</td></tr>");
  print("<tr><td class='mh_tdtitre'><b>Sang froid  </b></td><td class='mh_tdpage' colspan='3'>".$pcdm['sang']."</td></tr>");
  print("</table>");
  print("<br>");
  print("</body></html>");
}



// affiche_monstre
// affiche les données d'un monstre ajustée (pris dans la base)
// $monstre : tableau contenant le monstre
//            (cf la structure de la table pour les clefs du tableau)
//   ATTENTION : le tableau doit être complété avec le nom complet du monstre : 
//               $monstre['nom_monstre']
//
function affiche_monstre(&$monstre,&$capspe,&$caracs)
{
  print("<table border='1' cellpadding='0' cellspacing='1' align='center' class='mh_tdborder' width='80%'>");
  print("<tr class='mh_tdtitre'>");
  print("  <td colspan=16 align=center>".$monstre['nom_monstre']."</td>");
  print("</tr>");
  $td="td align=center width=70";
  print("<tr class='mh_tdpage'>");
  print("  <td>&nbsp;</td><$td>Niv</td><$td>PdV</td><$td>Att</td><$td>Esq</td>");
  print("  <$td>Deg</td><$td>Reg</td><$td>Arm</td><$td>Vue</td><$td>MM</td><$td>RM</td><$td>dla</td>");
  print("</tr>");
  print("<tr class='mh_tdpage'>");
  print("<td nowrap><em>Valeurs Moyennes</em></td>"); 
  $carac=carac_monstre($monstre['nivsom_monstre'],$monstre['nivnbr_monstre']);
  print("  <$td>".$carac."</td>"); // niv
  $carac=carac_monstre($monstre['pdvsom_monstre'],$monstre['pdvnbr_monstre']);
  print("  <$td>".$carac."</td>"); // Pdv
  $carac=carac_monstre($monstre['attsom_monstre'],$monstre['attnbr_monstre']);
  print("  <$td>".$carac."</td>"); // Att
  $carac=carac_monstre($monstre['esqsom_monstre'],$monstre['esqnbr_monstre']);
  print("  <$td>".$carac."</td>"); // Esq
  $carac=carac_monstre($monstre['degsom_monstre'],$monstre['degnbr_monstre']);
  print("  <$td>".$carac."</td>"); // Deg
  $carac=carac_monstre($monstre['regsom_monstre'],$monstre['regnbr_monstre']);
  print("  <$td>".$carac."</td>"); // Reg
  $carac=carac_monstre($monstre['armsom_monstre'],$monstre['armnbr_monstre']);
  print("  <$td>".$carac."</td>"); // Arm
  $carac=carac_monstre($monstre['vuesom_monstre'],$monstre['vuenbr_monstre']);
  print("  <$td>".$carac."</td>"); // Vue
	$carac=carac_monstre($monstre['mmsom_monstre'],$monstre['mmnbr_monstre']);
  print("  <$td>".$carac."</td>"); // MM
	$carac=carac_monstre($monstre['rmsom_monstre'],$monstre['rmnbr_monstre']);
  print("  <$td>".$carac."</td>"); // RM
	$carac=carac_monstre($monstre['dlasom_monstre'],$monstre['dlanbr_monstre']);
	print("  <$td>".$carac."</td>"); // DLA
  print("</tr>");

	
  print("<tr class='mh_tdpage'>");
  print("<td nowrap><em>Nbr de valeurs utilisées</em></td>"); // niv
  $carac=carac_monstre($monstre['nivsom_monstre'],$monstre['nivnbr_monstre']);
  print("<$td>".$monstre['nivnbr_monstre']."</td>"); // niv
  $carac=carac_monstre($monstre['pdvsom_monstre'],$monstre['pdvnbr_monstre']);
  print("<$td>".$monstre['pdvnbr_monstre']." </td>"); // Pdv
  $carac=carac_monstre($monstre['attsom_monstre'],$monstre['attnbr_monstre']);
  print("<$td>".$monstre['attnbr_monstre']."</td>"); // Att
  $carac=carac_monstre($monstre['esqsom_monstre'],$monstre['esqnbr_monstre']);
  print("<$td>".$monstre['esqnbr_monstre']."</td>"); // Esq
  $carac=carac_monstre($monstre['degsom_monstre'],$monstre['degnbr_monstre']);
  print("<$td>".$monstre['degnbr_monstre']."</td>"); // Deg
  $carac=carac_monstre($monstre['regsom_monstre'],$monstre['regnbr_monstre']);
  print("<$td>".$monstre['regnbr_monstre']."</td>"); // Reg
  $carac=carac_monstre($monstre['armsom_monstre'],$monstre['armnbr_monstre']);
  print("<$td>".$monstre['armnbr_monstre']."</td>"); // Arm
  $carac=carac_monstre($monstre['vuesom_monstre'],$monstre['vuenbr_monstre']);
  print("<$td>".$monstre['vuenbr_monstre']."</td>"); // Vue
	$carac=carac_monstre($monstre['mmsom_monstre'],$monstre['mmnbr_monstre']);
  print("<$td>".$monstre['mmnbr_monstre']."</td>"); // MM
	$carac=carac_monstre($monstre['rmsom_monstre'],$monstre['rmnbr_monstre']);
	print("<$td>".$monstre['rmnbr_monstre']."</td>"); // Vue
	$carac=carac_monstre($monstre['dlasom_monstre'],$monstre['dlanbr_monstre']);
	print("<$td>".$monstre['dlanbr_monstre']."</td>"); // DLA
  print("</tr></table>");
  if($capspe){
    $td="td align=center width=80";
    print("<table border='1' cellpadding='0' cellspacing='1' align='center' class='mh_tdborder' width='80%'>");
    print("<tr class='mh_tdpage'>");
    print("  <td colspan=6><em>Capacité spéciale</em>&nbsp;&nbsp;".htmlentities($capspe['nom_capspe'])."&nbsp;&nbsp;&nbsp;<em>affecte</em>&nbsp;&nbsp;&nbsp;".htmlentities($capspe['affecte_capspe'])."</td>");
    print("</tr>");
    print("<tr class='mh_tdpage'>");
    print("  <td align=left>[source : ".htmlentities($capspe['source_capspe'])."&nbsp;-&nbsp;date : ".mysqltimestamp_date($capspe['date_capspe'])."]</td>");
    print("  </td><$td>MM</td><$td>deg</td><$td>portee</td><$td>durée</td><$td>zone</td>");
    print("</tr>");
    print("<tr class='mh_tdpage'>");
		
    print("<td nowrap><em>Valeurs Moyennes</em></td>"); 
    $carac=carac_monstre($capspe['MMsom_capspe'],$capspe['MMnbr_capspe']);
    print("  <$td>".$carac."</td>");
    $carac=carac_monstre($capspe['degatsom_capspe'],$capspe['degatnbr_capspe']);
    print("  <$td>".$carac."</td>");
    print("  <$td>".$capspe['portee_capspe']."</td>");
    print("  <$td>".$capspe['duree_capspe']."</td>");
    print("  <$td>".$capspe['portee_zone_capspe']."</td>");
    print("</tr>");
		
    print("<tr class='mh_tdpage'>");

    print("<td nowrap><em>Nbr de valeurs utilisées</em></td>"); // niv
    $carac=carac_monstre($capspe['MMsom_capspe'],$capspe['MMnbr_capspe']);
    print("  <$td>".$capspe['MMnbr_capspe']."</td>");
    $carac=carac_monstre($capspe['degatsom_capspe'],$capspe['degatnbr_capspe']);
    print("  <$td>".$capspe['degatsnbr_capspe']."</td>");
    print("  <$td>".$capspe['portee_capspe']."</td>");
    print("  <$td>".$capspe['duree_capspe']."</td>");
    print("  <$td>".$capspe['portee_zone_capspe']."</td>");
    print("</tr></table>");
  }
  if($caracs){
    print("<table border='1' cellpadding='0' cellspacing='1' align='center' class='mh_tdborder' width='80%'>");
    print("<tr class='mh_tdpage'>");
    print("  <td>&nbsp;</td><td>RM</td><td>nbr</td><td colspan=14></td>");
    print("</tr>");
    print("<tr class='mh_tdpage'>");

    print("<td nowrap><em>Valeurs Moyennes</em></td>"); 
    $carac=carac_monstre($caracs['RMsom_caracs'],$caracs['RMnbr_caracs']);
    print("  <td>".$carac."</td><td colspan=14></td>");
    print("</tr>");

    print("<tr class='mh_tdpage'>");
    print("<td nowrap><em>Nbr de valeurs utilisées</em></td>"); // niv
    $carac=carac_monstre($caracs['RMsom_caracs'],$caracs['RMnbr_caracs']);
    print("  <td>".$caracs['RMnbr_caracs']."</td><td colspan=14></td>");
    print("</tr></table>");
  }
}

// affiche_niveau_monstre
// affiche les caracs d'un monstre ajustée (pris dans la base)
// $monstre : tableau contenant le monstre
//            (cf la structure de la table pour les clefs du tableau)
//   ATTENTION : le tableau doit être complété avec le nom complet du monstre :
//               $monstre['nom_monstre']
//
//function affiche_monstre(&$monstre,&$capspe,&$caracs)
//{
// Le but du jeu est d'afficher les intervalles probables des 
// caractéristiques d'une race donnée, en fonction des caractéristiques 
// évaluées de chaque 
// monstre.
//
// Pour chaque caractéristique, on récupère l'intervalle.
// On pondère par le nombre de monstres différents ayant cet intervalle.
// Plusieurs CdM sur un même monstre donnent un intervalle plus précis.
// 
// Pour un monstre, la proba de chaque valeur est égale à 1/nombre de valeurs
// Pour une valeur, la proba est donc la somme des probas, divisée par le 
// nombre de monstres.
//}


?>
