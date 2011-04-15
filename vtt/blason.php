<?php
include('secure.php');

function initBlason($no) {
	//$no = $_REQUEST["no"];
	if ($no==0) {
		# il faut tirer au sort le troll à afficher
		# tirage au sort d'une ligne de la table
		$query_result = my_mysql_query("SELECT * , nom_troll FROM "._TABLEVTT_.", trolls WHERE No=id_troll ORDER BY rand() LIMIT 1"); 
	} else {
		# il faut extraire les infos du troll numéro 'no'
		$query_result = my_mysql_query("SELECT *, nom_troll FROM "._TABLEVTT_.", trolls WHERE No=$no AND id_troll=No");
	}
	# récupération des infos
	$row = mysql_fetch_array($query_result);
	$pseudo = $row["nom_image_troll"];
	$cacherdata = $row["CacherData"];

	$text .= "<center>";
	
	$text .= "<table class=mh_tdborder  width=280>";
  $text .= "<tr class=mh_tdpage><td>";
   $text .= " <table width=280 cellspacing=0>";
  $text .= "    <tr class=mh_tdtitre align=center>";
 $text .= "       <td>";
	$text .= "<img src=http://www.pipeshow.net/RM/blasons/$pseudo.gif alt=$pseudo border=0 name=blason>";
 $text .= "       </td>";
  $text .= "    </tr>";
  $text .= "  </table>";
 $text .= " </td>";
 $text .= " <td>";

 $text .= " <table width=280 border=0 cellpadding=3 cellspacing=3>";
 $text .= " <tr><td valign=top>";

//	$text .= "<tr><td class=mh_tdpage colspan=2 align=center></td></tr>";
//	$text .= "<tr>";
//	$text .= "</table></td></tr></table>";
  $text .= "        <h2>$pseudo (n°$no)</h2>";
	$text .= "				<img src=http://www.pipeshow.net/RM/avatars/complets/".$pseudo."_avatar.gif";
	$text .= "						alt=[Avatar de $pseudo] border=0 width=110 height=110>";
	
	$text .= "<table>";
	
	$text .=  "<tr class=mh_tdpage><td  colspan=2 align=center>";
	$text .= "<b>Les informations ci dessous n engagent que le Joueur. Le webmaster se réserve le droit de restreindre ou de supprimer comme bon lui semble laccès au joueur à ces champs de libre expression.</b>";
$text .= "</td></tr>";

	$text .= "<tr class=mh_tdpage><td class=blasong align=right>Comp&eacute;tences</td><td class=blasond align=left>"
//	($cacherdata?"--":htmlspecialchars($row["Comps"]))
//	vtt.Comps est *deja* htmlspecialchars()-ise !
	.($cacherdata?"--":$row["Comps"])
	  ."&nbsp;</td></tr>";

	$text .= "<tr class=mh_tdpage><td class=blasong align=right>Nom (complet)<br>du Troll</td><td class=blasond align=left>";
	if (non_vide($row["nom_troll"]))
		$text .= htmlspecialchars($row["nom_troll"]); 
	else
		$text .= "&nbsp;"; 

	$text .= "</td></tr>";
	
	$text .= "<tr class=mh_tdpage><td class=blasong align=right>Joueur</td><td class=blasond align=left>"; 
	if (non_vide($row["Joueur"])) 
		$text .= htmlspecialchars($row["Joueur"]); 
	else
		$text .= "&nbsp;"; 

	$text .= "</td></tr>";

	$text .= "<tr class=mh_tdpage><td class=blasong align=right>Age du Joueur</td><td class=blasond align=left>"; 
	if (non_vide($row["AgeJoueur"]) and $row["AgeJoueur"]>=1) 
		$text .= htmlspecialchars($row["AgeJoueur"]); 
	else
		$text .= "&nbsp;"; 

	$text .= "</td></tr>";

	$text .= "<tr class=mh_tdpage><td class=blasong align=right>Ville du Joueur</td><td class=blasond align=left>"; 
	if (non_vide($row["VilleJoueur"])) 
		$text .= htmlspecialchars($row["VilleJoueur"]); 
	else
		$text .= "&nbsp;"; 
	$text .= "</td></tr>";
	 

	$text .= "<tr class=mh_tdpage><td class=blasong align=right>MSN</td><td class=blasond align=left>"; 
	if (non_vide($row["MSN"]))
		$text .= htmlspecialchars($row["MSN"]); 
	else
		$text .= "&nbsp;";

	$text .= "</td></tr>";
	
	$text .= "<tr class=mh_tdpage><td class=blasong align=right>ICQ</td><td class=blasond align=left>"; 
	if (non_vide($row["ICQ"]))
		$text .= htmlspecialchars($row["ICQ"]); 
	else
		$text .= "&nbsp;";
	$text .= "</td></tr>";
	
	$text .= "<tr class=mh_tdpage><td class=blasong align=right>Email</td><td class=blasond align=left>"; 
	if (non_vide($row["EMail"]))
		$text .= htmlspecialchars($row["EMail"]); 
	else
		$text .= "&nbsp;"; 
	$text .= "</td></tr>";
	
	$text .= "<tr class=mh_tdpage><td class=blasong align=right>Divers</td><td class=blasond align=left>"; 
	if (non_vide($row["Divers"]))
		$text .= preg_replace("/(\n|\r)/","<br>",htmlspecialchars($row["Divers"]));
	else
		$text .= "&nbsp;"; 
	$text .= "</td></tr>";

	$text .= "</table>";
	$text .= "</td></tr>";
	$text .="</table>";
	$text .= "</td><tr>";
	$text .= "</table></td></tr></table>";
	$text .="</center>";

	$text =preg_replace("/'/","_",$text);
	
	return htmlentities($text);
}
?>
