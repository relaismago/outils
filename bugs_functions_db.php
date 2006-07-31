<?

function selectDbBugs($id_bug = "",$outil="",$debut="0",$nb_ppage="10",$nom_ordre="id_bug",$order="")
{
  global $db_vue_rm;

  $sql = "SELECT	id_bug,  id_troll_emetteur_bug,  id_troll_responsable_bug,";
	$sql .= "t1.nom_troll as nom_emetteur, t2.nom_troll as nom_responsable,";
	$sql .= "UNIX_TIMESTAMP(date_ouverture_bug) as date_ouverture_bug,";
	$sql .= "UNIX_TIMESTAMP(date_cloture_bug) as date_cloture_bug, description_bug, criticite_bug,outil_touche_bug,";
	$sql .= "type_bug, etat_bug";

  $sql .= " FROM bugs, trolls t1, trolls t2";
	$sql .= " WHERE t1.id_troll = id_troll_emetteur_bug";
	$sql .= " AND t2.id_troll = id_troll_responsable_bug";

	if ($outil != "")
		$sql .= " AND outil_touche_bug = '$outil'";

  if ($id_bug != "")
    $sql .= " AND id_bug=$id_bug";

  $sql .= " ORDER BY $nom_ordre";
  $sql .= " $order";

  $sql .= " LIMIT $debut,$nb_ppage";

	//$sql .= " ORDER by etat_bug, type_bug desc, date_ouverture_bug";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
  } else {
    $i=1;
    while ($bug = mysql_fetch_assoc($result)) {
      $lesBugs[$i][id_bug]=$bug[id_bug];
      $lesBugs[$i][id_troll_emetteur_bug]=$bug[id_troll_emetteur_bug];
      $lesBugs[$i][id_troll_responsable_bug]=$bug[id_troll_responsable_bug];
      $lesBugs[$i][nom_emetteur]=$bug[nom_emetteur];
      $lesBugs[$i][nom_responsable]=$bug[nom_responsable];
      $lesBugs[$i][date_ouverture_bug]=$bug[date_ouverture_bug];
      $lesBugs[$i][date_cloture_bug]=$bug[date_cloture_bug];
      $lesBugs[$i][description_bug]=$bug[description_bug];
      $lesBugs[$i][criticite_bug]=$bug[criticite_bug];
      $lesBugs[$i][type_bug]=$bug[type_bug];
      $lesBugs[$i][etat_bug]=$bug[etat_bug];
      $lesBugs[$i][outil_touche_bug]=$bug[outil_touche_bug];
      $i++;
    }
  }
  return $lesBugs;
}


function selectDbBugsCount()
{
  global $db_vue_rm;

  $sql = "SELECT count(id_bug)";
  $sql .= " FROM bugs";

  $result=mysql_query($sql,$db_vue_rm);
  echo mysql_error();
  list($nb)=mysql_fetch_array($result);

  return $nb;
}



function editDbBug()
{
	global $db_vue_rm;

  // Récupération des variables du formulaire
  $id_bug = $_REQUEST[id_bug];
  $id_troll_emetteur_bug = $_REQUEST[id_troll_emetteur_bug];
  $id_troll_responsable_bug = $_REQUEST[id_troll_responsable_bug];
  $date_ouverture_bug = $_REQUEST[date_ouverture_bug];
  $date_cloture_bug = $_REQUEST[date_cloture_bug];
  $description_bug = htmlentities(addslashes($_REQUEST[description_bug]));
  $criticite_bug = $_REQUEST[criticite_bug];
  $type_bug = $_REQUEST[type_bug];
  $etat_bug = $_REQUEST[etat_bug];
  $etat_bug_old = $_REQUEST[etat_bug_old];
  $outil_touche_bug = $_REQUEST[outil_touche_bug];

	/* --- Vérification des droits. On autorise le changement uniquement si 
	       c'est un admnistrateur ou l'emetteur du bugs --- */
	if (($id_troll_emetteur_bug != $_SESSION[AuthTroll]) &&
			(!isControlAdministrateur()))
			die("<font color=red>Accès refusé</font>");

  // Si l'on veut ajouter le bug
  if ($id_bug == "new") {
    // On l'ajoute dans la base de données
		$sql = "INSERT into bugs (id_troll_emetteur_bug,date_ouverture_bug,id_troll_responsable_bug) ";
		$sql .= "VALUES ($id_troll_emetteur_bug,'$date_ouverture_bug',0)";

    mysql_query($sql);

    echo mysql_error();
    // puis on récupère l'identifiant qui vient de se faire rentrer
    $id_bug =mysql_insert_id($db_vue_rm);
    $info_action = "ajouté";
  } else {
    $info_action = "modifié";
  }

  $sql = " UPDATE bugs SET ";
  $sql .= " id_troll_responsable_bug=$id_troll_responsable_bug,";
  $sql .= " description_bug='$description_bug',";
  $sql .= " criticite_bug='$criticite_bug',";
  $sql .= " type_bug='$type_bug',";
  $sql .= " etat_bug='$etat_bug',";

	//si l'on cloture le bug,on renseigne la date
	if (($etat_bug_old != "clos") && ($etat_bug == "clos"))
	  $sql .= " date_cloture_bug='".date("Y-m-d H-i-s")."',";
	elseif (($etat_bug_old == "clos") && ($etat_bug != "clos"))
	  $sql .= " date_cloture_bug='0000-00-00 00:00',";
	
  $sql .= " outil_touche_bug='$outil_touche_bug'";
  $sql .= " WHERE id_bug=$id_bug";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la mise à jour du bug. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>Le Bug est $info_action</h1>";
    echo "<a href='bugs.php?bug=liste'>Retour à la liste des Bugs</a> - ";
    echo "<a href='bugs.php?bug=$id_bug'>Retour à la fiche du Bug</a> - ";
    echo "<a href='bugs.php?bug=new'>Ajouter un nouveau bug</a>";
  }
}

function deleteDbBug($id_bug)
{
  global $db_vue_rm;

	/* --- Vérification des droits. On autorise la suppression  uniquement si 
	       c'est un admnistrateur ou l'emetteur du bugs --- */
	$lesBugs = selectDbBugs($id_bug);

	$leBug = $lesBugs[1];
	$id_troll_emetteur_bug = $leBug[id_troll_emetteur_bug];

	if (($id_troll_emetteur_bug != $_SESSION[AuthTroll]) && 
			(!isControlAdministrateur()))
			die("<font color=red>Accès refusé</font>");

  $sql = " DELETE FROM bugs ";
  $sql .= " WHERE id_bug=$id_bug";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo " Erreur dans la suppression du Bug. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>Le Bug n° $id_bug est supprimé</h1>";
    echo "<a href='bugs.php?bug=liste'>Retour à la liste des bugs</a> ";
  }
}

?>
