<?

include_once ("bugs_functions_db.php");
include_once ("admin_functions.php3");

function afficherFicheBug($id_bug)
{
  global $db_vue_rm, $admin;

  if ($id_bug == "new") {
    $titre = "<h3>Ajout d'un bug ou d'un souhait</h3>";
		$id_troll_emetteur_bug = $_SESSION[AuthTroll];
		$id_troll_responsable_bug = 0;
	  $date_ouverture_bug =date("Y-m-d H-i-s");
		
  } else {
    // On va chercher les informations du bug
    $lesBugs = selectDbBugs($id_bug);
    $res = $lesBugs[1];

 		$id_bug = $res[id_bug];
	  $id_troll_emetteur_bug = $res[id_troll_emetteur_bug];
	  $id_troll_responsable_bug = $res[id_troll_responsable_bug];
	  $nom_emetteur= stripslashes($res[nom_emetteur]);
	  $nom_responsable= stripslashes($res[nom_responsable]);
	  $date_ouverture_bug = $res[date_ouverture_bug];
	  $date_cloture_bug = $res[date_cloture_bug];
	  $description_bug = stripslashes($res[description_bug]);
	  $criticite_bug = $res[criticite_bug];
	  $type_bug = $res[type_bug];
	  $etat_bug = $res[etat_bug];
	  $outil_touche_bug = $res[outil_touche_bug];

    $titre = "<h3>Edition d'un Bug ou d'un souhait</h3>";
  }

  if ($description=="") $description="....";

  echo "<form action='bugs.php'>";

  echo "<input type='hidden' name='bug' value='edit'>";
  echo "<input type='hidden' name='id_bug' value='$id_bug'>";
  echo "<input type='hidden' name='id_troll_emetteur_bug' value='$id_troll_emetteur_bug'>";
  echo "<input type='hidden' name='id_troll_responsable_bug' value='$id_troll_responsable_bug'>";
  echo "<input type='hidden' name='date_ouverture_bug' value='$date_ouverture_bug'>";
  echo "<input type='hidden' name='etat_bug_old' value='$etat_bug'>";
	
	echo "<table><tr><td valign='top'>";

  echo "<table class='mh_tdborder'>";
  echo "<tr class='mh_tdtitre'><td colspan='2' align='center'>$titre";

	if ($id_bug == "new")
		echo "<input type='submit' value='Ajouter' class='mh_form_submit'> ";
	else {

		if (($id_troll_emetteur_bug == $_SESSION[AuthTroll]) || 
				(isControlAdministrateur()))
		{	
			echo " <input type='submit' value='Modifier' class='mh_form_submit'>";
	    echo " <input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
	    echo " onClick=\"javascript=";
	    echo " k=confirm('Vous êtes sur le point de supprimer le bug. Il sera détruit de la base de données !";
			echo " Voulez-vous confirmer la suppression ?');";
	    echo " if (k==true) {document.location.href=";
	    echo "'bugs.php?bug=$id_bug&action=del';}";
	    echo "\"'>&nbsp;";

		}

	}

	echo "<input type='button' class='mh_form_submit' onClick=\"Javascript=document.location.href='bugs.php?bugs=liste'\" value='Retour Liste'>";

	
	echo "</td></tr>";

  echo "<tr class='mh_tdpage'><td><b>N° du bug</b></td>";
  echo "<td>$id_bug</td></tr>";
	
  echo "<tr class='mh_tdpage'><td><b>Troll émetteur</b></td>";

  echo "<td>$nom_emetteur ($id_troll_emetteur_bug)</td></tr>";

	if ($id_bug != "new") {
  	echo "<tr class='mh_tdpage'><td><b>Date d'émission</b></td>";
		echo "<td>".date('d/m/y H:i',$date_ouverture_bug)."</td></tr>";
	}

  echo "<tr class='mh_tdpage'><td><b>Description</b></td>";
	echo "<td><textarea cols=60 rows=4 name='description_bug'>";
	echo stripslashes($description_bug);
	echo "</textarea>";
	echo "</td></tr>";
		
  echo "<tr class='mh_tdpage'><td><b>Outil Touché principalement</b></td>";
  echo "<td><select name='outil_touche_bug'>";
  afficher_listbox_select("bestiaire", $outil_touche_bug);
  afficher_listbox_select("bugs", $outil_touche_bug);
  afficher_listbox_select("firemago", $outil_touche_bug);
  afficher_listbox_select("gps", $outil_touche_bug);
  afficher_listbox_select("ggc", $outil_touche_bug);
  afficher_listbox_select("recherchator", $outil_touche_bug);
  afficher_listbox_select("rg", $outil_touche_bug);
  afficher_listbox_select("stats", $outil_touche_bug);
  afficher_listbox_select("trombinoscope", $outil_touche_bug);
  afficher_listbox_select("vue2d", $outil_touche_bug);
  afficher_listbox_select("vtt", $outil_touche_bug);
  afficher_listbox_select("autre", $outil_touche_bug);
  echo "</select>";
	echo "</td></tr>";

  echo "<tr class='mh_tdpage'><td><b>Criticité</b></td>";
  echo "<td><select name='criticite_bug'>";
  afficher_listbox_select("basse", $criticite_bug);
  afficher_listbox_select("moyenne", $criticite_bug);
  afficher_listbox_select("prioritaire", $criticite_bug);
  echo "</select>";
	echo "</td></tr>";
	
  echo "<tr class='mh_tdpage'><td><b>Type</b></td>";
  echo "<td><select name='type_bug'>";
  afficher_listbox_select("souhait", $type_bug);
  afficher_listbox_select("bug", $type_bug);
  echo "</select>";
	echo "</td></tr>";
	
  echo "<tr class='mh_tdpage'><td><b>Etat</b></td>";
  echo "<td><select name='etat_bug'>";
  afficher_listbox_select("ouvert", $etat_bug);
  afficher_listbox_select("en-cours", $etat_bug);
  afficher_listbox_select("clos", $etat_bug);
  echo "</select>";
	echo "</td></tr>";

	if ($id_bug != "new") {
  	echo "<tr class='mh_tdpage'><td><b>Responsable</b></td>";
		echo "<td><select name='id_troll_responsable_bug'>";
		afficher_listbox_troll_rm_select($id_troll_responsable_bug,"",0);	
		echo "</select></td></tr>";

  	if ($etat_bug == "clos") {
			echo "<tr class='mh_tdpage'><td><b>Date de clôture</b></td>";
			echo "<td>".date('d/m/y H:i',$date_cloture_bug)."</td></tr>";
		}
	}

	echo "</table>";


	echo "</td><td valign='top'>";

	if ($id_bug != "new") {
 	 //echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	 	echo "<table class='mh_tdborder'>";
		echo "<tr class='mh_tdtitre'><td align='center'> Description </td></tr>";
		$description_bug = preg_replace("/\n/","<br>",$description_bug);
		echo "<tr class='mh_tdpage'><td>".stripslashes($description_bug)."</td></tr>";
		echo "</table>";
	}

	echo "</table>";
	
	echo "</form>";
}

function afficherListeBugsJs()
{
?>
<script language='Javascript'>
function changeOutil() {
 document.location.href='/bugs.php?outil='+document.formList.outil.value+'&criteres=etat_bug,type_bug%20desc,criticite_bug%20desc';
}
 </script>

<?
}

function afficherListeBugs()
{
  global $db_vue_rm;

  $debut=$_REQUEST['debut'];
  $order=$_REQUEST['order'];
  $criteres=$_REQUEST['criteres'];
  $nb_ppage=$_REQUEST['nb_ppage'];
  $outil=$_REQUEST['outil'];
	
	if ($debut == "" && $order == "" && $criteres == "" && $nb_ppage == "" && $outil == "") {
    $criteres = 'etat_bug, type_bug desc, criticite_bug desc';
    $nb_ppage = 50;
	}
  if (!isset($debut)) $debut = 0;
	
  //if ($criteres == "")

  if ($nb_ppage == "")
    $nb_ppage = 10;

  $lien_base = "/bugs.php?outil=$outil&criteres=";
	afficherListeBugsJs();
  ?>
  <table class='mh_tdborder' width='100%' align='center'>
    <tr>
      <td>
      <table width='100%' cellspacing='0'>
        <tr class='mh_tdtitre' align="center">
        <td><form name='formList'>
  Nombre de bugs par pages :
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=10"; ?>'>10</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=50"; ?>'>50</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=100"; ?>'>100</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=200"; ?>'>200</a>
  <a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=500"; ?>'>500</a>

	<br>Tri pratique :
	
  <a href='<? echo $lien_base ?>etat_bug,type_bug desc,criticite_bug desc&order=&nb_ppage=50'>État, types et criticité</a>

	<br>Filtrer
	<?
  echo "<select name='outil' onChange='Javascript:changeOutil();'>";
  afficher_listbox_select("", $outil,"Tous");
  afficher_listbox_select("bestiaire", $outil);
  afficher_listbox_select("bugs", $outil);
  afficher_listbox_select("firemago", $outil_touche_bug);
  afficher_listbox_select("gps", $outil);
  afficher_listbox_select("ggc", $outil);
  afficher_listbox_select("recherchator", $outil);
  afficher_listbox_select("rg", $outil);
  afficher_listbox_select("stats", $outil);
  afficher_listbox_select("trombinoscope", $outil_touche_bug);
  afficher_listbox_select("vue2d", $outil);
  afficher_listbox_select("vtt", $outil);
  afficher_listbox_select("autre", $outil);
  echo "</select></form>";
	?>
  <table class='mh_tdpage' width='100%' cellpadding=2>

	<?

	$lien_base = "/bugs.php?outil=$outil&nb_ppage=$nb_ppage&criteres=";

	$nbtotal = selectDbBugsCount();
	$lesBugs = selectDbBugs("",$outil,$debut,$nb_ppage,$criteres,$order);
  $nbBugs = count($lesBugs);

  $barre_nav = construct_barre_navigation($debut,$nbBugs,$nbtotal,$cfg_nbres_ppage,
                            $nb_ppage,$lien_base,$criteres,$order);

  for($i=1;$i<=$nbBugs;$i++) {

    if (($i-1)%10 == 0) {
      afficherEnteteListeBugs($lien_base,$criteres,$order);
    }

    $res = $lesBugs[$i];
		$etat_bug = $res[etat_bug];
		$criticite_bug = $res[criticite_bug];
		$type_bug = $res[type_bug];
		$description_bug = stripslashes($res[description_bug]);

    // Si la description est trop longue, on la coupe
    if(strlen($description_bug)>=85) {
      $description_bug = substr($description_bug,0,85)."...";
    }

		if ($etat_bug == "clos")
			$etat_c = "bbbbff";
		elseif ($etat_bug == "en-cours") 
			$etat_c = "161";
		elseif ($etat_bug == "ouvert")
			$etat_c = "911";

		if ($criticite_bug == "basse")
			$criticite_c = "117";
		elseif ($criticite_bug == "moyenne")
			$criticite_c = "F42";
		else //if ($criticite_bug == "haute")
			$criticite_c = "911";

		if ($type_bug == "souhait")
			$type_c = "117";	
		else //$type_bug == "bug")
			$type_c = "911";
			
		$classe="ligne invisible";
		
		if ($etat_bug == "clos") {
			$etat_c = "";
			$type_c = "";
			$criticite_c = "";
			$classe="ligne ";
		} elseif ($etat_bug == "en-cours") 
			$etat_c = "161";
		elseif ($etat_bug == "ouvert")
			$etat_c = "911";		

		$lien = "href='bugs.php?bug=$res[id_bug]'";

    //echo "<tr class='$classe' onmouseover=\"this.className='item-mouseover'\"";
		//echo " onmouseout=\"this.className='$classe'\" >";
    echo "<tr class='mh_tdpage'>";
 		echo "<td><a $lien>$res[id_bug]</a></td>";
 		echo "<td><a $lien>$res[outil_touche_bug]</a></td>";
	  echo "<td style='background-color:#$criticite_c;'><a $lien>$criticite_bug</a></td>";
	  echo "<td style='background-color:#$type_c;'><a $lien>$type_bug</a></td>";
	  echo "<td style='background-color:#$etat_c;'><a $lien>$etat_bug</a></td>";
	  echo "<td><a $lien>".stripslashes($res[nom_emetteur])." ($res[id_troll_emetteur_bug])</a></td>";
	  echo "<td><a $lien>".stripslashes($res[nom_responsable])." ($res[id_troll_responsable_bug])</a></td>";
		echo "<td><a $lien>".date('d/m/y H:i',$res[date_ouverture_bug])."</a></td>";
		echo "<td><a $lien>";
		if (date('d/m/y H:i',$res[date_cloture_bug]) != "01/01/70 01:00")
			echo date('d/m/y H:i',$res[date_cloture_bug]);
		echo "</a></td>";
	  echo "<td><a $lien>$description_bug</a></td>";
    echo "</tr>";

  }
  echo "</table>";
	echo $barre_nav;
	?>
   </td>
   </tr>
   </table>
   </tr>
   </td>
  </table><br>
<?
}

function afficherEnteteListeBugs($lien_base,$critere="",$order="")
{

  echo "<tr class='mh_tdtitre'>";

  if ($order == "desc")
    $order="";
  else
    $order="desc";

  affiche_celulle("N° bug",				$lien_base."id_bug&order=$order");
  affiche_celulle("Outil impacté",$lien_base."outil_touche_bug&order=$order");
  affiche_celulle("Criticité",		$lien_base."criticite_bug&order=$order");
  affiche_celulle("Type",					$lien_base."type_bug&order=$order");
  affiche_celulle("État",					$lien_base."etat_bug&order=$order");
  affiche_celulle("Émetteur",			$lien_base."id_troll_emetteur_bug&order=$order");
  affiche_celulle("Responsable",	$lien_base."id_troll_responsable_bug&order=$order");
  affiche_celulle("Date Ouverture",$lien_base."date_ouverture_bug&order=$order");
  affiche_celulle("Date clôture",	$lien_base."date_cloture_bug&order=$order");
  affiche_celulle("Description",	$lien_base."description_bug&order=$order");
  echo "</tr>";
}




?>
