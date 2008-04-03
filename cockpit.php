<? 
require_once('top.php');
require_once('functions_engine.php');
require_once('functions_help.php');
  
require_once('secure.php');

require_once('includes/ggc_groupe.class.php');

if ( isset($_REQUEST['refresh']) && (($_REQUEST['refresh'] == "s_public")||($_REQUEST['refresh'] == "copie_colle")) ) {
	initRefresh();
} else {
	init_cockpit();
}

function init_cockpit() {
	?>

		<head>
			<script language="javascript" type="text/javascript" 
				src="/js/cockpit.js">
			</script>
			<script language="javascript" type="text/javascript">
				function onLoad()
				{
					<?

					if ($_REQUEST[id_troll] != "" )
						echo "get_map();";
					else if ($_REQUEST[cX] != "" && $_REQUEST[cY] != "" && $_REQUEST[cZ] != "")
						echo "get_map_go(false,true);";
					
				
					?>
				}

				function suite_on_load() {
					<?	
					$options = $_SESSION["options"];
					if ($_REQUEST[max_pa] != "" || $options["vue_display_trollometer_option"] == "oui")
						echo "get_trollometer(true);";
					?>
				}

    function updateRadar(x,y,z)
    { 
      document.getElementById("radar").src="gps.php3?mode_radar=radar&vue=10&taille_map=120&x="+x+"&y="+y+"&quadrillage=on&repere=on&viseur=non&info_text=50&relaismago=on&baronnies=&tanieres_rm=&gowaps_rm=&allies=on&ennemis=on&guilde_ennemie=-1&champignons=non";
	}
				window.onload = onLoad;
			</script>
		</head>

		<body>
			<form name="form_cockpit">
			<table width="95%" class="mh_tdborder" align="center">
			<tr class="mh_tdtitre">
			<td nowrap>
		<? vue_criteres();	?>
		</td>
		<td>
		<div id="load_cage">

		</div>
		<div id="status" style="display: none">
			<div class="progressBar" id="progress_bar">
				<div class="border" id='border'>
					<div class="background" id='background'>
						<div class="foreground" id='foreground'>Patience...</div>
					</div>
				</div>
			</div>
		</div>
		</td>
		</tr>
		</table>

		<div id="result_cage">
			<!--This is where we'll be displaying the result -->
		</div>
<!--		  Trollometer :
		 <input type='button' onClick="get_trollometer();" value="Afficher" name="b_trollometer" class="mh_form_submit">
-->
		<div id="status_trollometer" style="display: none">
			<div class="progressBar" id="progress_bar">
				<div class="border" id='border'>
					<div class="background" id='background_trollometer'>
						<div class="foreground" id='foreground_trollometer'>Patience...</div>
					</div>
				</div>
			</div>
		</div>
		<div id="trollometer_cage">
			<!--This is where we'll be displaying the trollometer-->
		</div>
		<br><br>
	</form>

<?
include('foot.php');
}

function vue_criteres()
{
	$zoom = $_REQUEST["zoom"];
	$taille_vue = $_REQUEST["taille_vue"];
	$trolls_disparus= $_REQUEST["trolls_disparus"];
	$anim = $_REQUEST["anim"];

	$options = $_SESSION["options"];
	
	?>
		<input type='hidden' name='cX_direct' value='<?=$_REQUEST[cX]?>'>
		<input type='hidden' name='cY_direct' value='<?=$_REQUEST[cY]?>'>
		<input type='hidden' name='cZ_direct' value='<?=$_REQUEST[cZ]?>'>
		<input type='hidden' name='max_pa_direct' value='<?=$_REQUEST[max_pa]?>'>
		<input type='hidden' name='pcenter' value='<?=$_REQUEST[pcenter]?>'>

   <select name='id_troll_list' id='id_troll_list'
     onChange='document.form_cockpit.id_troll.value=this.value;get_map();'>
     <?
     if ($_REQUEST[id_troll] != "")
      showListeCache($_REQUEST[id_troll],true);
     else
	    showListeCache("",true);

     ?>
       </select>
			 <input type='hidden' value='<?=$_REQUEST[id_troll]?>' name='id_troll' id='id_troll'>
  <?
  echo " Vue ";

	if ($taille_vue == "") {
		$taille_vue = $options["vue_taille_option"];
	}

  formulaire_listbox("taille_vue",0,LIMITE_MAX_VUE,1,$taille_vue,"moinsplus","",false,true,"onChange='get_map();'");
	afficheAideVueTailleVue();
	
	if ($zoom == "") {
		$zoom = $options["vue_zoom_option"];
	}

	vue_afficher_zoom_select($zoom, "zoom", "onChange='get_map();'");
	
	if ($anim == "") {
		$anim = $options["vue_animations_option"];
	}
	
	if ($trolls_disparus == "") {
		$trolls_disparus = $options["vue_fantomes_option"];
	}

	echo " Animations ";
  echo "<select name='anim' onChange='get_map();'>";
  afficher_listbox_select("oui", $anim,"Oui");
  afficher_listbox_select("non", $anim,"Non");
	echo "</select>";
	afficheAideVueAnimation();
	echo " Trolls Disparus ";
  echo "<select name='trolls_disparus' onChange='get_map();'>";
  afficher_listbox_select("oui", $trolls_disparus,"Oui");
  afficher_listbox_select("non", $trolls_disparus,"Non");
  echo "</select>";
	afficheAideVueTrollsDisparus();

	$js_id = "id_troll=\"+document.form_cockpit.id_troll.value";
	echo " Rafraichir <input type='button' onClick='document.location.href=\"cockpit.php?refresh=s_public&$js_id' value='Auto' class='mh_form_submit' alt='Rafraichir la vue avec les scripts publics'> ";
	echo "<input type='button' onClick='document.location.href=\"cockpit.php?refresh=copie_colle&$js_id' value='Manuel' class='mh_form_submit'  alt='Rafraichir la vue avec un copi&eacute; coll&eacute;'>";
}
