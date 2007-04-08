<?

include_once('inc_connect.php3');
include_once('admin_functions_db.php3');


init_trombinoscope();

function init_trombinoscope()
{
	afficheTrombiHead();
	view_all();
	afficheTrombiBottom();
}


function view_all()
{

	$type = $_REQUEST[type];

	if ($type != "")
		$path = "images/avatars/cache";
	else
		$path = "http://www.pipeshow.net/RM";
		
  $lesTrolls = selectDbTrolls("","trombinoscope");
  $nbTrolls = count($lesTrolls);

	$flag=false;
	$flag_pnj=false;
	
  for($i=1;$i<=$nbTrolls;$i++) {
    $res = $lesTrolls[$i];

		if ($j==6) {
			echo "<br>";
			$j=0;
		}

		if (!$flag) {
			if ($num_rang_troll != $res[num_rang_troll]) {
				$num_rang_troll = $res[num_rang_troll];
				$nom_rang_troll = $res[nom_rang_troll];
				$nom_image_titre_distinction = $res[nom_image_titre_distinction];

				if ($i != 1) {
					echo "</td></tr></table>";
				}

				if ($num_rang_troll == 14)
					echo '<br><img src="http://www.pipeshow.net/RM/avatars/Trombinoscope_rangs1.gif"><br>';
				elseif ($num_rang_troll == 7)
					echo '<br><img src="http://www.pipeshow.net/RM/avatars/Trombinoscope_niveaux1.gif"><br>';

				echo "<br><br><h2>".$nom_rang_troll."</h2>";//<img src='$nom_image_titre_distinction'>";

				echo "<table>";
				echo "<tr><td align=center>";

				$j=0;
			}
		}
		$j++;
    echo "<img alt=\"[".addslashes($res[nom_troll])."]\"";
		echo " src='$path/avatars/$res[nom_image_troll]_avatar_bleu.gif' ".afficheInfosTroll($res).">";
		
		/* PNJ ayant perdu les trolls */
		if ($num_rang_troll == 10 && !$flag_pnj) {
			$res[nom_troll] = "Tackianosaurus";
			$res[nom_image_troll] = "Tackianosaurus";
			$res[nom_rang_troll] = "Monument de la Guilde (PNJ)";
			$res[race_troll] = "Skrim";

			echo "<img alt=\"[".addslashes($res[nom_troll])."]\"";
			echo " src='$path/avatars/$res[nom_image_troll]_avatar_bleu.gif' ".afficheInfosTroll($res).">";

			$res[nom_troll] = "Kkwet";
			$res[nom_image_troll] = "Kkwet";
			$res[nom_rang_troll] = "Monument de la Guilde (PNJ)";
			$res[race_troll] = "Durakuir";
			echo "<img alt=\"[".addslashes($res[nom_troll])."]\"";
			echo " src='$path/avatars/$res[nom_image_troll]_avatar_bleu.gif' ".afficheInfosTroll($res).">";

			$res[nom_troll] = "Bollocks Le TransplantÃ©";
			$res[nom_image_troll] = "Bollocks";
			$res[nom_rang_troll] = "Monument de la Guilde (PNJ)";
			$res[race_troll] = "Kastar";

			echo "<img alt=\"[".addslashes($res[nom_troll])."]\"";
			echo " src='$path/avatars/$res[nom_image_troll]_avatar_bleu.gif' ".afficheInfosTroll($res).">";

			$flag_pnj = true;
		}
  }
	echo "<br><hr>";
	echo "<br><br><h2>Anciens Blasons</h2>";
	affiche_ancien_blasons();
}



function afficheTrombiHead(){

include_once('top.php');
?>

<DIV class=popperlink id=topdecklink></DIV>
<SCRIPT language="JavaScript" src="vue.js" type="text/javascript">
</SCRIPT>

<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  <tbody><tr>
    <td align="center" valign="middle"><div align="center">
      <br>
      <table bgcolor="#343A5C" border="3" bordercolor="#fbba2c" cellpadding="10" cellspacing="0" width="90%">
        <tbody><tr>
          <td><div align="center">
            <p><br>
              <img src="http://www.pipeshow.net/RM/avatars/Trombinoscope_titre1.gif"><br>
							<i>Attendez que la page soit totalement chargée pour passer la souris sur les têtes.</i><br>
              <img src="images/trombinoscope/Trombinoscope_legende_class.gif"><br>
              <br>
              <img src="http://www.pipeshow.net/RM/avatars/Trombinoscope_conseil1.gif"> 
<?
}

function afficheTrombiBottom()
{
?>
					</td>
        </tr>
      </tbody></table>
      <br>
    </div></td>
  </tr>
</tbody></table>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1451857-2";
urchinTracker();
</script>
</body></html>
<?
}

function afficheInfosTroll($res)
{
	$img = "http://www.pipeshow.net/RM/".$res[nom_image_troll].".gif";
//  echo "onMouseOver=\"poplink('";
  $text .= "<center><font color=red>".addslashes($res[nom_troll])." N°$res[id_troll]</font></center><br>";
  $text .= "<font color=white>Niveau : <b>$res[niveau_troll]</b><br>";
  $text .= "Race : <b>$res[race_troll]</b><br>";
  $text .= "Rang Officiel : <b>".addslashes($res[nom_rang_troll])."</b><br></font>";
	$text .= "<img src=$img>";

  echo " onmouseover=\"return overlib('<font color=red> <b>Cliquez là où vous êtes !</b></font> <br>$text');\" ";
  echo " onclick=\"return overlib('$text', STICKY, CAPTION, 'Informations', CLOSECLICK, EXCLUSIVE);\" ";
  echo " onmouseout=\"return nd();\"";

//  echo " ')\" onmouseout=\"killlink()\"";

}

function affiche_ancien_blasons()
{
	affiche_ancien("Will");
	affiche_ancien("Zarik");
	affiche_ancien("Rodalgen");
	affiche_ancien("Vengeance");
	affiche_ancien("Tinette");
	echo "<br>";
	affiche_ancien("Sirlor");
	affiche_ancien("Jyha");
	affiche_ancien("Bouritou");

	echo "<br>";
	affiche_ancien("Harpoon");
	affiche_ancien("Liril");
	affiche_ancien("Neso");
	affiche_ancien("Ladytroll");
	affiche_ancien("Inconnu3");

	echo "<br>";
	affiche_ancien("Grokitach");
	affiche_ancien("Ess");
	affiche_ancien("Darkdragon");
	affiche_ancien("Warkragg");

	echo "<br>";
	affiche_ancien("Ankras");
	affiche_ancien("Creak");
	affiche_ancien("Balladurzgate");
	affiche_ancien("Daviskasskrout");
	affiche_ancien("Fedmankassad");
	affiche_ancien("Toto42");

	echo "<br>";
	affiche_ancien("Skalimero");
	affiche_ancien("Hyaragorne");
	affiche_ancien("Obno");
}

function affiche_ancien($nom)
{
	echo "<img src='http://www.pipeshow.net/RM/avatars/".$nom."_avatar_bleu.gif'"; 

	$img = "http://www.pipeshow.net/RM/".$nom.".gif";
	$text .= "<img src=$img>";

  echo " onmouseover=\"return overlib('<font color=red> <b>Cliquez là où vous êtes !</b></font> <br>$text');\" ";
  echo " onclick=\"return overlib('$text', STICKY, CAPTION, 'Informations', CLOSECLICK, EXCLUSIVE);\" ";
  echo " onmouseout=\"return nd();\"";
	echo ">";

}
?>
