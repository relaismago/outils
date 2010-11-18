<?
include('gps_advanced_functions.php');
function afficherCockpitRadar()
{
	$vue = 10;
	$text .= "<table width=100% cellspacing=0>";
	$text .= "	<tr class=mh_tdtitre>";
	$text .= "		<td align=center>Radar (vue:$vue)";
	$text .= " <a href='' id='lien_gps'>[Acc&egrave;s Gps]</a>";
	$text .= "		</td>";
	$text .= "	</tr>";
	$text .= "	<tr class=mh_tdpage>";
	$text .= "		<td>A VENIR";
	$text .= "		</td>";
	$text .= "	</tr>";
	$text .= "</table>";
	
	return $text;
}

function afficherCockpitAvatar()
{
	?>
	<form name='cockpitRecherchator' method='POST' action='cockpit.php'>

	<table class='mh_tdborder' border='0' cellpadding='0' cellspacing='0'>
	<tr class='mh_tdtitre'><td>

	</td></tr>
	<tr class='mh_tdpage'><td>
	
	</td></tr></table>
	<?
}

function afficherCockpitRecherchator()
{
	?>
	<form name='cockpitRecherchator' method='POST' action='cockpit.php' >
	<input type='hidden' name='old_recherche'>

	<table width='100%' cellspacing='0'>
		<tr class='mh_tdtitre'>
			<td align='center'>Recherchator</td>
		</tr>
		<tr class='mh_tdpage'>
			<td>
				<select name='recherche' onChange="Javascript:change_type();">
				<? afficher_listbox_select("trolls",$_REQUEST['recherche'],"Trolls"); 
				   afficher_listbox_select("monstres",$_REQUEST['recherche'],"Monstres");
				   afficher_listbox_select("lieux",$_REQUEST['recherche'],"Lieux"); ?>
				</select>

				<div name="conteneur" class="conteneur">
					<div id="trolls" name="trolls" style='display:block'>
					<select name='trolls_rm_num' id='trolls_rm_num'
					onChange='change_infos_RM(false)'>
					<? 
						if ($_REQUEST[id_troll] != "")
							$hidden = showListeCache($_REQUEST[id_troll],true);
						else if($_REQUEST[trolls_rm_num] != "")
							$hidden = showListeCache($_REQUEST[trolls_rm_num],true);
						else 
							$hidden = showListeCache($_SESSION[AuthTroll],true);
					?>
					</select>
					<a id='link_rg' href=''><img src='images/puce_rg.gif' title='Accès à la fiche RG' border=0></a>&nbsp;
					<a id='link_mh' href='' target='_blank'><img src='images/puce_mh.gif' title='Accès au profil MH' border=0></a>
					<a id='link_gps' href=''><img src='images/puce_gps.gif' title='Accès au GPS centré sur ce troll' border=0></a>
					<? echo $hidden ?>
					<? 
					$act = "onClick=\"JavaScript:document.getElementById('troll_avatar').style.display =";
					$act .= "swapSpan('trolls_plus','img_trolls_plus','swap_trolls_plus')\"";
					echo "<input type='hidden' id='swap_trolls_plus' name='swap_reglage' value='visible'>";
					if ($_REQUEST['recherche'] != "") {
						$id_troll_recherche = $_REQUEST[id_troll];
					}
					?>
					<table>
						<tr>
							<td nowrap>N° <input type='textbox' name='id_troll' size='6' value='<? echo $id_troll_recherche ?>'></td>
							<td nowrap>Nom <input type='textbox' name='nom_troll' size='6' value='<? echo $_REQUEST[nom_troll] ?>'></td>
							<td colspan='2' nowrap>Guilde <input type='textbox' name='nom_guilde' size='6' value='<? echo $_REQUEST[nom_guilde] ?>'>
								<img id='img_trolls_plus' src='images/triangle-bleu.gif' <? echo $act ?> > plus d'options
							</td>
						</tr>
					</table>
				</div>

				<div id="troll_avatar" name="troll_avatar" style='display:block' align='center'>
    			<table  border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' align='center'>
				    <tr class='mh_tdtitre'>
							<td valign='bottom' align='center'>
				    		<font color=black>
									<img id='avatar' src=''>
								</font>
					    </td>
						</tr>
			    </table>

				</div>

				<div id="trolls_plus" name="trolls_plus" style='display: none'>
					<table width='100%'>
						<tr>
							<td nowrap>Niveau 
								<input type='textbox' name='niveau_troll' size='2' value='<? echo $_REQUEST[niveau_troll] ?>'>
							</td>
							<td colspan='3' nowrap>Race 
								<select name='race_troll'>
								<?
							  afficher_listbox_select("", $_REQUEST['race_troll']);
							  afficher_listbox_select("Durakuir", $_REQUEST['race_troll']);
							  afficher_listbox_select("Kastar", $_REQUEST['race_troll']);
							  afficher_listbox_select("Skrim", $_REQUEST['race_troll']);
							  afficher_listbox_select("Tomawak", $_REQUEST['race_troll']);
								?>
							  </select>
							</td>
						</tr>
						<tr>
							<td colspan='4'>
	
								<table width='100%'>
									<tr valign='top'>
									  <td nowrap>Tk </td><td nowrap>
		<? afficher_radio("is_tk_troll", "oui", $_REQUEST['is_tk_troll'],"oui"); ?><br>
		<? afficher_radio("is_tk_troll", "", $_REQUEST['is_tk_troll'],"n'importe"); ?>

  </td><td nowrap>Wanted  </td><td nowrap>
		<? afficher_radio("is_wanted_troll", "oui", $_REQUEST['is_wanted_troll'],"oui"); ?><br>
		<? afficher_radio("is_wanted_troll", "", $_REQUEST['is_wanted_troll'],"n'importe"); ?>

  </td><td nowrap>Chatié  </td><td nowrap>
		<? afficher_radio("is_venge_troll", "oui", $_REQUEST['is_venge_troll'],"oui"); ?> <br>
		<? afficher_radio("is_venge_troll", "", $_REQUEST['is_venge_troll'],"n'importe"); ?>
	
	</td></tr>
	</table>

	</tr><tr>

  <td colspan='3' nowrap>Diplo Troll 
  <select name='statut_troll'>
  	<? afficher_listbox_select("", $_REQUEST['statut_troll']);
		  afficher_listbox_select("neutre", $_REQUEST['statut_troll']);
		  afficher_listbox_select("tk", $_REQUEST['statut_troll']);
		  afficher_listbox_select("ennemie", $_REQUEST['statut_troll']);
		  afficher_listbox_select("amie", $_REQUEST['statut_troll']);
		  afficher_listbox_select("alliee", $_REQUEST['statut_troll'], "alliée");
		?>
  </select>

  Diplo Guilde 
  <select name='statut_guilde'>
  <? 
		afficher_listbox_select("", $_REQUEST['statut_guilde']);
	  afficher_listbox_select("neutre", $_REQUEST['statut_guilde']);
	  afficher_listbox_select("tk", $_REQUEST['statut_guilde']);
	  afficher_listbox_select("ennemie", $_REQUEST['statut_guilde']);
	  afficher_listbox_select("amie", $_REQUEST['statut_guilde']);
  	afficher_listbox_select("alliee", $_REQUEST['statut_guilde'], "alliée");
	?>
  </select></td>

	</tr><tr>

 	<td colspan='4' nowrap>Position X/Y/Z
	<? formulaire_listbox("x_troll",-150,150,1,$_REQUEST['x_troll'],"plusmoins","yes");
	   formulaire_listbox("y_troll",-150,150,1,$_REQUEST['y_troll'],"plusmoins","yes");
	   formulaire_listbox("z_troll",0,100,1,$_REQUEST['z_troll'],"plusmoins","yes");
		?>
	</td></tr>
	</table>	
	</div>

	<div id="monstres" name="monstres" style='display: none'> 
	<? 
	$act = "onClick=\"JavaScript:swapSpan('monstres_plus','img_monstres_plus','swap_monstres_plus')\"";
	echo "<input type='hidden' id='swap_monstres_plus' name='swap_monstres_plus' value='visible'>";
	?>

		<table>
			<tr>
				<td nowrap>N° <input type='textbox' id='id_monstre' name='id_monstre' size='6' value='<? echo $_REQUEST[id_monstre] ?>'>
				</td>
				<td nowrap>Nom <input type='textbox' id='nom_monstre' name='nom_monstre' size='6' value='<? echo $_REQUEST[nom_monstre] ?>'>
				</td>
				
				<td>
					<img id='img_monstres_plus' src='images/triangle-bleu.gif' <? echo $act ?> > plus d'options
				</td>
			</tr>
		</table>
	</div>
	<div id="monstres_plus" name="monstres_plus" style='display: none'>
		<table>
			<tr>
		 		<td colspan='2' nowrap>Position X/Y/Z
				<?
				  formulaire_listbox("x_monstre",-150,150,1,$_REQUEST['x_monstre'],"plusmoins","yes");
				  formulaire_listbox("y_monstre",-150,150,1,$_REQUEST['y_monstre'],"plusmoins","yes");
				  formulaire_listbox("z_monstre",0,100,1,$_REQUEST['z_monstre'],"plusmoins","yes");
				?>
		  </td></tr>
			<tr><td>
			  Niveau du monstre (+/- 1) :  
				<? formulaire_listbox("niveau_monstre",0,40,1,$_REQUEST[niveau_monstre],"moinsplus","yes"); ?>
				</td></tr>
			<tr><td>
			  Race : 
				<? 
			  echo "<select name='race_monstre'>";
				afficher_listbox_race_bestiaire_select($_REQUEST[race_monstre],true);
			  echo "</select>";    
			  ?>
				</td></tr>
			  <tr><td>
			  Famille : 
				<?  
			  echo "<select name='famille_monstre'>";
				afficher_listbox_famille_bestiaire_select($_REQUEST[famille_monstre],true);
			  echo "</select>";
				?>
				</td></tr>
		</table>
	</div>

	<div id="lieux" name="lieux" style='display: none'>
	<? 
	$act = "onClick=\"JavaScript:swapSpan('lieux_plus','img_lieux_plus','swap_lieux_plus')\"";
	echo "<input type='hidden' id='swap_lieux_plus' name='swap_lieux_plus' value='visible'>";
	?>

	<table>
	<tr>
	<td nowrap>Nom <input type='textbox' name='nom_lieu' size='6' value='<? echo $_REQUEST[nom_lieu] ?>'></td>
	<td nowrap>
		<img id='img_lieux_plus' src='images/triangle-bleu.gif' <? echo $act ?> > plus d'options
	</td>
	</tr>
	</table>
	</div>

	<div id="lieux_plus" name="lieux_plus" style='display: none'>
	<table>
 	<td nowrap>Position X/Y/Z
	<? formulaire_listbox("x_lieu",-150,150,1,$_REQUEST['x_lieu'],"plusmoins","yes");
  	 formulaire_listbox("y_lieu",-150,150,1,$_REQUEST['y_lieu'],"plusmoins","yes");
  	 formulaire_listbox("z_lieu",0,100,1,$_REQUEST['z_lieu'],"plusmoins","yes");
		?>
  </td></tr>
	</table>
	</div>

	</td></tr>
	<tr><td>

	<center><input type='submit' class='mh_form_submit' value='Rechercher'>
	<input type='reset' class='mh_form_submit' value='Par d&eacute;faut'></center>
	</td></tr>
	</table>
	
<?	
}

function javascriptRecherchator()
{
?>
	<script language="JavaScript">
		function change_type()
		{
			myform = document.cockpitRecherchator;
			
			document.getElementById('trolls').style.display = 'none';
			document.getElementById('troll_avatar').style.display = 'none';
			document.getElementById('trolls_plus').style.display = 'none';
			document.getElementById('monstres').style.display = 'none';
			document.getElementById('monstres_plus').style.display = 'none';
			document.getElementById('lieux').style.display = 'none';
			document.getElementById('lieux_plus').style.display = 'none';
			document.getElementById(myform.recherche.value.toString()).style.display = 'block';
			if (myform.recherche.value.toString() == 'trolls') {
				document.getElementById('troll_avatar').style.display = 'block';
				document.getElementById('trolls_plus').style.display = 'none';
			} else if (myform.recherche.value.toString() == 'monstres') {
				document.getElementById('monstres_plus').style.display = 'none';
			} else if (myform.recherche.value.toString() == 'lieux') {
				document.getElementById('lieux_plus').style.display = 'none';
			}
		}

		function change_infos_RM(load_init,id_troll_recherche,x,y,z)
		{
			var myform = document.cockpitRecherchator;
			var myrm = myform.trolls_rm_num;
			
			var mid = myform.trolls_rm_num[myrm.selectedIndex].value
			
			var val = document.getElementById(mid).value;
			var pos = val.split('|');
			
			var x_troll = pos[0];
			var y_troll = pos[1];
			var z_troll = pos[2];
			var id_troll = pos[3];
			var nom_avatar = pos[4];

			if ( (id_troll_recherche > 0) && (load_init) ) {
				id_troll=id_troll_recherche;
		
				if (x != "")
					x_troll = x;
				if (y != "")
					y_troll = y;
				if (z != "")
					z_troll = z;
				if (x != "" && y != "" && z == "")
					z_troll = 0;
			}

			if ((load_init) && (id_troll_recherche > 0) ||
				  (load_init == false))
			
			{
			
				document.select_troll.cX.value = x_troll;
				document.select_troll.cY.value = y_troll;
				document.select_troll.cZ.value = z_troll;
				document.select_troll.id_troll.value = id_troll;

				//myform.id_troll.value = id_troll;
				insert_position();

			}	

			document.getElementById("link_rg").href ='engine_view.php?troll='+id_troll;
			document.getElementById("link_mh").href ='http://games.mountyhall.com/mountyhall/View/PJView.php?ai_IDPJ='+id_troll;

      lien_gps_adv = "gps_advanced.php?swap_affutage=block&";
      lien_gps_adv = lien_gps_adv + "swap_reglage=block&vue=40&guilde_ennemie=-1&";
      lien_gps_adv = lien_gps_adv + "relaismago_old=on&relaismago=on&allies_old=on&ennemis_old=on&poi_viseur_id_troll=";

			document.getElementById("link_gps").href =lien_gps_adv+id_troll;

			updateRadar(x_troll,y_troll,z_troll,id_troll);
			updateAvatar(nom_avatar);
		}

		function onLoad()
		{
			change_type();
			<? 
				// $info est rempli si c'est la vue2d qui est demandé
				if ($info[x_position] != "")  {
					echo "change_infos_RM(true,'$info[id_troll]',$info[x_position],$info[y_position],$info[z_position]);";
				} elseif ($_REQUEST[id_troll] != "" ) {
					echo "change_infos_RM(true,'$_REQUEST[id_troll]');";
				} else { 
					echo "change_infos_RM(true);";
				} 
			?>
			insert_position();
		}
		
		function clear_id_troll()
		{
				document.select_troll.id_troll.value = "";
		}

		function clear_position()
		{
			var myform = document.cockpitRecherchator;

			myform.x_troll.value = "";
			myform.y_troll.value = "";
			myform.z_troll.value = "";
			
			myform.x_monstre.value = "";
			myform.y_monstre.value = "";
			myform.z_monstre.value = "";

			myform.x_lieu.value = "";
			myform.y_lieu.value = "";
			myform.z_lieu.value = "";
		}

		function insert_position()
		{

			var myform = document.cockpitRecherchator;
			var myrm = myform.trolls_rm_num;
			
			var mid = myform.trolls_rm_num[myrm.selectedIndex].value
			
			var val = document.getElementById(mid).value;
			var pos = val.split('|');
			
			var x_troll = pos[0];
			var y_troll = pos[1];
			var z_troll = pos[2];
			var id_troll = pos[3];
			var nom_avatar = pos[4];

			myform.x_troll.value = x_troll;
			myform.y_troll.value = y_troll;
			myform.z_troll.value = z_troll;
			
			myform.x_monstre.value = x_troll;
			myform.y_monstre.value = y_troll;
			myform.z_monstre.value = z_troll;

			myform.x_lieu.value = x_troll;
			myform.y_lieu.value = y_troll;
			myform.z_lieu.value = z_troll;
		}

		function cacher_legende()
		{
			document.getElementById('radar_legende_c').style.visibility = 'hidden';
		}

		function updateRadar(x,y,z,mid)
		{
			document.getElementById("radar").src="gps.php?mode_radar=radar&vue=10&taille_map=120&x="+x+"&y="+y+"&quadrillage=on&repere=on&viseur=non&info_text=50&relaismago=on&baronnies=&tanieres_rm=&gowaps_rm=&allies=on&ennemis=on&guilde_ennemie=-1&champignons=non";
			document.getElementById('lien_gps').href="gps_advanced.php?swap_affutage=block&swap_reglage=block&vue=40&poi_viseur_id_troll="+mid+"&relaismago_old=on&relaismago=on&allies=on&ennemis=on&allies_old=on&ennemis_old=on&guilde_ennemie=-1";

		}

		function updateAvatar(nom_avatar)
		{
			document.avatar.src="http://www.pipeshow.net/RM/"+nom_avatar+"_avatar.gif";
		}

		window.onload = onLoad;
	</script>

<?
}

?>
