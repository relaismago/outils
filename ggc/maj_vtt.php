<?
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$copiercoller = $_POST[copiercoller];
$action = $_POST[action];

//Récup de infos ... bon ce sera à faire en mieux parceque là c'est le souk
//mais j'ai pas envi de chercher ce soir ...
$troll_nom=$_POST[troll_nom];
$troll_race=$_POST[troll_race];
$troll_niveau=$_POST[troll_niveau];
$troll_dla_reel_hh=$_POST[troll_dla_reel_hh];
$troll_dla_reel_mm=$_POST[troll_dla_reel_mm];
$troll_vue_base=$_POST[troll_vue_base];
$troll_vue_bm=$_POST[troll_vue_bm];
$troll_pv=$_POST[troll_pv];
$troll_reg_base=$_POST[troll_reg_base];
$troll_reg_bm=$_POST[troll_reg_bm];
$troll_att_base=$_POST[troll_att_base];
$troll_att_bm=$_POST[troll_att_bm];
$troll_esq_base=$_POST[troll_esq_base];
$troll_esq_bm=$_POST[troll_esq_bm];
$troll_deg_base=$_POST[troll_deg_base];
$troll_deg_bm=$_POST[troll_deg_bm];
$troll_arm_base=$_POST[troll_arm_base];
$troll_arm_bm=$_POST[troll_arm_bm];
$troll_kill=$_POST[troll_kill];
$troll_death=$_POST[troll_death];
$troll_mm_base=$_POST[troll_mm_base];
$troll_mm_bm=$_POST[troll_mm_bm];
$troll_rm_base=$_POST[troll_rm_base];
$troll_rm_bm=$_POST[troll_rm_bm];
$nb_comps=$_POST[nb_comps];
$nb_sorts=$_POST[nb_sorts];
$chaine_comps=$_POST[chaine_comps];
$chaine_sorts=$_POST[chaine_sorts];
$cacherdata = $_POST[cacherdata];


// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();



function exporter($nom_variable)
{
  global $$nom_variable;
  return $$nom_variable."<input type=hidden name=".$nom_variable." value=\"".$$nom_variable."\">";
}

/*---------------------------------------------------------------*/
/*                 RECUPERATION D'INFOS                          */
/*---------------------------------------------------------------*/
//RECHERCHE DES INFOS DU TROLL CONNECTE
$requete_troll=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$nom_troll = mysql_result($requete_troll,0,"nom_troll");  

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Mise à jour du VTT","'file:images/retour2_over.gif'");


/*-----------------------------------------------------------------*/
/*	PARSAGE DES DONNEES                                            */
/*-----------------------------------------------------------------*/
switch($action) {
    case "add":

	$update = 'UPDATE vtt SET';
	$update .= ' CacherData = \''.($cacherdata?'1':'0').'\'';
	$champs = array(
			'Race' => $troll_race,
			'DLAH' => $troll_dla_reel_hh,
			'DLAM' => $troll_dla_reel_mm,
			'VUE' => $troll_vue_base,
			'VUEB' => $troll_vue_bm,
			'Niveau' => $troll_niveau,
			'PVs' => $troll_pv,
			'REG' => $troll_reg_base,
			'REGB' => $troll_reg_bm,
			'ATT' => $troll_att_base,
			'ATTB' => $troll_att_bm,
			'ESQ' => $troll_esq_base,
			'ESQB' => $troll_esq_bm,
			'DEG' => $troll_deg_base,
			'DEGB' => $troll_deg_bm,
			'ARM' => $troll_arm_base,
			'ARMB' => $troll_arm_bm,
			'KILLs' => $troll_kill,
			'DEADs' => $troll_death,
			'RM' => $troll_rm_base,
			'RMB' => $troll_rm_bm,
			'MM' => $troll_mm_base,
			'MMB' => $troll_mm_bm,);
			
	foreach ($champs as $sql => $input)
	  {
	    $update .= ", $sql = '$input' ";
	  }
	$update .= ", NbSorts = '$nb_sorts'";
	$update .= ", Comps = '$chaine_comps'";
	$update .= ", Sorts = '$chaine_sorts'";
	$update .= ", DateMaj = NOW()";
	$update .= " where No = $id_troll";
	$query_result = mysql_db_query($bdd,$update,$db_link) or die(mysql_error());

    //Affichage de la page de confirmation
	AfficheConfirmation("Mise à jour du VTT","Mise à jour réussie !","Ton profil dans le vtt est à jour !","<a href=groupe.php?id=$id>Retourner voir le groupe</a>");


    break;

/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU FORMULAIRE DE SAISIE DU PROFIL                    */
/*-----------------------------------------------------------------*/
    default:
	$lignes = explode("\n", $copiercoller);
 	$i=0;
 	$j=0;
        $sorts=0;
        $nb_sorts=0;
        $nb_comps=0;
	while ($lignes[$i])
		{
		#echo "<br>".$lignes[$i]."\n";
		if(eregi("[ \t]*Identifian.+:[ \t]*(.+)[ \t]*-[ \t]*(.+)",$lignes[$i],$resultat)):
			$troll_id		= trim(htmlspecialchars($resultat[1]));
			$troll_nom		= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Race.+\.+:(.+)',$lignes[$i],$resultat)):
			$troll_race	= trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Dur.+normal.+:(.+)heures.+et(.+)minutes',$lignes[$i],$resultat)):
			$troll_dla_base_hh	= trim($resultat[1]);
			$troll_dla_base_mm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Dur.+prochai.+:(.+)heures.+et(.+)minutes',$lignes[$i],$resultat)):
			$troll_dla_reel_hh	= trim($resultat[1]);
			$troll_dla_reel_mm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Vue\.+:[ \t]*([0-9]+)[ \t]*Cases[ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_vue_base		= trim($resultat[1]);
			$troll_vue_bm		= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Exp.+Niveau.+:[ \t]*(.+)\(.+PI\).+',$lignes[$i],$resultat)):
			$troll_niveau	= trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Maximum\.+:[ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_pv		= trim($resultat[1]);
		endif;

		if(eregi('[ \t]*R.g.n.ration\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)[ \t]*-{3}.+',$lignes[$i],$resultat)):
			$troll_reg_base	= trim($resultat[1]);
			$troll_reg_bm	= trim($resultat[2]);
 		elseif (eregi('[ \t]*R.g.n.ration\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_reg_base	= trim($resultat[1]);
			$troll_reg_bm	= trim($resultat[2]);  
                endif;
		
		if(eregi('[ \t]*Atta.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_att_base	= trim($resultat[1]);
			$troll_att_bm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Esquive\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_esq_base	= trim($resultat[1]);
			$troll_esq_bm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*D.g.ts\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_deg_base	= trim($resultat[1]);
			$troll_deg_bm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Armu.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_arm_base	= trim($resultat[1]);
			$troll_arm_bm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Nombre.+Advers.+:[ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_kill		= trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Nombre.+D.c.s.+:[ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_death	= trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Magie.+R.sistance.+Magie.+:[ \t]*([0-9]+) (.+)',$lignes[$i],$resultat)):
			$troll_rm_base	= trim($resultat[1]);
			$troll_rm_bm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*Ma.trise.+Magie.+:[ \t]*([0-9]+) (.+)',$lignes[$i],$resultat)):
			$troll_mm_base	= trim($resultat[1]);
			$troll_mm_bm	= trim($resultat[2]);
		endif;
		if (eregi('[ \t]*Sortil.ges*', $lignes[$i], $resultat)):
		  $sorts=1;
		endif;
		if(eregi('[ \t]*(.+)\(niveau.+:(.+)%\)[ \t]*(.+)+\(niveau.+:(.+)%\)',$lignes[$i],$resultat)):
		  if ($sorts):
		          $troll_cs[$j][0] = trim($resultat[1]);
		          $troll_cs[$j][1] = trim($resultat[2]);
			  $j++; $nb_sorts++;
			  $troll_cs[$j][0] = trim($resultat[3]);
			  $troll_cs[$j][1] = trim($resultat[4]);
			  $j++; $nb_sorts++;
		  else:
		          $troll_cs[$j][0] = trim($resultat[1]);
		          $troll_cs[$j][1] = trim($resultat[2]);
			  $j++; $nb_comps++;
			  $troll_cs[$j][0] = trim($resultat[3]);
			  $troll_cs[$j][1] = trim($resultat[4]);
			  $j++; $nb_comps++;
		  endif;
		elseif(eregi('[ \t]*(.+)\(niveau.+:(.+)%\)',$lignes[$i],$resultat)):
		  if ($sorts):
			    $troll_cs[$j][0] = trim($resultat[1]);
			    $troll_cs[$j][1] = trim($resultat[2]);
			    $j++; $nb_sorts++;
		  else:
			$troll_cs[$j][0] = trim($resultat[1]);
			$troll_cs[$j][1] = trim($resultat[2]);
			$j++; $nb_comps++;
		  endif;
		endif;
		$i++;
		}
		
		
		
echo "<center>\n";
echo "<H1>Mise à jour des informations de<br>".stripslashes($nom_troll)."</H1>\n";
echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
echo "<tr valign='middle' class='mh_tdtitre'>";
echo "<td height='35' width='100%' align='center' >Confirmation des données pour le VTT</A></TD>";
echo "</tr>";
echo "<tr valign='middle' class='mh_tdpage'>";
echo "<td width='100%' align='center'>";
			
	echo "<form action=\"maj_vtt.php?id=$id\" method=post>\n";
	echo "<input type='hidden' name='action' value='add'>";
	echo "<table width='80%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'><tbody>";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> TROLL (id/nom)	</b></td><td width='50%'>".exporter(troll_nom)."</td><td width='17%'>".$troll_id."</td></tr>\n";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> RACE	(race/niveau)	</b></td><td width='50%'>".exporter(troll_race)."</td><td width='17%'>".exporter(troll_niveau)."</td></tr>\n";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> DLA	(base/réél)	</b></td><td width='50%'>".$troll_dla_base_hh."H".$troll_dla_base_mm."</td><td width='17%'>".exporter(troll_dla_reel_hh)."H".exporter(troll_dla_reel_mm)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> VUE	(base/bm)	</b></td><td width='50%'>".exporter(troll_vue_base)."</td><td width='17%'>".exporter(troll_vue_bm)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> PV			</b></td><td width='50%'>".exporter(troll_pv)."</td><td width='17%'>&nbsp;</td></tr>\n";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> REG	(base/bm)	</b></td><td width='50%'>".exporter(troll_reg_base)."</td><td width='17%'>".exporter(troll_reg_bm)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ATT	(base/bm)	</b></td><td width='50%'>".exporter(troll_att_base)."</td><td width='17%'>".exporter(troll_att_bm)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ESQ	(base/bm)	</b></td><td width='50%'>".exporter(troll_esq_base)."</td><td width='17%'>".exporter(troll_esq_bm)."</td></tr>\n";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> DEG	(base/bm)	</b></td><td width='50%'>".exporter(troll_deg_base)."</td><td width='17%'>".exporter(troll_deg_bm)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> ARM	(base/bm)	</b></td><td width='50%'>".exporter(troll_arm_base)."</td><td width='17%'>".exporter(troll_arm_bm)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> KILL / DEATH		</b></td><td width='50%'>".exporter(troll_kill)."</td><td width='17%'>".exporter(troll_death)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> MM	(base/bm)	</b></td><td width='50%'>".exporter(troll_mm_base)."</td><td width='17%'>".exporter(troll_mm_bm)."</td></tr>\n";	
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> RM	(base/bm)	</b></td><td width='50%'>".exporter(troll_rm_base)."</td><td width='17%'>".exporter(troll_rm_bm)."</td></tr>\n";	
	$chaine_comps="";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> Nb de Comp&eacute;tences</b></td><td width='50%'>".$nb_comps."</td><td width='17%'>&nbsp;</td></tr>\n";
	for ($i=0; $i<$nb_comps; $i++){
		echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b>COMP. (nom/pourcentage) </b></td><td width='33%'>".$troll_cs[$i][0]."</td><td width='34%'>".$troll_cs[$i][1]."</td></tr>\n";
		$chaine_comps.=($i==0?"":", ").htmlspecialchars($troll_cs[$i][0], ENT_QUOTES)." (".$troll_cs[$i][1]."%)";
	}
    $chaine_sorts="";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> Nb de Sorts Appris</b></td><td width='50%'>".$nb_sorts."</td><td width='17%'>&nbsp;</td></tr>\n";
    for ($i=$nb_comps; $i<($nb_comps+$nb_sorts); $i++){
		echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b>SORT (nom/pourcentage) </b></td><td width='33%'>".$troll_cs[$i][0]."</td><td width='34%'>".$troll_cs[$i][1]."</td></tr>\n";	
		$chaine_sorts.=($i==$nb_comps?"":", ").acronyme($troll_cs[$i][0])." (".$troll_cs[$i][1]."%)";
	}
    echo "<input type=hidden name=nb_comps value=\"".$nb_comps."\">\n";
    echo "<input type=hidden name=nb_sorts value=\"".$nb_sorts."\">\n";
    echo "<input type=hidden name=chaine_comps value=\"".$chaine_comps."\">\n";
    echo "<input type=hidden name=chaine_sorts value=\"".$chaine_sorts."\">\n";
    
    
	echo "</tbody></table>";
	echo "</td></tr>\n";
	echo "</table>";
	echo "<br>";
	echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'><tbody>";
	echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='90%'><b>Cochez la case qui suit si vous ne voulez pas que vos caractéristiques apparaissent dans le VisioTrolloTron</b></td><td width='10%' align='center'><input type=checkbox name=cacherdata></td></tr>\n";
	echo "</tbody></table>";
	echo "</td></tr>\n";
	echo "</table>";
	echo "<br><input type=submit value=\"Mettre à Jour\" class='mh_form_submit'>\n";
	echo "<br><br><a href='groupe.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour' border='0'></a><br>";
	echo "</form>\n";
	echo "</center>\n";
 
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
echo "</td></tr>";
echo "</table>";
echo "</center>\n"; 
 
    break;

}
/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();
mysql_close($db_link);

?>
