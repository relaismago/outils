<?php 

	require_once('top.php');
	require_once('functions_engine.php');
	require_once('functions_help.php');
	  
	if (!userIsGuilde() && !userIsGroupSpec())
	  die("<h1><font color=black><b>Vous n'avez pas accès à cette page !</b></font></h1>");
	
	require_once('includes/ggc_groupe.class.php');
	
	if ( isset($_REQUEST['refresh']) && (($_REQUEST['refresh'] == "s_public")||($_REQUEST['refresh'] == "copie_colle")) )
		initRefresh();
	else
		init_cockpit();
	
	include('foot.php');
	
	function init_cockpit() {
		
		echo "
			<script language='javascript' type='text/javascript' src='/js/cockpit.js'></script>
			<script language='javascript' type='text/javascript'>
				function onLoad()
				{
		";			
			
					if ( !empty($_REQUEST["id_troll"]) )
						echo "get_map();";
					else if ( !empty($_REQUEST["cX"]) && !empty($_REQUEST["cY"]) && !empty($_REQUEST["cZ"]) )
						echo "get_map_go(false,true);";
					
		echo "				
				}
			
				function suite_on_load() {
		";			
						if ( !empty($_REQUEST["max_pa"]) || $_SESSION["options"]["vue_display_trollometer_option"] == "oui" )
							echo "get_trollometer(true);";
		echo "							
				}
			
			    function updateRadar(x,y,z)
			    { 
			      document.getElementById('radar').src='gps.php?mode_radar=radar&vue=10&taille_map=120&x='+x+'&y='+y+'&quadrillage=on&repere=on&viseur=non&info_text=50&relaismago=on&baronnies=&tanieres_rm=&gowaps_rm=&allies=on&ennemis=on&guilde_ennemie=-1&champignons=non';
				}
				
				window.onload = onLoad;
			</script>
			<form name='form_cockpit'>
				<table width='95%' class='mh_tdborder' align='center'>
					<tr class='mh_tdtitre'>
						<td nowrap>
		";
			vue_criteres();
		echo "				
						</td>
						<td>
						<div id='load_cage'>
						</div>
						<div id='status' style='display: none'>
							<div class='progressBar' id='progress_bar'>
								<div class='border' id='border'>
									<div class='background' id='background'>
										<div class='foreground' id='foreground'>Patience...</div>
									</div>
								</div>
							</div>
						</div>
						</td>
					</tr>
				</table>
				<div id='result_cage'>
				</div>
				<div id='status_trollometer' style='display: none'>
					<div class='progressBar' id='progress_bar'>
						<div class='border' id='border'>
							<div class='background' id='background_trollometer'>
								<div class='foreground' id='foreground_trollometer'>Patience...</div>
							</div>
						</div>
					</div>
				</div>
				<div id='trollometer_cage'>
				</div>
				<br/><br/>
			</form>
		";

	}
	
	function vue_criteres(){
		
		$zoom = $_REQUEST["zoom"];
		$taille_vue = $_REQUEST["taille_vue"];
		$trolls_disparus = $_REQUEST["trolls_disparus"];
		$anim = $_REQUEST["anim"];
		$options = $_SESSION["options"];
	
		echo "
			<input type='hidden' name='cX_direct' value='" .$_REQUEST["cX"]. "'>
			<input type='hidden' name='cY_direct' value='" .$_REQUEST["cY"]. "'>
			<input type='hidden' name='cZ_direct' value='" .$_REQUEST["cZ"]. "'>
			<input type='hidden' name='max_pa_direct' value='" .$_REQUEST["max_pa"]. "'>
			<input type='hidden' name='pcenter' value='" .$_REQUEST["pcenter"]. "'>
			<select name='id_troll_list' id='id_troll_list' onChange='document.form_cockpit.id_troll.value=this.value;get_map();'>
		";
		showListeCache($_REQUEST["id_troll"],true);

		echo "
			</select>
			<input type='hidden' value='" .$_REQUEST["id_troll"]. "' name='id_troll' id='id_troll'>
		";
			
		echo " Vue ";
		
		if ( empty($taille_vue) )
			$taille_vue = $options["vue_taille_option"];
		
		formulaire_listbox("taille_vue",0,LIMITE_MAX_VUE,1,$taille_vue,"moinsplus","",false,true,"onChange='get_map();'");
		afficheAideVueTailleVue();
		
		if ( empty($zoom) )
			$zoom = $options["vue_zoom_option"];
		
		vue_afficher_zoom_select($zoom, "zoom", "onChange='get_map();'");
		
		if ( empty($anim) ) 
			$anim = $options["vue_animations_option"];
		
		if ( empty($trolls_disparus) ) 
			$trolls_disparus = $options["vue_fantomes_option"];
		
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
?>
