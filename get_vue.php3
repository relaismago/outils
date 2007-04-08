<?

session_start();

include_once("functions_auth.php");
include_once("functions_dev.php3");

if ( userIsGuilde()  ) {
	include_once ("inc_connect.php3");
	include_once ("admin_functions.php3");
	include_once ("admin_functions_db.php3");
}

if ( ($_REQUEST[datas]!="") ) {
	formulaire_to_file();
} else {
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
	<form name="select_troll" action="get_vue.php3" method="POST">

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

	<? 
	$id_troll=$_SESSION[AuthTroll];
	// Un RM peut choisir de mettre à jour la vue de quelqu'un d'autre en cas de TS
	if ( userIsGuilde() ) {
		echo "<p><b>Selectionnez-bien votre numéro de TROLL !</b><br>";
		echo "Numéro du troll : <input type=text name='id_troll' size=6 value='$id_troll'>";
		echo "<br>La base de données des Relais&Mago va être mise à jour avec la vue.";
	} else {
		echo "<p><b>Si vous avez une vue importante, vous pouvez la limiter en renseignant la taille.</b><br> <br>";
		echo "Taille de la vue : <input type='textbox' name='taille_vue_publique' size='3' maxlength='3'> cavernes.<br><br>";

		echo "<p><b>Également, si votre vue est importante, vous pouvez limiter la taille en PA du trollometer.<br>";
		echo " Le Trollometer résume les éléments vus sur la vue2d en dessous de celle-ci.</b><br> <br>";
		echo "Taille du Trollometer : <input type='textbox' name='max_pa_publique' size='3' maxlength='3'> Pa";
		$id_session = session_id();
		echo "<input type='hidden' name='TROLL' value='$id_session'>";
	}
	?>
	<br><br>
	<input type=submit name="Submit" value="[Uploader] - la vue du troll" class='mh_form_submit' ><br><br>
	<textarea name="datas" rows=10 cols=80></textarea>
	<br>
	</td></tr>
	</table>
	</form>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1451857-2";
urchinTracker();
</script>

	<?
}

################################
# Ecriture dans un fichier temporaire de la vue reçue
################################
function formulaire_to_file()
{
	# On envoie le texte dans le cache, et on le parse
	$datas2=preg_replace("//","\n",$_REQUEST[datas]); 
	if ($_REQUEST[id_troll]=="")
		$id_troll = session_id();
	else
		$id_troll = $_REQUEST[id_troll];
		
	$tmpfile = fopen ("vues/vue_tmp.$id_troll.txt","w");

	fwrite($tmpfile,$datas2);
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

	header("Location: parse_vue.php3?id_troll=$id_troll&taille_vue_publique=$_REQUEST[taille_vue_publique]&max_pa_publique=$_REQUEST[max_pa_publique]");
}
?>
