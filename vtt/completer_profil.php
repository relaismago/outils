<?php
include_once('../top.php');
include('secure.php');

function acronyme($chaine)
{
  if (eregi('Analyse.+', $chaine, $trash))        {return "AA";}
  if (eregi('Armure.+', $chaine, $trash))         {return "AE";}
  if (eregi('.+Attaque', $chaine, $trash))        {return "AdA";}
  if (eregi('.+D.g.ts', $chaine, $trash))         {return "AdD";}
  if (eregi('.+Esquive', $chaine, $trash))        {return "AdE";}
  if (eregi('.+Magie', $chaine, $trash))          {return "BAM";}
  if (eregi('Explosion', $chaine, $trash))        {return "Explo";}
  if (eregi('Faiblesse.+', $chaine, $trash))      {return "FP";}
  if (eregi('Flash.+', $chaine, $trash))          {return "Flash";}
  if (eregi('Glue', $chaine, $trash))             {return "Glue";}
  if (eregi('Griffe.+', $chaine, $trash))         {return "GdS";}
  if (eregi('Hypnotisme', $chaine, $trash))       {return "Hypno";}
  if (eregi('Identification.+', $chaine, $trash)) {return "IdT";}
  if (eregi('Invisibilit.+', $chaine, $trash))    {return "Invisi";}
  if (eregi('Projectile.+', $chaine, $trash))     {return "PM";}
  if (eregi('Projection', $chaine, $trash))        {return "Projection";}
  if (eregi('Rafale.+', $chaine, $trash))         {return "RP";}
  if (eregi('Sacrifice', $chaine, $trash))        {return "Sacrifice";}
  if (eregi('Vampirisme', $chaine, $trash))       {return "Vampi";}
  if (eregi('Voir.+', $chaine, $trash))           {return "VlC";}
  if (eregi('T.l.portation', $chaine, $trash))    {return "TP";}
  if (eregi('T.l.kin.sie', $chaine, $trash))      {return "T&eacute;l&eacute;kin&eacute;sie";}
  if (eregi('.+Accrue', $chaine, $trash))         {return "VA";}
  if (eregi('.+Lointaine', $chaine, $trash))       {return "VL";}
  if (eregi('Vue.+', $chaine, $trash))            {return "VT";}
  
  return htmlspecialchars($chaine, ENT_QUOTES);
}

function exporter($nom_variable)
{
  global $$nom_variable;
  return $$nom_variable."<input type=hidden name=".$nom_variable." value=\"".$$nom_variable."\">";
}

$query_result = my_mysql_query("SELECT * from "._TABLEVTT_.", trolls Where No='".$_SESSION[AuthTroll]."' AND id_troll = No");
$row = mysql_fetch_array($query_result);

echo "<FORM ACTION=\"verifier_maj.php?id=".$id."&no=".$row["No"]."\" method=post>\n";

echo "<center>";
echo "<H1>Mise à jour des informations de<br>".htmlspecialchars($row["nom_troll"])."</H1>\n";
echo "<H2>2ème Etape : compléter les infos facultatives (à saisie manuelle)</H2>\n";

	$lignes = explode("\n", htmlspecialchars(stripslashes($_REQUEST["copiercoller"])));
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
		
		if(eregi('[ \t]*Combat.+Atta.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)',$lignes[$i],$resultat)):
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
		if(eregi('[ \t]*Armure\.+:[ \t]*([0-9]+)[ \t]+(.+)',$lignes[$i],$resultat)):
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
		if (eregi('[ \t]*Sorts[ \t]*', $lignes[$i], $resultat)):
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
		
		if ($troll_niveau == "") {
			afficher_titre_tableau("Vous n'avez pas fait le copié/collé depuis la page du profil","Veuillez retenter...");
			die();
		}
		
		echo "<table width='50%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
		echo "<tr class='mh_tdtitre'><td>";
		echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'><tbody>";
		echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> TROLL (id/nom)	</b></td><td width='50%'>".exporter(troll_nom)."</td><td width='17%'>".$troll_id."</td></tr>\n";
		//echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> RACE	(race/niveau)	</b></td><td width='50%'>".exporter(troll_race)."</td><td width='17%'>mis à jour automatiquement toutes les nuits.".exporter(troll_niveau)."</td></tr>\n";
		echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> RACE	(race/niveau)	</b></td><td width='50%'>".exporter(troll_race)."</td><td width='17%'>Mis à jour automatiquement toutes les nuits.</td></tr>\n";
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
		for ($i=0; $i<$nb_comps; $i++) 
			{
			echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b>COMP. (nom/pourcentage) </b></td><td width='33%'>".$troll_cs[$i][0]."</td><td width='34%'>".$troll_cs[$i][1]."</td></tr>\n";
			$chaine_comps.=($i==0?"":", ").htmlspecialchars($troll_cs[$i][0], ENT_QUOTES)." (".$troll_cs[$i][1]."%)";
			}

                $chaine_sorts="";
		echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b> Nb de Sorts Appris</b></td><td width='50%'>".$nb_sorts."</td><td width='17%'>&nbsp;</td></tr>\n";
                for ($i=$nb_comps; $i<($nb_comps+$nb_sorts); $i++) 
			{
			echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='33%'><b>SORT (nom/pourcentage) </b></td><td width='33%'>".$troll_cs[$i][0]."</td><td width='34%'>".$troll_cs[$i][1]."</td></tr>\n";	
			$chaine_sorts.=($i==$nb_comps?"":", ").acronyme($troll_cs[$i][0])." (".$troll_cs[$i][1]."%)";
			}
                
		echo "<input type=hidden name=nbcomps value=\"".$nb_comps."\">\n";
		echo "<input type=hidden name=nbsorts value=\"".$nb_sorts."\">\n";
		echo "<input type=hidden name=comps value=\"".$chaine_comps."\">\n";
		echo "<input type=hidden name=sortsappris value=\"".$chaine_sorts."\">\n";


	echo "</tbody></table>";
	echo "</td></tr>\n";
	echo "</table>";
	echo "<br>";

	echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";

	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'><tbody>";
echo "<tr class='mh_tdpage'><td class='mh_tdtitre' width='90%'><b>Cochez la case qui suit si vous ne voulez pas que vos caractéristiques apparaissent dans le VisioTrolloTron</b></td><td width='10%'><input type=checkbox name=cacherdata></td></tr>\n";

	echo "</tbody></table>";
	echo "</td></tr>\n";
	echo "</table>";
	echo "<br>";

	echo "<table border='0' cellpadding='0' cellspacing='2' class='mh_tdborder'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%'><tbody>";

	echo "</tbody></table>";
	echo "</td></tr>";
	echo "</table>";

        echo "&nbsp;<br>\n";

	echo "<table border='0' cellpadding='0' cellspacing='2' class='mh_tdborder'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%'><tbody>";

        echo "<tr class='mh_tdpage'><td align=right>Joueur</td><td class=pair align=left><input name=joueur size=50 maxlength=50 value='".htmlspecialchars($row["Joueur"], ENT_QUOTES)."'></td></tr>\n";
        echo "<tr class='mh_tdpage'><td align=right>Age du Joueur</td><td class=pair align=left><input name=agejoueur size=3 maxlength=3 value='".htmlspecialchars($row["AgeJoueur"], ENT_QUOTES)."'></td></tr>\n";
        echo "<tr class='mh_tdpage'><td align=right>Ville du Joueur</td><td class=pair align=left><input name=villejoueur size=50 maxlength=50 value='".htmlspecialchars($row["VilleJoueur"], ENT_QUOTES)."'></td></tr>\n";
        echo "<tr class='mh_tdpage'><td align=right>MSN</td><td class=pair align=left><input name=msn size=50 maxlength=255 value='".htmlspecialchars($row["MSN"], ENT_QUOTES)."'></td></tr>\n";
        echo "<tr class='mh_tdpage'><td align=right>ICQ</td><td class=pair align=left><input name=icq size=20 maxlength=20 value='".htmlspecialchars($row["ICQ"], ENT_QUOTES)."'></td></tr>\n";
        echo "<tr class='mh_tdpage'><td align=right>Email</td><td class=pair align=left><input name=email size=50 maxlength=255 value='".htmlspecialchars($row["EMail"], ENT_QUOTES)."'></td></tr>\n";
        echo "<tr class='mh_tdpage'><td align=right>Divers</td><td class=pair align=left><textarea name=divers cols=50 rows=5>".htmlspecialchars($row["Divers"], ENT_QUOTES)."</textarea></td></tr>\n";

	echo "</tbody></table>";
	echo "</td></tr>";
	echo "</table>";

        echo "<br>&nbsp;<br>\n";


# le bouton de validation
echo "<br><input type=submit value=\"Mettre à Jour\">\n";

echo "</form>\n";

echo "</center>\n";
//echo "<br><a href=\"login.php?login=1&id=".$id."\" target=\"_parent\">Se déconnecter</a>";

echo "</BODY>\n";
echo "</HTML>\n";

?>
