<?

function selectDbMiss($annee, $genre, $type, $id_troll_miss = "", $resultat = false)
{
  global $db_vue_rm;

  $champs = " id_troll_miss, description_miss, annee_miss, genre_miss, type_miss,  image_1_miss, ";
  $champs .= " image_2_miss, nom_troll, reponse_miss, question_miss ";

  $sql = " SELECT ";
	$sql .= $champs;
	
	if ($resultat) {
		$sql .= " , COUNT(id_troll_vote) as nb_votes ";
	}

  $sql .= " FROM trolls, miss ";

	if ($resultat) {
		$sql .= " LEFT OUTER JOIN votes ON id_miss_vote = id_troll_miss ";
	}

  $sql .= " WHERE annee_miss = '$annee'";
	$sql .= " AND genre_miss = '$genre'"; 
	$sql .= " AND type_miss = '$type'"; 
	$sql .= " AND id_troll = id_troll_miss"; 

	if ($id_troll_miss != "") {
		$sql .= " AND id_troll_miss = $id_troll_miss";
	}

	if ($resultat) {
	  $sql .= " AND annee_vote = '$annee'";
		$sql .= " AND genre_vote = '$genre'"; 
		$sql .= " AND type_vote = '$type'"; 
		$sql .= " GROUP BY $champs ";
	}
		
  $sql .= " ORDER by nom_troll";
	
	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
	}

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
  } else {
    $i=1;
    while ($miss = mysql_fetch_assoc($result)) {
      $lesMiss[$i][id_troll_miss] = $miss[id_troll_miss];
      $lesMiss[$i][description_miss] = stripslashes($miss[description_miss]);
      $lesMiss[$i][annee_miss] = $miss[annee_miss];
      $lesMiss[$i][genre_miss] = $miss[genre_miss];
      $lesMiss[$i][type_miss] = $miss[type_miss];
      $lesMiss[$i][image_1_miss] = $miss[image_1_miss];
      $lesMiss[$i][image_2_miss] = $miss[image_2_miss];
      $lesMiss[$i][question_miss] = $miss[question_miss];
      $lesMiss[$i][reponse_miss] = $miss[reponse_miss];
      $lesMiss[$i][nom_troll] = $miss[nom_troll];
			if ($resultat) {
				$lesMiss[$i][nb_votes] = $miss[nb_votes]; 
			}
      $i++;
    }
  }
  return $lesMiss;
}

function edit_miss_db($annee, $genre, $type)
{
	global $db_vue_rm;

	$id_troll_miss = $_REQUEST[id_troll_miss];
	$description_miss = addslashes($_REQUEST[description_miss]);
	$question_miss = addslashes($_REQUEST[question_miss]);
	$reponse_miss = addslashes($_REQUEST[reponse_miss]);
	$image_1_miss = $_REQUEST[image_1_miss];
	$image_2_miss = $_REQUEST[image_2_miss];

	$sql = " UPDATE miss SET ";

	$sql .= " description_miss = '$description_miss',";
	$sql .= " question_miss = '$question_miss',";
	$sql .= " reponse_miss = '$reponse_miss',";
	$sql .= " image_1_miss ='$image_1_miss',";
	$sql .= " image_2_miss ='$image_2_miss'";
	$sql .= " WHERE id_troll_miss = $id_troll_miss";
	$sql .= " AND annee_miss = '$annee'";
	$sql .= " AND genre_miss = '$genre'";
	$sql .= " AND type_miss = '$type'";
	
	mysql_query($sql);
	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
		return false;
	} else {
		return true;
	}

}

function delete_miss_db($annee, $genre, $type)
{
	global $db_vue_rm;

	$id_troll_miss = $_REQUEST[id_troll_miss];

	$sql = " DELETE FROM miss ";

	$sql .= " WHERE id_troll_miss = $id_troll_miss";
	$sql .= " AND annee_miss = '$annee'";
	$sql .= " AND genre_miss = '$genre'";
	$sql .= " AND type_miss = '$type'";
	
	mysql_query($sql);
	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
		return false;
	} else {
		return true;
	}

}

function enregistre_vote_db( $id_troll_vote, $annee_vote, $id_miss_vote, $genre_vote, $type_vote )
{
  global $db_vue_rm;

	$ip_vote = getenv(REMOTE_ADDR);
	$date_vote = date("Y-m-d H-i-s");

	/* Vérification des variables */
	if (is_numeric($id_troll_vote) && is_numeric($id_miss_vote)) {
		$id_troll_vote = intval($id_troll_vote);
		$id_miss_vote = intval($id_miss_vote);
	} else {
		die("Erreur de Secu. Contacter Bodega 49145. fonction enregistre_vote_db(). Merci");
	}
	
	$sql = " INSERT INTO votes ( id_troll_vote , id_miss_vote, annee_vote, date_vote, ip_vote, genre_vote, type_vote )  VALUES (";
	$sql .= " $id_troll_vote,";
	$sql .= " $id_miss_vote,";
	$sql .= " '$annee_vote',";
	$sql .= " '$date_vote',";
	$sql .= " '$ip_vote',"; 
	$sql .= " '$genre_vote',"; 
	$sql .= " '$type_vote'"; 
	$sql .= " )";
	
	mysql_query($sql);
	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
		return false;
	} else {
		return true;
	}
}


function enregistre_candidature_db( $id_troll_miss, $annee_miss, $description_miss, $question_miss, $reponse_miss, $genre_miss , $type_miss)
{
  global $db_vue_rm;

	$sql = " INSERT INTO miss ( id_troll_miss , description_miss, reponse_miss, question_miss, annee_miss, genre_miss, type_miss )  VALUES (";
	$sql .= " $id_troll_miss,";
	$sql .= " '".addslashes($description_miss)."',";
	$sql .= " '".addslashes($reponse_miss)."',";
	$sql .= " '".addslashes($question_miss)."',";
	$sql .= " '$annee_miss',";
	$sql .= " '$genre_miss',"; 
	$sql .= " '$type_miss'"; 
	$sql .= " )";
	
	mysql_query($sql);
	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
		return false;
	} else {
		return true;
	}
}


function verif_nombre_vote_troll_db ($id_troll_vote, $annee_vote, $genre_vote, $type_vote )
{
  global $db_vue_rm;

	/* Vérification des variables */
	if (is_numeric($id_troll_vote)) {
		$id_troll_vote = intval($id_troll_vote);
	} else {
		die("Erreur de Secu. Contacter Bodega 49145. fonction verif_nombre_vote_troll_db(). Merci");
	}

	$sql = "SELECT COUNT(*) FROM votes";
	$sql .= " WHERE id_troll_vote = $id_troll_vote";
	$sql .= " AND annee_vote = '$annee_vote'";
	$sql .= " AND genre_vote = '$genre_vote'";
	$sql .= " AND type_vote = '$type_vote'";

	if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result = mysql_query($sql,$db_vue_rm);

	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
	}

	if (mysql_affected_rows() >0)
		list($nb) = mysql_fetch_array($result);
	else
		$nb = 0;

	if ($nb == 0)
		return false;
	else
		return true;
}

function verif_nombre_candidature_troll_db ( $id_troll_miss, $annee_miss, $genre_miss, $type_miss)
{
  global $db_vue_rm;

	$sql = "SELECT COUNT(*) FROM miss";
	$sql .= " WHERE id_troll_miss = $id_troll_miss";
	$sql .= " AND annee_miss = '$annee_miss'";
	$sql .= " AND genre_miss = '$genre_miss'";
	$sql .= " AND type_miss = '$type_miss'";

	if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result = mysql_query($sql,$db_vue_rm);

	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
	}

	if (mysql_affected_rows() >0)
		list($nb) = mysql_fetch_array($result);
	else
		$nb = 0;

	if ($nb == 0)
		return false;
	else
		return true;
}

function nombre_votes_db( $annee_vote, $genre_vote, $type_vote )
{
  global $db_vue_rm;

	$sql = "SELECT COUNT(*) FROM votes";
	$sql .= " WHERE annee_vote = '$annee_vote'";
	$sql .= " AND genre_vote = '$genre_vote'";
	$sql .= " AND type_vote = '$type_vote'";

	if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result = mysql_query($sql,$db_vue_rm);

	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
	}

	if (mysql_affected_rows() >0)
		list($nb) = mysql_fetch_array($result);
	else
		$nb = 0;

	return $nb;
}


function nombre_candidatures_db( $annee_miss, $genre_miss, $type_miss )
{
  global $db_vue_rm;

	$sql = "SELECT COUNT(*) FROM miss";
	$sql .= " WHERE annee_miss = '$annee_miss'";
	$sql .= " AND genre_miss = '$genre_miss'";
	$sql .= " AND type_miss = '$type_miss'";

	if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
	$result = mysql_query($sql,$db_vue_rm);

	$erreur = mysql_error();

	if ($erreur != "") {
		echo $erreur. " sql=$sql<br>";
	}

	if (mysql_affected_rows() >0)
		list($nb) = mysql_fetch_array($result);
	else
		$nb = 0;

	return $nb;

}
?>
