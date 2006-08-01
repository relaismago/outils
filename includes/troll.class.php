<?

class troll
{
	
	function get_id_troll()
	{
		return $this->id_troll;
	}
	
	function set_id_troll($id_troll)
	{
		$this->id_troll = $id_troll;
	}

	function get_nom_troll()
	{
		return htmlentities(stripslashes($this->nom_troll));
	}
		
	function set_nom_troll($nom_troll)
	{
		$this->nom_troll = $nom_troll;
	}

	function get_race_troll()
	{
		return $this->race_troll;
	}
		
	function set_race_troll($race_troll)
	{
		$this->race_troll = $race_troll;
	}


	function get_niveau_troll()
	{
		return $this->niveau_troll;
	}
		
	function set_niveau_troll($race_troll)
	{
		$this->niveau_troll = $niveau_troll;
	}

	function get_x_troll()
	{
		return $this->x_troll;
	}
		
	function set_x_troll($x_troll)
	{
		$this->x_troll = $x_troll;
	}

	function get_y_troll()
	{
		return $this->y_troll;
	}
		
	function set_y_troll($y_troll)
	{
		$this->y_troll = $y_troll;
	}

	function get_z_troll()
	{
		return $this->z_troll;
	}
		
	function set_z_troll($z_troll)
	{
		$this->z_troll = $z_troll;
	}
	
	function read_db()
	{
		global $db_vue_rm;
		
		$sql = "SELECT id_troll, nom_troll, nom_guilde, id_guilde, statut_guilde, ";
		$sql .= " is_wanted_troll, is_tk_troll, is_venge_troll, is_admin_troll, ";
		$sql .= " x_troll, y_troll, z_troll, UNIX_TIMESTAMP(date_troll) as date_troll, statut_troll, race_troll,";
		$sql .= " nom_image_troll, is_seen_troll, pass_troll, groupe_rm_troll,";
		$sql .= " id_distinction, nom_distinction, nom_image_distinction, niveau_troll, ";
		$sql .= " nom_image_titre_distinction,equipement_troll,date_last_refresh_manual_troll, date_last_visit_troll, is_pnj_troll, ";
		$sql .= " date_inscription_troll, email_troll , blason_troll ,  intangible_troll ,  nb_mouches_troll ,  nb_kills_troll ,";
		$sql .= " nb_morts_troll, num_rang_troll, nom_rang_troll, distinction_troll,  equipement2_troll, ";
		$sql .= " id_diplomate_troll, historique_troll ";
		$sql .= " FROM trolls ";
		$sql .= " LEFT JOIN guildes ON guilde_troll=id_guilde";
		$sql .= " LEFT JOIN distinctions ON distinction_troll=id_distinction";

		$sql .= " WHERE id_troll = ".$this->id_troll;

		$query_result = mysql_query($sql, $db_vue_rm);
		$row = mysql_fetch_array($query_result);

		$this->id_troll=$row['id_troll'];
		$this->nom_troll=$row['nom_troll'];
		$this->nom_image_troll=$row['nom_image_troll'];
		$this->id_guilde=$row['id_guilde'];
		$this->nom_guilde=$row['nom_guilde'];
		$this->statut_guilde=$row['statut_guilde'];
		$this->is_tk_troll=$row['is_tk_troll'];
		$this->is_wanted_troll=$row['is_wanted_troll'];
		$this->is_venge_troll=$row['is_venge_troll'];
		$this->is_admin_troll=$row['is_admin_troll'];
		$this->statut_troll=$row['statut_troll'];
		$this->x_troll=$row['x_troll'];
		$this->y_troll=$row['y_troll'];
		$this->z_troll=$row['z_troll'];
		$this->date_troll=$row['date_troll'];
		$this->race_troll=$row['race_troll'];
		$this->niveau_troll=$row['niveau_troll'];
		$this->is_seen_troll=$row['is_seen_troll'];
		$this->is_pnj_troll=$row['is_pnj_troll'];
		$this->groupe_rm_troll=$row['groupe_rm_troll'];
		// accÃ©dÃ© uniquement par l'administrateur pour le changement de mot de passe
		$this->pass_troll=$row['pass_troll'];
		$this->id_distinction=$row['id_distinction'];
		$this->nom_distinction=$row['nom_distinction'];
		$this->nom_image_distinction=$row['nom_image_distinction'];
		$this->nom_image_titre_distinction=$row['nom_image_titre_distinction'];
		$this->equipement_troll=$row['equipement_troll'];
		$this->date_last_visit_troll=$row['date_last_visit_troll'];

		$this->date_inscription_troll=$row['date_inscription_troll'];
		$this->email_troll=$row['email_troll'];
		$this->blason_troll=$row['blason_troll'];
		$this->intangible_troll=$row['intangible_troll'];
		$this->nb_mouches_troll=$row['nb_mouches_troll'];
		$this->nb_kills_troll=$row['nb_kills_troll'];

		$this->nb_morts_troll=$row['nb_morts_troll'];
		$this->num_rang_troll=$row['num_rang_troll'];
		$this->nom_rang_troll=$row['nom_rang_troll'];
		$this->distinction_troll=$row['distinction_troll'];
		$this->equipement2_troll=$row['equipement2_troll'];
		$this->id_diplomate_troll=$row['id_diplomate_troll'];
		$this->historique_troll=stripslashes($row['historique_troll']);

		echo mysql_error();
	}


	function troll($id_troll="")
	{
		$this->id_troll = $id_troll;
		if ($this->id_troll != "")
			$this->read_db();
	}
}

?>
