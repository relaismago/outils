<?php

/*---------------------------------------------------------------*/
/*                 FONCTIONS D'AFFICHAGE                         */
/*---------------------------------------------------------------*/

function AfficheErreur($titre,$message_erreur) {
//Affiche le message d'erreur lors de problèmes de saisie des formulaires
	echo "<center>\n";
	echo "<H1>$titre</H1>\n";
	echo "<br><table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' ><b>Erreur !</b></TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'>";
	echo "<br>$message_erreur<br><br>";
	echo "<br><a href=\"javascript:window.history.back()\">Retour</a><br>";	
	echo "</td>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td align='center'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr class='mh_tdtitre'>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "</table>";
	echo "</td></tr>";
	echo "</table>";
}

function AfficheConfirmation($titre,$texte1,$texte2,$renvoi){
//Affiche une page de confirmation de validation du formulaire
	echo "<center>\n";
	echo "<H1>$titre</H1>\n";
	echo "<br><table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' ><b>$texte1</b></TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'>";
	echo "<br>$texte2<br><br>";
	echo "<br>$renvoi<br>";
	echo "<br><br>";	
	echo "</td>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<TD align='center'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr class='mh_tdtitre'>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "</table>";
	echo "</td></tr>";
	echo "</table>";
}

function AfficheTitre($titre) {
//Affiche un titre dans un tableau (utilisé que dans la page groupe pour l'instant)
echo "<table width=\"100%\" class='mh_tdborder'>\n";
echo "	<tr>\n";
echo "    <td class='mh_tdpage' align='center'><H1>".stripslashes($titre)."</H1></td>\n";
echo "	</tr>\n";
echo "</table>\n";
}

function AffichePied($texte){
//Affiche un pied dans un tableau (utilisé que dans la page groupe pour l'instant)
echo "		<table width=\"100%\" class='mh_tdborder'>\n";
echo "			<tr>\n";
echo "				<td class='mh_tdpage' align='center'>$texte</td>\n";
echo "			</tr>\n";
echo "		</table>\n";
}

function Affiche_stats($nb_troll,$nb_monstre,$nb_pehiks) {
//Affiche les statistiques du groupe de chasse
echo "<table width=\"100%\" class='mh_tdborder'>\n";
echo "  <tr>\n";
echo "    <td class='mh_tdpage' align='center'>\n";
echo "    <br>\n";
echo "    Nb de membres : <b>".$nb_troll."</b><br>\n";
echo "    Nb monstres tués : <b>".$nb_monstre."</b><br>\n";
echo "    Nb péhiks gagnés : <b>".$nb_pehiks."</b><br>\n";
echo "    &nbsp;\n";
echo "    </td>\n";
echo "  </tr>\n";
echo "</table>\n";
}

function AfficheGraphTroll ($date,$nom,$id_troll,$niveau,$race,$dla,$dla_next,$dla_next2,$pos_x,$pos_y,$pos_z,$vie_act,$vie_max,$avatar,$pa){
//Affiche une tablea qui contient toutes les infos du trolls 
echo "<table width=\"800\" height=\"55\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"55\" height=\"55\"><img src='".$avatar."_avatar.gif' width=\"54\" height=\"54\"></td>\n";
echo "    <td width=\"200\" height=\"55\">\n";
echo "		<table width=\"100%\" height=\"55\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "			<tr>\n";
echo "				<td width=\"10%\" height=\"55\">&nbsp;</td>\n";
echo "				<td width=\"90%\" height=\"55\">\n";
echo "	  				<b>$nom</b> - (PV : $vie_act/$vie_max)<br>\n";
echo "	  				<b>$id_troll</b> - $race - $niveau <br>\n";
echo "	  				X=$pos_x | Y=$pos_y | N=$pos_z \n";
echo "				</td>\n";
echo "			</tr>\n";
echo "		</table>\n";
echo "    </td>\n";
echo "    <td width=\"400\" height=\"55\"><img src=\"graph.php?date=$date&dla=$dla&dla2=$dla_next&dla3=$dla_next2&pa=$pa\">\n"; //page qui génère l'image des DLAs
echo "    </td>\n";
echo "    <td width=\"105\" height=\"55\" align='center'>\n";
echo 	   "DLA -".date("j/m à H:i",$dla)."<br>\n";
echo 	   "DLA2-".date("j/m à H:i",$dla_next)."<br>\n";
echo 	   "DLA3-".date("j/m à H:i",$dla_next2)."<br>\n";
echo "    </td>\n";
echo "  </tr>\n";
echo "</table>\n";
}

function AfficheGraphAxe($date) {
//Affiche l'axes temps
echo "<table width=\"800\" height=\"55\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"55\" height=\"55\">&nbsp;</td>\n";
echo "    <td width=\"200\" height=\"55\">&nbsp;</td>\n";
echo "    <td width=\"400\" height=\"55\"><br><img src=\"graph_axe.php?date=$date&id=$id\">\n"; //page qui génère l'image de l'axe
echo "    <td width=\"105\" height=\"55\">&nbsp;</td>\n";
echo "    </td>\n";
echo "  </tr>\n";
echo "</table>\n";
}

function AfficheMonstre($id_connec,$id,$nom,$req_evt,$pos_monstre,$pv) {
//Affiche toutes les information d'un monstre
echo "<table width=\"755\" height=\"100\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class='mh_tdborder_trans'>\n";
echo "  <tr>\n";
echo "    <td width=\"55\" height=\"100\" align=\"center\"><img src=\"images/avatar_monstre.gif\" width=\"46\" height=\"55\"></td>\n";
echo "    <td width=\"150\" height=\"100\">\n";
echo "		<table width=\"100%\" height=\"100\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "			<tr>\n";
echo "				<td width=\"10%\" height=\"100\">&nbsp;</td>\n";
echo "				<td width=\"90%\" height=\"100\">\n";
echo "	  				<b>$nom</b> ($id)<br>\n";
echo "	  				<em>Dégats : $pv</em><br><br>$pos_monstre\n";
echo "				</td>\n";
echo "			</tr>\n";
echo "		</table>\n";
echo "    </td>\n";
echo "    <td width=\"445\" height=\"100\">\n";
AfficheTableauEvt($req_evt);
echo "    </td>\n";
echo "    <td width=\"105\" height=\"100\" align='center'>\n";
echo "		<a href=\"ajout_evt.php?id_monstre=$id\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('ajout_evt.$id','','images/ajout_evt_over.gif',1)\"><img src=\"images/ajout_evt.gif\" name=\"ajout_evt.$id\" border=\"0\"></a>";
echo "		<a href=\"histo_evt.php?id_monstre=$id\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('voir_histo.$id','','images/voir_histo_over.gif',1)\"><img src=\"images/voir_histo.gif\" name=\"voir_histo.$id\" border=\"0\"></a>";
echo "    </td>\n";
echo "    </td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "<br>";
}

function AfficheTableauEvt($req_evt){
//Affiche les 3 derniers évênements d'un monstre (passés sous forme de requete)
echo "<table width=\"445\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"80\" height=\"25\" align=\"center\"><b>Date</b></td>\n";
echo "    <td width=\"35\" height=\"25\" align=\"center\"><b>Troll</b></td>\n";
echo "    <td width=\"40\" height=\"25\" align=\"center\"><b>Type</b></td>\n";
echo "    <td width=\"295\" height=\"25\" align=\"center\"><b>Description</b></td>\n";
echo "    </td>\n";
echo "  </tr>\n";
	$color="#48548D";
	while($evt=mysql_fetch_array($req_evt, MYSQL_NUM)) {
		echo "  <tr bgcolor=$color>\n";
		echo "    <td width=\"80\" height=\"25\">".date("j/m à H:i",$evt[0])."</td>\n";
		echo "    <td width=\"35\" height=\"25\" align=\"center\">$evt[3]</td>\n";
		echo "    <td width=\"40\" height=\"25\" align=\"center\">$evt[1]</td>\n";
		echo "    <td width=\"295\" height=\"25\">".stripslashes($evt[2])."</td>\n";
		echo "  </tr>\n";	
		if($color=="#48548D") {$color="#30385C";} else {$color="#48548D";}
	}
echo "</table>\n";
}

function AfficheHisto($requete){
//Affiche la page d'historique des évènements d'un monstre
echo "<table width='80%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
echo "<tr valign='middle'>";
echo "<td height='60' width='100%' align='center'><img src=\"images/voir_histo_black.gif\" border=\"0\"></TD>";
echo "</tr>";
echo "<tr valign='middle' class='mh_tdpage'>";
echo "<td width='100%' align='center'>";
AfficheHistoEvt($requete);
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='right'><a href=\"#haut\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('up','','images/up_over.gif',1)\"><img src=\"images/up.gif\" name=\"up\" border=\"0\"></a></td>";
echo "</tr>";
echo "</table>";
echo "</td></tr>";
echo "</table>";
}

function AfficheHistoEvt($requete){
//Affiche la table contenant tous les évènements d'un monstre
echo "<table width=\"700\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"100\" height=\"25\" align=\"center\"><b>Date</b></td>\n";
echo "    <td width=\"100\" height=\"25\" align=\"center\"><b>Troll</b></td>\n";
echo "    <td width=\"70\" height=\"25\" align=\"center\"><b>Type</b></td>\n";
echo "    <td width=\"400\" height=\"25\" align=\"center\"><b>Description</b></td>\n";
echo "    <td width=\"30\" height=\"25\" align=\"center\"><b>PV</b></td>\n";
echo "    </td>\n";
echo "  </tr>\n";
 $color="#48548D";
 while($evt=mysql_fetch_array($requete, MYSQL_NUM)) {
  echo "  <tr bgcolor=$color>\n";
  echo "    <td width=\"100\" height=\"25\" align=\"center\">".date("j/m à H:i",$evt[1])."</td>\n";
  echo "    <td width=\"100\" height=\"25\" align=\"center\">".stripslashes($evt[5])." ($evt[0])</td>\n";
  echo "    <td width=\"70\" height=\"25\" align=\"center\">$evt[2]</td>\n";
  echo "    <td width=\"400\" height=\"25\" align=\"center\">[$evt[6]] : ".stripslashes($evt[3])."</td>\n";
  echo "    <td width=\"30\" height=\"25\" align=\"center\">$evt[4]</td>\n";
  echo "  </tr>\n"; 
  if($color=="#48548D") {$color="#30385C";} else {$color="#48548D";}
 }
echo "</table>\n";
}


function AfficheEnTete($titre,$files){
//Afficge l'entête de la page HTML avec le javascript
require("conf.php");
echo "<html>\n";
echo "<head>\n";
echo "<meta>\n";
echo "<title>$titre</title>\n";
echo "<link rel='stylesheet' href='$css' type='text/css'>\n";
// Javascript pour l'affichage des boutons 
echo "<script language=\"JavaScript\" type=\"text/JavaScript\">\n";
echo "<!--\n";
echo "function MM_swapImgRestore() {\n";
echo "  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;\n";
echo "}\n";
echo "function MM_preloadImages() {\n";
echo "  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();\n";
echo "    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)\n";
echo "    if (a[i].indexOf(\"#\")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}\n";
echo "}\n";
echo "function MM_findObj(n, d) {\n";
echo "  var p,i,x;  if(!d) d=document; if((p=n.indexOf(\"?\"))>0&&parent.frames.length) {\n";
echo "    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}\n";
echo "  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];\n";
echo "  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);\n";
echo "  if(!x && d.getElementById) x=d.getElementById(n); return x;\n";
echo "}\n";
echo "function MM_swapImage() {\n";
echo "  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)\n";
echo "   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";
echo "</head>\n";
echo "<body onLoad=\"MM_preloadImages($files)\">\n";
}

function AfficheBasPage (){
//Affiche le bas de page ... possibilité d'ajouter des chose avant la balise /body
echo "</body>\n";
echo "</html>\n";
}


function acronyme($chaine){
  if (eregi('Analyse.+', $chaine, $trash))        {return "AA";}
  if (eregi('Armure.+', $chaine, $trash))         {return "AE";}
  if (eregi('.+Attaque', $chaine, $trash))        {return "AdA";}
  if (eregi('.+D.g.ts', $chaine, $trash))         {return "AdD";}
  if (eregi('.+Esquive', $chaine, $trash))        {return "AdE";}
  if (eregi('.+Magie', $chaine, $trash))          {return "BAM";}
  if (eregi('Explosion', $chaine, $trash))        {return "Explo";}
  if (eregi('Faiblesse.+', $chaine, $trash))      {return "FP";}
  if (eregi('Flash.+', $chaine, $trash))          {return "Flash";}
  if (eregi('Glue', $chaine, $trash))             {return "Glue";}
  if (eregi('Griffe.+', $chaine, $trash))         {return "GdS";}
  if (eregi('Hypnotisme', $chaine, $trash))       {return "Hypno";}
  if (eregi('Identification.+', $chaine, $trash)) {return "IdT";}
  if (eregi('Invisibilit.+', $chaine, $trash))    {return "Invisi";}
  if (eregi('Projectile.+', $chaine, $trash))     {return "PM";}
  if (eregi('Projetion', $chaine, $trash))        {return "Projection";}
  if (eregi('Rafale.+', $chaine, $trash))         {return "RP";}
  if (eregi('Sacrifice', $chaine, $trash))        {return "Sacrifice";}
  if (eregi('Vampirisme', $chaine, $trash))       {return "Vampi";}
  if (eregi('Voir.+', $chaine, $trash))           {return "VdC";}
  if (eregi('T.l.portation', $chaine, $trash))    {return "TP";}
  if (eregi('T.l.kin.sie', $chaine, $trash))      {return "T&eacte;l&eacute;kin&eacute;sie";}
  if (eregi('.+Accrue', $chaine, $trash))         {return "VA";}
  if (eregi('.+Loitaine', $chaine, $trash))       {return "VL";}
  if (eregi('Vue.+', $chaine, $trash))            {return "VT";}
  
  return htmlspecialchars($chaine, ENT_QUOTES);
} 

?>
