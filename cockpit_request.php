<?php
require_once('functions_vue.php');
require_once('functions_display.php');
include_once('functions_help.php');

require_once('includes/troll.class.php');
require_once('includes/ggc_groupe.class.php');

if ($_REQUEST["action"] == "get_map") {
	if ($_REQUEST[id_troll] == -1 && $_REQUEST[cX] == "" && $_REQUEST[cY] == "" && $_REQUEST[cZ] == "") {
		echo "Pas de vue. S&eacute;lectionnez un troll.<br>";
		exit;
	}
		
	$tab_cookies = initCookie(); 
	$info = initVue2d($tab_cookies);
	afficher_vue2d($info);

 ?> 
 	<table class="mh_tdborder" width="40%" align="center">
		<tr class="mh_tdtitre">
			<td>
 				Trollometer :
		 		<input type='button' onClick="get_trollometer(true);" value="Afficher" name="b_trollometer" class="mh_form_submit">
				Taille en PA du troll-O-meter
				<?
				formulaire_listbox("max_pa",0,LIMITE_MAX_TAILLE_PA,1,$info[max_pa],"moinsplus","",false,true,"onChange=\"get_trollometer(true);\"");
				?>
			</td>
		</tr>
	</table>
<?
} elseif ($_REQUEST["action"] == "display_trollometer") {
	$tab_cookies = initCookie(); 
	$info = initVue2d($tab_cookies);
	if ($_REQUEST["display_trollometer"] == "Afficher") {
		vue2d_afficher_trollometer($info);
		vue2d_afficher_legende();
	} else {
		echo " ";
	}
}

function initCookie()
{

  if (isset($_REQUEST['anim'])) $anim = $_REQUEST['anim']; else $anim = "";
  if (isset($_REQUEST['trolls_disparus'])) $trolls_disparus = $_REQUEST['trolls_disparus']; else $trolls_disparus = "";

  if ($anim == "non" || ($_COOKIE['ANIMATIONS'] == "")) {
    setcookie("ANIMATIONS","non",time()+365*24*3600);
    $anim="non";
  } elseif ($anim == "oui") {
    setcookie("ANIMATIONS","oui",time()+365*24*3600);
  } else {
    $anim=$_COOKIE['ANIMATIONS'];
  }

  if ( $trolls_disparus == "oui" || ($_COOKIE['TROLLS_DISPARUS'] == "") ) {
    setcookie("TROLLS_DISPARUS","oui",time()+365*24*3600);
    $trolls_disparus = "oui";
  } elseif ( $trolls_disparus == "non") {
    setcookie("TROLLS_DISPARUS","non",time()+365*24*3600);
  } else {
    $trolls_disparus = $_COOKIE['TROLLS_DISPARUS'];
  }

  $tab_cookies["anim"] = $anim;
  $tab_cookies["trolls_disparus"] = $trolls_disparus;

  return $tab_cookies;
}   

function vue_criteres()
{
	?>
      <select name='id_troll' id='id_troll'
       onChange='get_map();'>
       <?
       if ($_REQUEST[id_troll] != "")
       	showListeCache($_REQUEST[id_troll],true);
       else
	       showListeCache("",true);
       ?>
       </select>
  <?
	if ($zoom == "")
		$zoom = 1;
	echo "<select name='zoom' onChange='get_map();'>"; 
  afficher_listbox_select(5.0, $zoom,"toupeti");
  afficher_listbox_select(4.5, $zoom,"=====");
  afficher_listbox_select(4.0, $zoom,"====-");
  afficher_listbox_select(3.6, $zoom,"===--");
  afficher_listbox_select(3.2, $zoom,"==---");
  afficher_listbox_select(2.9, $zoom,"=----");
  afficher_listbox_select(2.6, $zoom,"peti");
  afficher_listbox_select(2.3, $zoom,"-----");
  afficher_listbox_select(2.0, $zoom,"----");
  afficher_listbox_select(1.6, $zoom,"---");
  afficher_listbox_select(1.4, $zoom,"--");
  afficher_listbox_select(1.2, $zoom,"-");
  afficher_listbox_select(1 , $zoom,"Normal");
  afficher_listbox_select(0.9, $zoom,"+");
  afficher_listbox_select(0.8, $zoom,"++");
  afficher_listbox_select(0.7, $zoom,"+++");
  afficher_listbox_select(0.6, $zoom,"++++");
  afficher_listbox_select(0.5, $zoom,"BIG");
  echo "</select>";

  echo "Taille de la vue ";
	if ($taille_vue == "")
		$taille_vue = 3;
  formulaire_listbox("taille_vue",0,LIMITE_MAX_VUE,1,$taille_vue,"moinsplus","",false,true,"onChange='get_map();'");

	echo "Animations";
  echo "<select name='anim' onChange='get_map();'>";
  afficher_listbox_select("oui", $anim,"Oui");
  afficher_listbox_select("non", $anim,"Non");
	echo "</select>";

	echo "Trolls Disparus";
  echo "<select name='trolls_disparus' onChange='get_map();'>";
  afficher_listbox_select("oui", $trolls_disparus,"Oui");
  afficher_listbox_select("non", $trolls_disparus,"Non");
  echo "</select>";
}

function recherchator_criteres()
{
	afficherCockpitRecherchator();
}
?> 
