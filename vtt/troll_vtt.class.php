<?

class troll_vtt 
{

	function troll_vtt($id_troll)
	{
		$sql = "SELECT id_troll, nom_troll, nb_kills_troll, nb_morts_troll, niveau_troll, race_troll, ";
		$sql .= "	 No, CacherData, DateTrash, DateMaj,";
		$sql .= "	 VUE, VUEB, PVs, ";
		$sql .= "	 REG, REGB, ATT, ATTB,";
		$sql .= "	 ESQ, ESQB, DEG, DEGB,";
		$sql .= "	 ARM, ARMB, ";
		$sql .= "	 RM, RMB, MM, MMB,";
		$sql .= "	 DLAH, DLAM, Comps,	Sorts, NbSorts,";

		$sql .= " -DLAH*60-DLAM as TDLA, ";
		$sql .= " VUE+VUEB as TVUE, ";
		$sql .= " REG*2+REGB as TREG, ";
		$sql .= " ATT*3.5+ATTB as TATT, ";
		$sql .= " ESQ*3.5+ESQB as TESQ, ";
		$sql .= " DEG*2+DEGB as TDEG,  ";
		$sql .= " ARM+ARMB as TARM, ";
		$sql .= " RM+RMB as TRM, ";
		$sql .= " MM+MMB as TMM,";
		$sql .= " (TO_DAYS(NOW()) - TO_DAYS(DateMaj)) as Peremption";

		$sql .= " FROM "._TABLEVTT_.", trolls";
		$sql .= " WHERE id_troll = No"; 
		$sql .= " AND id_troll = $id_troll "; 

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$this->nom_troll = $row["nom_troll"];  	 
		$this->niveau_troll = $row["niveau_troll"];  	 
		$this->race_troll = $row["race_troll"];  	 

		$this->id_troll = $row["id_troll"];  	 
		$this->cacher_data = $row["CacherData"];
		$this->date_trash = $row["DateTrash"]; 
		$this->date_maj = $row["DateMaj"];  
		$this->race_troll = $row["race_troll"];
		$this->vue = $row["VUE"]; 
		$this->vue_bonus = $row["VUEB"]; 
		$this->niveau = $row["Niveau"]; 
		$this->pv = $row["PVs"];
		$this->reg = $row["REG"]; 
		$this->reg_bonus = $row["REGB"];
		$this->att = $row["ATT"];
		$this->att_bonus = $row["ATTB"];
		$this->esq = $row["ESQ"];
		$this->esq_bonus = $row["ESQB"];
		$this->deg = $row["DEG"];
		$this->deg_bonus = $row["DEGB"];
		$this->arm = $row["ARM"];
		$this->arm_bonus = $row["ARMB"];
		$this->kill = $row["nb_kills_troll"];
		$this->death = $row["nb_morts_troll"]; 
		$this->rm = $row["RM"];
		$this->rm_bonus = $row["RMB"];
		$this->mm = $row["MM"];
		$this->mm_bonus = $row["MMB"];
		$this->dla_heure = $row["DLAH"];
		$this->dla_min = $row["DLAM"];
		$this->competences = $row["Comps"];
		$this->sorts = $row["Sorts"];
		$this->nb_sorts = $row["NbSorts"];

		$this->total_dla = $row["TDLA"]; 
		$this->total_vue = $row["TVUE"]; 
		$this->total_reg = $row["TREG"]; 
		$this->total_att = $row["TATT"]; 
		$this->total_esq = $row["TESQ"]; 
		$this->total_deg = $row["TDEG"]; 
		$this->total_arm = $row["TARM"]; 
		$this->total_rm = $row["TRM"]; 
		$this->total_mm = $row["TMM"]; 
	}
}

/*
$s = new troll_vtt(49145);
echo "dla=".$s->total_dla;
echo "<br>";
echo $s->total_vue;
*/
?>
