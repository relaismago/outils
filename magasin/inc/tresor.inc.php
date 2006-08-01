<?php

//pas oublier d'inclure fichier des fonctions g�n�riques avant !

class Tresor
{
	var $arriveeDate;
	
	var $id;//id de l'objet
	var $taniere;//id de la tani�re o� se trouve le tr�sor
	var $type;//nom du type

	var $nom;//le nom de l'objet (sans template)
	var $template;//le template de l'objet	
	var $description;//la description (bonus-malus de l'objet, par ex)
	var $poids;//poids en minutes

	var $invisible;
	//est-il invisible dans le magasin pour une raison x ou y ?
	var $bloque;
	//est-il bloqu� pour une raison x ou y ?
	var $absent;
	//�tait-il absent sur MH � la derni�re maj

	var $dateMaj="";
	//date o� l'objet a �t� maj pour la derni�re fois (utile pour le parsing)

	var $reserve;//0 pour faux, 1 pour vrai
	//tr�sor r�serv� par un troll
	var $confirme;//0 pour faux, 1 pour vrai
	//confirm� par le gestionnaire
	var $reserveTroll;//0 si pas r�serv�
	var $reserveTrollNom;
	var $reserveDate;

	
	var $enVente;
	var $enVentePrix;
	var $enVenteTroll;//-1 pour aucun troll, 0 pour tous les trolls
	//tr�sor mis en vente

	var $isCompo;
	//est un compo/champignon

	var $codeSpecial;
	//indique un tr�sor particulier : compo prio par ex
	// pour l'instant : 0=>rien, 1=>compo prio

	//constructeur pour cr�ation � partir de la bdd
	function initBDD($row) {
		
		//$row est un r�sultat renvoy� par mysql_fetch_array($query_result)
		$this->arriveeDate=$row['date_arrivee'];
		$this->taniere=$row['id_taniere'];
		$this->id=$row['id_tresor'];
		$this->type=$row['nom_type'];
		$this->invisible=$row['invisible'];
		$this->bloque=$row['bloque'];
		$this->absent=$row['absent'];

		$this->nom=$row['nom'];
		$this->template=$row['template'];
		$this->description=$row['description'];
		$this->poids=$row['poids'];

		$this->dateMaj=$row['date_maj'];
		$this->reserve=$row['reserve'];
		$this->confirme=$row['confirme'];
		$this->reserveTroll=$row['reserve_troll'];
		$this->reserveTrollNom=$row['reserve_troll_nom'];
		$this->reserveDate=$row['reserve_date'];
		$this->enVente=$row['en_vente'];
		$this->enVentePrix=$row['en_vente_prix'];
		$this->enVenteTroll=$row['en_vente_troll'];
		$this->enVenteTrollNom=$row['en_vente_troll_nom'];

		if (isset($row['priorite_composant']) && $row['priorite_composant']!="")
			$this->codeSpecial=1;
		else
			$this->codeSpecial=0;
	}



	//constructeur pour l'ajout en base
	function initAjout($taniere, $id, $type, $nom, $template, $description, $poids, $enVentePrix, $enVenteTroll, $dateMaj)
	{
		$this->arriveeDate = date("d/m/Y");

		$this->taniere = $taniere;
		$this->id = $id;
		$this->type = $type;
		
		$this->nom = $nom;
		$this->template = $template;
		$this->description = $description;
		$this->poids = $poids;
		
		if ($enVenteTroll>=0) {
			$this->enVente = 1;
			$this->enVentePrix = $enVentePrix;
			$this->enVenteTroll = $enVenteTroll;
			$this->enVenteTrollNom=getNomTroll($enVenteTroll);
		}
		else {
			$this->enVente = 0;
			$this->enVentePrix = 0;
			$this->enVenteTroll = -1;
			$this->enVenteTrollNom = '';
		}

		

		if ($this->type=='Composant' || $this->type=='Champignon' || $this->type=='Minerai') {
			$this->isCompo=1;
		} else {
			$this->isCompo=0;
		}

		$this->dateMaj = $dateMaj;
		
		$this->absent = 0;
	}

	//Met � jour uniquement les informations r�cup�r�es de MH
	function updater()
	{
		//echo("<!--update de ".$this->id."-->\n");
		global $db_vue_rm;
		//echo("<!--date maj ".$this->dateMaj."-->\n");

		$query = "
			UPDATE stock_tresors
			SET nom_type='".addslashes($this->type)."',
				id_taniere=".$this->taniere.",
				absent=0,
				date_maj='".$this->dateMaj."',
				en_vente=".$this->enVente.",
				en_vente_prix=".$this->enVentePrix.",
				en_vente_troll=".$this->enVenteTroll.",
				en_vente_troll_nom='".addslashes($this->enVenteTrollNom)."',
				nom='".addslashes($this->nom)."',
				template='".addslashes($this->template)."',
				description='".addslashes($this->description)."',
				poids=".$this->poids.",
				compo=".$this->isCompo."
			WHERE id_tresor='".$this->id."'
			;";
			//echo("<!--$query\n\n-->");

		mysql_query($query,$db_vue_rm);

		if (mysql_affected_rows($db_vue_rm) == 0) {
			$query = "
				INSERT IGNORE INTO stock_tresors(
					id_tresor,
					nom_type,
					id_taniere,
					date_arrivee,

					invisible,
					bloque,
					absent,
					date_maj,

					reserve,
					confirme,
					reserve_troll,

					en_vente,
					en_vente_prix,
					en_vente_troll,
					en_vente_troll_nom,

					nom,
					template,
					description,
					poids,

					compo
				) VALUES (
					".$this->id.",
					'".addslashes($this->type)."',
					".$this->taniere.",
					'".$this->arriveeDate."',
					".$this->invisible.",
					".$this->bloque.",
					'false',
					'".$this->dateMaj."',
					0,
					0,
					0,
					".$this->enVente.",
					".$this->enVentePrix.",
					".$this->enVenteTroll.",
					'".addslashes($this->enVenteTrollNom)."',
					'".addslashes($this->nom)."',
					'".addslashes($this->template)."',
					'".addslashes($this->description)."',
					".$this->poids.",
					".$this->isCompo."
				)
				;";

			global $db_vue_rm;
			mysql_query($query,$db_vue_rm);
		}
	}

	function toString() {
		echo('<td>'.$this->id.'</td>');

		$texte = $this->nom." ".$this->template." (".$this->description.")";
		
		if ($this->codeSpecial==1) echo('<td class="bgred">'.stripslashes(htmlentities($texte)).'</td>');
		else echo('<td>'.stripslashes(htmlentities($texte)).'</td>');

		echo('<td align="center">'.$this->type.'</td>');

		echo('<td align="center">');
			if ($this->bloque==1) echo('Bloqu�');
			else if ($this->reserve==0) echo('<input type="checkbox" name="res_'.$this->id.'" value="res_'.$this->id.'" />');
			else echo(stripslashes(htmlentities($this->reserveTrollNom)).' ('.$this->reserveTroll.')');
		echo('</td>');

		echo('<td align="center">');
			if ($this->bloque==1) echo('<img src="./img/inactif.gif">');
			else if ($this->confirme==1) echo('<img src="./img/coche.gif">');
			else echo('<img src="./img/croix.gif">');
		echo('</td>');

		echo('<td align="center">');
			if ($this->enVente==1) {
				if ($this->enVenteTrollNom=='') $txtEnVente = '';
				else {
					$txtEnVente = stripslashes(htmlentities($this->enVenteTrollNom));
					if ($this->enVenteTroll>0) $txtEnVente .= ' ('.$this->enVenteTroll.')';
				}
				echo($txtEnVente);
			}
			else echo('&nbsp;');
		echo('</td>');
	}

	function toStringPublic() {
		echo('<td>'.$this->id.'</td>');
		
		$texte = $this->nom." ".$this->template." (".$this->description.")";
		
		if ($this->codeSpecial==1) echo('<td class="bgred">'.stripslashes(htmlentities($texte)).'</td>');
		else echo('<td>'.stripslashes(htmlentities($texte)).'</td>');

		echo('<td align="center">'.$this->type.'</td>');

		echo('<td align="center">');
			if ($this->enVente==1) {
				if ($this->enVenteTrollNom=='') $txtEnVente = '';
				else {
					$txtEnVente = stripslashes(htmlentities($this->enVenteTrollNom));
					if ($this->enVenteTroll>0) $txtEnVente .= ' ('.$this->enVenteTroll.')';
				}
				echo($txtEnVente);
			}
			else echo('&nbsp;');
		echo('</td>');
	}

	function toStringAdmin() {
		echo('<td>'.$this->id.'</td>');

		$texte = $this->nom." ".$this->template." (".$this->description.")";
		
		if ($this->codeSpecial==1) echo('<td class="bgred">'.stripslashes(htmlentities($texte)).'</td>');
		else echo('<td>'.stripslashes(htmlentities($texte)).'</td>');

		echo('<td align="center">'.$this->type.'</td>');

		echo('<!--r�server-->');
		echo('<td align="center">');
			if ($this->reserve==1) {
				echo('<img src="./img/coche.gif"><input type="checkbox" name="deres_'.$this->id.'" value="1" />');
				echo(stripslashes(htmlentities($this->reserveTrollNom)).'&nbsp('.$this->reserveTroll.')');
				echo('<br/> le '.stripslashes(htmlentities($this->reserveDate)));
			}
			else echo('<img src="./img/croix.gif"><input type="text" name="res_'.$this->id.'" size="4" />');

		echo('</td>');

		echo('<!--confirmer-->');
		echo('<td align="center">');
			if ($this->reserve==0) echo('<img src="./img/inactif.gif">');
			else if ($this->confirme==0) echo('<img src="./img/croix.gif"><input type="checkbox" name="conf_'.$this->id.'" value="1" />');
			else echo('<img src="./img/coche.gif"><input type="checkbox" name="deconf_'.$this->id.'" value="1" />');
		echo('</td>');

		echo('<!--vendre-->');
		echo('<td align="center">');
			if ($this->enVente==1) {
				if ($this->enVenteTrollNom=='') $txtEnVente = '';
				else {
					$txtEnVente = stripslashes(htmlentities($this->enVenteTrollNom));
					if ($this->enVenteTroll>0) $txtEnVente .= ' ('.$this->enVenteTroll.')';
				}
				echo($txtEnVente);
			}
			else echo('&nbsp;');
		echo('</td>');

		echo('<!--bloquer-->');
		echo('<td align="center">');
			if ($this->bloque==0) echo('<img src="./img/croix.gif"><input type="checkbox" name="bloq_'.$this->id.'" value="1" />');
			else echo('<img src="./img/coche.gif"><input type="checkbox" name="debloq_'.$this->id.'" value="1" />');
		echo('</td>');

		echo('<!--cacher-->');
		echo('<td align="center">');
			if ($this->invisible==0) echo('<img src="./img/croix.gif"><input type="checkbox" name="cach_'.$this->id.'" value="1" />');
			else echo('<img src="./img/coche.gif"><input type="checkbox" name="decach_'.$this->id.'" value="1" />');
		echo('</td>');

		echo('<td></td>');

		echo('<!--supprimer-->');
		echo('<td align="center">');
			echo('<input type="checkbox" name="suppr_'.$this->id.'" value="1" />');
		echo('</td>');
	}

}

function reserver($idTresor, $noTroll)
//r�serve un tr�sor pour un troll
{
	//on r�cup�re � la fois le nom du troll appelant et la confirmation que le tr�sor est r�servable
	$query = '
		SELECT 
			stock_tresors.reserve, stock_tresors.reserve_troll, stock_tresors.reserve_troll_nom, stock_tresors.reserve_date,
			stock_tresors.bloque, stock_tresors.invisible,
			trolls.nom_troll 
		FROM stock_tresors LEFT JOIN trolls ON trolls.id_troll=\''.$noTroll.'\'
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query,$db_vue_rm);
	if (mysql_num_rows($query_result)==0) return 'Le tr�sor '.$idTresor.' n\'existe pas dans cette tani�re !';

	$row = mysql_fetch_array($query_result);
	if ($row['reserve']==1)
		return 'Le tr�sor '.$idTresor.' a d�j� �t� r�serv� le '.$row['reserve_date'].' par le troll '.$row['reserve_troll_nom'].' ('.$row['reserve_troll'].').';

	if ($row['bloque']==1 || $row['invisible']==1)
		return 'Le tr�sor '.$idTresor.' n\'est pas disponible � la r�servation.';

	if ($row['nom_troll']=='') $row['nom_troll']=$noTroll;
	else $row['nom_troll'] = str_replace('\'', '\\\'', $row['nom_troll']);

	$query = '
		UPDATE stock_tresors
		SET reserve=1, reserve_troll=\''.$noTroll.'\', reserve_date=\''.date("Y-m-d").'\', reserve_troll_nom=\''.$row['nom_troll'].'\'
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query,$db_vue_rm);

	return "";
}

function reserverForce($idTresor, $noTroll, $noAdmin)
//r�serve un tr�sor pour un troll, quels que soit les autres param�tres
//$noAdmin est le num�ro de l'admin qui fait la demande
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re le nom du troll appelant
	$query = '
		SELECT trolls.nom_troll
		FROM trolls
		WHERE trolls.id_troll=\''.$noTroll.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query,$db_vue_rm);
	if (mysql_num_rows($query_result)==0) $row['nom_troll']=$noTroll;
	else {
		$row = mysql_fetch_array($query_result);
		if ($row['nom_troll']=='') $row['nom_troll']=$noTroll;
		else $row['nom_troll'] = str_replace('\'', '\\\'', $row['nom_troll']);
	}

	$query = '
		UPDATE stock_tresors
		SET reserve=1, reserve_troll=\''.$noTroll.'\', reserve_date=\''.date("Y-m-d").'\', reserve_troll_nom=\''.$row['nom_troll'].'\'
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query,$db_vue_rm);

	return "";
}

function deReserver($idTresor, $noTroll)
//annule la r�servation du tr�sor
//$noTroll est le num�ro de l'admin, pas du troll r�servant
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est d�r�servable
	$query = '
		SELECT 
			stock_tresors.reserve, stock_tresors.reserve_troll, stock_tresors.reserve_troll_nom, stock_tresors.reserve_date
		FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row['reserve']==0)
		return 'Le tr�sor '.$idTresor.' n\est actuellement pas r�serv�.';

	$query = '
		UPDATE stock_tresors
		SET reserve=0, reserve_troll=NULL, reserve_date=NULL, reserve_troll_nom=NULL
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

function confirmer($idTresor, $noTroll)
//confirme la r�servation d'un tr�sor par un troll
//$noTroll est le num�ro de l'admin, pas du troll r�servant
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est confirmable
	$query = '
		SELECT 
			stock_tresors.confirme, stock_tresors.reserve, stock_tresors.reserve_troll, stock_tresors.reserve_troll_nom, stock_tresors.reserve_date
		FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row['reserve']==0)
		return 'Le tr�sor '.$idTresor.' n\'est actuellement pas r�serv�.';

	if ($row['confirme']==1)
		return 'La r�servation du tr�sor '.$idTresor.' le '.$row['reserve_date'].' par le troll '.$row['reserve_troll_nom'].' ('.$row['reserve_troll'].') est d�j� confirm�e.';

	$query = '
		UPDATE stock_tresors
		SET confirme=1
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

function deconfirmer($idTresor, $noTroll)
//annule la confirmation de la r�servation d'un tr�sor par un troll
//$noTroll est le num�ro de l'admin, pas du troll r�servant
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est d�confirmable
	$query = '
		SELECT 
			stock_tresors.confirme, stock_tresors.reserve, stock_tresors.reserve_troll, stock_tresors.reserve_troll_nom, stock_tresors.reserve_date
		FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row['reserve']==0)
		return 'La r�servation du tr�sor '.$idTresor.' n\'est pas confirm�e.';

	$query = '
		UPDATE stock_tresors
		SET confirme=0
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

function bloquer($idTresor, $noTroll)
//bloque la r�servation d'un tr�sor
//$noTroll est le num�ro de l'admin
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est bloquable
	$query = '
		SELECT 
			stock_tresors.bloque
		FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row['bloque']==1)
		return 'Le tr�sor '.$idTresor.' est d�j� bloqu�.';

	$query = '
		UPDATE stock_tresors
		SET bloque=1
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

function debloquer($idTresor, $noTroll)
//d�bloque la r�servation d'un tr�sor
//$noTroll est le num�ro de l'admin
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est d�bloquable
	$query = '
		SELECT 
			stock_tresors.bloque
		FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row['bloque']==0)
		return 'Le tr�sor '.$idTresor.' n\'est pas bloqu�.';

	$query = '
		UPDATE stock_tresors
		SET bloque=0
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

function cacher($idTresor, $noTroll)
//cache un tr�sor
//$noTroll est le num�ro de l'admin
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est cachable
	$query = '
		SELECT 
			stock_tresors.invisible
		FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row['invisible']==1)
		return 'Le tr�sor '.$idTresor.' est d�j� cach�.';

	$query = '
		UPDATE stock_tresors
		SET invisible=1
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

function decacher($idTresor, $noTroll)
//d�cache un tr�sor
//$noTroll est le num�ro de l'admin
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est d�cachable
	$query = '
		SELECT 
			stock_tresors.invisible
		FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
	$row = mysql_fetch_array($query_result);
	
	if ($row['invisible']==0)
		return 'Le tr�sor '.$idTresor.' n\'est pas cach�.';

	$query = '
		UPDATE stock_tresors
		SET invisible=0
		WHERE id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

function supprimer($idTresor, $noTroll)
//supprime un tr�sor
//$noTroll est le num�ro de l'admin
{
	//TODO : v�rifier l'id de l'appelant !

	//on r�cup�re la confirmation que le tr�sor est pr�sent
	$query = '
		SELECT * FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);
		
	if (mysql_num_rows($query_result)==0)
		return 'Le tr�sor '.$idTresor.' n\'est pas pr�sent dans la base.';

	$query = '
		DELETE FROM stock_tresors
		WHERE stock_tresors.id_tresor=\''.$idTresor.'\'
		;';

	global $db_vue_rm;
	$query_result = mysql_query($query, $db_vue_rm);

	return "";
}

?>
