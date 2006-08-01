<?
	
class loterie_participant {
	
	function get_id() {
		return $this->id;
	}
	
	function set_id($id) {
		$this->id = $id;
	}

	function get_id_troll($id_troll) {
		return $this->id_troll;
	}

	function set_id_troll($id_troll) {
		$this->id_troll = $id_troll;
	}

	function get_id_loterie() {
		return $this->id_loterie;
	}

	function set_id_loterie($id_loterie) {
		$this->id_loterie = $id_loterie;
	}

	function get_date_participe() {
		return $this->date_participe;
	}

	function set_date_participe($date_participe){
		$this->date_participe = $date_participe;
	}

	function set_date_remise_db()
	{
		global $db_vue_rm;

		$sql = "UPDATE loteries_participants SET";
		$sql .= " date_remise_loteriep = NOW()";
		$sql .= " WHERE id_loteriep = ".$this->id;

		mysql_query($sql, $db_vue_rm);
		$err = mysql_error();    
		if ($err != "") {
			echo "Erreur : $err<br>";
			return false;
		} else {
			return true;;
		}
	}

	function get_ip() {
		return $this->ip;
	}

	function set_ip($ip) {
		$this->ip = $ip;
	}

	function can_participe ($id_loterie="") {
		global $db_vue_rm;

		$sql = "SELECT COUNT(*) as nb";
		$sql .= " FROM loteries_participants";
		$sql .= " WHERE id_troll_loteriep = ".$this->id_troll;
		$sql .= " AND date_remise_loteriep IS NULL";
		if ($id_loterie != "")
			$sql .= " AND id_loterie_loteriep != ".$id_loterie;

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		if (intval($row["nb"]) >= 1) {
			return false;
		} else
			return true;
	}

	function read_db() {
		global $db_vue_rm;

		$sql = "SELECT ";
		$sql .= "id_loteriep, id_troll_loteriep, id_loterie_loteriep, date_loteriep, ";
		$sql .= " date_remise_loteriep, ip_loteriep";

		$sql .= " FROM loteries_participants";
		$sql .= " WHERE id_troll_loteriep = ".$this->id_troll;
		$sql .= " AND id_loterie_loteriep = ".$this->id_loterie;

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		$this->id = $row["id_loteriep"];
		$this->id_troll_loteriep = $this->id_troll;
		$this->id_loterie_loteriep = $this->id_loterie;
		$this->date_loteriep = $row["date_loteriep"];
		$this->date_remise_loteriep = $row["date_remise_loteriep"];
		$this->ip_loteriep = $row["ip_loteriep"];

		echo mysql_error(); 
	}

	function write_db() {
		if (is_numeric($this->id))
			update_db(); 
		else
			insert_db();
		return $this->id;  
	}

	function insert_db() {
		global $db_vue_rm;

		$sql = "INSERT INTO loteries_participants (";
		$sql .= " id_troll_loteriep,";
		$sql .= " id_loterie_loteriep,";
		$sql .= " date_loteriep,";
		$sql .= " ip_loteriep";
		$sql .= " )";

		$sql .= " VALUES (";
		$sql .= " ".$this->id_troll.",";
		$sql .= " ".$this->id_loterie.",";
		$sql .= " NOW(),";
		$sql .= " '".$this->ip."'";
		$sql .= " )";

		mysql_query($sql, $db_vue_rm);
		$err = mysql_error();    
		if ($err) {
			echo "Erreur : $err<br>";
			return false;
		} else {
			$this->id = mysql_insert_id();
			return $this->id;
		}
	}

	function update_db() {
		die('Update_db n\'est pas utile');
	}

	function loterie_participant($id_troll, $id_loterie) {
		$this->id_troll	= $id_troll;
		$this->id_loterie = $id_loterie;
		$this->read_db();
		$this->ip = getenv('REMOTE_ADDR'); 
	}

	/* le troll participe-t-il deja a la loterie ? */
	function is_participant() {
		$this->read_db();
		if (is_numeric($this->id))
			return true;
		else
			return false;
	}
}

?>
