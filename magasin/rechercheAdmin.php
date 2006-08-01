<?php
/****************************************************************************************************
*	Cette page est celle de recherche dans les tanières. Elle gère à la fois l'affichage du			*
* formulaire de recherche et le traitement des résultats renvoyés.									*
*****************************************************************************************************/

global $HTTP_POST_VARS;
//critères de recherche

include('../top.php');
include_once('../secure.php');
include_once('../functions.php3');
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");

$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté
if (!isDbAdministration() && !isGGT() ) die("<h1><font color=black><b>Vous n'avez pas accès à cette page</b></font></h1");

//==================CREATION DU MODELE A PARTIR DES DONNEES POST==================
$modele = new Tresor();
if (isset($HTTP_POST_VARS['criteres'])) {

	if (isset($HTTP_POST_VARS['compo']) && $HTTP_POST_VARS['compo']=="1")
		$modele->isCompo = 1;
	else
		$modele->isCompo = 0;

	if (isset($HTTP_POST_VARS['potion']) && $HTTP_POST_VARS['potion']=="1")
		$modele->reserveTrollNom = 1;//nulle part ailleurs pour stocker ça...
	else
		$modele->reserveTrollNom = 0;

	if (isset($HTTP_POST_VARS['id']) && trim($HTTP_POST_VARS['id'])!="")
		$modele->id = $HTTP_POST_VARS['id'];
	if (isset($HTTP_POST_VARS['type']) && $HTTP_POST_VARS['type']!="")
		$modele->type = $HTTP_POST_VARS['type'];
	if (isset($HTTP_POST_VARS['taniere']) && $HTTP_POST_VARS['taniere']!="")
		$modele->taniere = $HTTP_POST_VARS['taniere'];

	if (isset($HTTP_POST_VARS['bloque']) && $HTTP_POST_VARS['bloque']!="2")
		$modele->bloque = $HTTP_POST_VARS['bloque'];
	if (isset($HTTP_POST_VARS['invisible']) && $HTTP_POST_VARS['invisible']!="2")
		$modele->invisible = $HTTP_POST_VARS['invisible'];
	if (isset($HTTP_POST_VARS['absent']) && $HTTP_POST_VARS['absent']!="2")
		$modele->absent = $HTTP_POST_VARS['absent'];
	if (isset($HTTP_POST_VARS['reserve']) && $HTTP_POST_VARS['reserve']!="2")
		$modele->reserve = $HTTP_POST_VARS['reserve'];
	if (isset($HTTP_POST_VARS['confirme']) && $HTTP_POST_VARS['confirme']!="2")
		$modele->confirme = $HTTP_POST_VARS['confirme'];
	if (isset($HTTP_POST_VARS['enVente']) && $HTTP_POST_VARS['enVente']!="2")
		$modele->enVente = $HTTP_POST_VARS['enVente'];

	$modele->description="";
	if (isset($HTTP_POST_VARS['attaque']) && $HTTP_POST_VARS['attaque']=="1") {
		$modele->description .= ';ATT : +';
	}
	if (isset($HTTP_POST_VARS['degats']) && $HTTP_POST_VARS['degats']=="1") {
		$modele->description .= ';DEG : +';
	}
	if (isset($HTTP_POST_VARS['esquive']) && $HTTP_POST_VARS['esquive']=="1") {
		$modele->description .= ';ESQ : +';
	}
	if (isset($HTTP_POST_VARS['regen']) && $HTTP_POST_VARS['regen']=="1") {
		$modele->description .= ';REG : +';
	}
	if (isset($HTTP_POST_VARS['armure']) && $HTTP_POST_VARS['armure']=="1") {
		$modele->description .= ';Armure : +';
	}
	if (isset($HTTP_POST_VARS['pv']) && $HTTP_POST_VARS['pv']=="1") {
		$modele->description .= ';PV : +';
	}
	if (isset($HTTP_POST_VARS['mm']) && $HTTP_POST_VARS['mm']=="1") {
		$modele->description .= ';MM : +';
	}
	if (isset($HTTP_POST_VARS['rm']) && $HTTP_POST_VARS['rm']=="1") {
		$modele->description .= ';RM : +';
	}

	//champ description lui-même
	if (isset($HTTP_POST_VARS['description']) && $HTTP_POST_VARS['description']!="") {
		$modele->description .= ';'.$HTTP_POST_VARS['description'];
	}

} else {

	$modele->id="0";

}

$tresors = rechercheAdmin($modele);

//==================FIN CREATION DU MODELE A PARTIR DES DONNEES POST==================
?>

<script language="javascript">
function valider() {
	var i=0;
<?php

if (count($tresors)>0) foreach($tresors as $tresor) {
	echo('if (document.forms["trtDemande"].elements["suppr_'.$tresor->id.'"].checked) i++;'."\n");
}
?>
	if (i>0 && !confirm("Vous êtes sur le point de supprimer "+i+" trésor(s). Etes-vous sûr ? Je veux dire vraiment sûr ? C'est vrai quoi, il s'agirait pas de faire une boulette.")) {return;}

	document.forms["trtDemande"].submit();
}

</script>

<?php
	$button = "<a href='./index.php'>[ Retour à l'index ] </a>";

	afficher_titre_tableau("Administration des Magasins ".NOM_GUILDE."<br/>\nRecherche dans les tanières",$button);
?>


<?php
//==================DEBUT FORMULAIRE DE RECHERCHE==================
?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST" name="trtRecherche" style="text-align:center; margin-bottom:40px;">
<table class='mh_tdborder' cellspacing="0" width="90%" align="center">
	<tr class='mh_tdpage'>
		<td width="33%">
			<table align="center">
				<tr><td>Id :</td><td><input type="text" name="id" style="width:100px" /></td></tr>
				<tr><td>Description :</td><td><input type="text" name="description" style="width:100px" /></td></tr>
				<tr>
					<td>Type :</td>
					<td><select name="type" style="width:100px">
							<option value="">Tous</option>
							<?php
								$types = getTypes();
								foreach($types as $option)
									echo('<option value="'.$option.'">'.$option.'</option>');
							?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Grande tanière :</td>
					<td>
						<select name="taniere" style="width:100px">
							<option value="">Toutes</option>
							<?php
								$tanieres = getTanieres();
								foreach($tanieres as $id) {
									if ( defined('GT_'.$id) ) $gt=constant('GT_'.$id);
									else $gt='Grande Tanière n°'.$id;
									echo('<option value="'.$id.'">'.$gt.'</option>');
								}
							?>
						</select>
					</td>
				</tr>

				<tr><td></td></tr>

				<tr>
					<td>Afficher les compos/champis :</td><td><input type="checkbox" name="compo" value="1" /></td>
				</tr>

				<tr>
					<td>Afficher les potions/parchemins :</td><td><input type="checkbox" name="potion" value="1" /></td>
				</tr>
					
			</table>

		</td><td width="33%">

			<table align="center">
				<tr>
					<td>Bloqué</td><td><input type="radio" name="bloque" value="1" /> </td>
					<td style="padding-left:15px;">Non bloqué</td><td><input type="radio" name="bloque" value="0" /> </td>
					<td style="padding-left:15px;">Indifférent</td><td><input type="radio" name="bloque" value="2" checked="checked" /> </td>
				</tr>
				<tr>
					<td>Invisible</td><td><input type="radio" name="invisible" value="1" /> </td>
					<td style="padding-left:15px;">Non invisible</td><td><input type="radio" name="invisible" value="0" /> </td>
					<td style="padding-left:15px;">Indifférent</td><td><input type="radio" name="invisible" value="2" checked="checked" /> </td>
				</tr>
				<tr>
					<td>Absent</td><td><input type="radio" name="absent" value="1" /> </td>
					<td style="padding-left:15px;">Non absent</td><td><input type="radio" name="absent" value="0" /> </td>
					<td style="padding-left:15px;">Indifférent</td><td><input type="radio" name="absent" value="2" checked="checked" /> </td>
				</tr>
				<tr>
					<td>Réservé</td><td><input type="radio" name="reserve" value="1" /> </td>
					<td style="padding-left:15px;">Non réservé</td><td><input type="radio" name="reserve" value="0" /> </td>
					<td style="padding-left:15px;">Indifférent</td><td><input type="radio" name="reserve" value="2" checked="checked" /> </td>
				</tr>
				<tr>
					<td>Confirmé</td><td><input type="radio" name="confirme" value="1" /> </td>
					<td style="padding-left:15px;">Non confirmé</td><td><input type="radio" name="confirme" value="0" /> </td>
					<td style="padding-left:15px;">Indifférent</td><td><input type="radio" name="confirme" value="2" checked="checked" /> </td>
				</tr>
				<tr>
					<td>En vente</td><td><input type="radio" name="enVente" value="1" /> </td>
					<td style="padding-left:15px;">Non en vente</td><td><input type="radio" name="enVente" value="0" /> </td>
					<td style="padding-left:15px;">Indifférent</td><td><input type="radio" name="enVente" value="2" checked="checked" /> </td>
				</tr>
			</table>

		</td><td width="33%">

			<table align="center">
				<tr>
					<td>Bonus d'attaque : </td><td><input type="checkbox" name="attaque" value="1" /></td>
				</tr>
				<tr>
					<td>Bonus de dégats : </td><td><input type="checkbox" name="degats" value="1" /></td>
				</tr>
				<tr>
					<td>Bonus d'esquive : </td><td><input type="checkbox" name="esquive" value="1" /></td>
				</tr>
				<tr>
					<td>Bonus de régénération : </td><td><input type="checkbox" name="regen" value="1" /></td>
				</tr>
				<tr>
					<td>Bonus d'armure : </td><td><input type="checkbox" name="armure" value="1" /></td>
				</tr>
				<tr>
					<td>Bonus de PV : </td><td><input type="checkbox" name="pv" value="1" /></td>
				</tr>
				<tr>
					<td>Bonus de MM : </td><td><input type="checkbox" name="mm" value="1" /></td>
				</tr>
				<tr>
					<td>Bonus de RM : </td><td><input type="checkbox" name="rm" value="1" /></td>
				</tr>

			</table>

		</td>
	</tr>
	<tr class='mh_tdpage'>
		<td colspan="3" align="center" style="padding-top:20px; padding-bottom:10px;">
			<input type="hidden" name="criteres" value="1" />
			<input type="submit" value="Rechercher" class='mh_form_submit' />
		</td>
	</tr>
</table>
</form>
<?php
//==================FIN FORMULAIRE DE RECHERCHE==================
?>

<?php
if (count($tresors)>0) {
?>
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
	[ <a href="#Spécial">Spécial</a> ]
	[ <a href="#Talisman">Talismans</a> ]
	[ <a href="#Champignon">Champignons</a> ]
	[ <a href="#Composant">Composants</a> ]
</td></tr>
</table>
<?php
}
?>

<form action="./faireAdmin.php?taniere=<?=$taniere?>" method="POST" name="trtDemande" style="text-align:center">
<table align="center" class='mh_tdborder' width="90%">

<?php
$typePrec = "";

foreach($tresors as $tresor) {
	if ($tresor->type!=$typePrec) {
?>
	<tr class='mh_tdtitre'>
		<td align="center">GT</td>
		<td align="center"><a name="<?=$tresor->type?>" />Id</td>
		<td>Description</td>
		<td align="center" style="width:80px;">Type</td>
		<td align="center">Réservé</td>
		<td align="center">Confirmer</td>
		<td align="center">En vente</td>
		<td align="center">Bloquer</td>
		<td align="center">Cacher</td>
		<td></td>
		<td align="center">Supprimer</td>
	</tr>
<?php
		$typePrec=$tresor->type;
	}
?>
	<tr <?php if($tresor->absent==1) echo('style="font-style:italic; text-decoration:line-through; color:#BBBBBB"')?>  class='mh_tdpage'>

		<td align="center">
			<?php
				if ( defined('GT_IMG_'.$tresor->taniere) ) $gt=constant('GT_IMG_'.$tresor->taniere);
				else $gt='riendutout';
				echo('<img src="./img/'.$gt.'" alt="'.$tresor->taniere.'" width="12" height="15" />');
			?>
		</td>
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

<?php
if (count($tresors)>0) {
?>
<input type="button" value="Valider" onClick="valider();" class='mh_form_submit'/>
<?php
}
?>

</form>


<?php
include('../foot.php');
?>
