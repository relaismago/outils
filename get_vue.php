<?php

session_start();

include_once("functions_auth.php");
include_once("functions_dev.php");

if ( is_array($_REQUEST["datas"]) || isset($_REQUEST["datas"]) )
	formulaire_to_file();
else {
	include_once('top.php');
	affiche_formulaire();
}
	
#############################
# Affichage du formulaire pour copier / coller la vue
#############################
function affiche_formulaire()
{
?>
  <table class='mh_tdborder' width='60%' align="center">
   <tr><td>
     <table width='100%' cellspacing='0'>
       <tr class='mh_tdtitre' align="center">
         <td>
						<img src='/images/titre-vue.gif'>
	         </td>
       </tr>
     </table>
		</td></tr>
	</table><br>
	<form name="select_troll" action="get_vue.php" method="POST">

  <table class='mh_tdborder' width='70%' align="center">
   <tr class='mh_tdtitre' >
	 		<td align='center'>
					Cliquez sur la fenêtre de vue, de MH, pressez CTRL + A, pour tout selectionner,<br>
					Pressez CTRL + C pour tout copier,<br>
					cliquez dans la petite zone de texte (ci dessous), et pressez sur CTRL + V pour tout coller.<br>
         </td>
   </tr>
   <tr class='mh_tdpage'>
	 	<td width='100%' align="center">

	<?php
		// Un RM peut choisir de mettre à jour la vue de quelqu'un d'autre en cas de TS
		if ( userIsGuilde() ) {
			echo "<p><b>Selectionnez-bien votre numéro de TROLL !</b><br>";
			echo "Numéro du troll : <input type=text name='id_troll' size=6 value='" .$_SESSION["AuthTroll"]. "'>";
			echo "<br>La base de données des Relais&Mago va être mise à jour avec la vue.";
		} else {
			echo "<p><b>Si vous avez une vue importante, vous pouvez la limiter en renseignant la taille.</b><br> <br>";
			echo "Taille de la vue : <input type='textbox' name='taille_vue_publique' size='3' maxlength='3'> cavernes.<br><br>";
	
			echo "<p><b>Également, si votre vue est importante, vous pouvez limiter la taille en PA du trollometer.<br>";
			echo " Le Trollometer résume les éléments vus sur la vue2d en dessous de celle-ci.</b><br> <br>";
			echo "Taille du Trollometer : <input type='textbox' name='max_pa_publique' size='3' maxlength='3'> Pa";
			echo "<input type='hidden' name='TROLL' value='" .session_id(). "'>";
		}
	?>
	<br><br>
	<input type=submit name="Submit" value="[Uploader] - la vue du troll" class='mh_form_submit' ><br><br>
	<textarea name="datas" rows=10 cols=80></textarea>
	<br>
	</td></tr>
	</table>
	</form>

	<?php
include('foot.php');
}

################################
# Ecriture dans un fichier temporaire de la vue reçue
################################
function formulaire_to_file()
{
	# On envoie le texte dans le cache, et on le parse	
	$id_troll = ( empty($_REQUEST["id_troll"]) ) ? session_id() : $_REQUEST["id_troll"];
		
	$tmpfile = fopen ("vues/vue_tmp.$id_troll.txt","w");

	$datas = ( is_array($_REQUEST["datas"]) ) ? implode("",$_REQUEST["datas"]) : $_REQUEST["datas"];

	fwrite($tmpfile,$datas);
	fwrite($tmpfile,"\n\n");
	fwrite($tmpfile,getenv(REMOTE_ADDR));
	fclose($tmpfile);
	
	$date=date("Y-m-d H-i-s");
	$tmpfile=fopen ("vues/list.txt","a");
	fwrite($tmpfile,$date);
	fwrite($tmpfile,":");
	fwrite($tmpfile,getenv(REMOTE_ADDR));
	fwrite($tmpfile,"\n");
	fclose($tmpfile);

	header("Location: parse_vue.php?id_troll=$id_troll&taille_vue_publique=$_REQUEST[taille_vue_publique]&max_pa_publique=$_REQUEST[max_pa_publique]");
}
?>
