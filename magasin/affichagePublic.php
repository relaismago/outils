<?php
/****************************************************************************************************
*	Cette page est celle d'affichage du contenu d'une tani�re particuli�re, � l'attention d'un      *
* utilisateur hors de la guilde.																	*
*****************************************************************************************************/

/****************************************************************************************************
*	PARAMETRES																						*
*****************************************************************************************************/

global $HTTP_GET_VARS;

//taniere concern�e
if (isset($HTTP_GET_VARS['taniere']) && $HTTP_GET_VARS['taniere']!='' && is_numeric($HTTP_GET_VARS['taniere'])) $taniere = $HTTP_GET_VARS['taniere'];
else header("Location: ./indexPublic.php");

/****************************************************************************************************
*	INCLUSION																						*
*****************************************************************************************************/
//incusions g�n�riques
include('../top.php');
include_once('../secure.php');
include_once('../functions.php3');

//inclusions des magasins
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");


/****************************************************************************************************
*	T�TE DE LA PAGE																					*
*****************************************************************************************************/
$button = "<a href='./indexPublic.php'>[ Retour � l'index ]</a>";

if ( defined('GT_'.$taniere) ) $gt=constant('GT_'.$taniere).' ('.constant('GT_POS_'.$taniere).')';
else $gt='Grande Tani�re n�'.$taniere;

afficher_titre_tableau('Magasins '.NOM_GUILDE.'<br/>'."\n".$gt, $button);
?>


<?
/****************************************************************************************************
*	CORPS DE LA PAGE																				*
*****************************************************************************************************/
?>

<!-- ************************************************************************************************
* Liens en t�te de page																				*
***************************************************************************************************** -->
<table align="center">
<tr><td>
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
</td></tr>
</table>

<form style="text-align:center">
<table align="center" class='mh_tdborder' width="90%">

<!-- ************************************************************************************************
* Contenu du tableau																				*
***************************************************************************************************** -->

<?php
//on r�cup�re les �l�ments � afficher
$tresors = getEquipementPublic($taniere);
$typePrec = "";

foreach($tresors as $tresor) {
	if ($tresor->type!=$typePrec) {
?>
	<tr class='mh_tdtitre'>
		<td align="center"><a name="<?=$tresor->type?>" />Id</td>
		<td align="center">Description</td>
		<td align="center" style="width:80px;">Type</td>
		<td align="center">En vente</td>
	</tr>
<?
		$typePrec=$tresor->type;
	}
?>
	<tr class='mh_tdpage'>
		<?php
			$tresor->toStringPublic();
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
?>
<br/>
</form>

<?php
include('../foot.php');
?>
