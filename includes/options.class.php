<?

class options {

	function get_id_troll() {
		return $this->id_troll;
	}

	function set_id_troll($id_troll) {
		$this->id_troll = $id_troll;
	}

	function get_date_option() {
		return $this->date_option;
	}

	function set_date_option($date_option) {
		$this->date_option = $date_option;
	}
	
	function get_display_mouches_option() {
		return $this->display_mouches_option;
	}

	function set_display_mouches_option($display_mouches_option) {
		$this->display_mouches_option= $display_mouches_option;
	}
	
	function get_display_noms_mouches_option() {
		return $this->display_noms_mouches_option;
	}

	function set_display_noms_mouches_option($display_noms_mouches_option) {
		$this->display_noms_mouches_option = $display_noms_mouches_option;
	}

	function get_refresh_dla_option() {
		return $this->refresh_dla_option;
	}

	function set_refresh_dla_option($refresh_dla_option) {
		$this->refresh_dla_option = $refresh_dla_option;
	}

	function get_vue_zoom_option() {
		return $this->vue_zoom_option;
	}

	function set_vue_zoom_option($vue_zoom_option) {
		$this->vue_zoom_option = $vue_zoom_option;
	}

	function get_vue_taille_option() {
		return $this->vue_taille_option;
	}

	function set_vue_taille_option($vue_taille_option) {
		$this->vue_taille_option = $vue_taille_option;
	}

	function get_vue_max_pa_option() {
		return $this->vue_max_pa_option;
	}

	function set_vue_max_pa_option($vue_max_pa_option) {
		$this->vue_max_pa_option = $vue_max_pa_option;
	}

	function get_vue_animations_option() {
		return $this->vue_animations_option;
	}

	function set_vue_animations_option($vue_animations_option) {
		$this->vue_animations_option = $vue_animations_option;
	}

	function get_vue_display_trollometer_option() {
		return $this->vue_display_trollometer_option;
	}

	function set_vue_display_trollometer_option($vue_display_trollometer_option) {
		$this->vue_display_trollometer_option = $vue_display_trollometer_option;
	}


  function read_db()
  {
    global $db_vue_rm;

    $sql = "SELECT id_troll_option, date_option, display_mouches_option, display_noms_mouches_option, refresh_dla_option,";
    $sql .= " vue_taille_option, vue_zoom_option, vue_max_pa_option, vue_animations_option,vue_display_trollometer_option";
    $sql .= " FROM options";

    $sql .= " WHERE id_troll_option = ".$this->id_troll;

    $query_result = mysql_query($sql, $db_vue_rm);
    $row = mysql_fetch_array($query_result);

		$this->id_troll=$row['id_troll_option'];
		$this->date_option=$row['date_option'];
		$this->display_mouches_option=$row['display_mouches_option'];
		$this->display_noms_mouches_option=$row['display_noms_mouches_option'];
		$this->refresh_dla_option=$row['refresh_dla_option'];
		$this->vue_zoom_option= $row['vue_zoom_option'];
		$this->vue_taille_option= $row['vue_taille_option'];
		$this->vue_max_pa_option= $row['vue_max_pa_option'];
		$this->vue_animations_option= $row['vue_animations_option'];
		$this->vue_display_trollometer_option= $row['vue_display_trollometer_option'];
	}

	function write_db() {
		global $db_vue_rm;

		$sql = "UPDATE options SET ";
		$sql .= " date_option= '".$this->date_option."'";
		$sql .= ", display_mouches_option= '".$this->display_mouches_option."'";
		$sql .= ", display_noms_mouches_option= '".$this->display_noms_mouches_option."'";
		$sql .= ", refresh_dla_option= '".$this->refresh_dla_option."'";
		$sql .= ", vue_zoom_option= '".$this->vue_zoom_option."'";
		$sql .= ", vue_taille_option= '".$this->vue_taille_option."'";
		$sql .= ", vue_max_pa_option= '".$this->vue_max_pa_option."'";
		$sql .= ", vue_animations_option= '".$this->vue_animations_option."'";
		$sql .= ", vue_display_trollometer_option= '".$this->vue_display_trollometer_option."'";
    
		$sql .= " WHERE ";
		$sql .= " id_troll_option = ".$this->id_troll;
 
		mysql_query($sql, $db_vue_rm) ;

		$_SESSION["options"] = $this->get_options_tab();
		return mysql_error();
  
	}

	function options($id_troll, $read_db=true) {
		$this->id_troll = $id_troll;
		if ($read_db)
			$this->read_db();
	}

	function get_options_tab() {
		
		$tab["date_option"] = $this->date_option;
		$tab["display_mouches_option"] = $this->display_mouches_option;
		$tab["display_noms_mouches_option"] = $this->display_noms_mouches_option;
		$tab["refresh_dla_option"] = $this->refresh_dla_option;
		$tab["vue_zoom_option"] = $this->vue_zoom_option;
		$tab["vue_taille_option"] = $this->vue_taille_option;
		$tab["vue_max_pa_option"] = $this->vue_max_pa_option;
		$tab["vue_animations_option"] = $this->vue_animations_option;
		$tab["vue_display_trollometer_option"] = $this->vue_display_trollometer_option;
		return $tab;
	}
}

?>
