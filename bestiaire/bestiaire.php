<?
/******************************************************************************
*                                                                             *
* Bestiaire - fichier principal pour l'affichage du bestiaire                 *
* Copyright (C) 2004  Cormyr (cormyr@cat-the-psion.net)                       *
*                                                                             *
* This program is free software; you can redistribute it and/or               *
* modify it under the terms of the GNU General Public License                 *
* as published by the Free Software Foundation; either version 2              *
* of the License, or (at your option) any later version.                      *
*                                                                             *
* This program is distributed in the hope that it will be useful,             *
* but WITHOUT ANY WARRANTY; without even the implied warranty of              *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               *
* GNU General Public License for more details.                                *
*                                                                             *
* You should have received a copy of the GNU General Public License           *
* along with this program; if not, write to the Free Software                 *
* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. *
*                                                                             *
*******************************************************************************/
include_once('../inc_connect.php3');
include_once('../inc_authent.php3');

include_once("Libs/functions.php");
include_once("Libs/init_functions.php");

include_once('../top.php');
include_once('b_functions.php');

initAfficheMonstre();

function initAfficheMonstre()
{

	global $db_bestiaire;

	/* Libs/init_racemonstre.php */
	$tab = getInfoMonstre();
	$Monstre = $tab[0];
	$Race = $tab[1];
	$races = $tab[2];
	$Age = $tab[3];
	$agebasic = $tab[4];
	$Famille = $tab[5];
	$image = $tab[6];
	
	$MonstreAge=makeMonsterName($Monstre,$Age);
	
	/*init_tabcdm.php*/
	$tab = getCdm($MonstreAge,$Monstre,$Age,$agebasic);
	$cdm = $tab[0];
  $cdmtemplate = $tab[1];
	
	/*Libs/init_capspe.php*/
	$tab = getCapaciteSpeciales($MonstreAge,$Monstre,$Race, $agebasic);
	$pouvoirs = $tab[0];
	$pouvoirstemplate = $tab[1];
	
	
	/*Libs/init_caracs.php*/
	$tab = getCaracteristiques($MonstreAge,$Famille);
	$mlevel = $tab[0];
	$AttDLA = $tab[1];
	$DurDLA = $tab[2];
	$RM     = $tab[3];
	
	/*Libs/init_deathpower.php*/
	$tab = getDeathPower($MonstreAge,$Monstre,$agebasic);
	$deaths = $tab[0];
	$deathstemplate = $tab[1];
	
	// on compte le nombre de races, monstres, cdm, etc... pour afficher les stats
	// en bas de page
	
	/* nombre de cdms */
	$sql="SELECT COUNT(*) FROM `cdms`;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requête :<br>$sql<br>");
	$ret=mysql_fetch_array($query);
	$ncdm=$ret[0];

	/* nombre de monstres */
	$sql="SELECT COUNT(*) FROM `monstres`;";
	$query=mysql_query($sql,$db_bestiaire);
	$ret=mysql_fetch_array($query);
	$nmonstres=$ret[0];

	/* nombre de races */
	$sql="SELECT COUNT(*) FROM `races`;";
	$query=mysql_query($sql,$db_bestiaire);
	$ret=mysql_fetch_array($query);
	$nraces=$ret[0];

	/* nombre de monstres avec une capacité spéciale renseignée */
	$sql="SELECT COUNT(*) FROM `pouvoirs`;";
	$query=mysql_query($sql,$db_bestiaire);
	$ret=mysql_fetch_array($query);
	$npouvoirs=$ret[0];

	/* nombre de monstres possédant un pouvoir se déclenchant à sa mort */
	$sql="SELECT COUNT(*) FROM `derniersouffle`;";
	$query=mysql_query($sql,$db_bestiaire);
	$ret=mysql_fetch_array($query);
	$ndeath=$ret[0];
	
	echo "<script language='JavaScript' src='Libs/pxotron.js'></script>";
	echo "<script language='JavaScript' src='Libs/functions.js'></script>";
	echo "<script language='JavaScript' src='bestiaire.js'></script>";
	
	echo "<div align='center'>";
	
	afficheMenuBestiaire();
	echo "<br><br>";

	afficheChoixMonstre($Race,$Monstre,$Age,$MonstreAge,$Famille,$mlevel,$races);
	afficherCaracteristiquePrincipales($image,$mlevel,$AttDLA,$DurDLA,$RM,
																		$Race,$Monstre,$Age,$MonstreAge,$Famille,$mlevel,$races);
	afficherCdm($cdm,$cdmtemplate);
	afficherPouvoirs($pouvoirs,$pouvoirstemplate,$deaths,$deathstemplate,$cdm,$caracs,
									$Race,$Monstre,$Age,$MonstreAge,$Famille,$mlevel,$races);

	afficheAutresConnaissances($cdm,$caracs,$pouvoirs,$pouvoirstemplate,$deaths,$deathstemplate);
	
	afficheStatGlobales($nmonstres,$ncdm,$nraces,$npouvoirs,$ndeath);
	echo "</body>";
	echo "</html>";
}

function afficheChoixMonstre($Race,$Monstre,$Age,$MonstreAge,$Famille,$mlevel,$races)
{
?>
  <form name="select_cdm" method="GET" action="MaJ/majcdm.php">
    <input type="hidden" name="Race"  value="<?echo $Race;?>"/>
    <input type="hidden" name="Monstre"  value="<?echo $Monstre;?>"/>
    <input type="hidden" name="Age"  value="<?echo $Age;?>"/>
    <input type="hidden" name="Nom"  value="<?echo $MonstreAge;?>"/>
    <input type="hidden" name="Famille"  value="<?echo $Famille;?>"/>
    <input type="hidden" name="MLEVEL" value="<?echo $mlevel;?>"/>

  <table width="780" border="0" cellspacing="0" class='bestiaire_cailloux'> <!-- table race/nom -->
    <tr align="center">
      <td><font size="+1">Race</font></td>
      <td><font size="+1">Template</font></td>
      <td><font size="+1">Âge</font></td>
      <td colspan= 2 align="center" width="240"><font size="+1">Famille</font></td>
    </tr>
    <tr align="center">
      <td>
        <select name="race_streum" onChange="RaceSelectMenu();">
        <? echo showListRaces($races,$Race); ?>
        </select>
      </td>
      <td>
        <select name="name_streum" onChange="MonstreSelectMenu()">
        <? echo showListNames($Race,$Monstre); ?>
        </select>
      </td>
      <td>
        <select name="age_streum" onChange="AgeSelectMenu()">
          <? echo showListAges($Race,$races[$Race]['genre'],$Monstre,$Famille,$Age); ?>
        </select>
      </td>
      <td rowspan=2>
        <? echo $Famille; ?>
      </td>
      <td rowspan=2>
        <img src="<? print("Familles/".famille2gif($Famille));?>" alt="<? print(famille2gif($Famille));?>"/>
      </td>
    </tr>
    </form>
    <tr align='center'>
      <form name="new_race" method="POST" action="MaJ/newrace.php">
      <input type="hidden" name="Famille"  value="<?echo $Famille;?>">
      <td><input type="submit" value="nouvelle race"/></td>
      </form>
      <form name="new_template" method="GET" action="MaJ/newtemplate.php">
      <input type="hidden" name="Race"  value="<?echo $Race;?>">
      <td><input type="submit" value="nouveau template"/></td>
  	 </form>
      <form name="new_age" method="POST" action="MaJ/newage.php">
      <input type="hidden" name="Race"  value="<?echo $Race;?>">
      <input type="hidden" name="Famille"  value="<?echo $Famille;?>">
      <td><input type="submit" value="nouvel âge"/></td>
      </form>
    </tr>
  </table> <!-- fin table race/nom -->
  <table width="950" border="0" cellspacing="0" bgcolor="#F75007">
	<tr><th><? echo $MonstreAge; ?></th></tr>
  </table>

<?
}

function afficherCaracteristiquePrincipales($image,$mlevel,$AttDLA,$DurDLA,$RM,
																						$Race,$Monstre,$Age,$MonstreAge,$Famille,$mlevel,$races)
{
?>
  <table width="950" border="0" cellspacing="0" bgcolor="#30395D"> <!-- table des données -->
    <!-- ligne contenant l\'image et une table pour les caracs principales -->
    <tr>
			<th>
		
				<table><tr>
	      <!-- première colonne : l\'image -->
	      <th  width="350" height="280">
					<img src="<? echo $image; ?>"border="2"align="center" bgcolor="#30395D">
	      </th>
	     <!-- deuxième colonne : les carac principales et le pxotron -->
     <th>
			
			<table>
				<tr><th>   <!-- début 1ère ligne - caracs principales -->

				  <table width="650" border="0" cellspacing="0" style='background-color:#6f7ca2;' class='bestiaire'>
					<tr>
					<td colspan='4' align='center'>
		      	<font color="#FFFFFF" size="+1"><b><em>Caractéristiques Principales :</em></b></font>
					</td>
					</tr>
			    <tr align="center">
			      <th>Niveau</th>
			      <th>Attaques/DLA</th>
			      <th>Duree DLA</th>
			      <th>RM</th>
			    </tr>
			    <tr align="center">
					<? // affichage des caractéristique principales 
					echo "<td bgcolor='#B7B7DB'>".$mlevel."</td>";
					echo "<td bgcolor='#B7B7DB'>".$AttDLA."</td>";
					echo "<td bgcolor='#B7B7DB'>".$DurDLA."</td>";
					echo "<td bgcolor='#B7B7DB'>".$RM."</td>";
					?>
		      </tr>
		  		</table>

				</th></tr> <!-- fin 1ère ligne --> 

   			<tr><th>   <!-- début 2ème ligne - bouton nouvelle carac -->
		   	  <form name="new_caracs" method="GET" action="MaJ/newcaracs.php">
	  	 	  <input type="hidden" name="Race"  value="<?echo $Race;?>">
	  	 	  <input type="hidden" name="Monstre"  value="<?echo $Monstre;?>">
		   	  <input type="hidden" name="Age"  value="<?echo $Age;?>">
		   	  <input type="hidden" name="Nom"  value="<?echo $MonstreAge;?>">
		   	  <input type="hidden" name="Famille"  value="<?echo $Famille;?>">
		   	  <input type="hidden" name="MLEVEL" value="<?echo $mlevel;?>">
				  <input type="submit" name="newcaracs" value="entrer de nouvelles caracs"></input>
		   	  </form>
				</th></tr> <!-- fin 2ème ligne -->
      	<tr><th></th></tr>  <!-- ligne blanche -->
       	<tr><th>  <!-- début 3ème ligne - PXotron -->
       	  <table width="650" border="0" cellspacing="0" style='background-color:#6f7ca2;' class='bestaire'>
	      		<tr>
							<td colspan='3' align='center'>
								<font color="#FFFFFF" size="+1"><em>PXoTron :</em></font></strong>
							</td>
						</tr>
	   				 <tr align="center">
				      <th width="200">Niveau Troll</th>
				      <th width="100">Click !</th>
				      <th width="300">PXs à Partager</th>
				    </tr>
				    <tr align="center">
				      <form name="calc_px">
				      <td bgcolor='#B7B7DB'><input name="troll" type="text" size="2" value="1"></input></td>
				      <td bgcolor='#B7B7DB'><INPUT onclick="calcPx()"; type="button" value="===>>>"></INPUT></td>
				      <td bgcolor='#B7B7DB' id="oPx">&nbsp;</td>
			      </form>
			    </tr>
		  </table>
	</th></tr> <!-- fin 3ème ligne -->
      </table></th>
    </tr></table></th> <!-- fin de la ligne image+table carac et pxotron -->
   </tr> 
 </table>
<?
}

function afficherCdm($cdm,$cdmtemplate)
{
	echo "<table width='950' border='0' cellspacing='0' style='background-color:#6f7ca2;' class='bestiaire'>";
	echo "<tr>";
	echo "<td colspan='12' align='center'>";
	echo "<font color='#FFFFFF' size='+1'><b><em>";
	if( (count($cdm)!=0) || ($cdmtemplate==0))
		echo "Caractéristiques Physiques (dernière cdm)";
	else
		echo "<font color=\"#FF0000\">Donnée manquante :</font> cdm indicative d'un(e) ".$cdmtemplate['Nom'];
	echo "</em></b></font>";
	echo "</td></tr>";

  print_cdm_colums();

  print_cdm_row($cdm[0]); 
  if( (count($cdm)==0) && ($cdmtemplate!=0)) 
		print_cdm_row($cdmtemplate); 

	echo "</table>";
	echo "<form name='parse_cdm' method='POST' action='MaJ/cdm_parseur.php'/>";
	echo "<input type='submit' name='parsecdm' value='analyser une nouvelle cdm'/>";

}

function afficherPouvoirs($pouvoirs,$pouvoirstemplate,$deaths,$deathstemplate,$cdm,$caracs,
													$Race,$Monstre,$Age,$MonstreAge,$Famille,$mlevel,$races)
{
?>
 <table width="950" border="0" cellspacing="0" style='background-color:#6f7ca2;' class='bestiaire'>
   <tr><th>
   <!--  ------------------------------------ -->
   <? print_capspe($pouvoirs,$pouvoirstemplate,FALSE);?>
   <!--  ------------------------------------ -->
   </th></tr>
   <tr><th>
     <form name="new_pouvoir" method="GET" action="MaJ/newpouvoirs.php">
     <input type="hidden" name="Race"  value="<?echo $Race;?>"/>
     <input type="hidden" name="Monstre"  value="<?echo $Monstre;?>"/>
     <input type="hidden" name="Age"  value="<?echo $Age;?>"/>
     <input type="hidden" name="Nom"  value="<?echo $MonstreAge;?>"/>
     <input type="hidden" name="Famille"  value="<?echo $Famille;?>"/>
     <input type="submit" name="newpouvoir" value="entrer un nouveau pouvoir magique"/>
     </form>
   </th></tr>
	 </table>

	<br><br>
 <table width="950" border="0" cellspacing="0" style='background-color:#6f7ca2;' class='bestiaire'>
   <tr><th>
   <!--  ------------------------------------ -->
   <? print_death($deaths,$deathstemplate,FALSE);?>
   <!--  ------------------------------------ -->
   </th></tr>
   <tr><th>
     <form name="new_deathpower" method="GET" action="MaJ/newdeathpower.php">
     <input type="hidden" name="Race"  value="<?echo $Race;?>"/>
     <input type="hidden" name="Monstre"  value="<?echo $Monstre;?>"/>
     <input type="hidden" name="Age"  value="<?echo $Age;?>"/>
     <input type="hidden" name="Nom"  value="<?echo $MonstreAge;?>"/>
     <input type="hidden" name="Famille"  value="<?echo $Famille;?>"/>
     <input type="submit" name="newdeathpower" value="entrer un nouveau pouvoir à la mort"/>
     </form>
   </th></tr>
	</table>
<br><br>
<?
}

function afficheAutresConnaissances($cdm,$caracs,$pouvoirs,$pouvoirstemplate,$deaths,$deathstemplate)
{
?>
 <table width="950" border="0" cellspacing="0" style='background-color:#6f7ca2;' class='bestiaire'>
   <tr><th><font color="#FFFFFF" size="+1"><b>Autres connaissances sur le monstre</b></font></th></tr>
   <tr>
     <th>
     <!--  ------------------------------------ -->
     <? print_cdm($cdm,TRUE);?> <!-- on n\'affiche pas la première cdm -->
     <!--  ------------------------------------ -->
     </th>
   </tr>
   <tr><th>
   <!--  ------------------------------------ -->
   <? print_caracs($caracs,TRUE,TRUE);?> <!-- on les affiche toutes sauf la première -->
   <!--  ------------------------------------ -->
   </th></tr>
   <tr><th>
   <!--  ------------------------------------ -->
   <? print_capspe($pouvoirs,$pouvoirstemplate,TRUE,TRUE);?> <!-- on les affiche toutes sauf la première -->
   <!--  ------------------------------------ -->
   </th></tr>
   <tr><th>
   <!--  ------------------------------------ -->
   <? print_death($deaths,$deathstemplate,TRUE,TRUE);?> <!-- on les affiches tous sauf le premier -->
   <!--  ------------------------------------ -->

   </th></tr>
   <tr><th>&nbsp;</th></tr>
   <tr><th>&nbsp;</th></tr>
 </table>
 </form>  
 </div>
<?
}

function afficheStatGlobales($nmonstres,$ncdm,$nraces,$npouvoirs,$ndeath)
{
	echo "<center><font color='#FFFFFF' size='+1'><b>";
	echo "$ncdm CdMs de $nmonstres Monstres différents répartis dans ";
	echo "$nraces Races<br>dont $npouvoirs";
	echo "avec une capacité spéciale et $ndeath";
	echo "avec un pouvoir se déclenchant à leur mort.</b>";
	echo "</font></center>";
}

?>
