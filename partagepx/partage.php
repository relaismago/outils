<?php
session_start();
include_once ( "../inc_connect.php3" );
define(URL,$_SERVER['PHP_SELF']);
if(isset($_GET['gr']) and is_numeric($_GET['gr']))
	$_SESSION['gr'] = $_GET['gr'];
if(isset($_GET['troll']) and is_numeric($_GET['troll']))
	$_SESSION['num_troll'] = $_GET['troll'];
if(isset($_SESSION['gr']) AND is_numeric($_SESSION['gr'])){
	$timestamp_expire = time() + 365*24*3600; //On mais la durée de vie du cookie a 1 an (bien moisi le cookie a la fin ;o)
	setcookie('gr', $_SESSION['gr'], $timestamp_expire); 
}

require_once ( "../top.php" );

function sl($str){
	if(get_magic_quotes_gpc()==1)
		return $str;
	else
		return addslashes($str);
}
class db{
	var $db, $nb_req = 0;
	function db(){
		$this->db = $GLOBALS['db_vue_rm'];
		//$this->db = mysql_connect("localhost", "root", "");
		//mysql_select_db("outilsrm",$this->db);
	}
	
	function bug($req){
		return '<strong>Erreur MySQL: '.mysql_error($this->db).'</strong><br /><br />Requête: <em>'.$req.'</em>';
	}
	
	function query($req, $tri = "none"){
		if($tri=="array"){
			$b = mysql_query($req,$this->db);// or die($this->bug($req));
			$a = mysql_fetch_array($b);
		}
		elseif($tri=="single"){
			$b = mysql_query($req,$this->db) or die($this->bug($req));
			$a = mysql_result($b,0);
		}
		else
			$a = mysql_query($req,$this->db) or die($this->bug($req));
		$this->nb_req++;
		return $a;
	}
		
	function close(){
		mysql_close($this-db);
	}
	
}
class groupe{
	var $statut = 0; var $last = 0;
	var $nom_gr; var $num_gr;
	var $mb_gr = array();
	var $db;
	var $liste_distrib;
	function groupe(){
		$this->db = new db();
		if(isset($_SESSION['gr']) and is_numeric($_SESSION['gr']))
			$this->load($_SESSION['gr']);
		elseif(isset($_COOKIE['gr']) and is_numeric($_COOKIE['gr']))
			$this->load($_COOKIE['gr']);
		else
			$this->load();		
	}
	function load($num_gr=0){
		$cpt_gr = $this->db->query("SELECT COUNT(*) as cpt from px_groupes","single");
		if($cpt_gr==0)
			$this->statut = 0; //L'utilisateur doit créer un groupe (sélection cachée)
		else{
			if($cpt_gr==1 && $num_gr==0)
				$this->load($this->db->query("SELECT id from px_groupes","single"));
			elseif($num_gr==0)
				$this->statut=0; //On laisse à l'utilisateur sélectionner son groupe
			else{
				$_SESSION['gr']=$num_gr;
				$this->num_gr = $num_gr;
				$this->nom_gr = $this->db->query("SELECT nom from px_groupes WHERE id={$num_gr}","single");
				$query = $this->db->query("SELECT * from px_partage WHERE groupe={$num_gr} ORDER by nom");
				$this->mb_gr = array(); //On vide la variable avant pour éviter que le refresh foire au cas où le groupe serait vide
				while($rep = mysql_fetch_array($query)){
					$this->mb_gr[$rep["nom"]] = $rep["num"];
					if($rep["last"]==1)
						$this->last = $rep["num"];
				}
				if(count($this->mb_gr)>0)
					$this->statut=3;
				else
					$this->statut=2;
			}
		}
	}
	function new_groupe($nom_gr){
		if($this->db->query("SELECT COUNT(*) from px_groupes WHERE nom='{$nom_gr}'","single")==0){
			$this->db->query("INSERT into px_groupes VALUES(NULL,'{$nom_gr}')");
			$this->num_gr = $this->db->query("SELECT id FROM px_groupes WHERE nom='{$nom_gr}'","single");
			$this->load($this->num_gr);
		}
		else
			echo '<table class="mh_tdborder" align="center" width="90%"><tr class="mh_tdtitre"><th style="color:#FFFFFF;padding:5px;">Erreur: Un groupe portant ce nom est déjà existant dans cet outil</th></tr></table><br /><br />';
	}
	function del_groupe($num){
		$this->db->query("INSERT into px_log VALUES(NULL,(SELECT \"DEL groupe \" || nom from px_groupes WHERE id={$num}),'".$_SERVER['REMOTE_ADDR']."')");
		$this->db->query("DELETE from px_groupes WHERE id={$num}");
		$this->db->query("DELETE from px_partage WHERE groupe={$num}");
		$this->load();
	}
	function liste_gr(){
		$req = $this->db->query("SELECT * from px_groupes");
		$plus = (isset($_GET['modif'])) ? '?modif=1&' : '?';
		$plus .= (isset($_GET['distribpx'])) ? 'distribpx=1&' : '';
		$output = '<table class="mh_tdborder"><tr class="mh_tdtitre"><td><b>Groupe:</b> <select name="switch" onchange="if(this.value!=\'\') document.location.href=\''.URL.$plus.'gr=\'+this.value;"><option value="">*** Choisissez un groupe ***</option>';
		$g = 0;
		while($rep=mysql_fetch_array($req)){
			$add = ($_SESSION['gr']==$rep['id']) ? ' selected="selected"' : '';
			$output .= '<option value="'.$rep['id'].'"'.$add.'>'.$rep['nom'].'</option>';
			$g++;
		}
		$output .= '</select></td></tr></table><br />';
		if($g>1)
			return $output;
		else 
			return '';
	}
	function add_mb($num,$nom,$num_gr){
		if(is_numeric($num_gr) and $num_gr>0){
			if($this->db->query("SELECT COUNT(*) from px_partage WHERE num={$num}","single")==0){
				$this->db->query("INSERT into px_partage VALUES('{$num}','{$nom}','{$num_gr}','0')");
				$this->load($num_gr);
			}
			else
				echo '<table class="mh_tdborder" align="center" width="90%"><tr class="mh_tdtitre"><th style="color:#FFFFFF;padding:5px;">Erreur: Un troll portant ce numéro est déjà inscrit dans cet outil (veuillez le supprimer d\'un autre groupe avant de l\'inscrire dans un nouveau)</th></tr></table><br /><br />';
		}
	}
	function del_mb($num){
		$this->db->query("DELETE from px_partage WHERE num={$num}");
		$this->db->query("INSERT into px_log VALUES(NULL,'DEL mb {$num}','".$_SERVER['REMOTE_ADDR']."')");	
		$this->load($this->num_gr);
	}
	function set_last($num,$num_gr){
		$this->db->query("UPDATE px_partage set last=0 WHERE groupe={$num_gr}");
		$this->db->query("UPDATE px_partage set last=1 WHERE num={$num}");
		$this->load($this->num_gr);
	}
	function partage($px){
		$liste = array();
		$entier = floor($px / count($this->mb_gr));
		$j = 0; $dernier = 0;
		foreach($this->mb_gr as $nom => $num){
			$liste[$j] = array("nom" => $nom, "num" => $num, "px" => $entier);
			if($num == $this->last)
				$dernier = $j;
			$j++;
		}
		$reste = $px % count($this->mb_gr);
		if($this->last==0)
			$dernier = 0;
		for($i=$reste;$i>0;$i--){
			$liste[$dernier]["px"]++;
			$dernier++;
			if($dernier>(count($this->mb_gr)-1))
				$dernier=0;
		}
		$last_new = $liste[$dernier]["num"];
		if(!isset($last_new)) $last_new = $this->last;
		$sortie = '';
		for($z=0;$z<count($liste);$z++){
			$l = ($liste[$z]["num"]==$last_new) ? ' <-- début prochain' : '';
			$sortie .= $liste[$z]["num"]." ".$liste[$z]["nom"]." : ".$liste[$z]["px"].$l."\n";
		}
		$this->liste_distrib = $liste;
		$this->set_last($last_new,$this->num_gr);
		return $sortie;
	}
}
$gr = new groupe();
//Si on a demandé à créer un groupe
if(isset($_GET['create']))
	$gr->statut=0;
//Partage de PX
if(isset($_POST['px']) and is_numeric($_POST['px']) and $gr->statut==3){
	$px = (isset($_POST['px'])) ? $_POST['px'] : $_GET['distribpx'];
	echo '<p><table class="mh_tdborder" align="center" width="90%"><tr class="mh_tdtitre"><td style="text-align: center; padding:5px;">Vous pouvez maintenant copier/coller le résultat du partage dans la text-box pour le mettre sur le forum ;o)<br />';
	echo '<textarea id="ta" cols="60" rows="14">'.$gr->partage($px).'</textarea>';
	echo '<script language="JavaScript">document.getElementById("ta").focus(); document.getElementById("ta").select();</script>';
	//On fait le form pour le partage sur MH
	echo '<br /><br /><form method="post" name="GivePXForm" action="http://games.mountyhall.com/mountyhall/Messagerie/MH_Messagerie.php?cat=8" target="_top"><input type="button" class="mh_form_submit" value="Retour" onclick="javascript:document.location.href=\''.URL.'\';" />';
	$nl = '';
	foreach($gr->liste_distrib as $key => $param){
		if((!isset($_SESSION['num_troll']) or $param['num']!=$_SESSION['num_troll']) && $param['px']>0){
			echo '<input type="hidden" name="ai_PXToGive_'.$param['num'].'" value="'.$param['px'].'" />';
			$nl .= $param['num'].',';
		}
	}
	$nl = substr($nl,0,-1);
	echo '<input type="hidden" name="as_TrollToSend" value="'.$nl.'" /> <input type="submit" class="mh_form_submit" name="as_Action" value="Partager sur MH" /></td></tr></table>
</form><br />
<table class="mh_tdborder" align="center" width="90%"><tr class="mh_tdtitre"><td style="padding:5px;">
<b>/!\ Pour le boutton "Partager sur MH":</b>
<ul><li>Vous devez être connecté à MH sinon ça ne marchera pas</li>
<li>La fenêtre de partage s\'ouvrira dans cette fenêtre</li>';
	if(isset($_SESSION['num_troll']))
		echo '<li>Vous êtes le troll n° <b>'.$_SESSION['num_troll'].'</b>, si ce n\'est pas le cas, vous étiez connecté à Firemago avec un autre troll et le troll portant ce numéro ne recevera pas de PX dans ce partage</li>';
	else
		echo '<li>Si ce message s\'affiche, vous vous enverrez votre part de PX à vous-même</li>';
echo '</ul></td></tr></table>';
}
elseif(!is_numeric($_POST['px']))
	$reload = 1;
//Nouveau groupe
if(isset($_POST['new'])){
	if(!isset($_POST['gr']) or empty($_POST['gr']))
		echo '<span style="color:#FFFFFF;font-weight:bold;">Le nom du groupe est obligatoire</span><br /><br />';
	else
		$gr->new_groupe(sl($_POST['gr']));
}
if(isset($_POST['nom'],$_POST['num']) and is_numeric($_POST['num']))
	$gr->add_mb($_POST['num'],sl(ucfirst($_POST['nom'])),$gr->num_gr);
if(isset($_GET['del']) and is_numeric($_GET['del']))
	$gr->del_mb($_GET['del']);
if(isset($_GET['del_gr']) and is_numeric($_GET['del_gr']))
	$gr->del_groupe($_GET['del_gr']);
if(isset($_GET['last']) and is_numeric($_GET['last'])){
	$gr->set_last($_GET['last'],$gr->num_gr);
}
//Si aucun groupe de créé
//Ou aussi si pas de cookie trouver mais groupes existants
if($gr->statut==0){
	echo $gr->liste_gr();
	echo '<p><table width="90%" class="mh_tdborder" align="center"><tr class="mh_tdtitre"><td style="padding:10px;"><b>Bienvenue dans le script de partage de PX fait par le gentil TDG!</b><br />
Veuillez entrer le nom du vôtre puis vous serez dirigé vers une autre page pour renseigner les membres qui le composent.
<br /><form method="post" action="'.URL.'">
<b><u>Nouveau groupe:</u></b><br /><br />
Nom: <input type="text" name="gr" /><input type="hidden" name="new" value="1" /> <input type="submit" class="mh_form_submit" value="Enregister" /></form><input type="button" class="mh_form_submit" value="Retour" onclick="document.location.href=\''.URL.'\';" /></td></tr></table>';
}
//Si on a un groupe et qu'il est vide ou si on a cliqué sur "éditer"
if($gr->statut==2 || isset($_GET['modif'])){
	echo <<<END
<script language="JavaScript">
function find_nom(){
	if(window.XMLHttpRequest){ // Firefox 
		xml = new XMLHttpRequest(); var ajax = 1; 
	}
	else if(window.ActiveXObject){ // Internet Explorer 
		xml = new ActiveXObject("Microsoft.XMLHTTP"); var ajax = 1; 
	}
	else var ajax = 0;
	if(ajax!=0){
		xml.open("POST", "px_ajax.php", true);
		xml.onreadystatechange = function() { 
			if(xml.readyState == 4){
				var rep = xml.responseText;
				if(rep=='####')
					document.new_mb.nom.value='';
				else
					document.new_mb.nom.value=rep;		
			}
		}
		xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xml.send("num_troll="+document.new_mb.num.value);
	}
}
</script>
END;

	echo $gr->liste_gr();
	echo <<<END
<p><table width="90%" class="mh_tdborder" align="center">
<tr class="mh_tdtitre">
<td style="padding:10px;"><b>Ici vous pouvez éditer la composition du groupe.</b><br />
Remplissez le formulaire en bas pour ajouter un membre ou cliquer sur la croix à côté d'un troll pour le dégager du groupe.<br />
Vous ne pourrez accéder à la zone de partage, en cliquant sur "Partage", que si le groupe n'est pas vide.<br />
Le bouton "Début partage" permet de préciser au script le premier à recevoir les PX.</td></tr></table></p>
END;
	echo '<form method="post" name="new_mb" action="'.URL.'?modif=1">
<table class="mh_tdborder" align="center" width="60%"><tr class="mh_tdtitre"><td align="center" valign="center" style="font-size:20px; font-weight: bold;">'.$gr->nom_gr.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="Supprimer le groupe" href="javascript:if(confirm(\'Etes-vous sûr de vouloir supprimer le groupe '.$gr->nom_gr.'?\n/!\\\ Attention ceci est irréversible et les trolls du groupe seront supprimés de l\\\'outil...\')) document.location.href=\''.URL.'?del_gr='.$gr->num_gr.'&create=1\'; else alert(\'... alors faites pas mumuse avec le bouton!\');" /><img src="images/icone_suppr.gif" alt="supprimer" style="position:relative;top:2px;border:none;" /></a></td></tr></table>';
	echo '<br /><table width="90%" class="mh_tdborder" align="center"><tr class="mh_tdtitre"><td style="padding-left: 40px; padding-top: 10px; padding-bottom: 10px;"><ul>';
	$q = 0;
	foreach($gr->mb_gr as $nom => $num){
		$add = ($gr->last==$num) ? ' <-- début prochain' : '<input type="button" class="mh_form_submit" value="Début prochain" style="font-size:9;" onclick="javascript:document.location.href=\''.URL.'?last='.$num.'&modif=1\';" />';
		if($num!=0){
			echo '<li>'.$num.' <b>'.stripslashes($nom).'</b> <a title="Supprimer ce troll du groupe" href="javascript:if(confirm(\'Etes-vous sûr de vouloir supprimer '.$nom.' du groupe?\')) document.location.href=\''.URL.'?del='.$num.'&modif=1\'; else alert(\'... alors faites pas mumuse avec le bouton!\');" /><img src="images/icone_suppr.gif" alt="supprimer" style="position:relative;top:2px;border:none;" /></a> '.$add.'</li>';
			$q++;
		}
	}
	if($q==0)
		echo '<li><em>Vide</em></li>';
	echo '</ul></td></tr></table><br />
<table class="mh_tdborder" align="center" width="90%"><tr class="mh_tdtitre"><td style="text-align: left; padding:5px;"><b>Ajouter un membre:</b><br />
Numéro: <input type="text" size="5" name="num" onblur="if(this.value!=\'\') find_nom();" /> | Nom: <input type="text" name="nom" /> <input type="submit" class="mh_form_submit" value="Add" /></td>
<td style="text-align: right; padding:5px;"><input type="button" class="mh_form_submit" value="Retour au Partage" onclick="javascript:document.location.href=\''.URL.'\';" /></td></tr></table></form>';
}
//Si on a un groupe rempli et qu'on est pas en train de faire un partage de px
elseif((!isset($_POST["px"]) or isset($reload)) and $gr->statut==3 ){
		$url = URL.'?create=1';
		echo $gr->liste_gr();
		echo <<<END
<p><table width="90%" class="mh_tdborder" align="center">
<tr class="mh_tdtitre">
<td style="padding:10px;"><b>Bienvenue dans le script de partage de PX fait par le gentil TDG!</b><br />
Indiquez le nombre de PX et cliquez sur "Partager!" pour effectuer le partage.
Si vous souhaitez modifier la composition du groupe ou indiquer un autre "début prochain", cliquez sur "Éditer le groupe".<br />
Pour créer un nouveau groupe, cliquer <input type="button" class="mh_form_submit" value="ici" onclick="document.location.href='{$url}';" />
</td></tr></table></p>
END;
	echo '<form method="post" action="'.URL.'">
<table class="mh_tdborder" align="center" width="60%"><tr class="mh_tdtitre"><td align="center" valign="center" style="font-size:20px; font-weight: bold;">'.$gr->nom_gr.'</td></tr></table>
<br />
<table width="90%" class="mh_tdborder" align="center"><tr class="mh_tdtitre"><td style="padding-left: 40px; padding-top: 10px; padding-bottom: 10px;"><ul>';
	foreach($gr->mb_gr as $nom => $num){
		$add = ($gr->last==$num) ? ' <-- début prochain' : '';
		if($num!=0)
		echo '<li>'.$num.' <b>'.stripslashes($nom).'</b> '.$add.'</li>';
	}
	echo '</ul><input type="button" class="mh_form_submit" value="Éditer le groupe" onclick="javascript:document.location.href=\''.URL.'?modif=1\';" /></td></tr></table>
	<br />
	<table class="mh_tdborder" align="center" width="90%"><tr class="mh_tdtitre"><td style="text-align: center; padding:5px;"><b>Nombre de PX:</b> <input type="text" size="4" name="px" value="'.$_GET['distribpx'].'" /> <input type="submit" class="mh_form_submit" value="Partager!" /></td></tr></table></form>';
}
?>
<!-- <table class="mh_tdborder" align="center" width="90%"><tr class="mh_tdtitre"><td style="text-align: center; padding:5px;">Nombre de requêtes sql: <?php echo $gr->db->nb_req; ?></td></tr></table> -->

<?

require_once ( "../foot.php" );

?>

