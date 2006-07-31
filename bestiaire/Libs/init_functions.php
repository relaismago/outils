<?

/* --------------------------------------------
Sont pr�sentes dans ce fichier : 
-----------------------------
function getInfoMonstre()
function getCapaciteSpeciales($MonstreAge,$Monstre,$Race, $agebasic) 
function getCaracteristiques($MonstreAge,$Famille)
function getDeathPower($MonstreAge,$Monstre,$agebasic)
function getCdm($MonstreAge,$Monstre,$Age,$agebasic)
----------------------------------------------- */

function getInfoMonstre()
{
	global $db_bestiaire;

	// Initialisation des variables Race et Monstre pour la pr�-s�lection d'un
	// affichage
	// on est oblig� d'utiliser stripslashes car certains noms contiennent des
	// apostrophes et ils se retrouvent prot�g�s par un \ ce qui fausse ensuite les
	// recherches en table.
	if (isset($_GET['Race'])) $Race = stripslashes($_GET['Race']); else $Race="none";
	if (isset($_GET['Monstre'])) $Monstre = stripslashes($_GET['Monstre']); else $Monstre="none";
	if (isset($_GET['Age'])) $Age = stripslashes($_GET['Age']); else $Age='';

	// R�affectation des variables Monstres et Races en fonctions des donn�es
	// sp�cifi�es ou non dans l'url

	// si la variable Monstre est positionn�e on v�rifie qu'il correspond � la race
	if( ($Monstre!="none") && ($Race!="none") ){ // Monstre et Race donn�s en param�tre dans l'url
	  $sql="SELECT Monstre FROM monstres WHERE Race=\"$Race\" and `Monstre`=\"$Monstre\";";
	  $query=mysql_query($sql,$db_bestiaire);
		// le Monstre donn� n'est pas de la Race indiqu�e.
	  if(mysql_num_rows($query)==0){ 
	    $Monstre="none";
	  }
	}
	if( ($Race!="none") && ($Monstre=="none") ){
	  // pour le monstre on cherche celui qui a le template standard cad le m�me nom
	  // que la race.
	  $sql="SELECT Monstre FROM `monstres` WHERE `Race`=\"$Race\" AND `Monstre`=\"$Race\";";
	  $query=mysql_query($sql,$db_bestiaire);
	  if(mysql_num_rows($query)>0) $Monstre=$Race; // template standard
	  else{ // pas de monstre ayant le nom de la race, on prend le premier qui vient
	    $sql="SELECT Monstre FROM `monstres` WHERE `Race`=\"$Race\";";
	    $query=mysql_query($sql,$db_bestiaire);
	    $ret=mysql_fetch_array($query);
	    $Monstre=$ret['Monstre'];
	  }
	}
	
	if( ($Race=="none") && ($Monstre!="none") ){
	  $sql="SELECT Race FROM `monstres` WHERE `Monstre`=\"$Monstre\";";
	  $query=mysql_query($sql,$db_bestiaire);
	  $ret=mysql_fetch_array($query);
	  $Race=$ret['Race'];
	}
	if( ($Race=="none") && ($Monstre=="none") ){ // si aucun des deux n'est donn�
	  $Monstre="Abishaii Bleu";
	  $Race="Abishaii Bleu";
	}
	
	// remplissage du tableau des races (sert � la construction du SELECT des races
	$races=array();
	$sql="SELECT * FROM `races` ORDER by `race` ASC;"; // r�cup�rer toutes les races
	$query=mysql_query($sql,$db_bestiaire);
	while($ret=mysql_fetch_array($query)){ // stocker toutes les races dans le
	  $races[$ret[0]]=$ret;                // tableau $races 
	}
	$image=$races[$Race]['image'];// nom de l'image repr�sentant la race
	$Famille=$races[$Race]['Famille'];// nom de la famille de la race.
	$genre=$races[$Race]['genre'];
	
	// V�rification et Affectation de l'�ge.
	if($Age!=''){ // si un �ge est donn� on le v�rifie
	  // r�cup�rer les �ges correspondants � la famille
	  $sql="SELECT ".$genre." FROM `ages` WHERE `Famille`=\"$Famille\"";
	  $query=mysql_query($sql,$db_bestiaire);
	  $ageok=FALSE;
	  while( ($ret=mysql_fetch_array($query)) && !$ageok ){ // on v�rifie si l'�ge pass� ds l'url
	    if($Age==$ret[$genre]) $ageok=TRUE;   // est valide
	  }
	  if(!$ageok) $Age='';
	}
	// recuperation de l'�ge de base
	$sql="SELECT * FROM famille WHERE Famille=\"$Famille\" ;";
	$query=mysql_query($sql,$db_bestiaire);
	
	if(!$query) die("Echec de la requ�te :<br>>$sql ".mysql_error()."<br>");
	$ret=mysql_fetch_array($query);
	$agebasic=$ret[$genre];
	if($Age==''){ // si toujours pas d'�ge, on prend l'�ge de base.
	  $Age=$agebasic;
	}
	

	$tab[0] = $Monstre;
	$tab[1] = $Race;
	$tab[2] = $races;
	$tab[3] = $Age;
	$tab[4] = $agebasic;
	$tab[5] = $Famille;
	$tab[6] = $image;
	
	return $tab;
}	

// r�cup�ration des capacit�s sp�ciales

function getCapaciteSpeciales($MonstreAge,$Monstre,$Race, $agebasic) 
{
	global $db_bestiaire;

	$pouvoirs=array();

	$sql="SELECT * FROM pouvoirs WHERE Nom=\"$MonstreAge\" ORDER BY cachet DESC;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requ�te :<br>$sql ".mysql_error()."<br>");
	
	while($ret=mysql_fetch_array($query)){
		$pouvoirs[]=$ret;
	}
	
	// si pas de pouvoir pour ce monstre, on cherche un pouvoir pour un monstre du
	// m�me template
	$pouvoirstemplate=array();
	
	if(count($pouvoirs)==0){ // on cherche d'abord pour le template sans �ge
		// on r�cup�re le premier �ge
		$sql="SELECT * FROM pouvoirs WHERE `Nom` LIKE \"$Monstre [".$agebasic."]\" ORDER BY `cachet` DESC LIMIT 1;";
		$query=mysql_query($sql,$db_bestiaire);
		if(!$query)
			die("Echec de la requ�te :<br>$sql<br>");

		$pouvoirstemplate=mysql_fetch_array($query);  
	
		if($pouvoirtsemplate==0) { // on essaie avec un autre template d'un autre �ge  
			$sql="SELECT * FROM pouvoirs WHERE `Nom`=\"$Monstre [%]\" ORDER BY `cachet` DESC LIMIT 1;";
			$query=mysql_query($sql,$db_bestiaire);
			
			if(!$query) 
				die("Echec de la requ�te :<br>$sql<br>");
				
			$pouvoirstemplate=mysql_fetch_array($query);

			if($pouvoirtsemplate==0){ // on essaie avec un autre template sans �ge (anciennes cdm)
				$sql="SELECT * FROM pouvoirs WHERE `Nom` LIKE \"$Monstre\" ORDER BY `cachet` DESC LIMIT 1;";
				$query=mysql_query($sql,$db_bestiaire);
				
				if(!$query) 
					die("Echec de la requ�te :<br>$sql<br>");
				
				$pouvoirstemplate=mysql_fetch_array($query);
	
				if($pouvoirstemplate==0) { // on essaie avec un autre template de la m�me race
					$sql="SELECT * FROM pouvoirs WHERE `Nom` LIKE \"%$Race%\" ORDER BY `cachet` DESC LIMIT 1;";
				
					$query=mysql_query($sql,$db_bestiaire);
					if(!$query) 
						die("Echec de la requ�te :<br>$sql<br>");
					$pouvoirstemplate=mysql_fetch_array($query);
			  }
			}
		}
	}

	$tab[0] = $pouvoirs;
	$tab[1] = $pouvoirstemplate;
	return $tab ;
}

function getCaracteristiques($MonstreAge,$Famille)
{
	global $db_bestiaire;
	
	$caracs=array();
	$sql="SELECT * FROM `caracs` WHERE `Nom`=\"$MonstreAge\" ORDER BY `cachet` DESC;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requ�te :<br>$sql<br>");
		while($ret=mysql_fetch_array($query)){
			$caracs[]=$ret;
	}

	// Affectation des variables pour les caracs principales
	// Si les caracs calcul�es ont �t� renseign�es on les prends, sinon on affecte
	// une autre valeur :
	// - niveau : celle de la premi�re cdm (il y en a forc�ment une, un monstre
	//            n'est entr�e dans la base que suite � la saisie d'une cdm)
	// _ AttDLA : '?'
	// - DurDLA : '?'
	// - RM     : '?'
	//
	$mlevel='?';
	$AttDLA='?';
	$DurDLA='?';
	$RM    ='?';
	
	if(count($caracs)>0){
		$mlevel=$caracs[0]['Niv'];
		$AttDLA=$caracs[0]['ATTDLA'];
		$DurDLA=$caracs[0]['DurDLA'];
		$RM    =$caracs[0]['RM'];
	}
	
	if($mlevel=='?'){
		if(count($cdm)>0) {
			$mlevel=$cdm[0]['Niv'];
			
		} else { // on essaie de le calculer
		  // on commence par remplir le tableau des �ges
		  $tab_age=array();
		  $sql="SELECT * FROM `ages` WHERE `Famille`=\"".$Famille."\" ORDER by `niveau` ASC;";
		  $query=mysql_query($sql,$db_bestiaire);
		  while($ret=mysql_fetch_array($query)){
				$tab_age[$ret[$races[$Race]['genre']]]=$ret; // on indexe suivant l'�ge du bon genre (donn� par race)
			}
			// on calcule l'�ge standard
			$Niv=calculeagestd($MonstreAge,$tab_age);
			// si il n'a jamais �t� initialis� (Niv==0) alors le niveau reste inconnu
			if($Niv==0)
				$mlevel='?';
			else
				$mlevel=$Niv;
		}
	}
	$tab[0] =$mlevel;
	$tab[1] =$AttDLA;
	$tab[2] =$DurDLA;
	$tab[3] =$RM    ;

	return $tab;
}

function getDeathPower($MonstreAge,$Monstre,$agebasic)
{
	global $db_bestiaire;

	// r�cup�ration des capacit�s sp�ciales
	$deaths=array();
	$sql="SELECT * FROM `derniersouffle` WHERE `Nom`=\"$MonstreAge\" ORDER BY `cachet` DESC;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	while($ret=mysql_fetch_array($query)){
	  $deaths[]=$ret;
	}
	
	// si pas de pouvoir pour ce monstre, on cherche un pouvoir pour un monstre du
	// m�me template
	$deathstemplate=array();
	if(count($deaths)==0){ // on essaie avec le template sans �ge
	  // on r�cup�re le premier �ge
	  $sql="SELECT * FROM `derniersouffle` WHERE `Nom` LIKE \"$Monstre [".$agebasic."]\" ORDER BY `cachet` DESC LIMIT 1;";
	  $query=mysql_query($sql,$db_bestiaire);
	  if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	  $deathstemplate=mysql_fetch_array($query);  
	  if($pouvoirtsemplate==0){ // on essaie avec un autre template d'un autre �ge  
	    $sql="SELECT * FROM `derniersouffle` WHERE `Nom`=\"$Monstre [%]\" ORDER BY `cachet` DESC LIMIT 1;";
	    $query=mysql_query($sql,$db_bestiaire);
	    if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	    $deathstemplate=mysql_fetch_array($query);
	    if($deathstemplate==0){ // sinon on essaie avec le m�me template sans �ge (anciennes cdm)
	      $sql="SELECT * FROM `derniersouffle` WHERE `Nom` LIKE \"$Monstre\" ORDER BY `cachet` DESC LIMIT 1;";
	      $query=mysql_query($sql,$db_bestiaire);
	      if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	      $deathstemplate=mysql_fetch_array($query);
	//       if($deathstemplate==0){ // on essaie avec un autre template de la m�me race
	// 	$sql="SELECT * FROM `derniersouffle` WHERE `Nom` LIKE \"%$Race%\" ORDER BY `cachet` DESC LIMIT 1;";
	// 	$query=mysql_query($sql);
	// 	if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	// 	$deathstemplate=mysql_fetch_array($query);
	//       }
	    }
	  }
	}
	
	$tab[0] = $deaths; 
	$tab[1] = $deathstemplate;

	return $tab;
}

function getCdm($MonstreAge,$Monstre,$Age,$agebasic)
{
	global $db_bestiaire;
	
	// remplissage du tableau des cdms pour le monstre s�lectionn�
	$cdm=array();
	$sql="SELECT * FROM `cdms` WHERE `Nom`=\"$MonstreAge\" ORDER BY `cachet` DESC;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	while($ret=mysql_fetch_array($query)){
		$cdm[]=$ret;
	}

	// si pas de cdms pour ce monstre, on cherche une cdm pour ce m�me template
	$cdmtemplate=array();

	if(count($cdm)==0){ // on cherche d'abord pour le template avec l'�ge de base
	  // on r�cup�re le premier �ge
	  $sql="SELECT * FROM `cdms` WHERE `Nom` LIKE \"$Monstre [".$agebasic."]\" ORDER BY `cachet` DESC LIMIT 1;";
	  $query=mysql_query($sql,$db_bestiaire);
	  if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	  $cdmtemplate=mysql_fetch_array($query);  
	  if($cdmtemplate==0){ // on essaie avec un autre template d'un autre �ge
	    $sql="SELECT * FROM `cdms` WHERE `Nom`=\"$Monstre [%]\" ORDER BY `cachet` DESC LIMIT 1;";
	    $query=mysql_query($sql,$db_bestiaire);
	    if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	    $cdmtemplate=mysql_fetch_array($query);
	    if($cdmtemplate==0){ // on essaie avec un autre template sans �ge (anciennes
				 // cdm avec erreur d'accent dans le nom de la race)
	      $sql="SELECT * FROM `cdms` WHERE `Nom` LIKE \"$Monstre\" ORDER BY `cachet` DESC LIMIT 1;";
	      $query=mysql_query($sql,$db_bestiaire);
	      if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	      $cdmtemplate=mysql_fetch_array($query);
	//   if($cdmtemplate==0){ // on essaie avec un autre template de la m�me race
	// 	$sql="SELECT * FROM `cdms` WHERE `Nom` LIKE \"%$Race%\" ORDER BY `cachet` DESC LIMIT 1;";
	// 	$query=mysql_query($sql);
	// 	if(!$query) die("Echec de la requ�te :<br>$sql<br>");
	// 	$cdmtemplate=mysql_fetch_array($query);
	//       }
	    }
	  }
	}
	$tab[0]= $cdm;
	$tab[1]= $cdmtemplate;
	return $tab;
}

?>
