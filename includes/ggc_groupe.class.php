<?

class ggc_groupe
{

	function get_id_groupe()
	{
		return $this->id_groupe;
	}

	function get_nom_groupe()
	{
		if ($this->nom_groupe != "")
			return htmlentities(stripslashes($this->nom_groupe));
		else
			return "Aucun Groupe de Chasse";
	}

	function get_nb_trolls()
	{
		return $this->nb_trolls;
	}

	function get_nb_monstres()
	{
		return $this->nb_monstres;
	}

	function get_nb_px()
	{
		return $this->nb_px;
	}

	function get_nb_gg()
	{
		return $this->nb_gg;
	}

	function get_date_maj()
	{
		return $this->date_maj;
	}

	function read_db_by_id_troll($id_troll)
	{
		global $db_vue_rm;
		if (!$id_troll)
			return false;

		$sql = " SELECT id_groupe";
		$sql .= " FROM ggc_troll";
		$sql .= " WHERE id_troll = ".$id_troll;

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		echo mysql_error();
		if ($row["id_groupe"] != "")
			$this->read_db(" WHERE id_groupe = ".$row["id_groupe"]);
		else
			return false; // Le troll ne fait pas parti d'un groupe
	}

	function read_db($criteria="")
	{
		global $db_vue_rm;

		$sql = " SELECT id_groupe, nom_groupe, nb_trolls, nb_monstres, nb_px, nb_gg, date_maj";
		$sql .= " FROM ggc_groupe";
		$sql .= $criteria;

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		echo mysql_error();
		$this->id_groupe = $row["id_groupe"];
		$this->nom_groupe = $row["nom_groupe"];
		$this->nb_trolls = $row["nom_trolls"];
		$this->nb_monstres = $row["nb_monstres"];
		$this->nb_px = $row["nb_px"];
		$this->nb_gg = $row["nb_gg"];
		$this->date_maj = $row["date_maj"];
	}

	function get_db_list_membres()
	{
		global $db_vue_rm;

		if (!$this->id_groupe)
			return false;	
		
		$sql = " SELECT id_groupe, t.id_troll as id_troll, t.nom_troll as nom_troll, x_troll, y_troll, z_troll, ";
		$sql .= " dla_en_cours, dla_suivante, dla_prevue, date_maj, duree_dla, fatigue_kastar, pa, pv_actuel, pv_max";
		$sql .= " FROM ggc_troll g, trolls t";
		$sql .= " WHERE id_groupe= ".$this->id_groupe;
		$sql .= " AND t.id_troll = g.id_troll ";

		if (!$result=mysql_query($sql,$db_vue_rm)) {
			echo mysql_error();
		} else {
			$i=1;
			while ($row = mysql_fetch_assoc($result)) {
				$troll = new troll();
				$troll->set_id_troll($row['id_troll']);
				$troll->set_nom_troll($row['nom_troll']);
				$troll->set_x_troll($row['x_troll']);
				$troll->set_y_troll($row['y_troll']);
				$troll->set_z_troll($row['z_troll']);
				$list[$i][troll] = $troll;
				$list[$i][dla1] = $row['dla_en_cours'];
				$list[$i][dla2] = $row['dla_suivante'];
				$list[$i][dla3] = $row['dla_prevue'];
				$list[$i][date_maj] = $row['date_maj'];
				$list[$i][duree_dla] = $row['duree_dla'];
				$list[$i][pa] = $row['pa'];
				$list[$i][fatigue_kastar] = $row['fatigue_kastar'];
				$list[$i][pv_actuel] = $row['pv_actuel'];
				$list[$i][pv_max] = $row['pv_max'];
				$i++;
			}
		}
		return $list;
	}

	function ggc_groupe()
	{

	}

}

?>
