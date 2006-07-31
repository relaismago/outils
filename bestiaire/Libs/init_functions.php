<?

/* --------------------------------------------
Sont présentes dans ce fichier : 
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

	// Initialisation des variables Race et Monstre pour la pré-sélection d'un
	// affichage
	// on est obligé d'utiliser stripslashes car certains noms contiennent des
	// apostrophes et ils se retrouvent protégés par un \ ce qui fausse ensuite les
	// recherches en table.
	if (isset($_GET['Race'])) $Race = stripslashes($_GET['Race']); else $Race="none";
	if (isset($_GET['Monstre'])) $Monstre = stripslashes($_GET['Monstre']); else $Monstre="none";
	if (isset($_GET['Age'])) $Age = stripslashes($_GET['Age']); else $Age='';

	// Réaffectation des variables Monstres et Races en fonctions des données
	// spécifiées ou non dans l'url

	// si la variable Monstre est positionnée on vérifie qu'il correspond à la race
	if( ($Monstre!="none") && ($Race!="none") ){ // Monstre et Race donnés en paramètre dans l'url
	  $sql="SELECT Monstre FROM monstres WHERE Race=\"$Race\" and `Monstre`=\"$Monstre\";";
	  $query=mysql_query($sql,$db_bestiaire);
		// le Monstre donné n'est pas de la Race indiquée.
	  if(mysql_num_rows($query)==0){ 
	    $Monstre="none";
	  }
	}
	if( ($Race!="none") && ($Monstre=="none") ){
	  // pour le monstre on cherche celui qui a le template standard cad le même nom
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
	if( ($Race=="none") && ($Monstre=="none") ){ // si aucun des deux n'est donné
	  $Monstre="Abishaii Bleu";
	  $Race="Abishaii Bleu";
	}
	
	// remplissage du tableau des races (sert à la construction du SELECT des races
	$races=array();
	$sql="SELECT * FROM `races` ORDER by `race` ASC;"; // récupérer toutes les races
	$query=mysql_query($sql,$db_bestiaire);
	while($ret=mysql_fetch_array($query)){ // stocker toutes les races dans le
	  $races[$ret[0]]=$ret;                // tableau $races 
	}
	$image=$races[$Race]['image'];// nom de l'image représentant la race
	$Famille=$races[$Race]['Famille'];// nom de la famille de la race.
	$genre=$races[$Race]['genre'];
	
	// Vérification et Affectation de l'Âge.
	if($Age!=''){ // si un âge est donné on le vérifie
	  // récupérer les âges correspondants à la famille
	  $sql="SELECT ".$genre." FROM `ages` WHERE `Famille`=\"$Famille\"";
	  $query=mysql_query($sql,$db_bestiaire);
	  $ageok=FALSE;
	  while( ($ret=mysql_fetch_array($query)) && !$ageok ){ // on vérifie si l'âge passé ds l'url
	    if($Age==$ret[$genre]) $ageok=TRUE;   // est valide
	  }
	  if(!$ageok) $Age='';
	}
	// recuperation de l'âge de base
	$sql="SELECT * FROM famille WHERE Famille=\"$Famille\" ;";
	$query=mysql_query($sql,$db_bestiaire);
	
	if(!$query) die("Echec de la requête :<br>>$sql ".mysql_error()."<br>");
	$ret=mysql_fetch_array($query);
	$agebasic=$ret[$genre];
	if($Age==''){ // si toujours pas d'âge, on prend l'âge de base.
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

// récupération des capacités spéciales

function getCapaciteSpeciales($MonstreAge,$Monstre,$Race, $agebasic) 
{
	global $db_bestiaire;

	$pouvoirs=array();

	$sql="SELECT * FROM pouvoirs WHERE Nom=\"$MonstreAge\" ORDER BY cachet DESC;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requête :<br>$sql ".mysql_error()."<br>");
	
	while($ret=mysql_fetch_array($query)){
		$pouvoirs[]=$ret;
	}
	
	// si pas de pouvoir pour ce monstre, on cherche un pouvoir pour un monstre du
	// même template
	$pouvoirstemplate=array();
	
	if(count($pouvoirs)==0){ // on cherche d'abord pour le template sans âge
		// on récupère le premier âge
		$sql="SELECT * FROM pouvoirs WHERE `Nom` LIKE \"$Monstre [".$agebasic."]\" ORDER BY `cachet` DESC LIMIT 1;";
		$query=mysql_query($sql,$db_bestiaire);
		if(!$query)
			die("Echec de la requête :<br>$sql<br>");

		$pouvoirstemplate=mysql_fetch_array($query);  
	
		if($pouvoirtsemplate==0) { // on essaie avec un autre template d'un autre âge  
			$sql="SELECT * FROM pouvoirs WHERE `Nom`=\"$Monstre [%]\" ORDER BY `cachet` DESC LIMIT 1;";
			$query=mysql_query($sql,$db_bestiaire);
			
			if(!$query) 
				die("Echec de la requête :<br>$sql<br>");
				
			$pouvoirstemplate=mysql_fetch_array($query);

			if($pouvoirtsemplate==0){ // on essaie avec un autre template sans âge (anciennes cdm)
				$sql="SELECT * FROM pouvoirs WHERE `Nom` LIKE \"$Monstre\" ORDER BY `cachet` DESC LIMIT 1;";
				$query=mysql_query($sql,$db_bestiaire);
				
				if(!$query) 
					die("Echec de la requête :<br>$sql<br>");
				
				$pouvoirstemplate=mysql_fetch_array($query);
	
				if($pouvoirstemplate==0) { // on essaie avec un autre template de la même race
					$sql="SELECT * FROM pouvoirs WHERE `Nom` LIKE \"%$Race%\" ORDER BY `cachet` DESC LIMIT 1;";
				
					$query=mysql_query($sql,$db_bestiaire);
					if(!$query) 
						die("Echec de la requête :<br>$sql<br>");
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
	if(!$query) die("Echec de la requête :<br>$sql<br>");
		while($ret=mysql_fetch_array($query)){
			$caracs[]=$ret;
	}

	// Affectation des variables pour les caracs principales
	// Si les caracs calculées ont été renseignées on les prends, sinon on affecte
	// une autre valeur :
	// - niveau : celle de la première cdm (il y en a forcément une, un monstre
	//            n'est entrée dans la base que suite à la saisie d'une cdm)
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
		  // on commence par remplir le tableau des âges
		  $tab_age=array();
		  $sql="SELECT * FROM `ages` WHERE `Famille`=\"".$Famille."\" ORDER by `niveau` ASC;";
		  $query=mysql_query($sql,$db_bestiaire);
		  while($ret=mysql_fetch_array($query)){
				$tab_age[$ret[$races[$Race]['genre']]]=$ret; // on indexe suivant l'âge du bon genre (donné par race)
			}
			// on calcule l'âge standard
			$Niv=calculeagestd($MonstreAge,$tab_age);
			// si il n'a jamais été initialisé (Niv==0) alors le niveau reste inconnu
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

	// récupération des capacités spéciales
	$deaths=array();
	$sql="SELECT * FROM `derniersouffle` WHERE `Nom`=\"$MonstreAge\" ORDER BY `cachet` DESC;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requête :<br>$sql<br>");
	while($ret=mysql_fetch_array($query)){
	  $deaths[]=$ret;
	}
	
	// si pas de pouvoir pour ce monstre, on cherche un pouvoir pour un monstre du
	// même template
	$deathstemplate=array();
	if(count($deaths)==0){ // on essaie avec le template sans âge
	  // on récupère le premier âge
	  $sql="SELECT * FROM `derniersouffle` WHERE `Nom` LIKE \"$Monstre [".$agebasic."]\" ORDER BY `cachet` DESC LIMIT 1;";
	  $query=mysql_query($sql,$db_bestiaire);
	  if(!$query) die("Echec de la requête :<br>$sql<br>");
	  $deathstemplate=mysql_fetch_array($query);  
	  if($pouvoirtsemplate==0){ // on essaie avec un autre template d'un autre âge  
	    $sql="SELECT * FROM `derniersouffle` WHERE `Nom`=\"$Monstre [%]\" ORDER BY `cachet` DESC LIMIT 1;";
	    $query=mysql_query($sql,$db_bestiaire);
	    if(!$query) die("Echec de la requête :<br>$sql<br>");
	    $deathstemplate=mysql_fetch_array($query);
	    if($deathstemplate==0){ // sinon on essaie avec le même template sans âge (anciennes cdm)
	      $sql="SELECT * FROM `derniersouffle` WHERE `Nom` LIKE \"$Monstre\" ORDER BY `cachet` DESC LIMIT 1;";
	      $query=mysql_query($sql,$db_bestiaire);
	      if(!$query) die("Echec de la requête :<br>$sql<br>");
	      $deathstemplate=mysql_fetch_array($query);
	//       if($deathstemplate==0){ // on essaie avec un autre template de la même race
	// 	$sql="SELECT * FROM `derniersouffle` WHERE `Nom` LIKE \"%$Race%\" ORDER BY `cachet` DESC LIMIT 1;";
	// 	$query=mysql_query($sql);
	// 	if(!$query) die("Echec de la requête :<br>$sql<br>");
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
	
	// remplissage du tableau des cdms pour le monstre sélectionné
	$cdm=array();
	$sql="SELECT * FROM `cdms` WHERE `Nom`=\"$MonstreAge\" ORDER BY `cachet` DESC;";
	$query=mysql_query($sql,$db_bestiaire);
	if(!$query) die("Echec de la requête :<br>$sql<br>");
	while($ret=mysql_fetch_array($query)){
		$cdm[]=$ret;
	}

	// si pas de cdms pour ce monstre, on cherche une cdm pour ce même template
	$cdmtemplate=array();

	if(count($cdm)==0){ // on cherche d'abord pour le template avec l'âge de base
	  // on récupère le premier âge
	  $sql="SELECT * FROM `cdms` WHERE `Nom` LIKE \"$Monstre [".$agebasic."]\" ORDER BY `cachet` DESC LIMIT 1;";
	  $query=mysql_query($sql,$db_bestiaire);
	  if(!$query) die("Echec de la requête :<br>$sql<br>");
	  $cdmtemplate=mysql_fetch_array($query);  
	  if($cdmtemplate==0){ // on essaie avec un autre template d'un autre âge
	    $sql="SELECT * FROM `cdms` WHERE `Nom`=\"$Monstre [%]\" ORDER BY `cachet` DESC LIMIT 1;";
	    $query=mysql_query($sql,$db_bestiaire);
	    if(!$query) die("Echec de la requête :<br>$sql<br>");
	    $cdmtemplate=mysql_fetch_array($query);
	    if($cdmtemplate==0){ // on essaie avec un autre template sans âge (anciennes
				 // cdm avec erreur d'accent dans le nom de la race)
	      $sql="SELECT * FROM `cdms` WHERE `Nom` LIKE \"$Monstre\" ORDER BY `cachet` DESC LIMIT 1;";
	      $query=mysql_query($sql,$db_bestiaire);
	      if(!$query) die("Echec de la requête :<br>$sql<br>");
	      $cdmtemplate=mysql_fetch_array($query);
	//   if($cdmtemplate==0){ // on essaie avec un autre template de la même race
	// 	$sql="SELECT * FROM `cdms` WHERE `Nom` LIKE \"%$Race%\" ORDER BY `cachet` DESC LIMIT 1;";
	// 	$query=mysql_query($sql);
	// 	if(!$query) die("Echec de la requête :<br>$sql<br>");
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
