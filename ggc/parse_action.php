<?php

require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
require_once("fonction_parse.php");
require_once("../top.php");

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();

//EST CE QUE LE TROLL A UN GROUPE DE CHASSE ?
$requete_groupe=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$groupe = mysql_result($requete_groupe,0,"id_groupe");
if($groupe==0){
	die("Il faut apartenir � un groupe !");
} else {
//IL A UN GROUPE, ALLONS CHERCHE LE NOM 
    $requete=mysql_db_query($bdd,"select * from ggc_groupe where id_groupe='$groupe'",$db_link) or die(mysql_error());
    $nom_groupe = mysql_result($requete,0,"nom_groupe");
}

function MenuPrincipal($new,$id){
if($new=="ok"){
	echo "<a href='rejoindre.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('rejoindre','','images/rejoindre_over.gif',1)\"><img src='images/rejoindre.gif' name='rejoindre' border='0'></a><br>";
	echo "<a href='creation.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('creation','','images/creer_over.gif',1)\"><img src='images/creer.gif' name='creation' border='0'></a><br>";
}else{
	echo "<a href='groupe.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('groupe','','images/voir_groupe_over.gif',1)\"><img src='images/voir_groupe.gif' name='groupe' border='0'></a><br>";
	echo "<a href='quitter.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('quitter','','images/quitter_over.gif',1)\"><img src='images/quitter.gif' name='quitter' border='0'></a><br>";
}
echo "<a href='index.php' onMouseOut='MM_swapImgRestore()' onMouseOver='MM_swapImage('deconnexion','','images/deconnexion_over.gif',1)'><img src='images/deconnexion.gif' name='deconnexion' border='0'></a><br>";
}

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Menu Principal","'file:images/rejoindre_over.gif','file:images/creer_over.gif','file:images/voir_groupe_over.gif','file:images/deconnexion_over.gif','file:images/quitter_over.gif'");


/*---------------------------------------------------------------*/
/*                      PAGE                                     */
/*---------------------------------------------------------------*/	

echo "<a name='haut'></a>";
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td colspan='3' align='center'>\n";

//Affichage du titre
AfficheTitre($nom_groupe);

echo "	  </td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='150' rowspan='4' align='center' valign='top'>\n";

//Affichage Menu
echo "		<table width='100%'>\n";
echo "		 <tr>\n";
echo "		  <td>\n";
echo "		   <table width='100%' class='mh_tdborder_trans'>\n";
echo "		    <tr>\n";
echo "			  <td align='center'>\n";
echo "			  <img src='images/titre_menu.gif' border='0'>\n";
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
echo "		   <table width='100%' class='mh_tdborder'>\n";
echo "		    <tr>\n";
echo "			  <td class='mh_tdpage' align='center'>\n";
MenuPrincipal($nouveau,$id);
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
echo "		  </tr>\n";
echo "		 </td>\n";
echo "		</table>\n";
echo "    </td>\n";
echo "    <td width='20' rowspan='4'>&nbsp;</td>\n";
echo "    <td rowspan='4' align='center' valign='top'>\n";
//Fin du menu

//Affichage Centre
echo "		<table width='100%'>\n";
echo "		 <tr>\n";
echo "		  <td>\n";
echo "         <table width='100%' class='mh_tdborder'>\n";
echo "           <tr>\n";
echo "            <td height='30' align='center'><img src='images/bienvenue.gif'></td>\n";
echo " 	         </tr>\n";
echo "           <tr>\n";
echo "            <td height='250' class='mh_tdpage'>";

if ( isset($_REQUEST["trapInfo"]) && isset($_REQUEST["idLanceur"]) ){
	
	if ( is_array($_REQUEST["trapInfo"]) ){
		$temp = "";
		foreach ( $_REQUEST["trapInfo"] as $data )
			$temp .= $data;
		$_REQUEST["trapInfo"] = $temp;
	}	
	
	removeTrap( $_REQUEST, $bdd, $db_link );
	
}
	
if ( isset($_REQUEST["copiercoller"]) && isset($_REQUEST["date"]) && isset($_REQUEST["type"]) && isset($_REQUEST["nom"]) && isset($_REQUEST["idCible"]) ){
	
	if ( $_REQUEST["idLanceur"] == 0 )
		$_REQUEST["idLanceur"] = $_SESSION["AuthTroll"];
	
	if ( is_array($_REQUEST["copiercoller"]) ){
		$temp = "";
		foreach ( $_REQUEST["copiercoller"] as $data )
			$temp .= $data;
		$_REQUEST["copiercoller"] = $temp;
	}

	$array = array ( "<|>" => "!|!", "<p>" => "!p!", "</p>" => "!/p!" );
	$_REQUEST["copiercoller"] = preg_replace( '#(<\|>){2,}#', '<|>', $_REQUEST["copiercoller"] );
	$_REQUEST["copiercoller"] = strtr( $_REQUEST["copiercoller"], $array );
	$_REQUEST["copiercoller"] = str_replace( '|>', '', $_REQUEST["copiercoller"] );
	$_REQUEST["copiercoller"] = strip_tags($_REQUEST["copiercoller"]);
	$_REQUEST["copiercoller"] = strtr( $_REQUEST["copiercoller"], array_flip($array) );		
	$_REQUEST["copiercoller"] = trim($_REQUEST["copiercoller"]);
	$_REQUEST["nom"] = trim($_REQUEST["nom"]);	
	
	if ( preg_match( "#.+é.+#", $_REQUEST["copiercoller"] ) ){
		$_REQUEST["copiercoller"] = utf8_decode($_REQUEST["copiercoller"]);
		$_REQUEST["copiercoller"] = str_replace( "C?ur", "Coeur", $_REQUEST["copiercoller"] );		
		$_REQUEST["copiercoller"] = str_replace( "?il", "Oeil", $_REQUEST["copiercoller"] );				
	}
	
	$_REQUEST["copiercoller"] = str_replace( '%2B', '+', $_REQUEST["copiercoller"] );
	$_REQUEST["copiercoller"] = preg_replace( '#n?bsp;#', '', $_REQUEST["copiercoller"] );	
	
	// Supression du texte concernant la r�ussite du sort/comp
	$_REQUEST["copiercoller"] = preg_replace ( "#Vous avez R�USSI � utiliser ce(tte)? (sortil�ge|comp�tence) de niveau \d \(\d+ sur \d+ %\).(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );
	$_REQUEST["copiercoller"] = preg_replace ( "#Votre Jet d'am�lioration est de \d+.(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );
	$_REQUEST["copiercoller"] = preg_replace ( "#Vous avez donc r�ussi � am�liorer ce(tte)? (sortil�ge|comp�tence) de \d %.(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );
	$_REQUEST["copiercoller"] = preg_replace ( "#Vous n'avez donc pas r�ussi � am�liorer ce(tte)? (sortil�ge|comp�tence).(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );	
	$_REQUEST["copiercoller"] = preg_replace ( "#Il ne vous est plus possible d'am�liorer ce(tte)? (sortil�ge|comp�tence).(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );
	$_REQUEST["copiercoller"] = preg_replace ( "#(\s|<\|>)?Cette action vous a cout� \d+ PA.(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );

	// Supression des PX gagn� sauf pour une mort
	if ( $_REQUEST["type"] != "MORT" ){
		$_REQUEST["copiercoller"] = preg_replace ( "#(\s|<\|>)*(<p>)?Vous avez �galement (<b>)?gagn� \d+ PX(</b>)? pour (cette superbe action|la r�ussite).(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );			
		$_REQUEST["copiercoller"] = preg_replace ( "#(\s|<\|>)*Pour cette action, vous avez gagn� un total de \d+ PX.(\s|<\|>)*#", "", $_REQUEST["copiercoller"] );
	}
	
	// Supression du saut de ligne avant le %
	if ( preg_match( "#AA|CdM#", $_REQUEST["nom"] ) ){
		$_REQUEST["copiercoller"] = preg_replace ( "#<\|>(\d+ %)#", "$1 %", $_REQUEST["copiercoller"] );		
	}
	
	$_REQUEST["nom"] = preg_replace ( "#Connaissance des Monstres \d#", "CdM", $_REQUEST["nom"] );
	$_REQUEST["nom"] = preg_replace ( "#Analyse Anatomique.+#", "AA", $_REQUEST["nom"] );

	if ( $_REQUEST["type"] == "POUVOIR" )
		echo parseCompGGC( $_REQUEST, $bdd, $db_link );
				
	if ( preg_match( "#.+Le tr�sor se trouve � vos pieds en.+#", $_REQUEST["copiercoller"] ) )	
		addTreasure( $_REQUEST["copiercoller"], $bdd, $db_link );
		
	if ( preg_match( "#.+Vous avez pos� un Pi�ge.+#", $_REQUEST["copiercoller"] ) )	
		addTrap( $_REQUEST, $bdd, $db_link );		

	switch ($_REQUEST["nom"]){
		
		case "AttaqueBot" :
			echo "<form action='parse_action.php' method='POST'>";
				echo "Type d'attaque : <select name='nom'><option value='Attaque Pr�cise'>Attaque Pr�cise</option><option value='BS'>BS</option><option value='Charger'>Charger</option><option value='Projo'>Projo</option><option value='CdB'>CdB</option><option value='Vampi'>Vampi</option><option value='Fr�n�sie'>Fr�n�sie</option><option value='GdS'>GdS</option></select>";
				echo "<input type='hidden' name='copiercoller' value=\"" .$_REQUEST["copiercoller"]. "\"/>";
				echo "<input type='hidden' name='date' value='" .$_REQUEST["date"]. "'/>";
				echo "<input type='hidden' name='idCible' value='" .$_REQUEST["idCible"]. "'/>";		
				echo "<input type='hidden' name='type' value='" .$_REQUEST["type"]. "'/>";						
				echo "<br/><br/><input type='submit' value='Enregistrer l'attaque' />";	
			echo "</form>";
			break;
		
		case "COMBAT" :
		case "MORT" :
		case "Accel" :
		case "Attaque Pr�cise" :
		case "Balayage" :
		case "Balluchonnage" :	
		case "Bidouille" :
		case "BS" :	
		case "Camouflage" :		
		case "Charger" :	
		case "CdM" :	
		case "Pi�ge" :
		case "Contre-Attaquer" :						
		case "CdB" :
		case "DE" :
		case "Dressage" :
		case "EM" :	
		case "Fr�n�sie" :
		case "Golemologie" :
		case "Grattage" :	
		case "Hurlement Effrayant" :	
		case "IdC" :
		case "Insulte" :
		case "Lancer de Potions" :
		case "Marquage" :
		case "M�lange Magique" :
		case "Miner" :
		case "N�cromancie" :																
		case "Parer" :	
		case "Pistage" :	
		case "Planter un Champignon" :	
		case "RA" :	
		case "R�paration" :	
		case "Retraite" :	
		case "RotoBaffe" :	
		case "Shamaner" :	
		case "Tailler" :																												
			echo parseCompGGC( $_REQUEST, $bdd, $db_link );
			break;
			
		case "AA" : 
		case "Armure Eth�r�e" :	
		case "AdA" :
		case "AdE" :
		case "AdD" :
		case "BAM" :
		case "BuM" :	
		case "Explo" :
		case "Faiblesse Passag�re" :
		case "FA" :
		case "Glue" :			
		case "GdS" :	
		case "Hypno" :	
		case "IdT" :
		case "Invi" :
		case "L�vitation" :
		case "Pr�cision Magique" :
		case "Projection" :
		case "Projo" :				
		case "Puissance Magique" :
		case "RP" :	
		case "Sacro" :
		case "Syphon" :	
		case "T�l�k" :
		case "TP" :
		case "VA" :
		case "Vampi" :
		case "VL" :
		case "VlC" :
		case "VT" :
			echo parseSortGGC( $_REQUEST, $bdd, $db_link );
			break;			
		
		default : 
			break;
		
	}

} else 
	echo "Rien � parser !";
echo "            </td>";
echo "	         </tr>\n";
echo "      	</table>\n";
echo "		   <br>\n";
echo "		  </tr>\n";
echo "		 </td>\n";
echo "		</table>\n";
//Fin d'affichage Centre

echo "    </td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td colspan='3' align='center'>\n";

//Affichage du pied
AffichePied(date("H:i:s \l\e j/m/Y"));
//Fin d'affichage du pied

echo "    <td colspan='3' align='center'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "</table>\n";

/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();
mysql_close($db_link);

?>