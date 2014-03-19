<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$copiercoller = $_POST[copiercoller];
$action = $_POST[action];
$vtt = $_POST[vtt];

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();
    
/*---------------------------------------------------------------*/
/*                 RECUPERATION D'INFOS                          */
/*---------------------------------------------------------------*/
//RECHERCHE DES INFOS DU TROLL CONNECTE
$requete_troll=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$nom_troll = mysql_result($requete_troll,0,"nom_troll");    
    
   
/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Mise à jour du profil","'file:images/retour2_over.gif'");

/*-----------------------------------------------------------------*/
/*	PARSAGE DES DONNEES                                            */
/*-----------------------------------------------------------------*/
switch($action) {
    case "add":
    
    //PARSAGE DU PROFIL
//    $copiercoller=str_replace("\r\n","\n",$copiercoller);
//    $copiercoller=str_replace("\r","\n",$copiercoller);
//    $copiercoller=str_replace("Position\n","Position",$copiercoller);
    $lignes = explode("\n" , $copiercoller);
 	$i=0;
 	$j=0;
        $sorts=0;
        $nb_sorts=0;
        $nb_comps=0;
	while ($lignes[$i])
		{
		if(eregi("[ \t]*Identifian.+:[ \t]*(.+)[ \t]*-[ \t]*(.+)",$lignes[$i],$resultat)):
			$troll_id = trim(htmlspecialchars($resultat[1]));
			$troll_nom = trim(addslashes($resultat[2]));
		endif;
		if(eregi('[ \t]*Race.+\.+:(.+)',$lignes[$i],$resultat)):
			$troll_race	= trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Date Limite d.+Action : (.+)[ \t]*(.+)',$lignes[$i],$resultat)):
   		    $troll_dla_en_cours = trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Il me reste (.+) PA',$lignes[$i],$resultat)):
			$troll_pa = trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Dur.+prochai.+:(.+)heures.+et(.+)minutes',$lignes[$i],$resultat)):
			$troll_dla_reel_hh	= trim($resultat[1]);
			$troll_dla_reel_mm	= trim($resultat[2]);
		endif;
		if(eregi('[ \t]*.+X =(.+) .+ Y = (.+) .+ N = (.+)',$lignes[$i],$resultat)):
			$troll_x = trim($resultat[1]);
			$troll_y = trim($resultat[2]);
			$troll_z = trim($resultat[3]);
		endif;
		if(eregi('[ \t]*.*Niveau.+:(.+)\(.+',$lignes[$i],$resultat)):
			$troll_niveau	= trim($resultat[1]);
		endif;

		if(eregi('[ \t]*Actuels\.+:[ \t]*(.+)',$lignes[$i],$resultat)):
			$troll_pv_act = trim($resultat[1]);
		endif;
		if(eregi('[ \t]*Maximum\.+:[ \t]*(.+)',$lignes[$i],$resultat)):
			$resultat = explode( " +", trim($resultat[1]) );
			if ( isset($resultat[1]) )
				$resultat[0] = $resultat[0] + $resultat[1];
			$troll_pv_max = $resultat[0];
		endif;
		
		if(eregi('[ \t]*Régénération.+Fatigue du Kastar.+:[ \t]*(.+).+\(',$lignes[$i],$resultat)):
			//La fatigue n'existe que si le troll est un Kastar
			if($troll_race=="Kastar") {
			  $troll_fatigue = trim($resultat[1]);
			}else{
			  $troll_fatigue = 0;
			}
		endif;
		
		if (eregi('[ \t]*Sorts[ \t]*', $lignes[$i], $resultat)):
		  $sorts=1;
		endif;
		if(eregi('[ \t]*(.+)\(niveau.+:(.+)%\)[ \t]*(.+)+\(niveau.+:(.+)%\)',$lignes[$i],$resultat)):
		  if ($sorts):
		      $troll_cs[$j][0] = trim($resultat[1]);
		      $troll_cs[$j][1] = trim($resultat[2]);
			  $j++; $nb_sorts++;
			  $troll_cs[$j][0] = trim($resultat[3]);
			  $troll_cs[$j][1] = trim($resultat[4]);
			  $j++; $nb_sorts++;
		  else:
		      $troll_cs[$j][0] = trim($resultat[1]);
		      $troll_cs[$j][1] = trim($resultat[2]);
			  $j++; $nb_comps++;
			  $troll_cs[$j][0] = trim($resultat[3]);
			  $troll_cs[$j][1] = trim($resultat[4]);
			  $j++; $nb_comps++;
		  endif;
		elseif(eregi('[ \t]*(.+)\(niveau.+:(.+)%\)',$lignes[$i],$resultat)):
		  if ($sorts):
			  $troll_cs[$j][0] = trim($resultat[1]);
			  $troll_cs[$j][1] = trim($resultat[2]);
			  $j++; $nb_sorts++;
		  else:
			  $troll_cs[$j][0] = trim($resultat[1]);
			  $troll_cs[$j][1] = trim($resultat[2]);
			  $j++; $nb_comps++;
		  endif;
		endif;
		$i++;
		}
		
    //MISE EN FORME DES DATES
    $jj_fin_dla = $troll_dla_en_cours[0].$troll_dla_en_cours[1];
	$mm_fin_dla = $troll_dla_en_cours[3].$troll_dla_en_cours[4];
	$aa_fin_dla = $troll_dla_en_cours[6].$troll_dla_en_cours[7].$troll_dla_en_cours[8].$troll_dla_en_cours[9];
	$hh_fin_dla = $troll_dla_en_cours[11].$troll_dla_en_cours[12];
	$min_fin_dla = $troll_dla_en_cours[14].$troll_dla_en_cours[15];
	
	//CALCULS DES DATES/HEURES DES DLA
	$fin_dla = mktime($hh_fin_dla,$min_fin_dla,0,$mm_fin_dla,$jj_fin_dla,$aa_fin_dla);
	$fin_next_dla = mktime($hh_fin_dla+$troll_dla_reel_hh,$min_fin_dla+$troll_dla_reel_mm,0,$mm_fin_dla,$jj_fin_dla,$aa_fin_dla);
	$fin_next2_dla = mktime($hh_fin_dla+2*$troll_dla_reel_hh,$min_fin_dla+2*$troll_dla_reel_mm,0,$mm_fin_dla,$jj_fin_dla,$aa_fin_dla);
    
    //UPLOAD DU PROFIL
    $date_maj = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$sql = "update ggc_troll set nom_troll = '$troll_nom',"
        . " niveau_troll = '$troll_niveau',"
        . " race = '$troll_race',"
        . " dla_en_cours = '$fin_dla',"
        . " dla_suivante = '$fin_next_dla',"
        . " dla_prevue = '$fin_next2_dla',"
        . " position_x = '$troll_x',"
        . " position_y = '$troll_y',"
        . " position_z = '$troll_z',"
        . " pv_actuel = '$troll_pv_act',"
        . " pv_max = '$troll_pv_max',"
        . " fatigue_kastar = '$troll_fatigue',"
        . " pa = '$troll_pa',"
        . " date_maj = '$date_maj' where id_troll = '$troll_id';";

    $requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
        
    //MISE A JOUR DE LA TABLE DES COMP
    //On commence par purger les infos pour ce troll
    $sql = "delete from ggc_comp where id_troll = '$troll_id';";
    $requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
    
    //Puis on charge 
    $chaine_comps="";
	for ($i=0; $i<$nb_comps; $i++) 
	{
	  //chargement des compétences
	  //echo $troll_cs[$i][0]." ".$troll_cs[$i][1]."<br>\n";
	  $sql = "insert into ggc_comp (id_troll,id_comp_sort,nom_comp_sort,pct_comp_sort,date_maj) values ('$id_troll',100+$i,'".$troll_cs[$i][0]."','".$troll_cs[$i][1]."','$date_maj')";
	  $requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	  $chaine_comps.=($i==0?"":", ").htmlspecialchars($troll_cs[$i][0], ENT_QUOTES)." (".$troll_cs[$i][1]."%)";
	}
    $chaine_sorts="";
    for ($i=$nb_comps; $i<($nb_comps+$nb_sorts); $i++) 
	{
	  //chargement des sorts
	  //echo $troll_cs[$i][0]." ".$troll_cs[$i][1]."<br>\n";	
	  $sql = "insert into ggc_comp (id_troll,id_comp_sort,nom_comp_sort,pct_comp_sort,date_maj) values ('$id_troll',200+$i,'".$troll_cs[$i][0]."','".$troll_cs[$i][1]."','$date_maj')";
	  $requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	  
	  $chaine_sorts.=($i==$nb_comps?"":", ").acronyme($troll_cs[$i][0])." (".$troll_cs[$i][1]."%)";
	}
    
    if($vtt=="vtt"){
    	//Affichage saisie vtt
    	AfficheConfirmation("Mise à jour du profil","Mise à jour du GGC réussie !","Le profil du Troll $troll_id est à jour !","" .
//    			"<form action='maj_vtt.php?id=".$id."' method='post'>" .
			"<form action='../vtt/completer_profil.php?id=".$id."' method='post'>" .

    					"<input type='hidden' name='copiercoller' value=\"$copiercoller\">" .
    					"<input type='submit' name='soumettre' value='Le VTT maintenant !' class='mh_form_submit'>" .
    					"</form>");
    }else{
    	//Affichage de la page de confirmation
		AfficheConfirmation("Mise à jour du profil","Mise à jour réussie !","Le profil du Troll $troll_id est à jour !","<a href=groupe.php?id=$id>Retourner voir le groupe</a>");
// var_dump($copiercoller);
//echo "<BR>";
//var_dump($lignes);



    }



    break;

/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU FORMULAIRE DE SAISIE DU PROFIL                    */
/*-----------------------------------------------------------------*/
    default:

    echo "<center>\n";
	echo "<H1>Mise à jour des informations de<br>".htmlspecialchars(stripslashes($nom_troll))."</H1>\n";
	echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
	echo "<form action='maj_profil.php?id=".$id."' method='post'>";
	echo "<input type='hidden' name='action' value='add'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' >Données MH<br>Faire un copier coller de son profil MH</A></TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'>";
	echo "&nbsp;<br><textarea rows='10' cols='75' name='copiercoller' class='mh_selectbox'></textarea><br>&nbsp;";
	echo "&nbsp;<br><INPUT TYPE='submit' NAME='soumettre' VALUE='On parse le zinzin...' CLASS='mh_form_submit'><br>&nbsp;";
	echo "<br><em>Si vous voulez mettre à jour le VTT cochez la pitite case :</em> <input type=\"checkbox\" name=\"vtt\" value=\"vtt\"><br>";
	echo "<br><a href='groupe.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour' border='0'></a><br>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "</form>";
	echo "</table>";
	echo "</td></tr>";
	echo "</table>";
    echo "</center>\n";
    
    break;

}

/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();
mysql_close($db_link);

?>
