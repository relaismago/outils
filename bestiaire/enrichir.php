<?
include_once('../inc_connect.php3');
include_once('../inc_authent.php3');
?>

<html>
<head>
<title>Envoyer un Descriptif</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body bgcolor="#30395D" text="#000000" scrollbars="yes" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<center>
<?php if (empty($submit)) { ?>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <table width="600" border="0" cellspacing="1" bgcolor="#000000">
      <caption>
      <font color="#FFFFFF" size="+1"><b><em>MONSTRE :</em></b></font> 
      </caption>
      <tr align="center"> 
        <th align="center" width="600" bgcolor="#F75007"><font size="+1">NOM</font></th>
      </tr>
      <tr align="center"> 
        <th bgcolor="#B7B7DB"><INPUT size=50 name="NOM"></th>
      </tr>
    </table>
    <br>
    <br>
    <table width="700" border="0" cellspacing="1" bgcolor="#000000">
      <caption>
      <font color="#FFFFFF" size="+1"><b><em>Caractéristiques Principales :</em></b></font> 
      </caption>
      <tr align="center"> 
        <th width="150" bgcolor="#F32394"><font size="+1">NIVEAU</font></th>
        <th width="200" bgcolor="#F32394"><font size="+1">ATTAQUES / DLA</font></th>
        <th width="150" bgcolor="#F32394"><font size="+1">DUREE DLA</font></th>
        <th width="150" bgcolor="#F32394"><font size="+1">FAMILLE</font></th>
      </tr>
      <tr align="center"> 
        <th bgcolor="#B7B7DB"><INPUT size=10 name="NIVEAU"></th>
        <th bgcolor="#B7B7DB"><select name="ATTDLA">
            <option selected value="?"></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="6">6</option>
          </select></th>
        <th bgcolor="#B7B7DB"><select name="DLA">
            <option selected value="?"></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
          </select></th>
        <th bgcolor="#B7B7DB"><select name="FAMILLE">
            <option selected value="?"></option>
            <option value="Animal">ANIMAL</option>
            <option value="Démon">DEMON</option>
            <option value="Humanoïde">HUMANOIDE</option>
            <option value="Insecte">INSECTE</option>
            <option value="Monstre">MONSTRE</option>
            <option value="Mort-Vivant">MORT-VIVANT</option>
            <option value="Spécial">SPECIAL</option>
          </select></th>
      </tr>
    </table>
    <br>
    <table width="700" border="0" cellspacing="1" bgcolor="#000000">
      <caption>
      <font color="#FFFFFF" size="+1"><b><em>Caractéristiques Physiques :</em></b></font> 
      </caption>
      <tr align="center"> 
        <th align="center" width="100" bgcolor="#1AC611">PV</th>
        <th align="center" width="100" bgcolor="#1AC611">Attaque</th>
        <th align="center" width="100" bgcolor="#1AC611">Esquive</th>
        <th align="center" width="100" bgcolor="#1AC611">Dégâts</th>
        <th align="center" width="100" bgcolor="#1AC611">Régénération</th>
        <th align="center" width="100" bgcolor="#1AC611">Armure</th>
        <th align="center" width="100" bgcolor="#1AC611">Vue</th>
      </tr>
      <tr align="center"> 
        <th bgcolor="#B7B7DB"><select name="PV"><option selected value="?"></option><option value="< 20">< 20</option><option value="20-40">20-40</option><option value="40-60">40-60</option><option value="60-80">60-80</option><option value="80-100">80-100</option><option value="> 100">> 100</option><option value="100-120">100-120</option><option value="120-140">120-140</option><option value="140-160">140-160</option><option value="160-180">160-180</option><option value="180-200">180-200</option><option value="> 200">> 200</option></select></th>
        <th bgcolor="#B7B7DB"><select name="ATT"><option selected value="?"></option><option value="< 2">< 2</option><option value="2-4">2-4</option><option value="4-6">4-6</option><option value="6-8">6-8</option><option value="8-10">8-10</option><option value="> 10">> 10</option><option value="10-12">10-12</option><option value="12-14">12-14</option><option value="14-16">14-16</option><option value="16-18">16-18</option><option value="18-20">18-20</option><option value="> 20">> 20</option></select></th>
        <th bgcolor="#B7B7DB"><select name="ESQ"><option selected value="?"></option><option value="< 2">< 2</option><option value="2-4">2-4</option><option value="4-6">4-6</option><option value="6-8">6-8</option><option value="8-10">8-10</option><option value="> 10">> 10</option><option value="10-12">10-12</option><option value="12-14">12-14</option><option value="14-16">14-16</option><option value="16-18">16-18</option><option value="18-20">18-20</option><option value="> 20">> 20</option></select></th>
        <th bgcolor="#B7B7DB"><select name="DEG"><option selected value="?"></option><option value="< 2">< 2</option><option value="2-4">2-4</option><option value="4-6">4-6</option><option value="6-8">6-8</option><option value="8-10">8-10</option><option value="> 10">> 10</option><option value="10-12">10-12</option><option value="12-14">12-14</option><option value="14-16">14-16</option><option value="16-18">16-18</option><option value="18-20">18-20</option><option value="> 20">> 20</option></select></th>
        <th bgcolor="#B7B7DB"><select name="REG"><option selected value="?"></option><option value="1-2">1-2</option><option value="2-3">2-3</option><option value="3-4">3-4</option><option value="4-5">4-5</option><option value="> 5">> 5</option><option value="5-6">5-6</option><option value="6-7">6-7</option><option value="7-8">7-8</option><option value="8-9">8-9</option><option value="9-10">9-10</option><option value="> 10">> 10</option></select></th>
        <th bgcolor="#B7B7DB"><select name="ARM"><option selected value="?"></option><option value="< 2">< 2</option><option value="2-4">2-4</option><option value="4-6">4-6</option><option value="6-8">6-8</option><option value="8-10">8-10</option><option value="> 10">> 10</option><option value="10-12">10-12</option><option value="12-14">12-14</option><option value="14-16">14-16</option><option value="16-18">16-18</option><option value="18-20">18-20</option><option value="> 20">> 20</option></select></th>
        <th bgcolor="#B7B7DB"><select name="VUE"><option selected value="?"></option><option value="< 2">< 2</option><option value="2-4">2-4</option><option value="4-6">4-6</option><option value="6-8">6-8</option><option value="8-10">8-10</option><option value="> 10">> 10</option><option value="10-12">10-12</option><option value="12-14">12-14</option><option value="14-16">14-16</option><option value="16-18">16-18</option><option value="18-20">18-20</option><option value="> 20">> 20</option></select></th>
      </tr>
    </table>
    <br>
<?
if ($PV == '<20'){ echo "Coucou 0-20\n";}
	
?>    <br>
    <table width="950" border="0" cellspacing="1" bgcolor="#000000">
      <caption>
      <font color="#FFFFFF" size="+1"><b><em>Caractéristiques Magiques :</em></b></font> 
      </caption>
    <tr align="center">
      <th align="center" width="150" bgcolor="#18D5BD">POUVOIR</th>
      <th align="center" width="200" bgcolor="#18D5BD">Description</th>
      <th align="center" width="150" bgcolor="#C33FC2">Durée Malus</th>
      <th align="center" width="200" bgcolor="#C33FC2">Portée (Cases et Niveaux)</th>
      <th align="center" width="150" bgcolor="#C33FC2">Séparé de l'Attaque</th> <!-- ' -->
      <th align="center" width="100" bgcolor="#C33FC2">Effet de Zone</th>
    </tr>
      <tr align="center"> 
        <th bgcolor="#B7B7DB"><INPUT size=20 name="POUVOIR"></th>
        <th bgcolor="#B7B7DB"><INPUT size=20 name="MALUS"></th>
        <th bgcolor="#B7B7DB"><select name="DUREE">
            <option selected value="?"></option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option></th>
        <th bgcolor="#B7B7DB"><table><tr><th bgcolor="#B7B7DB"><select name="DIST1"><option selected value="?"></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option></select></th>
        <th bgcolor="#B7B7DB"><select name="DIST2"><option selected value="?"></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option></select></th></tr></table></th>
        <th bgcolor="#B7B7DB"><select name="SEP"><option selected value="?"></option><option value="Auto">OUI</option><option value="Normal">NON</option></select></th>
        <th bgcolor="#B7B7DB"><select name="ZON"><option selected value="?"></option><option value="Zone">OUI</option><option value="Normal">NON</option></select></th>
      </tr>
    </table>
    <br>
    <table width="650" border="0" cellspacing="1" bgcolor="#000000">
    <tr align="center">
      <th align="center" width="200" bgcolor="#18D5BD">RM</th>
      <th align="center" width="200" bgcolor="#18D5BD">MM</th>
    </tr>
      <tr align="center"> 
        <th bgcolor="#B7B7DB"><INPUT size=10 name="RM"></th>
        <th bgcolor="#B7B7DB"><INPUT size=10 name="MM"></th>
      </tr>
    </table>
    <br>
    <table width="950" border="0" cellspacing="1" bgcolor="#000000">
    <tr align="center">
      <th align="center" width="150" bgcolor="#18D5BD">2e POUVOIR (mort)</th>
      <th align="center" width="200" bgcolor="#18D5BD">Description</th>
      <th align="center" width="150" bgcolor="#C33FC2">Durée Malus</th>
      <th align="center" width="200" bgcolor="#C33FC2">Portée (Cases et Niveaux)</th>
      <th align="center" width="150" bgcolor="#C33FC2">Séparé de l'Attaque</th> <!-- ' -->
      <th align="center" width="100" bgcolor="#C33FC2">Effet de Zone</th>
    </tr>
      <tr align="center"> 
        <th bgcolor="#B7B7DB"><INPUT size=20 name="POUVOIR2"></th>
        <th bgcolor="#B7B7DB"><INPUT size=20 name="MALUS2"></th>
        <th bgcolor="#B7B7DB"><select name="DUREE2">
            <option selected value="?"></option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option></th>
        <th bgcolor="#B7B7DB"><table><tr><th bgcolor="#B7B7DB"><select name="DIST21"><option selected value="?"></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option></select></th>
        <th bgcolor="#B7B7DB"><select name="DIST22"><option selected value="?"></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option></select></th></tr></table></th>
        <th bgcolor="#B7B7DB"><select name="SEP2"><option selected value="?"></option><option value="Auto">OUI</option><option value="Normal">NON</option></select></th>
        <th bgcolor="#B7B7DB"><select name="ZON2"><option selected value="?"></option><option value="Zone">OUI</option><option value="Normal">NON</option></select></th>
      </tr>
    </table>
    <br>
<input type="reset" value="Effacer" name="reset">
<input type="submit" value="Envoyer --&gt;" name="submit">
</form>
</center>
<?php
}
else { // Sinon, lorsque submit est défini
die("soumission"); 
?>
<h3>Veuillez v&eacute;rifier les donn&eacute;es saisies</h3>

<?php
if ($NIVEAU == '') { $NIVEAU = '?';}
if ($POUVOIR == '') { $POUVOIR = '?';}
if ($MALUS == '') { $MALUS = '?';}
if ($POUVOIR2 == '') { $POUVOIR2 = '?';}
if ($MALUS2 == '') { $MALUS2 = '?';}
if ($MM == '') { $MM = '?';}
if ($RM == '') { $RM = '?';}

echo "<b>NOM :</b> $NOM<br><br>\n\n";
echo "<b>Niveau :</b> $NIVEAU<br>\n";
echo "<b>Nombre Attaques / DLA :</b> $ATTDLA<br>\n";
echo "<b>Durée DLA :</b> $DLA<br>\n";
echo "<b>Famille :</b> $FAMILLE<br><br>\n\n";
echo "<b>PV :</b> $PV<br>\n";
echo "<b>Attaque :</b> $ATT<br>\n";
echo "<b>Esquive :</b> $ESQ<br>\n";
echo "<b>Dégâts :</b> $DEG<br>\n";
echo "<b>Régénération :</b> $REG<br>\n";
echo "<b>Armure :</b> $ARM<br>\n";
echo "<b>Vue :</b> $VUE<br><br>\n\n";
echo "<b>Pouvoir :</b> $POUVOIR<br>\n";
echo "<b>Description du Pouvoir Spécial :<br>\n</b> $MALUS<br><br>\n\n";
echo "<b>Durée du Malus :</b> $DUREE<br>\n";
echo "<b>Portée (cases):</b> $DIST1<br>\n";
echo "<b>Portée (niveaux):</b> $DIST2<br><br>\n\n";
echo "<b>Séparé de l'attaque :</b> $SEP<br>\n";
echo "<b>Effet de Zone :</b> $ZON<br><br>\n\n";
echo "<b>MM :</b> $MM<br>\n";
echo "<b>RM :</b> $RM<br><br>\n\n";
echo "<b>2e Pouvoir (mort) :</b> $POUVOIR2<br>\n";
echo "<b>Description du 2e Pouvoir :<br>\n</b> $MALUS2<br><br>\n\n";
echo "<b>Durée du Malus :</b> $DUREE2<br>\n";
echo "<b>Portée (cases):</b> $DIST21<br>\n";
echo "<b>Portée (niveaux):</b> $DIST22<br><br>\n\n";
echo "<b>Séparé de l'attaque :</b> $SEP2<br>\n";
echo "<b>Effet de Zone :</b> $ZON2<br><br>\n\n";

echo "<b>Les informations sont-elles correctes ?</b></p>\n";

// Les données saisies par l'utilisateur sont stockées dans un champ :
$message="NOM : $NOM\n\nNiveau : $NIVEAU\nATTDLA : $ATTDLA\n\nPV : $PV\nATT : $ATT\nESQ : $ESQ\nDEG : $DEG\nREG : $REG\nARM : $ARM\nVUE : $VUE\n\nMM : $MM\nRM : $RM\nPouvoir : $POUVOIR\nMalus : $MALUS\nPortée (cases): $DIST1 (niveaux): $DIST2\nDuree : $DUREE\nSepare : $SEP\nZone : $ZON\n\n2e Pouvoir : $POUVOIR2\nMalus : $MALUS2\nPortée (cases): $DIST21 (niveaux): $DIST22\nDuree : $DUREE2\nSepare : $SEP2\nZone : $ZON2\nDLA : $DLA\nFAMILLE : $FAMILLE\n\nTROLL : $pseudo ($numero_troll)\n";
$message=htmlspecialchars($message); // On ignore les caractères spéciaux
$message=stripslashes($message); // On supprime les backslash

// Génération du nouveau formulaire pour le transfert au script d'envoi de l'email
echo "<form action=\"ajouter.php\" method=\"post\">\n";

// Astuce : transfert via des champs de formulaire cachés :
echo "<input type=\"hidden\" name=\"NOM\" value=\"$NOM\">\n";
echo "<input type=\"hidden\" name=\"ATTDLA\" value=\"$ATTDLA\">\n";
echo "<input type=\"hidden\" name=\"NIVEAU\" value=\"$NIVEAU\">\n";
echo "<input type=\"hidden\" name=\"PV\" value=\"$PV\">\n";
echo "<input type=\"hidden\" name=\"ATT\" value=\"$ATT\">\n";
echo "<input type=\"hidden\" name=\"ESQ\" value=\"$ESQ\">\n";
echo "<input type=\"hidden\" name=\"DEG\" value=\"$DEG\">\n";
echo "<input type=\"hidden\" name=\"REG\" value=\"$REG\">\n";
echo "<input type=\"hidden\" name=\"ARM\" value=\"$ARM\">\n";
echo "<input type=\"hidden\" name=\"VUE\" value=\"$VUE\">\n";
echo "<input type=\"hidden\" name=\"MM\" value=\"$MM\">\n";
echo "<input type=\"hidden\" name=\"RM\" value=\"$RM\">\n";
echo "<input type=\"hidden\" name=\"POUVOIR\" value=\"$POUVOIR\">\n";
echo "<input type=\"hidden\" name=\"MALUS\" value=\"$MALUS\">\n";
echo "<input type=\"hidden\" name=\"DUREE\" value=\"$DUREE\">\n";
echo "<input type=\"hidden\" name=\"DIST1\" value=\"$DIST1\">\n";
echo "<input type=\"hidden\" name=\"DIST2\" value=\"$DIST2\">\n";
echo "<input type=\"hidden\" name=\"SEP\" value=\"$SEP\">\n";
echo "<input type=\"hidden\" name=\"ZON\" value=\"$ZON\">\n";
echo "<input type=\"hidden\" name=\"POUVOIR2\" value=\"$POUVOIR2\">\n";
echo "<input type=\"hidden\" name=\"MALUS2\" value=\"$MALUS2\">\n";
echo "<input type=\"hidden\" name=\"DUREE2\" value=\"$DUREE2\">\n";
echo "<input type=\"hidden\" name=\"DIST21\" value=\"$DIST21\">\n";
echo "<input type=\"hidden\" name=\"DIST22\" value=\"$DIST22\">\n";
echo "<input type=\"hidden\" name=\"SEP2\" value=\"$SEP2\">\n";
echo "<input type=\"hidden\" name=\"ZON2\" value=\"$ZON2<br>>\n";
echo "<input type=\"hidden\" name=\"DLA\" value=\"$DLA\">\n";
echo "<input type=\"hidden\" name=\"FAMILLE\" value=\"$FAMILLE\">\n";
echo "<input type=\"hidden\" name=\"message\" value=\"$message\">\n";
echo "<input type=\"button\" value=\"&lt;-- Non, je veux corriger\" onclick=\"self.history.back()\">\n";
echo "<input type=\"submit\" name=\"valider\" value=\"Ok je veux envoyez --&gt;\"></form>\n";
}
?>
</font></td>
    </tr>

</table>
</center></div>
</body>
</html>
