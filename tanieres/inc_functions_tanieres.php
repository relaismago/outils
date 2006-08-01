<?

function afficher_liste_gtanieres()
{
	$lien = "/tanieres/tanieres.php?taniere=new";
	$button = "<input type='button' onClick='Javascript:document.location.href=\"$lien\"' value='Ajouter une tanière'";
	$button .= " class='mh_form_submit'>";

	$position = "Tris en distance en PA, Position de départ : <br>";
	$position .= "X=".formulaire_listbox("x_troll",-150,150,1,$_REQUEST['x_troll'],"plusmoins","yes",true,false);
	$position .= "Y=".formulaire_listbox("y_troll",-150,150,1,$_REQUEST['y_troll'],"plusmoins","yes",true,false);
	$position .= "Z=".formulaire_listbox("z_troll",0,100,1,$_REQUEST['z_troll'],"plusmoins","yes",true,false);

  $lien_base = "/tanieres/tanieres.php?taniere=liste&nb_ppage=$nb_ppage&criteres=";
	
	$position .= " <input type='submit' value='Trier' class='mh_form_submit'>" ;

	echo "<form name='trieForm' action='$lien_base' method='POST'>";
	afficher_titre_tableau("Les Grandes Tanières",$button."<br><br>".$position);
	echo "</form>";
	
	$lesGTanieres = selectDbGrandesTanieres();
 	

  $debut=$_REQUEST['debut'];
  $order=$_REQUEST['order'];
  $criteres=$_REQUEST['criteres'];
  $nb_ppage=$_REQUEST['nb_ppage'];

  if (!isset($debut)) $debut = 0;
  if ($criteres == "") 
    $criteres = 'nom_gtaniere';

  if ($nb_ppage == "")
    $nb_ppage = 10;

  $lien_base = "/tanieres/tanieres.php?taniere=liste&";
	$lien_base .= "x_troll=".$_REQUEST['x_troll'];
	$lien_base .= "&y_troll=".$_REQUEST['y_troll'];
	$lien_base .= "&z_troll=".$_REQUEST['z_troll'];
	$lien_base .= "&criteres=";


  ?>
  <table class='mh_tdborder' width='60%' align='center'>
    <tr>
      <td>
      <table width='100%' cellspacing='0'>
        <tr class='mh_tdtitre' align="center">
        <td>
  Nombre de tanières par page :
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=10"; ?>'>10</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=50"; ?>'>50</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=100"; ?>'>100</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=200"; ?>'>200</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=500"; ?>'>500</a>
	
	<table width='100%'  class='mh_tdpage' cellpadding=2>

	<?

  $lien_base = "/tanieres/tanieres.php?taniere=liste&nb_ppage=$nb_ppage&criteres=";

	$x_troll = $_REQUEST['x_troll'];
	$y_troll = $_REQUEST['y_troll'];
	$z_troll = $_REQUEST['z_troll'];
	 
  $nbtotal = selectDbGrandesTanieresCount();
  $lesGTanieres= selectDbGrandesTanieres("",$debut,$nb_ppage,$criteres,$order,$x_troll,$y_troll,$z_troll);
  $nbGTanieres = count($lesGTanieres);
	
	if (is_numeric($x_troll) && is_numeric($y_troll) && is_numeric($z_troll) ) {
  	usort($lesGTanieres,"callbackSortDistancePa");
	}

	$criteres .= "&x_troll=".$x_troll;
	$criteres .= "&y_troll=".$y_troll;
	$criteres .= "&z_troll=".$z_troll;

	$barre_nav = construct_barre_navigation($debut,$nbGTanieres,$nbtotal,$cfg_nbres_ppage,
                            $nb_ppage,$lien_base,$criteres,$order);

	$i = 0;
	$j = 0;
	while (list ($key, $res) = each ($lesGTanieres)) {	
    $j++;
    if ( $j < $debut ) {
       next;
    }
    if ($j > $nb_ppage ) {
       break;
    }

		if (($i)%10 == 0)
			afficher_entete_liste_gtaniere($lien_base,$criteres,$order,$x_troll,$y_troll,$z_troll);
			
		$res = $lesGTanieres[$i];
		afficher_ligne_gtaniere($res,$x_troll,$y_troll,$z_troll);
		$i++;
	}

	?>
	</table>
 <? echo $barre_nav; ?>
   </td>
   </tr>
   </table>
   </tr>
   </td>
  </table><br>

	<?
}

function afficher_entete_liste_gtaniere($lien_base,$criteres,$order,$x_troll,$y_troll,$z_troll) 
{

  if ($order == "desc")
    $order="";
  else
    $order="desc";

	echo "<tr class='mh_tdtitre'>";
	if (is_numeric($x_troll) && is_numeric($y_troll) && is_numeric($z_troll) )
		affiche_celulle("Distance en PA","");

	affiche_celulle("Nom",$lien_base."nom_gtaniere&order=$order");
	affiche_celulle("Guilde",$lien_base."nom_guilde&order=$order");
	affiche_celulle("Position","");

	$tgv = "<table><tr><td colspan='4'>TGV</td></tr>";
	$tgv .= "<tr><td>Guilde</td><td>Amis</td><td>Neutres</td><td>Ennemis</td></tr></table>";

	$soins = "<table><tr><td colspan='4'>Soins</td></tr>";
	$soins .= "<tr><td>Guilde</td><td>Amis</td><td>Neutres</td><td>Ennemis</td></tr></table>";

	$resurection = "<table><tr><td colspan='4'>Résurrection</td></tr>";
	$resurection .= "<tr><td>Guilde</td><td>Amis</td><td>Neutres</td><td>Ennemis</td></tr></table>";

	$forgeron = "<table><tr><td colspan='4'>Forgeron</td></tr>";
	$forgeron .= "<tr><td>Guilde</td><td>Amis</td><td>Neutres</td><td>Ennemis</td></tr></table>";

	affiche_celulle($tgv,$lien_base."is_tgv_gtaniere&order=$order");
	affiche_celulle($soins,$lien_base."is_soins_gtaniere&order=$order");
	affiche_celulle($resurection,$lien_base."is_resurection_gtaniere&order=$order");
	affiche_celulle($forgeron,$lien_base."is_forgeron_gtaniere&order=$order");
	affiche_celulle("Commerce",$lien_base."is_commerce_gtaniere&order=$order");

	echo "<td>Éditer</td>";
	
	echo "</tr>";
}

function afficher_ligne_gtaniere($res,$x_troll,$y_troll,$z_troll) 
{
		echo "<tr class='mh_tdpage'>";


		if (is_numeric($x_troll) && is_numeric($y_troll) && is_numeric($z_troll) )
			echo "<td>$res[distance_pa]</td>";
		
		echo "<td>$res[nom_gtaniere]</td>";
		echo "<td>".stripslashes($res[nom_guilde])."</td>";
		echo "<td>$res[x_gtaniere]|$res[y_gtaniere]|$res[z_gtaniere]</td>";
	
		/* TGV */
		echo "<td>";
		echo "<table width='100%'><tr><td colspan='4' align='center'>$res[is_tgv_gtaniere]</td></tr>";
		echo "<tr><td width='25%'>$res[prix_tgv_guilde_gtaniere]</td><td>$res[prix_tgv_amis_gtaniere]</td>";
		echo "<td>$res[prix_tgv_neutres_gtaniere]</td><td>$res[prix_tgv_ennemis_gtaniere]</td></tr></table>";
		echo "</td>";

		/* Soins */
		echo "<td>";
		echo "<table width='100%'><tr><td colspan='4' align='center'>$res[is_soins_gtaniere]</td></tr>";
		echo "<tr><td>$res[prix_soins_guilde_gtaniere]</td><td>$res[prix_soins_amis_gtaniere]</td>";
		echo "<td>$res[prix_soins_neutres_gtaniere]</td><td>$res[prix_soins_ennemis_gtaniere]</td></tr></table>";
		echo "</td>";

		/* Résurrection */
		echo "<td>";
		echo "<table width='100%'><tr><td colspan='4' align='center'>$res[is_tgv_gtaniere]</td></tr>";
		echo "<tr><td>$res[prix_resurection_guilde_gtaniere]</td><td>$res[prix_resurection_amis_gtaniere]</td>";
		echo "<td>$res[prix_resurection_neutres_gtaniere]</td><td>$res[prix_resurection_ennemis_gtaniere]</td></tr></table>";
		echo "</td>";

		/* Forgeron */
		echo "<td>";
		echo "<table width='100%'><tr><td colspan='4' align='center'>$res[is_forgeron_gtaniere]</td></tr>";
		echo "<tr><td>$res[prix_forgeron_guilde_gtaniere]</td><td>$res[prix_forgeron_amis_gtaniere]</td>";
		echo "<td>$res[prix_forgeron_neutres_gtaniere]</td><td>$res[prix_forgeron_ennemis_gtaniere]</td></tr></table>";
		echo "</td>";
		
		/* Commerce */
		echo "<td>".$res[is_commerce_gtaniere]."</td>";
		$lien = "/tanieres/tanieres.php?taniere=$res[id_lieu_gtaniere]";
		$button = "<input type='button' onClick='Javascript:document.location.href=\"$lien\"' value='Éditer'";
		$button .= " class='mh_form_submit'>";
		echo "<td>".$button."<td>";

		echo "</tr>";
}

function afficher_fiche_gtaniere( $id_lieu_gtaniere )
{
	if (is_numeric($id_lieu_gtaniere)) {
		$lesGTanieres = selectDbGrandesTanieres( $id_lieu_gtaniere );
		$res = $lesGTanieres[1];

		$id_lieu_gtaniere = $res[id_lieu_gtaniere];
		$id_guilde_gtaniere = $res[id_guilde_gtaniere];

		$nom_gtaniere = $res['nom_gtaniere'];
		$x_gtaniere = $res['x_gtaniere'];
		$y_gtaniere = $res['y_gtaniere'];
		$z_gtaniere = $res['z_gtaniere'];
		$is_tgv_gtaniere = $res['is_tgv_gtaniere'];
		$prix_tgv_guilde_gtaniere = $res['prix_tgv_guilde_gtaniere'];
		$prix_tgv_amis_gtaniere = $res['prix_tgv_amis_gtaniere'];
		$prix_tgv_neutres_gtaniere = $res['prix_tgv_neutres_gtaniere'];
		$prix_tgv_ennemis_gtaniere = $res['prix_tgv_ennemis_gtaniere'];
		$connexions_gtaniere = $res['connexions_gtaniere'];
		$is_soins_gtaniere = $res['is_soins_gtaniere'];
		$prix_soins_guilde_gtaniere = $res['prix_soins_guilde_gtaniere'];
		$prix_soins_amis_gtaniere = $res['prix_soins_amis_gtaniere'];
		$prix_soins_neutres_gtaniere = $res['prix_soins_neutres_gtaniere'];
		$prix_soins_ennemis_gtaniere = $res['prix_soins_ennemis_gtaniere'];
		$is_resurection_gtaniere = $res['is_resurection_gtaniere'];
		$prix_resurection_guilde_gtaniere = $res['prix_resurection_guilde_gtaniere'];
		$prix_resurection_amis_gtaniere = $res['prix_resurection__gtaniere'];
		$prix_resurection_neutres_gtaniere = $res['prix_resurection__gtaniere'];
		$prix_resurection_ennemis_gtaniere =$res['prix_resurection__gtaniere'];
		$is_forgeron_gtaniere = $res['is_forgeron_gtaniere'];
		$prix_forgeron_guilde_gtaniere = $res['prix_forgeron_guilde_gtaniere'];
		$prix_forgeron_amis_gtaniere = $res['prix_forgeron_guilde_gtaniere'];
		$prix_forgeron_neutres_gtaniere = $res['prix_forgeron_guilde_gtaniere'];
		$prix_forgeron_ennemis_gtaniere = $res['prix_forgeron_guilde_gtaniere'];
		$is_commerce_gtaniere = $res['is_commerce_gtaniere'];
		$date_gtaniere = $res['date'];
		$info = "Modifier";
	} else {
		$info = "Ajouter";
	}

	?>
	<form action='tanieres.php?' method='POST'>
	<input type='hidden' name='type_action' value='editdb'>
	<table class='mh_tdtitre'>
		<tr class='mh_tdpage' valign='top' align='right'>
			<td>
				Nom la tanière <br>
					<input type='text' name='nom_gtaniere' value='<? echo addslashes($nom_gtaniere) ?>' size='25'> <br>
				Numéro de la tanière <input type='text' name='id_lieu_gtaniere' value='<? echo $id_lieu_gtaniere ?>' size='6'> <br>
				Numéro de la guilde <input type='text' name='id_guilde_gtaniere' value='<? echo $id_guilde_gtaniere ?>' size='6'> <br>
				Positions X:<input type='text' name='x_gtaniere' value='<? echo $x_gtaniere ?>' size="3"> <br>
				Positions Y:<input type='text' name='y_gtaniere' value='<? echo $y_gtaniere ?>' size="3"> <br>
				Positions Z:<input type='text' name='z_gtaniere' value='<? echo $z_gtaniere ?>' size="3"> <br>
			</td>
			<td>
				TGV : 
				<select name='is_tgv_gtaniere'>
				<?echo afficher_listbox_select("oui",$is_tgv_gtaniere,"Oui");
					echo afficher_listbox_select("non",$is_tgv_gtaniere,"Non");
				?>
				</select><br>
				Prix <br>
				Guilde : <input type='text' name='prix_tgv_guilde_gtaniere' value='<? echo $prix_tgv_guilde_gtaniere?>' size="6"> <br>
				Amis : <input type='text' name='prix_tgv_amis_gtaniere' value='<? echo $prix_tgv_amis_gtaniere?>' size="6"> <br>
				Neutres : <input type='text' name='prix_tgv_neutres_gtaniere' value='<? echo $prix_tgv_neutres_gtaniere?>' size="6"> <br>
				Ennemis : <input type='text' name='prix_tgv_ennemis_gtaniere' value='<? echo $prix_tgv_ennemis_gtaniere?>' size="6"> <br>
			</td>
			<td>
				Soins : 
				<select name='is_soins_gtaniere'>
				<?echo afficher_listbox_select("oui",$is_soins_gtaniere,"Oui");
					echo afficher_listbox_select("non",$is_soins_gtaniere,"Non");
				?>
				</select><br>
				Prix <br>
				Guilde : <input type='text' name='prix_soins_guilde_gtaniere' value='<? echo $prix_tgv_guilde_gtaniere?>' size="6"> <br>
				Amis : <input type='text' name='prix_soins_amis_gtaniere' value='<? echo $prix_tgv_amis_gtaniere?>' size="6"> <br>
				Neutres : <input type='text' name='prix_soins_neutres_gtaniere' value='<? echo $prix_tgv_neutres_gtaniere?>' size="6"> <br>
				Ennemis : <input type='text' name='prix_soins_ennemis_gtaniere' value='<? echo $prix_tgv_ennemis_gtaniere?>' size="6"> <br>
			</td>
			<td>
				Résurection : 
				<select name='is_resurection_gtaniere'>
				<?echo afficher_listbox_select("oui",$is_resurection_gtaniere,"Oui");
					echo afficher_listbox_select("non",$is_resurection_gtaniere,"Non");
				?>
				</select><br>
				Prix <br>
				Guilde : <input type='text' name='prix_resurection_guilde_gtaniere' value='<? echo $prix_resurection_guilde_gtaniere?>' size="6"> <br>
				Amis : <input type='text' name='prix_resurection_amis_gtaniere' value='<? echo $prix_resurection_amis_gtaniere?>' size="6"> <br>
				Neutres : <input type='text' name='prix_resurection_neutres_gtaniere' value='<? echo $prix_resurection_neutres_gtaniere?>' size="6"> <br>
				Ennemis : <input type='text' name='prix_resurection_ennemis_gtaniere' value='<? echo $prix_resurection_ennemis_gtaniere?>' size="6"> <br>
			</td>
			<td>
				Forgeron : 
				<select name='is_forgeron_gtaniere'>
				<?echo afficher_listbox_select("oui",$is_forgeron_gtaniere,"Oui");
					echo afficher_listbox_select("non",$is_forgeron_gtaniere,"Non");
				?>
				</select><br>
				Prix <br>
				Guilde : <input type='text' name='prix_forgeron_guilde_gtaniere' value='<? echo $prix_forgeron_guilde_gtaniere?>' size="6"> <br>
				Amis : <input type='text' name='prix_forgeron_amis_gtaniere' value='<? echo $prix_forgeron_amis_gtaniere?>' size="6"> <br>
				Neutres : <input type='text' name='prix_forgeron_neutres_gtaniere' value='<? echo $prix_forgeron_neutres_gtaniere?>' size="6"> <br>
				Ennemis : <input type='text' name='prix_forgeron_ennemis_gtaniere' value='<? echo $prix_forgeron_ennemis_gtaniere?>' size="6"> <br>
			</td>
			<td>
				Commerce : 
				<select name='is_commerce_gtaniere'>
				<?echo afficher_listbox_select("oui",$is_commerce_gtaniere,"Oui");
					echo afficher_listbox_select("non",$is_commerce_gtaniere,"Non");
				?>
				</select>
			</td>
			<td>
				Connexions : <br>
				<textarea name='connexions_gtaniere'><?echo $connexions_gtaniere;?></textarea><br>
				<i>Séparez par des ; les numéros des LIEUX concernés.</i>
			</td>
		</tr>

	</table>
	<?
	echo "<input type='submit' name='submit' value='$info' class='mh_form_submit'>&nbsp;";
	if (isControlAdministrateur()) {
		if ($id_taniere != "new") {
			echo "<input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
			echo " onClick=\"javascript=";
			echo " k=confirm('Confirmer la suppression de la tanière ?');";
			echo " if (k==true) {document.location.href='taniere.php?type_action=del&id_lieu_gtaniere=$id_lieu_gtaniere';}";
			echo "\">&nbsp;";
		}
	}
	?>
	<input type='Button' value='Retour à Liste' class='mh_form_submit' 
	onClick='JavaScript=document.location.href="tanieres.php?type_action=list"'>
	<?
}

?>
