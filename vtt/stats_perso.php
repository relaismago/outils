<?
require_once("../inc_connect.php");
require_once("../functions_auth.php");
require_once("../top.php");
require_once("../secure.php");

require_once("stats_vtt.class.php");
require_once("troll_vtt.class.php");

$id_troll = $_REQUEST[id_troll];

if ($id_troll == "")
	$id_troll = $_SESSION[AuthTroll];

init_stats_perso($id_troll);

include_once("../foot.php");

function init_stats_perso($id_troll)
{


	$t = new troll_vtt($id_troll);
	
	$text = "$t->nom_troll ($t->id_troll)<br>"; 
 	$text .= "<select name='id_troll' id='id_troll_rm'";
	$text .= "onChange=\"javascript:document.location.href='/vtt/stats_perso.php?id_troll=";
	$text .= "'+this.value+'";
	$text .= "';\">";
	$text .= afficher_listbox_troll_rm_select($id_troll, $no_not="","",false);
	$text .= "</select>"; 
	$img = "<img src='/images/narcissotron.jpg'>";
	afficher_titre_tableau("$img",$text);

	if ($t->pv == "") {
		$text = "$t->nom_troll ($t->id_troll) n'a jamais renseign&eacute; le VTT.";
		afficher_titre_tableau("Erreur",$text);
		die();
	}
	
	$s = new stats_vtt($t->race_troll, $t->niveau_troll);
  
	?>
	<table width='100%'>
	<tr>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_pv($s, $t); ?>
	</table><br>

	</td>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_reg($s, $t); ?>
	</table><br>

	</td>
	</tr>

	<tr>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_dla($s, $t); ?>
	</table><br>

	</td>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_vue($s, $t); ?>
	</table><br>

	</td>
	</tr>
	<tr>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_att($s, $t); ?>
	</table><br>

	</td>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_esq($s, $t);?>
	</table><br>

	</td>
	</tr>
	<tr>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_deg($s, $t); ?>
	</table><br>

	</td>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_arm($s, $t); ?>
	</table><br>

	</td>
	</tr>
	<tr>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_kill($s, $t); ?>
	</table><br>

	</td>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_dead($s, $t); ?>
	</table><br>

	</td>
	</tr>
	<tr>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_rm($s, $t); ?>
	</table><br>

	</td>
	<td>

	<table align='center' class='mh_tdborder'>
	<? dessine_mm($s, $t); ?>
	</table><br>

	</td>
	</tr>

	</table>
	<?
}

function dessine_barre($text1, $text2, $val, $coef=1)
{
	$val = $val * $coef;

	$img = "/images/progress-bar-fixe.gif";

	echo "<tr class='mh_tdpage'>";
	echo "<td>";
	echo $text1;
	echo "</td>";
	echo "<td>";
	echo "<img src='$img' height='18px' width='".$val."px'>";
	echo "</td>";
	echo "<td>";
	echo $text2;
	echo "</td>";
	echo "</tr>";
}

function dessine_pv($s, $t)
{

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> PV</td>";
	echo "</tr>";

	$a = $s->get_max_pv();
	dessine_barre("Max Guilde PV", "$a[value] ".$a[nom_troll], $a[value]);

	$a = $s->get_moyenne_pv();
	dessine_barre("Moy Guilde PV", "$a[value] ".$a, $a);

	$a = $s->get_max_race_pv();
	dessine_barre("Max Race PV", "$a[value] ".$a[nom_troll], $a[value]);

	$a = $s->get_moyenne_race_pv();
	dessine_barre("Moyenne Race PV", "$a", $a);

	$a = $s->get_max_alentour_race_pv();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll], $a[value]);

	$a = $s->get_moyenne_alentour_race_pv();
	dessine_barre("Moy Race niv+1/-1", "$a", $a);
	
	dessine_barre("$t->nom_troll PV", $t->pv, $t->pv);
}

function dessine_reg($s, $t)
{
	$coef = 3;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Reg&eacute;n&eacute;ration</td>";
	echo "</tr>";

	$a = $s->get_max_reg();
	dessine_barre("Max Guilde REG", "$a[value] ".$a[nom_troll]." ($a[normal]D3".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_reg();
	dessine_barre("Moy Guilde REG", "$a[value] ".$a, $a);

	$a = $s->get_max_race_reg();
	dessine_barre("Max Race REG", "$a[value] ".$a[nom_troll]." ($a[normal]D3".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_reg();
	dessine_barre("Moyenne Race REG", "$a", $a);

	$a = $s->get_max_alentour_race_reg();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]D3".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_reg();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll REG", $t->total_reg." (".$t->reg."D3".plus($t->reg_bonus).$t->reg_bonus.")", $t->total_reg, $coef);
}

function dessine_dla($s, $t)
{
	$coef = 3;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> DLA</td>";
	echo "</tr>";

	$a = $s->get_max_dla();
	dessine_barre("Min Guilde DLA", $a[nom_troll]." ($a[normal] heures et $a[bonus] minutes)", $a[value], $coef);

	$a = $s->get_moyenne_dla();
	dessine_barre("Moy Guilde DLA", "En developpement".$a, $a);

	$a = $s->get_max_race_dla();
	dessine_barre("Min Race DLA", $a[nom_troll]." ($a[normal] heures et $a[bonus] minutes)", $a[value], $coef);

	$a = $s->get_moyenne_race_dla();
	dessine_barre("Moyenne Race DLA", "$a En developpement", $a);

	$a = $s->get_max_alentour_race_dla();
	dessine_barre("Min Race niv+1/-1", $a[nom_troll]." ($a[normal] heures et $a[bonus] minutes)", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_dla();
	dessine_barre("Moy Race niv+1/-1", "$a En developpement", $a, $coef);
	
	dessine_barre("$t->nom_troll DLA", "($t->dla_heure heures et $t->dla_min minutes)", $t->total_dla, $coef);
}

function dessine_vue($s, $t)
{
	$coef = 3;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Vue</td>";
	echo "</tr>";

	$a = $s->get_max_vue();
	dessine_barre("Max Guilde VUE", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_vue();
	dessine_barre("Moy Guilde VUE", "$a[value] ".$a, $a);

	$a = $s->get_max_race_vue();
	dessine_barre("Max Race VUE", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_vue();
	dessine_barre("Moyenne Race VUE", "$a", $a);

	$a = $s->get_max_alentour_race_vue();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_vue();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll VUE", $t->total_vue." (".$t->vue.plus($t->vue_bonus).$t->vue_bonus.")", $t->total_vue, $coef);
}

function dessine_att($s, $t)
{

	$coef = 2;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Attaque</td>";
	echo "</tr>";

	$a = $s->get_max_att();
	dessine_barre("Max Guilde ATT", "$a[value] ".$a[nom_troll]." ($a[normal]D6".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_att();
	dessine_barre("Moy Guilde ATT", "$a[value] ".$a, $a, $coef);

	$a = $s->get_max_race_att();
	dessine_barre("Max Race ATT", "$a[value] ".$a[nom_troll]." ($a[normal]D6".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_att();
	dessine_barre("Moyenne Race ATT", "$a", $a, $coef);

	$a = $s->get_max_alentour_race_att();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]D6".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_att();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll ATT", $t->total_att." (".$t->att."D6".plus($t->att_bonus).$t->att_bonus.")", $t->total_att, $coef);
}

function dessine_esq($s, $t)
{

	$coef = 2;
	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Esquive</td>";
	echo "</tr>";

	$a = $s->get_max_esq();
	dessine_barre("Max Guilde ESQ", "$a[value] ".$a[nom_troll]." ($a[normal]D6".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_esq();
	dessine_barre("Moy Guilde ESQ", "$a[value] ".$a, $a, $coef);

	$a = $s->get_max_race_esq();
	dessine_barre("Max Race ESQ", "$a[value] ".$a[nom_troll]." ($a[normal]D6".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_esq();
	dessine_barre("Moyenne Race ESQ", "$a", $a, $coef);

	$a = $s->get_max_alentour_race_esq();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]D6".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_esq();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll ESQ", $t->total_esq." (".$t->esq."D6".plus($t->esq_bonus).$t->esq_bonus.")", $t->total_esq, $coef);
}

function dessine_deg($s, $t)
{
	$coef = 2;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> D&eacute;gats</td>";
	echo "</tr>";

	$a = $s->get_max_deg();
	dessine_barre("Max Guilde DEG", "$a[value] ".$a[nom_troll]." ($a[normal]D3".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_deg();
	dessine_barre("Moy Guilde DEG", "$a[value] ".$a, $a, $coef);

	$a = $s->get_max_race_deg();
	dessine_barre("Max Race DEG", "$a[value] ".$a[nom_troll]." ($a[normal]D3".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_deg();
	dessine_barre("Moyenne Race DEG", "$a", $a, $coef);

	$a = $s->get_max_alentour_race_deg();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]D3".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_deg();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll DEG", $t->total_deg." (".$t->deg."D3".plus($t->deg_bonus).$t->deg_bonus.")", $t->total_deg, $coef);
}

function dessine_arm($s, $t)
{
	$coef = 2;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Armure</td>";
	echo "</tr>";

	$a = $s->get_max_arm();
	dessine_barre("Max Guilde ARM", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_arm();
	dessine_barre("Moy Guilde ARM", "$a[value] ".$a, $a, $coef);

	$a = $s->get_max_race_arm();
	dessine_barre("Max Race ARM", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_arm();
	dessine_barre("Moyenne Race ARM", "$a", $a, $coef);

	$a = $s->get_max_alentour_race_arm();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_arm();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll ARM",$t->total_arm." (".$t->arm.plus($t->arm_bonus).$t->arm_bonus.")", $t->total_arm,  $coef);
}

function dessine_kill($s, $t)
{

	$coef = 0.7;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Meurtres</td>";
	echo "</tr>";

	$a = $s->get_max_kill();

	dessine_barre("Max Guilde Kills", "$a[value] ".$a[nom_troll], $a[value], $coef);
	$a = $s->get_moyenne_kill();
	dessine_barre("Moy Guilde Kills", "$a[value] ".$a, $a, $coef);

	$a = $s->get_max_race_kill();
	dessine_barre("Max Race Kills", "$a[value] ".$a[nom_troll], $a[value], $coef);

	$a = $s->get_moyenne_race_kill();
	dessine_barre("Moyenne Race Kills", "$a", $a, $coef);

	$a = $s->get_max_alentour_race_kill();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll], $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_kill();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll Kills", $t->kill, $t->kill, $coef);
}

function dessine_dead($s, $t)
{
	$coef = 10;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Morts</td>";
	echo "</tr>";

	$a = $s->get_min_dead();
	dessine_barre("Min Guilde Morts", "$a[value] ".$a[nom_troll], $a[value], $coef);

	$a = $s->get_moyenne_dead();
	dessine_barre("Moy Guilde Morts", "$a[value] ".$a, $a, $coef);

	$a = $s->get_min_race_dead();
	dessine_barre("Min Race Morts", "$a[value] ".$a[nom_troll], $a[value], $coef);

	$a = $s->get_moyenne_race_dead();
	dessine_barre("Moyenne Race Morts", "$a", $a, $coef);

	$a = $s->get_min_alentour_race_dead();
	dessine_barre("Min Race niv+1/-1", "$a[value] ".$a[nom_troll], $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_dead();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll Morts", $t->death, $t->death, $coef);
}

function dessine_rm($s, $t)
{

	$coef = 0.02;

	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> R&eacute;sistance Magique</td>";
	echo "</tr>";

	$a = $s->get_max_rm();
	dessine_barre("Max Guilde RM", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_rm();
	dessine_barre("Moy Guilde RM", "$a[value] ".$a, $a, $coef);

	$a = $s->get_max_race_rm();
	dessine_barre("Max Race RM", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_rm();
	dessine_barre("Moyenne Race RM", "$a", $a, $coef);

	$a = $s->get_max_alentour_race_rm();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_rm();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll RM", $t->total_rm." (".$t->rm.plus($t->rm_bonus).$t->rm_bonus.")", $t->total_rm, $coef);
}

function dessine_mm($s, $t)
{
	$coef = 0.05;
	echo "<tr class='mh_tdtitre'>";
	echo "<td colspan='10' align='center'> Maitrise Magique</td>";
	echo "</tr>";

	$a = $s->get_max_mm();
	dessine_barre("Min Guilde MM", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_mm();
	dessine_barre("Moy Guilde MM", "$a[value] ".$a, $a, $coef);

	$a = $s->get_max_race_mm();
	dessine_barre("Max Race MM", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_race_mm();
	dessine_barre("Moyenne Race MM", "$a", $a, $coef);

	$a = $s->get_max_alentour_race_mm();
	dessine_barre("Max Race niv+1/-1", "$a[value] ".$a[nom_troll]." ($a[normal]".plus($a[bonus]).$a[bonus].")", $a[value], $coef);

	$a = $s->get_moyenne_alentour_race_mm();
	dessine_barre("Moy Race niv+1/-1", "$a", $a, $coef);
	
	dessine_barre("$t->nom_troll MM", $t->total_mm." (".$t->mm.plus($t->mm_bonus).$t->mm_bonus.")", $t->total_mm, $coef);
}
?>
