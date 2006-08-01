<?

class loteries {

	/* renvoie la liste des loteries, dans un tableau
	 */
	function get_list() {
		$this->read_db();
		return $this->list;
	}

	/* renvoie la liste des loteries, dans un tableau
	 */
	function get_list_gagnee($id_troll) {
		$this->read_db(" AND id_gagnant_loterie =$id_troll");
		return $this->list;
	}
	
	/* Lit l'ensemble des loteries dans la base de données
	 * et les mets dans $this->list, accessible par get_list()
	 */
	function read_db($criteres="") {
		global $db_vue_rm;
  
		$sql = " SELECT id_loterie, date_creation_loterie, gain_loterie, id_gagnant_loterie,";
		$sql .= "valeur_type_loterie, etat_loterie,";
		$sql .= "nom_troll";
		$sql .= " FROM loteries, trolls ";
		$sql .= " WHERE id_gagnant_loterie = id_troll";
		$sql .= $criteres;

		if (!$result=mysql_query($sql,$db_vue_rm)) {
			echo mysql_error();
		} else {
			$i=1;
			while ($row = mysql_fetch_assoc($result)) {
				$this->list[$i]['id_loterie'] = $row['id_loterie'];
				$this->list[$i]['date_creation_loterie'] = $row['date_creation_loterie'];
				$this->list[$i]['gain_loterie'] = $row['gain_loterie'];
				$this->list[$i]['id_gagnant_loterie'] = $row['id_gagnant_loterie'];
				$this->list[$i]['valeur_type_loterie'] = $row['valeur_type_loterie'];
				$this->list[$i]['etat_loterie'] = $row['etat_loterie'];
				$this->list[$i]['nom_gagnant_loterie'] = $row['nom_troll'];
				$i++;
			}
		}
	}
	
	/* renvoie true si toutes les loteries sont closes, false sinon */
	function is_toutes_closes() {
		global $db_vue_rm;
  
		$sql = " SELECT count(distinct(etat_loterie)) as nb";
		$sql .= " FROM loteries";
		$sql .= " WHERE etat_loterie != 'clos'";

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		echo mysql_error();
		if ($row["nb"] == 0)
			return true;
		else 
			return false;
	}

	/* renvoie true si id_troll a été gagnant une fois */
	function is_gagnant($id_troll) {
		global $db_vue_rm;
  
		$sql = " SELECT count(*) as nb";
		$sql .= " FROM loteries";
		$sql .= " WHERE id_gagnant_loterie= ".$id_troll;

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		echo mysql_error();
		if ($row["nb"] > 0 && is_numeric($row["nb"]))
			return true;
		else 
			return false;
	}
	
	/* 
	 * Retourne l'id de la dernière loterie 
	 * 
	 */
	function get_last_id_loterie() {
		global $db_vue_rm;
  
		$sql = " SELECT max(id_loterie) as id_loterie";
		$sql .= " FROM loteries";

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		echo mysql_error();
		return $row["id_loterie"];
	}

	
	/* Constructeur, fait appel à $this->read_db()
	 *
	 */
	function loteries() {
	}
}

?>
