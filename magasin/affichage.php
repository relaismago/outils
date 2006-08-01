<?php
/****************************************************************************************************
*	Cette page est celle d'affichage du contenu d'une tanière particulière, à l'attention d'un      *
* utilisateur standard.																				*
*****************************************************************************************************/

/****************************************************************************************************
*	PARAMETRES																						*
*****************************************************************************************************/

global $HTTP_GET_VARS;

//taniere concernée
if (isset($HTTP_GET_VARS['taniere']) && $HTTP_GET_VARS['taniere']!='' && is_numeric($HTTP_GET_VARS['taniere'])) $taniere = $HTTP_GET_VARS['taniere'];
else header("Location: ./index.php");

//affichage des compos oui/non
if (isset($HTTP_GET_VARS['compos']) && $HTTP_GET_VARS['compos']=='1' ) $compos = true;
else $compos = false;

/****************************************************************************************************
*	INCLUSION																						*
*****************************************************************************************************/
//incusions génériques
include('../top.php');
include_once('../secure.php');
include_once('../functions.php3');

//inclusions des magasins
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");


/****************************************************************************************************
*	TÊTE DE LA PAGE																					*
*****************************************************************************************************/
$button = "<a href='./index.php'>[ Retour à l'index ]</a>";
if ($compos) $button .= " - <a href='./affichage.php?taniere=".$taniere."'>[ Equipement ]</a>";
else $button .= " - <a href='./affichage.php?taniere=".$taniere."&compos=1'>[ Compos/Champis ]</a>";
	$button .= " - <a href='./recherche.php?taniere=$taniere'>[ Recherche ]</a>";

if ( defined('GT_'.$taniere) ) $gt=constant('GT_'.$taniere).' ('.constant('GT_POS_'.$taniere).')';
else $gt='Grande Tanière n°'.$taniere;

afficher_titre_tableau('Magasins '.NOM_GUILDE.'<br/>'."\n".$gt, $button);
?>


<?
/****************************************************************************************************
*	CORPS DE LA PAGE																				*
*****************************************************************************************************/
?>

<!-- ************************************************************************************************
* Liens en tête de page																				*
***************************************************************************************************** -->
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
[ <a href="#Spécial">Spécial</a> ]
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
<form action="./faireDemande.php?taniere=<?=$taniere?>" method="POST" name="trtDemande" style="text-align:center">
<table align="center" class='mh_tdborder' width="90%">

<!-- ************************************************************************************************
* Contenu du tableau																				*
***************************************************************************************************** -->

<?php
//on récupère les éléments à afficher
if ($compos) $tresors = getCompos($taniere);
else $tresors = getEquipement($taniere);

$typePrec = "";

foreach($tresors as $tresor) {
	if ($tresor->type!=$typePrec) {
?>
	<tr class='mh_tdtitre'>
		<td align="center"><a name="<?=$tresor->type?>" />Id</td>
		<td align="center">Description</td>
		<td align="center" style="width:80px;">Type</td>
		<td align="center">Réserver</td>
		<td align="center">Confirmé</td>
		<td align="center">En vente</td>
	</tr>
<?
		$typePrec=$tresor->type;
	}
?>
	<tr class='mh_tdpage'>
		<?php
			$tresor->toString();
		?>
	</tr>
<?php
}

?>

</table>

<?
/****************************************************************************************************
*	PIED DE LA PAGE																					*
*****************************************************************************************************/
$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté
?>

<br/>
<input type="hidden" name="no_troll" value="<?=$no_troll?>" />
<input type="submit" value="Valider" class='mh_form_submit'/>
</form>

<?php
include('../foot.php');
?>
