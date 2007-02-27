<?

function afficherPropositionAnatomique()
{
		$lesTrolls = selectDbTrolls($_SESSION[AuthTroll]);
		$troll = $lesTrolls[1];
		$source= htmlentities($troll[nom_troll]);
?>
	<table class='mh_tdborder' width='60%' align='center'>
	  <tr>
	    <td>
	    <table width='100%' cellspacing='0'>
	      <tr class='mh_tdtitre' align="center">
	      <td><h2>Nouvelle Analyse Anatomique</h2>
	      <!--<img src='../images/titre_calculs.gif'>-->
	      </td>
	    </tr>
	    </table>
	    </tr>
	  </td>
	</table><br>

   <table class='mh_tdborder' width='60%' align='center' >
    <tr><td>
      <table width='100%' cellspacing='0'>
        <tr class='mh_tdtitre' align="center">
          <td>
						Vous pouvez mettre plusieurs analyses anatomique en meme temps.<br>
						Du moment que chacune commence par le nom du troll (n°) et se finisse par la ligne renseignant l'armure.
          </td>
        </tr>
      </table>
    </td></tr>
    <tr class='mh_tdpage'><td width='50%'>
    	<table width="750" border="0" cellpadding="3" cellspacing="3">
	      <tr align="center">
	        <td width="150" align="center">
						<form name='form_anat' action='anatomique.php' method='Post'>
						<input type='hidden' value='newdb' name='id_troll'>
					  <textarea cols=80 rows=10 name='copiercoller'>
					  </textarea><br>
						Source : <input type='textbox' name='source' value='<? echo $source ?>'><br>
						<input type='Submit'  class='mh_form_submit' value='Envoyer'>
						</form>
						</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
<?
}

function afficherListeTrollAnatomique()
{
	global $db_vue_rm;
	
	$debut=$_REQUEST['debut'];
	$order=$_REQUEST['order'];
	$criteres=$_REQUEST['criteres'];
	$nb_ppage=$_REQUEST['nb_ppage'];

	if (!isset($debut)) $debut = 0;
	if ($criteres == "")
		$criteres = 'nom_troll';

	if ($nb_ppage == "")
		$nb_ppage = 10;
	
	$lien_base = "/anatomique/anatomique.php?id_troll=liste&criteres=";

	
	?>
  <table class='mh_tdborder' width='60%' align='center'>
    <tr>
      <td>
      <table width='100%' cellspacing='0'>
        <tr class='mh_tdtitre' align="center">
        <td>
	Nombre de trolls par pages : 
	<a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=10"; ?>'>10</a>
	<a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=50"; ?>'>50</a>
	<a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=100"; ?>'>100</a>
	<a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=200"; ?>'>200</a>
	<a href='<? echo $lien_base.$criteres."&order=".$order."&nb_ppage=500"; ?>'>500</a>

	<table class='mh_tdpage' width='100%' cellpadding=2>
	<?

	$lien_base = "/anatomique/anatomique.php?id_troll=liste&nb_ppage=$nb_ppage&criteres=";

	$nbtotal = selectDbAnalyseAnatomiqueCount();
	$lesAnats = selectDbAnalyseAnatomique("",$debut,$nb_ppage,$criteres,$order);
	$nbAnats = count($lesAnats);

	$barre_nav = construct_barre_navigation($debut,$nbAnats,$nbtotal,$cfg_nbres_ppage,
														$nb_ppage,$lien_base,$criteres,$order);

	for($i=1;$i<=$nbAnats;$i++) {

	  if (($i-1)%10 == 0) {
			afficherEnteteListeAnatomique($lien_base,$criteres,$order);
		}

 		$res = $lesAnats[$i];
		echo afficher_ligne_anatomique($res);

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

/* Convertit les ( en br et supprime les ) */
function anaChaine($str)
{
	$str = preg_replace("/\(/","<br>",$str);
	$str = preg_replace("/\)/","",$str);
	return $str;
}

function afficher_ligne_anatomique($res) 
{
	$lesTrolls = selectDbTrolls($res[id_troll_anatomique]);
	$troll = $lesTrolls[1];

  $lien = "href='/engine_view.php?troll=$res[id_troll_anatomique]'";

	echo "<tr class='mh_tdpage'>";
	echo "<td nowrap>$troll[id_troll]</td>";
	echo "<td nowrap>$troll[nom_troll]<br>$troll[race_troll] ($troll[niveau_troll])</td>";
	echo "<td nowrap>".anaChaine($res[pv_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[att_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[esq_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[deg_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[reg_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[vue_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[arm_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[date_anatomique])."</td>";
	echo "<td nowrap>".anaChaine($res[source_anatomique])."</td>";
	echo "<td nowrap><a $lien>[Fiche RG]</a></td>";
	echo "</tr>";
}

function afficherEnteteListeAnatomique($lien_base,$critere="",$order="")
{
	
	echo "<tr class='mh_tdtitre'>";
	
	if ($order == "desc")
		$order="";
	else
		$order="desc";

	affiche_celulle("Id",$lien_base."id_troll&order=$order");
	affiche_celulle("Nom",$lien_base."nom_troll&order=$order");
	affiche_celulle("Pv",$lien_base."pv_anatomique&order=$order");
	affiche_celulle("Att",$lien_base."att_anatomique&order=$order");
	affiche_celulle("Esq",$lien_base."esq_anatomique&order=$order");
	affiche_celulle("Deg",$lien_base."deg_anatomique&order=$order");
	affiche_celulle("Reg",$lien_base."reg_anatomique&order=$order");
	affiche_celulle("Vue",$lien_base."vue_anatomique&order=$order");
	affiche_celulle("Arm",$lien_base."arm_anatomique&order=$order");
	affiche_celulle("Date",$lien_base."date_anatomique&order=$order");
	affiche_celulle("Source",$lien_base."source_anatomique&order=$order");
	echo "<td>&nbsp;</td>";
	echo "</tr>";
}

function parseAnalyseAnatomique($lignes,$source,$date)
{
	$i = 0;
	$debug = false;	
	while ($lignes[$i]) {

		if(eregi("[ \t]*\(n°(.+)\)",$lignes[$i],$resultat)){
			$id_troll_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "Id=$id_troll_anat<br>";
			$control = "1";
		}
		if(eregi("[ \t]*Points de Vie : (.*)",$lignes[$i],$resultat)){
			$pv_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "pv=$pv_anat<br>";
			$control .= "2";
		}
		if(eregi("[ \t]*D.s d'Attaque : (.*)",$lignes[$i],$resultat)){
			$att_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "att=$att_anat<br>";
			$control .= "3";
		}
		if(eregi("[ \t]*D.s d'Esquive : (.*)",$lignes[$i],$resultat)){
			$esq_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "esq=$esq_anat<br>";
			$control .= "4";
		}
		if(eregi("[ \t]*D.s de D.gat : (.*)",$lignes[$i],$resultat)){
			$deg_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "esq=$deg_anat<br>";
			$control .= "5";
		}
		if(eregi("[ \t]*D.s de R.g.n.ration : (.*)",$lignes[$i],$resultat)){
			$reg_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "esq=$reg_anat<br>";
			$control .= "6";
		}
		if(eregi("[ \t]*Vue : (.*)",$lignes[$i],$resultat)){
			$vue_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "vue=$vue_anat<br>";
			$control .= "7";
		}
		if(eregi("[ \t]*Armure : (.*)",$lignes[$i],$resultat)){
			$arm_anat   = trim(htmlspecialchars($resultat[1]));
			if ($debug) echo "arm=$arm_anat<br>";
			$control .= "8";
		}

		if (($control == "12345678") || ($control == "12345687")) {
			
			if ($debug)	echo "editDbTroll($id_troll_anat,$pv_anat,$att_anat,$esq_anat,$deg_anat,";
			if ($debug)	echo "$reg_anat,$vue_anat,$arm_anat,$source,$date);<br>";

			$info .= editDbTrollAnatomique($id_troll_anat,$pv_anat,$att_anat,$esq_anat,$deg_anat,
																		 $reg_anat,$vue_anat,$arm_anat,$source,$date);
			
			$control = "";
		}

	$i++;
	}
	afficherFinEnregistre($info);
}

function enregistreAnatomique()
{
	
	$lignes = explode("\n", htmlspecialchars(stripslashes($_REQUEST["copiercoller"])));
	$source = htmlspecialchars(stripslashes($_REQUEST["source"]));

	$date=date("Y-m-d");
	parseAnalyseAnatomique($lignes,$source,$date);
}

function afficherFinEnregistre($info)
{
	?>
	<table class='mh_tdborder' width='60%' align='center'>
	  <tr>
	    <td>
	     <table width='100%' cellspacing='0'>
	      <tr class='mh_tdtitre' align="center">
	       <td>Résumé
	       </td>
	      </tr>
	     </table>
	    </td>
	  </tr>
	  <tr>
	    <td>
	     <table width='100%' cellspacing='0'>
	      <tr class='mh_tdpage' align="left">
	       <td><? echo $info ?></td>
	      </tr>
	     </table>
	    </td>
	  </tr>
	</table>
	<?
}



?>
