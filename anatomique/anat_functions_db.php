<?

function editDbTrollAnatomique($id_troll_anat,$pv_anat,$att_anat,
										 $esq_anat,$deg_anat,$reg_anat,$vue_anat,
										 $arm_anat,$source_anat,$date_anat)
{

  global $db_vue_rm;

	if ($source_anat == "") {
		$lesTrolls = selectDbTrolls($_SESSION[AuthTroll]);
		$troll = $lesTrolls[1];
		$source_anat= htmlentities($troll[nom_troll]);
	}

	// on regarde si le troll existe dans la table des trolls 
  $sql = " SELECT count(id_troll)";
  $sql .= " FROM trolls";
  $sql .= " WHERE id_troll = $id_troll_anat";

  $result=mysql_query($sql,$db_vue_rm);
  echo mysql_error();
  list($nb)=mysql_fetch_array($result);

	if ($nb==0) {
		$info = " Le troll $id_troll_anat n'existe pas dans la tables des trolls";
		$info .= ", l'ananlyse n'est donc pas prise en compte.<br>";
		return $info;
	}

  // On regarde si le troll n'existe pas déjà dans la table anatomiques 
  $sql = " SELECT id_troll_anatomique";
  $sql .= " FROM anatomiques";
  $sql .= " WHERE id_troll_anatomique = $id_troll_anat";

	$result = mysql_query($sql,$db_vue_rm);
  echo mysql_error();

	if (mysql_affected_rows() == 0 )
		$new = true;
	else
		$new = false;

	if ($new == "new") {
		// On l'ajoute dans la base de données
		mysql_query("INSERT into anatomiques (id_troll_anatomique) VALUES ($id_troll_anat)");
		echo mysql_error();
	}

  
  $sql = " UPDATE anatomiques SET";
  $sql .= " pv_anatomique = '".addslashes($pv_anat)."',";
  $sql .= " att_anatomique = '".addslashes($att_anat)."',";
  $sql .= " esq_anatomique = '".addslashes($esq_anat)."',";
  $sql .= " deg_anatomique = '".addslashes($deg_anat)."',";
  $sql .= " reg_anatomique = '".addslashes($reg_anat)."',";
  $sql .= " vue_anatomique = '".addslashes($vue_anat)."',";
  $sql .= " arm_anatomique = '".addslashes($arm_anat)."',";
  $sql .= " source_anatomique = '".addslashes($source_anat)."',";
  $sql .= " date_anatomique = '$date_anat'";
  $sql .= " WHERE id_troll_anatomique=$id_troll_anat";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la mise à jour de la baronnie. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
    die('Erreur');
  } else {
		$info_retour = "L'analyse du troll $id_troll_anat est enregistrée<br>";
	}
	return $info_retour;

}

function selectDbAnalyseAnatomiqueCount()
{
  global $db_vue_rm;

  $sql = "SELECT count(id_troll_anatomique)";
  $sql .= " FROM anatomiques,trolls";
	$sql .= " WHERE id_troll = id_troll_anatomique";

  $result=mysql_query($sql,$db_vue_rm);
  echo mysql_error();
  list($nb)=mysql_fetch_array($result);

	return $nb;
}

function selectDbAnalyseAnatomique($id_troll_anat="",$debut=0,$nb_ppage="10",$nom_ordre="id_troll_anatomique",$order="")
{
  global $db_vue_rm;

  $sql = "SELECT id_troll_anatomique,	pv_anatomique ,   att_anatomique ,  esq_anatomique ,";
	$sql .= "  deg_anatomique ,  reg_anatomique ,  vue_anatomique ,  arm_anatomique , ";
	$sql .= "source_anatomique , date_anatomique";

  $sql .= " FROM anatomiques,trolls";
	
	$sql .= " WHERE id_troll = id_troll_anatomique";
  if ($id_troll_anat!="")
    $sql .= " AND id_troll_anatomique=$id_troll_anat";
	
	$sql .= " ORDER BY $nom_ordre";
	$sql .= " $order";

	$sql .= " LIMIT $debut,$nb_ppage";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
  } else {
    $i=1;
    while ($anat = mysql_fetch_assoc($result)) {

      $date_anat = $anat[date_anatomique];
      $lesAnats[$i][id_troll_anatomique]=$anat[id_troll_anatomique];
      $lesAnats[$i][pv_anatomique]=$anat[pv_anatomique];
      $lesAnats[$i][att_anatomique]=$anat[att_anatomique];
      $lesAnats[$i][esq_anatomique]=$anat[esq_anatomique];
      $lesAnats[$i][deg_anatomique]=$anat[deg_anatomique];
      $lesAnats[$i][reg_anatomique]=$anat[reg_anatomique];
      $lesAnats[$i][vue_anatomique]=$anat[vue_anatomique];
      $lesAnats[$i][arm_anatomique]=$anat[arm_anatomique];
      $lesAnats[$i][source_anatomique]=$anat[source_anatomique];
      $lesAnats[$i][date_anatomique]=substr($date_anat,8,2)."-".substr($date_anat,5,2)."-".substr($date_anat,0,4);
      $i++;
    }
  }
  return $lesAnats;
}

?>
