<?


function affiche_celulle($titre,$lien)
{
  echo "<td><a href='$lien'>$titre</a></td>";
}

// ------------------------------------------------------------------------
// barre_navigation
// ------------------------------------------------------------------------
function barre_navigation($nbtotal,
                          $nbenr,
                          $cfg_nbres_ppage,
                          $debut,
                          $lien,$criteres,$order)
{
    // --------------------------------------------------------------------
       $cfg_nb_pages    = 10; // Nb de n° de pages affichées dans la barre
       $lien_on         = '&nbsp;<A HREF="{cible}">{lien}</A>&nbsp;';
       $lien_off        = '&nbsp;{lien}&nbsp;';
    // --------------------------------------------------------------------
    //$query  = $criteres.'&debut=';

    $query  = $lien.$criteres.'&order='.$order.'&debut=';

    // début << .
    // --------------------------------------------------------------------
    if ($debut >= $cfg_nbres_ppage)
    {   
        $cible = $query.(0);
        $image = image_html('/images/gauche_on.gif');
        $lien = str_replace('{lien}', $image.$image, $lien_on);
        $lien = str_replace('{cible}', $cible, $lien);
    }
    else
    {   
        $image = image_html('/images/gauche_off.gif');
        $lien = str_replace('{lien}', $image.$image, $lien_off);
    }
    $barre .= $lien."&nbsp;<B>&middot;</B>";


    // précédent < .
    // --------------------------------------------------------------------
    if ($debut >= $cfg_nbres_ppage) {
        $cible = $query.($debut-$cfg_nbres_ppage);
        $image = image_html('/images/gauche_on.gif');

        $lien = str_replace('{lien}', $image, $lien_on);
        $lien = str_replace('{cible}', $cible, $lien);
    } else {
        $image = image_html('/images/gauche_off.gif');
        $lien = str_replace('{lien}', $image, $lien_off);
    }
    $barre .= $lien."&nbsp;<B>&middot;</B>";


    // pages 1 . 2 . 3 . 4 . 5 . 6 . 7 . 8 . 9 . 10
    // -------------------------------------------------------------------
    if ($debut >= ($cfg_nb_pages * $cfg_nbres_ppage)) {
        $cpt_fin = ($debut / $cfg_nbres_ppage) + 1;
        $cpt_deb = $cpt_fin - $cfg_nb_pages + 1;
    }else{
        $cpt_deb = 1;

        $cpt_fin = (int)($nbtotal / $cfg_nbres_ppage);
        if (($nbtotal % $cfg_nbres_ppage) != 0) $cpt_fin++;

        if ($cpt_fin > $cfg_nb_pages) $cpt_fin = $cfg_nb_pages;
    }

    for ($cpt = $cpt_deb; $cpt <= $cpt_fin; $cpt++)
    {
        if ($cpt == ($debut / $cfg_nbres_ppage) + 1)
        {
            $barre .= "<A CLASS='off'>&nbsp;".$cpt."&nbsp;</A> ";
        }
        else
        {
            $barre .= "<A HREF='".$query.(($cpt-1)*$cfg_nbres_ppage);
            $barre .= "'>&nbsp;".$cpt."&nbsp;</A> ";
        }
    }
   // suivant . >
    // --------------------------------------------------------------------
    if ($debut + $cfg_nbres_ppage < $nbtotal)
    {
        $cible = $query.($debut+$cfg_nbres_ppage);
        $image = image_html('/images/droite_on.gif');
        $lien = str_replace('{lien}', $image, $lien_on);
        $lien = str_replace('{cible}', $cible, $lien);
    }
    else
    {
        $image = image_html('/images/droite_off.gif');
        $lien = str_replace('{lien}', $image, $lien_off);
    }
    $barre .= "&nbsp;<B>&middot;</B>".$lien;

    // fin . >>
    // --------------------------------------------------------------------
    $fin = ($nbtotal - ($nbtotal % $cfg_nbres_ppage));
    if (($nbtotal % $cfg_nbres_ppage) == 0) $fin = $fin - $cfg_nbres_ppage;

    if ($fin != $debut)
    {
        $cible = $query.$fin;
        $image = image_html('/images/droite_on.gif');
        $lien = str_replace('{lien}', $image.$image, $lien_on);
        $lien = str_replace('{cible}', $cible, $lien);
    }
    else
    {
        $image = image_html('/images/droite_off.gif');
        $lien = str_replace('{lien}', $image.$image, $lien_off);
    }
    $barre .= "<B>&middot;</B>&nbsp;".$lien;

    return($barre);
}

// ------------------------------------------------------------------------
// image_html          
// ------------------------------------------------------------------------
function image_html($img, $align = "absmiddle")
{
    $taille = @getimagesize($img);
    return '<IMG SRC="'.$img.'" '.$taille[3].' BORDER=0 ALIGN="'.$align.'">';
}

function construct_barre_navigation($debut,$nbenr,$nbtotal,$cfg_nbres_ppage,
                                    $nb_ppage,$lien_base,$criteres,$order)
{
  // plage de réponses
  $barre_nav  = "<table width='100%' align='center'>";
  $barre_nav .= '<tr><td width="40%" align="left">';
  $barre_nav .= 'Réponses <B>'.($debut + 1).'</B> à <B>'.($debut + $nbenr).'</B>';
  $barre_nav .= ' sur <B>'.($nbtotal).'</B></TD>';

  // barre de navigation
  $barre_nav .= "<td align='left' width='60%'>&nbsp;";
  if ($nbtotal > $cfg_nbres_ppage)
  {
    $barre_nav .= barre_navigation($nbtotal, $nbenr,
                                   $nb_ppage,
                                   $debut, $lien_base, $criteres,$order);
  }
  $barre_nav .= "</td></tr></table>\n";

  return $barre_nav;
}

function affiche_popup($titre, $titre_couleur, $text,$puce="",$clic = true, $display = true)
{
	$text = addslashes($text);
	$titre = addslashes($titre);

	$popup ='';
	
	if ($puce != "")
		$popup .= "<span ";
	else
		$popup .=	"<img src='/images/aide_puce.gif' ";

	if ( $clic )
		$titre_fixe = "Clic pour Fixer la popup ! $titre";
	else
		$titre_fixe ="";
	
	$popup .= " onmouseover=\"return overlib('$text',CAPTION,'$titre_fixe');\"";
	if ( $clic ) $popup .= " onclick=\"return overlib('$text', STICKY, CAPTION, '$titre', CLOSECLICK, EXCLUSIVE);\" ";
	$popup .= " onmouseout=\"return nd();\">";

	if ($puce != "")
		$popup .= " $puce</span>";

	if ($display)
		echo $popup;
	else
		return $popup;
}



function afficher_titre_tableau($titre,$text = "")
{
?> 

   <table class='mh_tdborder' width='70%' align='center'>
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdtitre' align="center">
            <td>
              <h2><? echo $titre ?></h2>
              <? echo $text ?>
            </td>
          </tr>
        </table>
      </td></tr>
    </table>
    <br>
<?
}

function afficher_contenu_tableau($text)
{
?>

   <table class='mh_tdborder' width='70%' align='center'>
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdpage' align="center">
            <td>
              <? echo $text ?>
            </td>
          </tr>
        </table>
      </td></tr>
    </table>
    <br>


<?
}

####################################
# Afficher les liens vers la vue2d, 
# vers le gps, vers MH
####################################
function afficherLien($type_objet,$type_lien,$id,$x="",$y="",$z="",$titre="",$write=true)
{
	if ($type_objet == "centrage_vue") {
	// nothing
  } elseif ($id == 0)
    return ;

  $mh_base_link = "href=http://games.mountyhall.com/mountyhall/View";
  switch($type_objet) {
    case "troll" :
      $lien_gps_adv = "<a href=gps_advanced.php?swap_affutage=block&";
      $lien_gps_adv .= "swap_reglage=block&vue=40&poi_viseur_id_troll=$id&";
      $lien_gps_adv .= "relaismago_old=on&relaismago=on&allies_old=on&ennemis_old=on&guilde_ennemie=-1>";

      //$lien_vue2d="<a href=cockpit.php?centrer=on&cX=$x&cY=$y&cZ=$z>";
      $lien_vue2d="<a href=cockpit.php?id_troll=$id>";

      $lien_mh_profil = "<a $mh_base_link/PJView.php?ai_IDPJ=$id target=troll>";
      $lien_mh_evenements = "<a $mh_base_link/PJView_Events.php?ai_IDPJ=$id target=troll>";
      $lien_mh_classement = "<a $mh_base_link/PJView_Classements.php?ai_IDPJ=$id target=troll>";

      $lien_fiche = "<a href=engine_view.php?troll=$id>";
      break;
    case "lieu" :
    case "tresor" :
    case "monstre" :
    case "gowap" :
      $lien_fiche = "<a href=/engine_view.php?gowap=$id>";
      $lien_vue2d = "<a href=/cockpit.php?cX=$x&cY=$y&cZ=$z>";
      $lien_gps_adv = "<a href=/gps_advanced.php?taille_map=600&vue=40&x=$x&y=$y&";
      $lien_gps_adv .= "gowaps_rm_old=non&gowaps_rm=on&allies_old=non&allies=non&ennemis_old=non&ennemis=non";
      $lien_gps_adv .= "&swap_poi=block&vue=20>";

      $lien_mh_evenements = "<a $mh_base_link/MonsterView.php?ai_IDPJ=$id target=troll>";
      break;
    case "taniere" :
      $lien_fiche = "<a href=/engine_view.php?taniere=$id>";
      $lien_vue2d = "<a href=/cockpit.php?cX=$x&cY=$y&cZ=$z>";
      $lien_gps_adv = "<a href=/gps_advanced.php?taille_map=600&vue=40&x=$x&y=$y&";
      $lien_gps_adv .= "tanieres_rm_old=non&tanieres_rm=on&allies_old=non&allies=non";
      $lien_gps_adv .="&ennemis_old=non&ennemis=non&swap_poi=block&vue=20>";
      $lien_mh_profil = "<a $mh_base_link/TaniereDescription.php?ai_IDLieu=$id>";
      break;
		case "centrage_vue" :
      $lien_vue2d = "<a href=/cockpit.php?cX=$x&cY=$y&cZ=$z>";
			break;
  }

  switch($type_lien) {
    case "fiche":
      if ($titre=="") $titre="<img src=/images/puce_rg.gif border=0 title=Fiche_RG>";
      $ret = $lien_fiche;
      break;
    case "vue2d":
      if ($titre=="") $titre="<img src=/images/puce_vue2d.gif border=0 title=Centrer_sur_la_Vue2d>";
      $ret = $lien_vue2d;
      break;
    case "gps":
      if ($titre=="") $titre="<img src=/images/puce_gps.gif border=0 title=GPS>";
     $ret = $lien_gps_adv;
      break;
    case "mh_profil":
      if ($titre=="") $titre="<img src=/images/puce_mh.gif border=0 title=Profil_mh>";
      $ret = $lien_mh_profil;
      break;
    case "mh_evenements":
      if ($titre=="") $titre="<img src=/images/puce_mh.gif border=0 title=Evenements_mh>";
      $ret = $lien_mh_evenements;
      break;
    case "mh_classement":
      if ($titre=="") $titre="<img src=/images/puce_mh.gif border=0 title=Classement_mh>";
      $ret = $lien_mh_classement;
      break;
  }
  if ($write)
    echo " ".$ret.$titre."</a> ";
  else
    return "".$ret.$titre."</a>";
}

####################################
## retourne la date troll 2 zhom
####################################
function trollToZhom($cycle, $saison, $jour)
{
  $ragnarok=mktime(0,0,0,8,26,2001);
  $days=($cycle-1)*378;
  $days+=$jour+$saison*28;
  if ($saison!=0) {
    $days+=14;
  }
  $days-=1;
  $timestamp=$ragnarok+$days*86400;
  return $timestamp;
}

function afficherDateTroll()
{
  global $MUNDIDAY;

  echo "<center>";
  $tab=zhomToTroll(time());
  echo "Nous sommes le ".dayStr($tab[0],$tab[1],$tab[2]);
  $mois=$tab[1];
  echo "<br>Prochain Mundidey ";
  if ($mois>0) {
    echo "($MUNDIDAY[$mois]) dans ",28-$tab[2]," jours.";
  } elseif ($mois<13) {
    echo "(Saison du ... hum.) dans ",14-$tab[2]," jours.";
  } else {
    echo "($MUNDIDAY[$mois]) dans ",28-$tab[2]," jours.";
  }
  echo "</center>";
}

####################################
## retourne la date zhom 2 troll
####################################
function dayStr($cycle,$saison,$jour)
{
  global $MUNDIDAY;
  if ($jour==1) {
    $str="Mundiday du ";
  } else {
    $str="$jour"."e jour ";
  }
  if ($saison==0) {
    $str.="de la saison du Hum";
  } else {
    $str.="du mois ".$MUNDIDAY[$saison-1];
  }
  $str.=" du $cycle"."e cycle après Ragnarok";
  return $str;
}

####################################
## retourne la date zhom 2 troll
####################################
function zhomToTroll($timestamp)
{
  $ragnarok=mktime(0,0,0,8,26,2001);
  // 26 Aout 2001
  $days=floor(($timestamp-$ragnarok)/86400)+1;
  // Combien de temps s'est écoulé
  $cycle=floor($days/378)+1;
  $reste=$days%378;
  if ($reste<=14) {
    // Saison du Hum
    $saison=0;
    $jour=$reste;
  } else {
    // Autre (mois)
    $reste+=14;
    $saison=floor($reste/28);
    $jour=floor($reste%28);
  }
  if (isset($DEBUG) && $DEBUG) {
    echo "<br>*$cycle $saison $jour C S J*<br>";
  }
  return array($cycle,$saison,$jour);
}

function afficherAccesRapide()
{
	$fiche = "<a href='/engine_view.php?troll=".$_SESSION['AuthTroll']."' title='Accès direct à ma fiche RG'>[Ma fiche RG]</a> ";	

  if (!preg_match("/cockpit.php/",$_SERVER['REQUEST_URI']))
		$fiche .= "<a href='/cockpit.php?id_troll=".$_SESSION['AuthTroll']."' title='Accès direct à ma vue2D'>[Ma Vue]</a> ";	
  else
		$fiche .= "<a href='#' onClick='document.form_cockpit.id_troll.value=".$_SESSION[AuthTroll].";get_map();'title='Accès direct à ma vue2D'>[Ma Vue]</a> ";	

  $lesGowaps = selectDbGowaps("",$_SESSION['AuthTroll']);
  $nbGowaps = count($lesGowaps);
	if ($nbGowaps > 0) {
		$text = "<b>Mes Gowaps</b><br><br>";
	  for($i=1;$i<=$nbGowaps;$i++) {
	    $res = $lesGowaps[$i];
			$id_gowap = $res['id_gowap'];
			
			$text .= "Gowap $id_gowap";

			$titre = "X=$res[x_monstre], Y=$res[y_monstre], Z=$res[z_monstre]<br>";
			$titre .= "vu : $res[is_seen_monstre] (".date("d/m/y H:i",$res['date_monstre']).")";
			
			$text .= afficherLien('gowap','fiche',$res['id_gowap'],"","","","",false);
			$text .= afficherLien('gowap','vue2d',$res['id_gowap'],$res['x_monstre'], $res['y_monstre'],$res['z_monstre'],"",false);
			$text .= afficherLien('gowap','gps',$res['id_gowap'],$res['x_monstre'], $res['y_monstre'],$res['z_monstre'],"",false);
			$text .= afficherLien('gowap','mh_evenements',$res['id_gowap'],"","","","",false);

			$text .= "<br>".$titre; 
			$text .= "<br><br>";
		}

		$html_gowap =  "<td onmouseover=\"return overlib('$text',CAPTION,'Clique pour fixer la popup!');\"";
		$html_gowap .= " onclick=\"return overlib('$text', STICKY, CAPTION, 'Accès Rapide', CLOSECLICK, EXCLUSIVE);\" ";
		$html_gowap .= " onmouseout=\"return nd();\">Mes Gowaps</td>";
	}	

	if (!isset($html_gowap)) $html_gowap="";

  $lesTanieres = selectDbTanieres("",$_SESSION['AuthTroll']);
  $nbTanieres = count($lesTanieres);

	$html_taniere = "";
	if ($nbTanieres > 0) {
		$text = "<b>Mes Tanières</b><br><br>";
  	for($i=1;$i<=$nbTanieres;$i++) {
	    $res = $lesTanieres[$i];

			$id_taniere = $res['id_taniere'];
			$text .= "Tanière $id_taniere";

			$text .= afficherLien('taniere','fiche',$res['id_taniere'],"","","","",false);
			$text .= afficherLien('taniere','vue2d',$res['id_taniere'],$res['x_lieu'], $res['y_lieu'],$res['z_lieu'],"",false);
			$text .= afficherLien('taniere','gps',$res['id_taniere'],$res['x_lieu'], $res['y_lieu'],$res['z_lieu'],"",false);
			$text .= afficherLien('taniere','mh_profil',$res['id_taniere'],"","","","",false);

			$text .= "<br>X=$res[x_lieu], Y=$res[y_lieu], Z=$res[z_lieu]";
			$text .= "<br><br>";
			
		}

		$html_taniere .=  "<td onmouseover=\"return overlib('$text',CAPTION,'Clique pour fixer la popup!');\"";
		$html_taniere .= " onclick=\"return overlib('$text', STICKY, CAPTION, 'Accès Rapide', CLOSECLICK, EXCLUSIVE);\" ";
		$html_taniere .= " onmouseout=\"return nd();\">Mes Tanières</td>";
	}

  $lesGt = selectDbTanieres("","",true);
  $nbTanieres = count($lesGt);

	$html_gt = "";
	if ($nbTanieres > 0 && userIsGuilde()) {
		$text = "<b>Les Grandes Tanières Relais&Mago</b><br><br>";

		for($i=1;$i<=$nbTanieres;$i++) {
			$res = $lesGt[$i];

			$id_taniere = $res['id_taniere'];
			$nom_lieu = $res['nom_lieu']." ";
			$text .= addslashes($nom_lieu);

			$text .= afficherLien('taniere','fiche',$res['id_taniere'],"","","","",false);
			$text .= afficherLien('taniere','vue2d',$res['id_taniere'],$res['x_lieu'], $res['y_lieu'],$res['z_lieu'],"",false);
			$text .= afficherLien('taniere','gps',$res['id_taniere'],$res['x_lieu'], $res['y_lieu'],$res['z_lieu'],"",false);
			$text .= afficherLien('taniere','mh_profil',$res['id_taniere'],"","","","",false);

			$text .= "<br>X=$res[x_lieu], Y=$res[y_lieu], Z=$res[z_lieu]";
			$text .= "<br><br>";
			
		}

		$html_gt .=  "<td onmouseover=\"return overlib('$text',CAPTION,'Clique pour fixer la popup!');\"";
		$html_gt .= " onclick=\"return overlib('$text', STICKY, CAPTION, 'Accès Rapide', CLOSECLICK, EXCLUSIVE);\" ";
		$html_gt .= " onmouseout=\"return nd();\">GT</td>";
	}


	?>
	<table class='mh_tdborder'>
		<tr class='mh_tdpage'>
			<td nowrap>
				<?echo $fiche ?>	
			</td>
			<? echo $html_gowap ?>
			<? echo $html_taniere ?>
			<? echo $html_gt ?>
		</tr>
	</table>
	<?
}

function tutorial_haut()
{
	?>
	<table bgcolor="#30385c" border="3" bordercolor="#fbba2c" cellpadding="10" cellspacing="0" width="90%" align="center">
	<tr>
	<td align="center">
	<?
}

function tutorial_haut_bulle_gauche($image,$nom)
{
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="743" align="center">
		<tr>
		<td valign="top" width="110" align="center">
			<img src="<? echo $image ?>" border="0" height="110" width="110"><br><b><? echo $nom ?></b>
		</td>
    <td colspan="4">
			<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="633" align='center'>
				<tr>
					<td colspan="3"><img src="/images/bord_sup_1.gif" height="16" width="633"></td>
				</tr>
				<tr>
					<td background="/images/ele_hor_gauche1.gif" valign="top" width="38">
						<img src="/images/bulle_gauche.gif" height="55" width="38">
						</td>
					<td rowspan="2" width="579" >
					<font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="2">
		<?
}

function tutorial_haut_bas_gauche()
{
?>
						</font>
						<td rowspan="2" background="/images/ele_hor_droit1.gif" width="18">
					</td>
				</tr>
				<tr>
					<td background="/images/ele_hor_gauche1.gif" height="100%" width="38">&nbsp;</td>
					</tr>
				<tr>
					<td colspan="3"><img src="/images/bord_inf1.gif" height="18" width="633"></td>
				</tr>
			</table>
		</td>
		</tr>
	</table>
<?
}

function tutorial_haut_bulle_droit()
{
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="743">
		<tr>
			<td>
				<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="633">
					<tr>
						<td colspan="3">
							<img src="/images/bord_sup_2.gif" height="16" width="633">
						</td>
					</tr>
					<tr>
						<td rowspan="2" background="/images/ele_hor_gauche2.gif" width="18">&nbsp;</td>
						<td rowspan="2" width="587">
							<font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="2">

	<?
}

function tutorial_haut_bas_droit($image,$nom)
{
?>					</font>
						</td>
						<td background="/images/ele_hor_droit2.gif" height="55" valign="top" width="38">
							<img src="/images/bulle_droite.gif" width="38">
						</td>
					</tr>
					<tr>
						<td background="/images/ele_hor_droit2.gif">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><img src="/images/bord_inf2.gif" height="18" width="633"></td>
					</tr>
				</table>
			</td>
			<td valign="top" width="110" align="center">
					<img src="<? echo $image ?>" border="0" height="110" width="110"><br><b><? echo $nom ?></b>
			</td>
		</tr>
	</table>
<?
}

function tutorial_bas()
{
	?>
		</td>
		</tr>
		</table>
	<?
}
?>
