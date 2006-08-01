<?

function editDbGrandeTaniere()
{
	global $db_vue_rm;

	// Récupération des variables du formulaire
	$id_lieu_gtaniere = $_REQUEST['id_lieu_gtaniere'];
	$id_guilde_gtaniere = $_REQUEST['id_guilde_gtaniere'];

	$nom_gtaniere = $_REQUEST['nom_gtaniere'];
	$x_gtaniere = $_REQUEST['x_gtaniere'];
	$y_gtaniere = $_REQUEST['y_gtaniere'];
	$z_gtaniere = $_REQUEST['z_gtaniere'];
	$is_tgv_gtaniere = $_REQUEST['is_tgv_gtaniere'];
	$prix_tgv_guilde_gtaniere = $_REQUEST['prix_tgv_guilde_gtaniere'];
	$prix_tgv_amis_gtaniere = $_REQUEST['prix_tgv_amis_gtaniere'];
	$prix_tgv_neutres_gtaniere = $_REQUEST['prix_tgv_neutres_gtaniere'];
	$prix_tgv_ennemis_gtaniere = $_REQUEST['prix_tgv_ennemis_gtaniere'];
	$connexions_gtaniere = $_REQUEST['connexions_gtaniere'];
	$is_soins_gtaniere = $_REQUEST['is_soins_gtaniere'];
	$prix_soins_guilde_gtaniere = $_REQUEST['prix_soins_guilde_gtaniere'];
	$prix_soins_amis_gtaniere = $_REQUEST['prix_soins_amis_gtaniere'];
	$prix_soins_neutres_gtaniere = $_REQUEST['prix_soins_neutres_gtaniere'];
	$prix_soins_ennemis_gtaniere = $_REQUEST['prix_soins_ennemis_gtaniere'];
	$is_resurection_gtaniere = $res['is_resurection_gtaniere'];
	$prix_resurection_guilde_gtaniere = $_REQUEST['prix_resurection_guilde_gtaniere'];
	$prix_resurection_amis_gtaniere = $_REQUEST['prix_resurection__gtaniere'];
	$prix_resurection_neutres_gtaniere = $_REQUEST['prix_resurection__gtaniere'];
	$prix_resurection_ennemis_gtaniere =$_REQUEST['prix_resurection__gtaniere'];
	$is_forgeron_gtaniere = $_REQUEST['is_forgeron_gtaniere'];
	$prix_forgeron_guilde_gtaniere = $_REQUEST['prix_forgeron_guilde_gtaniere'];
	$prix_forgeron_amis_gtaniere = $_REQUEST['prix_forgeron_guilde_gtaniere'];
	$prix_forgeron_neutres_gtaniere = $_REQUEST['prix_forgeron_guilde_gtaniere'];
	$prix_forgeron_ennemis_gtaniere = $_REQUEST['prix_forgeron_guilde_gtaniere'];
	$is_commerce_gtaniere = $_REQUEST['is_commerce_gtaniere'];
	$date_gtaniere = $_REQUEST['date'];

	$date = date("Y-m-d H-i-s");
	
	$sql = "INSERT into gtanieres (id_lieu_gtaniere) VALUES ($id_lieu_gtaniere)";
	echo "SQL=$sql<br><br>";

	mysql_query($sql);
	$id_gtaniere = mysql_insert_id();
	echo mysql_error();

  $sql = " UPDATE gtanieres";

	$sql .= "  SET ";
	$sql .= "  id_lieu_gtaniere = $id_lieu_gtaniere,";
	$sql .= "  id_guilde_gtaniere = $id_guilde_gtaniere,";
	$sql .= "  nom_gtaniere = '$nom_gtaniere',";
	$sql .= "  x_gtaniere = $x_gtaniere,";
	$sql .= "  y_gtaniere = $y_gtaniere,";
	$sql .= "  z_gtaniere = $z_gtaniere,";
	$sql .= "  is_tgv_gtaniere = '$is_tgv_gtaniere',";
	$sql .= "  prix_tgv_guilde_gtaniere = '$prix_tgv_guilde_gtaniere',";
	$sql .= "  prix_tgv_amis_gtaniere = '$prix_tgv_amis_gtaniere',";
	$sql .= "  prix_tgv_neutres_gtaniere = '$prix_tgv_neutres_gtaniere',";
	$sql .= "  prix_tgv_ennemis_gtaniere = '$prix_tgv_ennemis_gtaniere',";
	$sql .= "  connexions_gtaniere = '$connexions_gtaniere',";
	$sql .= "  is_soins_gtaniere = '$is_soins_gtaniere',";
	$sql .= "  prix_soins_guilde_gtaniere = '$prix_soins_guilde_gtaniere',";
	$sql .= "  prix_soins_amis_gtaniere = '$prix_soins_amis_gtaniere',";
	$sql .= "  prix_soins_neutres_gtaniere = '$prix_soins_neutres_gtaniere',";
	$sql .= "  prix_soins_ennemis_gtaniere = '$prix_soins_ennemis_gtaniere',";
	$sql .= "  is_resurection_gtaniere = '$is_resurection_gtaniere',";
	$sql .= "  prix_resurection_guilde_gtaniere = '$prix_resurection_guilde_gtaniere',";
	$sql .= "  prix_resurection_amis_gtaniere = '$prix_resurection__gtaniere',";
	$sql .= "  prix_resurection_neutres_gtaniere = '$prix_resurection__gtaniere',";
	$sql .= "  prix_resurection_ennemis_gtaniere = '$prix_resurection__gtaniere',";
	$sql .= "  is_forgeron_gtaniere = '$is_forgeron_gtaniere',";
	$sql .= "  prix_forgeron_guilde_gtaniere = '$prix_forgeron_guilde_gtaniere',";
	$sql .= "  prix_forgeron_amis_gtaniere = '$prix_forgeron_guilde_gtaniere',";
	$sql .= "  prix_forgeron_neutres_gtaniere = '$prix_forgeron_guilde_gtaniere',";
	$sql .= "  prix_forgeron_ennemis_gtaniere = '$prix_forgeron_guilde_gtaniere',";
	$sql .= "  is_commerce_gtaniere = '$is_commerce_gtaniere',";
	$sql .= "  date_gtaniere = '$date'";
	
	$sql .= " WHERE id_gtaniere=$id_gtaniere";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
		echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour de la Tanière. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
	} else {
		 echo "<h1>Modification effectuée</h1>";
	}
}

function selectDbGrandesTanieres( $id="",$debut=0,$nb_ppage="10",$nom_ordre="nom_gtaniere",$order="",
																	$x_troll="",$y_troll="",$z_troll="")
{
  global $db_vue_rm;

	$champs .= "id_lieu_gtaniere , id_guilde_gtaniere ,	nom_gtaniere ,";
	$champs .= "x_gtaniere,	 y_gtaniere,	 z_gtaniere,	 is_tgv_gtaniere ,";
	$champs .= "prix_tgv_guilde_gtaniere ,	 prix_tgv_amis_gtaniere , ";
	$champs .= "prix_tgv_neutres_gtaniere, 	 prix_tgv_ennemis_gtaniere,";
	$champs .= "connexions_gtaniere ,	 is_soins_gtaniere, ";
	$champs .= "prix_soins_guilde_gtaniere ,	 prix_soins_amis_gtaniere ,";
	$champs .= "prix_soins_neutres_gtaniere ,	 prix_soins_ennemis_gtaniere , ";
	$champs .= "is_resurection_gtaniere ,	 prix_resurection_guilde_gtaniere ,";
	$champs .= "prix_resurection_amis_gtaniere ,	 prix_resurection_neutres_gtaniere ,";
	$champs .= "prix_resurection_ennemis_gtaniere,	 is_forgeron_gtaniere,";
	$champs .= "prix_forgeron_guilde_gtaniere,	 prix_forgeron_amis_gtaniere ,";
	$champs .= "prix_forgeron_neutres_gtaniere ,	 prix_forgeron_ennemis_gtaniere,";
	$champs .= "is_commerce_gtaniere, ";
	$champs .= "nom_guilde ";
	
  $sql = " SELECT $champs ";
  if ($id != "") {
		$sql .= " , max(date_gtaniere)";
	} else {
		$sql .= " , date_gtaniere";
	}

  $sql .= " FROM gtanieres, guildes";
	$sql .= " WHERE id_guilde = id_guilde_gtaniere ";

  if ($id != "") {
    $sql .= " AND id_lieu_gtaniere = $id";
	} else {
		// FIXME pas beau, à revoir ! :)
		$sql_select = " SELECT max(id_gtaniere) as id, id_lieu_gtaniere, max(date_gtaniere)";
		$sql_select .= " FROM gtanieres";
		$sql_select .= " GROUP BY id_lieu_gtaniere";

	  if ( !$result = mysql_query($sql_select,$db_vue_rm) ) {
	    echo mysql_error();
	 	} else {
	    $i=1;
			$sql .= " AND (";
    	while ($res = mysql_fetch_assoc($result)) {
    		$sql .= " id_gtaniere = $res[id] OR";
			}
			$sql = substr($sql,0,-3);
			$sql .= ")";
		}
	}

  if ($id != "") {
		$sql .= " GROUP BY $champs";
	}
  $sql .= " ORDER BY $nom_ordre";
  $sql .= " $order";

 // $sql .= " LIMIT $debut,$nb_ppage";


  if ( !$result = mysql_query($sql,$db_vue_rm) ) {
    echo mysql_error();
  } else {
    $i=1;
    $j=1;
    while ($gtanieres = mysql_fetch_assoc($result)) {
			
			if (is_numeric($x_troll) && is_numeric($y_troll) && is_numeric($z_troll) ) {
      	$lesGrandesTanieres[$i]['distance_pa'] = calcPA($x_troll,$y_troll,$z_troll,$gtanieres[x_gtaniere],$gtanieres[y_gtaniere],$gtanieres[z_gtaniere]);  
			}

      $lesGrandesTanieres[$i]['id_gtaniere'] = $gtanieres['id_gtaniere'];
			$lesGrandesTanieres[$i]['id_lieu_gtaniere'] = $gtanieres['id_lieu_gtaniere'];
			$lesGrandesTanieres[$i]['id_guilde_gtaniere'] = $gtanieres['id_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['nom_guilde'] = $gtanieres['nom_guilde'];
			$lesGrandesTanieres[$i]['nom_gtaniere'] = $gtanieres['nom_gtaniere'];
			$lesGrandesTanieres[$i]['x_gtaniere'] = $gtanieres['x_gtaniere'];
			$lesGrandesTanieres[$i]['y_gtaniere'] = $gtanieres['y_gtaniere'];
			$lesGrandesTanieres[$i]['z_gtaniere'] = $gtanieres['z_gtaniere'];
			$lesGrandesTanieres[$i]['is_tgv_gtaniere'] = $gtanieres['is_tgv_gtaniere'];
			$lesGrandesTanieres[$i]['prix_tgv_guilde_gtaniere'] = $gtanieres['prix_tgv_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['prix_tgv_amis_gtaniere'] = $gtanieres['prix_tgv_amis_gtaniere'];
			$lesGrandesTanieres[$i]['prix_tgv_neutres_gtaniere'] = $gtanieres['prix_tgv_neutres_gtaniere'];
			$lesGrandesTanieres[$i]['prix_tgv_ennemis_gtaniere'] = $gtanieres['prix_tgv_ennemis_gtaniere'];
			$lesGrandesTanieres[$i]['connexions_gtaniere'] = $gtanieres['connexions_gtaniere'];
			$lesGrandesTanieres[$i]['is_soins_gtaniere'] = $gtanieres['is_soins_gtaniere'];
			$lesGrandesTanieres[$i]['prix_soins_guilde_gtaniere'] = $gtanieres['prix_soins_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['prix_soins_amis_gtaniere'] = $gtanieres['prix_soins_amis_gtaniere'];
			$lesGrandesTanieres[$i]['prix_soins_neutres_gtaniere'] = $gtanieres['prix_soins_neutres_gtaniere'];
			$lesGrandesTanieres[$i]['prix_soins_ennemis_gtaniere'] = $gtanieres['prix_soins_ennemis_gtaniere'];
			$lesGrandesTanieres[$i]['is_resurection_gtaniere'] = $gtanieres['is_resurection_gtaniere'];
			$lesGrandesTanieres[$i]['prix_resurection_guilde_gtaniere'] = $gtanieres['prix_resurection_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['prix_resurection_amis_gtaniere'] = $gtanieres['prix_resurection_amis_gtaniere'];
			$lesGrandesTanieres[$i]['prix_resurection_neutres_gtaniere'] = $gtanieres['prix_resurection_neutres_gtaniere'];
			$lesGrandesTanieres[$i]['prix_resurection_ennemis_gtaniere'] =$gtanieres['prix_resurection_ennemis_gtaniere'];
			$lesGrandesTanieres[$i]['is_forgeron_gtaniere'] = $gtanieres['is_forgeron_gtaniere'];
			$lesGrandesTanieres[$i]['prix_forgeron_guilde_gtaniere'] = $gtanieres['prix_forgeron_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['prix_forgeron_amis_gtaniere'] = $gtanieres['prix_forgeron_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['prix_forgeron_neutres_gtaniere'] = $gtanieres['prix_forgeron_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['prix_forgeron_ennemis_gtaniere'] = $gtanieres['prix_forgeron_guilde_gtaniere'];
			$lesGrandesTanieres[$i]['is_commerce_gtaniere'] = $gtanieres['is_commerce_gtaniere'];
			$lesGrandesTanieres[$i]['date_gtaniere'] = $gtanieres['date'];
      $i++;
    }
  }
  return $lesGrandesTanieres;
}

function deleteDbGrandeTaniere()
{
  global $db_vue_rm;

  // Récupération des variables du formulaire
  $id_taniere = $_REQUEST['id_taniere'];

  if (! iscontroladministrateur()) {
    echo "REFUSE, vous n'êtes pas admin ! <br>";
    exit;
  }

  $id_troll_taniere = $res['id_troll_taniere'];

  $sql = " DELETE FROM gtanieres";
  $sql .= " WHERE id_gtaniere = $id_gtaniere";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la suppression de la tanière. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>La Grande Tanière $id_gtaniere est supprimée</h1>";
  }
}

function selectDbGrandesTanieresCount()
{
  global $db_vue_rm;

  $sql = "SELECT count(distinct(id_lieu_gtaniere))";
  $sql .= " FROM gtanieres";

  $result=mysql_query($sql,$db_vue_rm);
  echo mysql_error();
  list($nb)=mysql_fetch_array($result);

  return $nb;
}

?>
