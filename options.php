<?

include_once ("inc_connect.php");
include_once ("functions_auth.php");

include_once ("options_functions_db.php");

include_once ("top.php");

if (!userIsGuilde() && !userIsGroupSpec())
  die("<h1><font color=black><b>Vous n'avez pas accès à cette page !</b></font></h1>");

init();

function init()
{
	affiche_titre_options();
	update_options($_REQUEST['upd']);
	affiche_liste_options();
}

function affiche_titre_options()
{
?>
	<table width='80%' cellspacing='0' class='mh_tdborder' align='center'>
		<tr class='mh_tdtitre' align="center">
			<td>
				<h2>Mes Options dans les outils <? echo RELAISMAGO ?></h2>
			</td>
		</tr>
	</table><br>

	<?
}

function affiche_liste_options()
{
	
	$options = new options($_SESSION[AuthTroll]);

	$display_mouches_option = $options->get_display_mouches_option();
	$display_noms_mouches_option = $options->get_display_noms_mouches_option();
	$refresh_dla_option = $options->get_refresh_dla_option();
	$vue_zoom_option = $options->get_vue_zoom_option();
	$vue_taille_option = $options->get_vue_taille_option();
	$vue_max_pa_option = $options->get_vue_max_pa_option();
	$vue_animations_option = $options->get_vue_animations_option();
	$vue_display_trollometer_option= $options->get_vue_display_trollometer_option();
	$vue_fantomes_option= $options->get_vue_fantomes_option();
	
	?>
	<form action='options.php' method='POST'>
		<input type='hidden' value='upd' name='upd'>
		<table width='80%' cellspacing='0' class='mh_tdborder' align='center'>
		<?
			affiche_option('display_mouches_option', $display_mouches_option, "Affichage des mouches dans ma fiche RG");
			affiche_option('display_noms_mouches_option', $display_noms_mouches_option, "Affichage du nom de mes mouches dans ma fiche RG","Il faut autoriser l'affichage des mouches pour activer cette option");

			affiche_option('refresh_dla_option', $refresh_dla_option, "Activer l'utilisation de scripts publics pour mettre à jour le ggc automatiquement.","Outils pas encore en service");

			?>
			<tr class='mh_tdpage' align="center">
				<td>Zoom dans la vue2d</td>
				<td><? vue_afficher_zoom_select($vue_zoom_option, "vue_zoom_option"); ?></td>
				<td></td>
			</tr>

			<tr class='mh_tdpage' align="center">
				<td>Taille dans la vue2d</td>
				<td><?   formulaire_listbox("vue_taille_option",0,LIMITE_MAX_VUE,1,$vue_taille_option,"moinsplus","",false,true,""); ?></td>
				<td></td>
			</tr>
			<?
			affiche_option('vue_animations_option', $vue_animations_option, "Activer les animations dans la vue 2d","Les animations ralentissent l'affichage des grandes vues");

			affiche_option('vue_display_trollometer_option', $vue_display_trollometer_option, "Afficher le trollometer en m&ecirc;me temps que la vue 2d","Si vous ne regardez pas tout le temps le trollometer, merci de mettre non ici :-)");
			
			affiche_option('vue_fantomes_option', $vue_fantomes_option, "Afficher les trolls disparus", "");
			?>
	
			<tr class='mh_tdpage' align="center">
				<td>Taille en PA du trollometer</td>
				<td><?  formulaire_listbox("vue_max_pa_option",0,LIMITE_MAX_TAILLE_PA,1,$vue_max_pa_option,"moinsplus","",false,true,"");	?></td>
				<td></td>
			</tr>
			<?

		?>
		<tr class='mh_tdtitre'>
			<td colspan='3' align='center'>
				<input type='submit' value='Modifier' class='mh_form_submit'>
			</tr>
		</tr>
		</table>
	</form>

	<?
}

function affiche_option($name, $value, $titre, $tips="")
{
	?>
	<tr class='mh_tdpage' align="center">
		<td><? echo $titre ?></td>
		<td>
			<select name='<? echo $name ?>'>
			<?  afficher_listbox_select('oui', $value,'oui'); ?>
			<?  afficher_listbox_select('non', $value,'non'); ?>
			</select>
		</td>
		<td><? echo $tips ?></td>
	</tr>
<?	
}

function update_options($upd)
{
	if ($upd != 'upd')
		return;
	
	$options = new options($_SESSION[AuthTroll]);
  $options->set_display_mouches_option($_REQUEST[display_mouches_option]);
  $options->set_display_noms_mouches_option($_REQUEST[display_noms_mouches_option]);
  $options->set_refresh_dla_option($_REQUEST[refresh_dla_option]);
  $options->set_vue_zoom_option($_REQUEST[vue_zoom_option]);
  $options->set_vue_taille_option($_REQUEST[vue_taille_option]);
  $options->set_vue_animations_option($_REQUEST[vue_animations_option]);
  $options->set_vue_max_pa_option($_REQUEST[vue_max_pa_option]);
  $options->set_vue_display_trollometer_option($_REQUEST[vue_display_trollometer_option]);
  $options->set_vue_fantomes_option($_REQUEST[vue_fantomes_option]);
	$message = $options->write_db();
/*  $id_troll_option = $_SESSION[AuthTroll];
  $display_mouches_option = $_REQUEST[display_mouches_option];
  $display_noms_mouches_option = $_REQUEST[display_noms_mouches_option];
  $refresh_dla_option = $_REQUEST[refresh_dla_option];
	$message .= editDbOptions($id_troll_option,$display_mouches_option,$display_noms_mouches_option,$refresh_dla_option);
*/	

	if ($message != "")
		$message = "Erreur : $message";
	else 
	 $message = "Modifications effectuées";

	?>
		<table class='mh_tdborder' align='center' width='80%'>
			<tr class='mh_tdtitre'>
				<td align='center'>
					<h2><i><? echo $message ?></i></h2>
				</td>
			</tr>
		</table><br>

	<?
}

?>
