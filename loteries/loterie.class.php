<?

class loterie
{
	
	function get_gain() {
		return stripslashes($this->gain);
	}

	function set_gain($gain) {
		$this->gain = addslashes($gain);
	}
	
	function get_id_gagnant() {
		return $this->id_gagnant;
	}

	function get_nom_gagnant() {
		return $this->nom_gagnant;
	}

	function get_valeur_participe() {
		return $this->valeur_participe;
	}

	function set_valeur_participe($valeur_participe) {
		$this->valeur_participe = $valeur_participe;
	}

	function get_valeur_type() {
		return $this->valeur_type;
	}

	function set_valeur_type($valeur_type) {
		$this->valeur_type = $valeur_type;
	}

	function get_etat() {
		return $this->etat;
	}

	function set_etat($etat) {
		$this->etat = $etat;
	}

	function get_date_creation() {
		return $date_creation;
	}

	function set_date_creation($date_creation) {
		$this->date_creation = $date_creation;
	}

	function calcul_gagnant() {

		$loterie_participants = new loterie_participants($this->id);
		$list = $loterie_participants->get_list();

		// Nbr totalement aléatoire
		// initialisation avec srand. http://fr.php.net/manual/fr/function.srand.php
		list($usec, $sec) = explode(' ', microtime());
		srand((float) $sec + ((float) $usec * 100000));

		// liste des trolls participant à la loterie
		$n = rand(1,count($list));
		$this->id_gagnant = $list[$n][id_troll_loteriep];

		if ($this->id_gagnant != "")
			return $this->id_gagnant;
		else
			return false;
	}

	function write_db_gagnant() {
		global $db_vue_rm;

		$sql = "UPDATE loteries SET ";
		$sql .= " id_gagnant_loterie = ".$this->id_gagnant;

		$sql .= " WHERE ";
		$sql .= " id_loteriep = ".$this->id;

		mysql_query($sql, $db_vue_rm)	;
		echo mysql_error();

		return $this->id_gagnant;
	}

	function insert_db() {
		global $db_vue_rm;
		
		$sql = "INSERT INTO loteries (";
		$sql .= " date_creation_loterie,";
		$sql .= " etat_loterie,";
		$sql .= " gain_loterie,";
		$sql .= " valeur_participe_loterie,";
		$sql .= " valeur_type_loterie";
		$sql .= " )";

		$sql .= " VALUES (";
		$sql .= " NOW(),";
		$sql .= " 'ouvert',";
		$sql .= " '".$this->gain."',";
		$sql .= " '".$this->valeur_participe."',";
		$sql .= " '".$this->valeur_type."'";
		$sql .= " )";

		mysql_query($sql, $db_vue_rm)	;
		echo mysql_error();
		$this->id = mysql_insert_id(); 
		echo "S=$sql id=".$this->id."<br>";
	}

	function update_db() {
		global $db_vue_rm;
		
		$sql = "UPDATE loteries SET ";
		$sql .= " etat_loterie = '".$this->etat."',";
		$sql .= " gain_loterie = '".$this->gain."',";
		$sql .= " valeur_participe_loterie = '".$this->valeur_participe."',";
		$sql .= " valeur_type_loterie = '".$this->valeur_type."',";
		$sql .= " id_gagnant_loterie = '".$this->id_gagnant."'";

		$sql .= " WHERE ";
		$sql .= " id_loterie = ".$this->id;

		mysql_query($sql, $db_vue_rm)	;
		echo mysql_error();
	}

	function write_db() {
		if (is_numeric($this->id))
			$this->update_db();
		else
			$this->insert_db();

		return $this->id;
	}

	function read_db() {
		global $db_vue_rm;
		
		$sql = "SELECT ";
		$sql .= "id_loterie, date_creation_loterie ,etat_loterie ,gain_loterie";
		$sql .= ", valeur_participe_loterie, valeur_type_loterie ,id_gagnant_loterie";

		$sql .= ", nom_troll";

		$sql .= " FROM loteries, trolls";
		$sql .= " WHERE id_loterie = ".$this->id;
		$sql .= " AND id_gagnant_loterie = id_troll";

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);
	
		$this->id = $row["id_loterie"];
		$this->date_creation = $row["date_creation_loterie"];    
		$this->etat = $row["etat_loterie"];    
		$this->gain = $row["gain_loterie"];    
		$this->valeur_participe = $row["valeur_participe_loterie"];    
		$this->valeur_type = $row["valeur_type_loterie"];    
		$this->id_gagnant = $row["id_gagnant_loterie"];    
		$this->nom_gagnant = $row["nom_troll"];    

		echo mysql_error();
	}

	function delete_db() {
		global $db_vue_rm;
	
		$sql = "DELETE FROM loteries";
		$sql .= " FROM loteries";
		$sql .= " WHERE id_loteries = ".$this->id;
	
		mysql_query($sql, $db_vue_rm);
		echo mysql_error();
	}
	
	function get_id() {
		return $this->id;	
	}

	function loterie($id_loterie="") {
		if (is_numeric($id_loterie)) {
			$this->id = $id_loterie;
			$this->read_db();
		} else { // Nouvelle Loterie
			$this->set_etat('ouvert');
		}
	}
}

?>
