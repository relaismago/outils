<?php
/****************************************************************************************************
*	Cette page est celle d'affichage du contenu d'une tani�re particuli�re, � l'attention d'un      *
* administrateur.																					*
*****************************************************************************************************/

/****************************************************************************************************
*	PARAMETRES																						*
*****************************************************************************************************/

global $HTTP_GET_VARS;

if (isset($HTTP_GET_VARS['taniere']) && $HTTP_GET_VARS['taniere']!='' && is_numeric($HTTP_GET_VARS['taniere'])) $taniere = $HTTP_GET_VARS['taniere'];
else header("Location: ./index.php");
//taniere concern�e

if (isset($HTTP_GET_VARS['compos']) && $HTTP_GET_VARS['compos']=='1' ) $compos = true;
else $compos = false;

/****************************************************************************************************
*	INCLUSION																						*
*****************************************************************************************************/
include('../top.php');
include_once('../secure.php');
include_once('../functions.php3');
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");

/****************************************************************************************************
*	SESSION																							*
*****************************************************************************************************/

$no_troll=$_SESSION['AuthTroll']; // Id du troll connect�
if (!isDbAdministration() && !isGGT() ) die("<h1><font color=black><b>Vous n'avez pas acc�s � cette page</b></font></h1");

if ($compos) $tresors = getAllCompos($taniere);
else $tresors = getAllEquipement($taniere);

/****************************************************************************************************
*	SCRIPTS																							*
*****************************************************************************************************/
?>

<script language="javascript">
function valider() {
	var i=0;
<?php

if (count($tresors)>0) foreach($tresors as $tresor) {
	echo('if (document.forms["trtDemande"].elements["suppr_'.$tresor->id.'"].checked) i++;'."\n");
}
?>
	if (i>0 && !confirm("Vous �tes sur le point de supprimer "+i+" tr�sor(s). Etes-vous s�r ? Je veux dire vraiment s�r ? C'est vrai quoi, il s'agirait pas de faire une boulette.")) {return;}

	document.forms["trtDemande"].submit();
}

function nettoyer() {
	if (!confirm("Vous �tes sur le point de supprimer d�finitivement de la base les tr�sors marqu�s comme absent. Pas de regrets, vous voulez continuer ?")) {return;}

	window.location="./faireMenage.php?taniere=<?=$taniere?>";
}
</script>

<?
/****************************************************************************************************
*	T�TE DE LA PAGE																					*
*****************************************************************************************************/

	$button = "<a href='./index.php'>[ Retour � l'index ] </a>";

	if ($compos) $button .= " - <a href='./affichageAdmin.php?taniere=".$taniere."'>[ Equipement ]</a>";
	else $button .= " - <a href='./affichageAdmin.php?taniere=".$taniere."&compos=1'>[ Compos/Champis ]</a>";

	$button .= " - <a href='./rechercheAdmin.php?taniere=$taniere'>[ Recherche ]</a>";

	if ( defined('GT_'.$taniere) ) $gt=constant('GT_'.$taniere).' ('.constant('GT_POS_'.$taniere).')';
	else $gt='Grande Tani�re n�'.$taniere;

	afficher_titre_tableau("Administration des Magasins ".NOM_GUILDE."<br/>\n".$gt,$button);
?>
<center><input type="button" value="Nettoyer le contenu" class="mh_form_submit" onClick="nettoyer()" /></center>

<table align="center">
<tr><td>
<?
if (!$compos) {
?>
[ <a href="#Arme (1 main)">Armes (1 main)</a> ]
[ <a href="#Arme (2 mains)">Armes (2 mains)</a> ]
[ <a href="#Armure">Armures</a> ]
[ <a href="#Bidouille">Bidouilles</a> ]
[ <a href="#Bottes">Bottes</a> ]
[ <a href="#Bouclier">Boucliers</a> ]
[ <a href="#Casque">Casques</a> ]
[ <a href="#Parchemin">Parchemins</a> ]
[ <a href="#Sp�cial">Sp�cial</a> ]
[ <a href="#Talisman">Talismans</a> ]
<?
} else {
?>
[ <a href="#Champignon">Champignons</a> ]
[ <a href="#Composant">Composants</a> ]
<?
}
?>
</td></tr>
</table>

<form action="./faireAdmin.php?taniere=<?=$taniere?>" method="POST" name="trtDemande" style="text-align:center">
<table  align="center" class='mh_tdborder' width="90%">

<?php
$typePrec = "";

foreach($tresors as $tresor) {
	if ($tresor->type!=$typePrec) {
?>
	<tr class='mh_tdtitre'>
		<td align="center"><a name="<?=$tresor->type?>" />Id</td>
		<td>Description</td>
		<td align="center" style="width:80px;">Type</td>
		<td align="center">R�serv�</td>
		<td align="center">Confirmer</td>
		<td align="center">En vente</td>
		<td align="center">Bloquer</td>
		<td align="center">Cacher</td>
		<td></td>
		<td align="center">Supprimer</td>
	</tr>
<?
		$typePrec=$tresor->type;
	}
?>
	<tr <?php if($tresor->absent==1) echo('style="font-style:italic; text-decoration:line-through; color:#BBBBBB"')?>  class='mh_tdpage'>

		<?php
			$tresor->toStringAdmin();
		?>

	</tr>

<?php
}

?>

</table>
<br/>
<input type="hidden" name="no_troll" value="<?=$no_troll?>" />
<input type="button" value="Valider" onClick="valider();" class='mh_form_submit'/>
</form>


<?php
include('../foot.php');
?>
