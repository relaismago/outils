<?

class loterie_participants
{
	function get_list() {
		return $this->list;
	}
	
	/* renvoie la valeur de la loterie
	 * Nombre de participants x valeur de chaque participation
	 */
	function get_total_participe() {
    global $db_vue_rm;

		$loterie = new loterie($this->id_loterie);

		return $this->get_nombre_participants() * $loterie->get_valeur_participe();
	}
	
	/* renvoie le nombre de participants pour la loterie
	 *
	 */
	function get_nombre_participants() {
    global $db_vue_rm;

    $sql = "SELECT COUNT(*) as nb";
    $sql .= " FROM loteries_participants";
    $sql .= " WHERE id_loterie_loteriep = ".$this->id_loterie;

    $query_result = mysql_query($sql, $db_vue_rm);
    $row = mysql_fetch_array($query_result);

    echo mysql_error();  

		return $row["nb"];
	}

	/* Lits tous les participants dans la base de données
	 * et les mets dans un tableau, accessible par get_list()
	 */
	function read_db() {
		global $db_vue_rm;

		$sql = " SELECT id_loteriep, id_troll_loteriep, id_loterie_loteriep, date_loteriep, ";
		$sql .= " date_remise_loteriep, ip_loteriep, ";
		$sql .= " nom_troll ";
		$sql .= " FROM loteries_participants, trolls";
		$sql .= " WHERE id_loterie_loteriep =".$this->id_loterie;
		$sql .= " AND id_troll_loteriep = id_troll";

		if (!$result=mysql_query($sql,$db_vue_rm)) {
			echo mysql_error();
		} else {
			$i=1;
			while ($row = mysql_fetch_assoc($result)) {
				$this->list[$i]['id_loteriep'] = $row['id_loteriep'];
				$this->list[$i]['id_troll_loteriep'] = $row['id_troll_loteriep'];
				$this->list[$i]['id_loterie_loteriep'] = $row['id_loterie_loteriep'];
				$this->list[$i]['date_loteriep'] = $row['date_loteriep'];
				$this->list[$i]['date_remise_loteriep'] = $row['date_remise_loteriep'];
				$this->list[$i]['ip_loteriep'] = $row['ip_loteriep'];
				$this->list[$i]['nom_troll_loteriep'] = $row['nom_troll'];
				$i++;
			}
		}  
	}
	
	/* Constructeur, $id_loterie en paramêtre
	 * fait appel à read->db() pour remplir $this->list
	 */
	function loterie_participants ($id_loterie) {
		$this->id_loterie = $id_loterie;
		$this->read_db();
	}

}

?>
