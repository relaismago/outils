<?
session_start();
#include_once('../secure.php');

include_once('config.php');
include_once('variables.php');
include('troll_vtt.class.php');


class stats_vtt
{
	
	function stats_vtt($race, $niveau)
	{
		$this->set_race($race);
		$this->set_niveau($niveau);
		$this->init_nb_troll();
	}
	
	function set_niveau($niveau)
	{
		$this->niveau = $niveau;
	}

	function set_race($race)
	{
		switch (strtolower($race)) {
			case "durakuir";
			case "kastar";
			case "tomawak";
			case "skrim";
				break;
			default :
				die("Erreur de race. set_race()");
		}

		$this->race = $race;
	}

	function init_nb_troll()
	{
		$sql = "SELECT count(*) as nb";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$this->nb_troll = $row["nb"]; 

		$sql = "SELECT count(*) as nb";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$this->nb_troll_race = $row["nb"]; 

		$sql = "SELECT count(*) as nb";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		
		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$this->nb_troll_race_alentour = $row["nb"]; 
	}

	function get_sql_fin() 
	{
		$sql_fin  = " FROM "._TABLEVTT_.", trolls";
		$sql_fin .= " WHERE id_troll = No ";
		$sql_fin .= " AND race_troll = '".$this->race."'";
		$sql_fin .= " AND PVs IS NOT NULL";

		return $sql_fin;
	}

	function get_sql_fin_alentour()
	{
		$sql .= " AND ( niveau_troll = ".($this->niveau-1);
		$sql .= " OR niveau_troll = ".$this->niveau;
		$sql .= " OR niveau_troll = ".($this->niveau+1).")";

		return $sql;
	}

	/******* PV *******/
	function get_max_pv()
	{
		$sql = "SELECT nom_troll, PVs as pv ";
		$sql .= " FROM "._TABLEVTT_.", trolls";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY pv DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["pv"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_max_race_pv()
	{
		$sql = "SELECT nom_troll, PVs as pv ";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY pv DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["pv"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_moyenne_race_pv()
	{
		$sql = "SELECT sum(PVs) as pv ";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["pv"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_pv()
	{
		$sql = "SELECT sum(PVs) as pv ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["pv"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_pv()
	{
		$sql = "SELECT nom_troll, max(PVs) as pv ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll ";
		$sql .= "ORDER BY pv DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["pv"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_moyenne_pv()
	{
		$sql = "SELECT sum(PVs) as pv ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["pv"] / $this->nb_troll); 
	}

	/****** REG ******/
	function get_max_reg()
	{
		$sql = "SELECT nom_troll, REG*2+REGB as TREG, REG, REGB ";
		$sql .= " FROM "._TABLEVTT_.", trolls";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TREG DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TREG"]; 
		if ($tab['value'] > 10000) {
			$tab['nom_troll'] = "ERREUR sur ".$row["nom_troll"]; 
			$tab['value'] = 0; 
		} else
			$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["REG"]; 
		$tab['bonus'] = $row["REGB"]; 

		return $tab;	
	}

	function get_max_race_reg()
	{
		$sql = "SELECT nom_troll, REG*2+REGB as TREG, REG, REGB ";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TREG DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TREG"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["REG"]; 
		$tab['bonus'] = $row["REGB"]; 

		return $tab;	
	}

	function get_moyenne_race_reg()
	{
		$sql = "SELECT sum(REG*2+REGB) as reg ";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["reg"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_reg()
	{
		$sql = "SELECT sum(REG*2+REGB) as reg ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["reg"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_reg()
	{
		$sql = "SELECT nom_troll, max(REG*2+REGB) as mreg, REG, REGB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, regb,reg  ";
		$sql .= "ORDER BY mreg DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mreg"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["REG"]; 
		$tab['bonus'] = $row["REGB"]; 

		return $tab;	
	}

	function get_moyenne_reg()
	{
		$sql = "SELECT sum(REG*2+REGB) as reg ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["reg"] / $this->nb_troll); 
	}

	/****** ATT ******/
	function get_max_att()
	{
		$sql = "SELECT nom_troll, ATT*3.5+ATTB as TATT, ATT, ATTB ";
		$sql .= " FROM "._TABLEVTT_.", trolls";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TATT DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TATT"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ATT"]; 
		$tab['bonus'] = $row["ATTB"]; 

		return $tab;	
	}

	function get_max_race_att()
	{
		$sql = "SELECT nom_troll, ATT*3.5+ATTB as TATT, ATT, ATTB ";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TATT DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TATT"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ATT"]; 
		$tab['bonus'] = $row["ATTB"]; 

		return $tab;	
	}

	function get_moyenne_race_att()
	{
		$sql = "SELECT sum(ATT*3.5+ATTB) as att";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["att"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_att()
	{
		$sql = "SELECT sum(ATT*3.5+ATTB) as att ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["att"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_att()
	{
		$sql = "SELECT nom_troll, max(ATT*3.5+ATTB) as matt, ATT, ATTB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, ATTB, ATT  ";
		$sql .= "ORDER BY matt DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["matt"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ATT"]; 
		$tab['bonus'] = $row["ATTB"]; 

		return $tab;	
	}

	function get_moyenne_att()
	{
		$sql = "SELECT sum(ATT*3.5+ATTB) as att ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["att"] / $this->nb_troll); 
	}

	/****** ESQ ******/
	function get_max_esq()
	{
		$sql = "SELECT nom_troll, ESQ*3.5+ESQB as TESQ, ESQ, ESQB ";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TESQ DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TESQ"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ESQ"]; 
		$tab['bonus'] = $row["ESQB"]; 

		return $tab;	
	}

	function get_max_race_esq()
	{
		$sql = "SELECT nom_troll, ESQ*3.5+ESQB as TESQ, ESQ, ESQB ";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TESQ DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TESQ"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ESQ"]; 
		$tab['bonus'] = $row["ESQB"]; 

		return $tab;	
	}

	function get_moyenne_race_esq()
	{
		$sql = "SELECT sum(ESQ*3.5+ESQB) as esq";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["esq"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_esq()
	{
		$sql = "SELECT sum(ESQ*3.5+ESQB) as esq ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["esq"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_esq()
	{
		$sql = "SELECT nom_troll, max(ESQ*3.5+ESQB) as mesq, ESQ, ESQB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, ESQB, ESQ  ";
		$sql .= "ORDER BY mesq DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mesq"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ESQ"]; 
		$tab['bonus'] = $row["ESQB"]; 

		return $tab;	
	}

	function get_moyenne_esq()
	{
		$sql = "SELECT sum(ESQ*3.5+ESQB) as esq ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["esq"] / $this->nb_troll); 
	}

	/****** DEG ******/
	function get_max_deg()
	{
		$sql = "SELECT nom_troll, DEG*2+DEGB as TDEG, DEG, DEGB ";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TDEG DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TDEG"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["DEG"]; 
		$tab['bonus'] = $row["DEGB"]; 

		return $tab;	
	}

	function get_max_race_deg()
	{
		$sql = "SELECT nom_troll, DEG*2+DEGB as TDEG, DEG, DEGB ";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TDEG DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TDEG"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["DEG"]; 
		$tab['bonus'] = $row["DEGB"]; 

		return $tab;	
	}

	function get_moyenne_race_deg()
	{
		$sql = "SELECT sum(DEG*2+DEGB) as deg";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["deg"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_deg()
	{
		$sql = "SELECT sum(DEG*2+DEGB) as deg ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["deg"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_deg()
	{
		$sql = "SELECT nom_troll, max(DEG*2+DEGB) as mdeg, DEG, DEGB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, DEGB, DEG  ";
		$sql .= "ORDER BY mdeg DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mdeg"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["DEG"]; 
		$tab['bonus'] = $row["DEGB"]; 

		return $tab;	
	}

	function get_moyenne_deg()
	{
		$sql = "SELECT sum(DEG*2+DEGB) as deg ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["deg"] / $this->nb_troll); 
	}

	/****** ARM  ******/
	function get_max_arm()
	{
		$sql = "SELECT nom_troll, ARM+ARMB as TARM, ARM, ARMB ";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TARM DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TARM"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ARM"]; 
		$tab['bonus'] = $row["ARMB"]; 

		return $tab;	
	}

	function get_max_race_arm()
	{
		$sql = "SELECT nom_troll, ARM+ARMB as TARM, ARM, ARMB";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TARM DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TARM"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ARM"]; 
		$tab['bonus'] = $row["ARMB"]; 

		return $tab;	
	}

	function get_moyenne_race_arm()
	{
		$sql = "SELECT sum(ARM+ARMB) as arm";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["arm"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_arm()
	{
		$sql = "SELECT sum(ARM+ARMB) as arm ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["arm"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_arm()
	{
		$sql = "SELECT nom_troll, max(ARM+ARMB) as marm, ARM, ARMB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, ARMB, ARM  ";
		$sql .= "ORDER BY marm DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["marm"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["ARM"]; 
		$tab['bonus'] = $row["ARMB"]; 

		return $tab;	
	}

	function get_moyenne_arm()
	{
		$sql = "SELECT sum(ARM+ARMB) as arm ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["arm"] / $this->nb_troll); 
	}


	/****** KILL  ******/
	function get_max_kill()
	{
		$sql = "SELECT nom_troll, nb_kills_troll ";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY nb_kills_troll DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["nb_kills_troll"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_max_race_kill()
	{
		$sql = "SELECT nom_troll, nb_kills_troll ";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY nb_kills_troll DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["nb_kills_troll"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_moyenne_race_kill()
	{
		$sql = "SELECT sum(nb_kills_troll) as kills ";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["kills"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_kill()
	{
		$sql = "SELECT sum(nb_kills_troll) as kills ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["kills"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_kill()
	{
		$sql = "SELECT nom_troll, max(nb_kills_troll) as mkill ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll ";
		$sql .= "ORDER BY mkill DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mkill"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_moyenne_kill()
	{
		$sql = "SELECT sum(nb_kills_troll) as kills ";
		$sql .= " FROM "._TABLEVTT_.", trolls";
		$sql .= " WHERE PVs IS NOT NULL";
		$sql .= " AND id_troll = No";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["kills"] / $this->nb_troll); 
	}

	/****** DEADS ******/
	function get_min_dead()
	{
		$sql = "SELECT nom_troll, DEADs";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY DEADs";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["DEADs"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_min_race_dead()
	{
		$sql = "SELECT nom_troll, DEADs ";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY DEADs";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["DEADs"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_moyenne_race_dead()
	{
		$sql = "SELECT sum(DEADs) as deads ";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["deads"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_dead()
	{
		$sql = "SELECT sum(DEADs) as deads ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["deads"] / $this->nb_troll_race_alentour); 
	}

	function get_min_alentour_race_dead()
	{
		$sql = "SELECT nom_troll, max(DEADs) as mdead ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll ";
		$sql .= "ORDER BY mdead";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mdead"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 

		return $tab;	
	}

	function get_moyenne_dead()
	{
		$sql = "SELECT sum(DEADs) as deads ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["deads"] / $this->nb_troll); 
	}

	/****** MM  ******/
	function get_max_mm()
	{
		$sql = "SELECT nom_troll, MM+MMB as TMM, MM, MMB ";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TMM DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TMM"]; 
		if ($tab['value'] > 100000) {
			$tab['value'] = 0; 
			$tab['nom_troll'] = "ERREUR ".$row["nom_troll"]; 
		} else
			$tab['nom_troll'] = $row["nom_troll"]; 

		$tab['normal'] = $row["MM"]; 
		$tab['bonus'] = $row["MMB"]; 

		return $tab;	
	}

	function get_max_race_mm()
	{
		$sql = "SELECT nom_troll, MM+MMB as TMM, MM, MMB";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TMM DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TMM"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["MM"]; 
		$tab['bonus'] = $row["MMB"]; 

		return $tab;	
	}

	function get_moyenne_race_mm()
	{
		$sql = "SELECT sum(MM+MMB) as mm";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["mm"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_mm()
	{
		$sql = "SELECT sum(MM+MMB) as mm ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["mm"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_mm()
	{
		$sql = "SELECT nom_troll, max(MM+MMB) as mmm, MM, MMB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, MMB, MM  ";
		$sql .= "ORDER BY mmm DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mmm"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["MM"]; 
		$tab['bonus'] = $row["MMB"]; 

		return $tab;	
	}

	function get_moyenne_mm()
	{
		$sql = "SELECT sum(MM+MMB) as mm ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["mm"] / $this->nb_troll); 
	}


	/****** RM  ******/
	function get_max_rm()
	{
		$sql = "SELECT nom_troll, RM+RMB as TRM, RM, RMB ";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TRM DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TRM"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["RM"]; 
		$tab['bonus'] = $row["RMB"]; 

		return $tab;	
	}

	function get_max_race_rm()
	{
		$sql = "SELECT nom_troll, RM+RMB as TRM, RM, RMB";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TRM DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TRM"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["RM"]; 
		$tab['bonus'] = $row["RMB"]; 

		return $tab;	
	}

	function get_moyenne_race_rm()
	{
		$sql = "SELECT sum(RM+RMB) as rm";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["rm"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_rm()
	{
		$sql = "SELECT sum(RM+RMB) as rm ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["rm"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_rm()
	{
		$sql = "SELECT nom_troll, max(RM+RMB) as mrm, RM, RMB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, RMB, RM  ";
		$sql .= "ORDER BY mrm DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mrm"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["RM"]; 
		$tab['bonus'] = $row["RMB"]; 

		return $tab;	
	}

	function get_moyenne_rm()
	{
		$sql = "SELECT sum(RM+RMB) as rm ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["rm"] / $this->nb_troll); 
	}

	/****** Vue ******/
	function get_max_vue()
	{
		$sql = "SELECT nom_troll, VUE+VUEB as TVUE, VUE, VUEB";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TVUE DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TVUE"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["VUE"]; 
		$tab['bonus'] = $row["VUEB"]; 

		return $tab;	
	}

	function get_max_race_vue()
	{
		$sql = "SELECT nom_troll, VUE+VUEB as TVUE, VUE, VUEB";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TVUE DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TVUE"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["VUE"]; 
		$tab['bonus'] = $row["VUEB"]; 

		return $tab;	
	}

	function get_moyenne_race_vue()
	{
		$sql = "SELECT sum(VUE+VUEB) as vue";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["vue"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_vue()
	{
		$sql = "SELECT sum(VUE+VUEB) as vue ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["vue"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_vue()
	{
		$sql = "SELECT nom_troll, max(VUE+VUEB) as mvue, VUE, VUEB ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, VUEB, VUE  ";
		$sql .= "ORDER BY mvue DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mvue"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["VUE"]; 
		$tab['bonus'] = $row["VUEB"]; 

		return $tab;	
	}

	function get_moyenne_vue()
	{
		$sql = "SELECT sum(VUE+VUEB) as vue ";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["vue"] / $this->nb_troll); 
	}

	/****** DLA ******/
	function get_max_dla()
	{
		$sql = "SELECT nom_troll, -DLAH*60-DLAM as TDLA , DLAH, DLAM";
		$sql .= " FROM "._TABLEVTT_.", trolls ";
		$sql .= " WHERE id_troll = No";
		$sql .= " ORDER BY TDLA DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TDLA"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["DLAH"]; 
		$tab['bonus'] = $row["DLAM"]; 

		return $tab;	
	}

	function get_max_race_dla()
	{
		$sql = "SELECT nom_troll,  -DLAH*60-DLAM as TDLA , DLAH, DLAM";
		$sql .= $this->get_sql_fin();
		$sql .= " ORDER BY TDLA DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["TDLA"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["DLAH"]; 
		$tab['bonus'] = $row["DLAM"]; 

		return $tab;	
	}

	function get_moyenne_race_dla()
	{
		$sql = "SELECT sum(-DLAH*60-DLAM) as dla";
		$sql .= $this->get_sql_fin();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["dla"] / $this->nb_troll_race); 
	}

	function get_moyenne_alentour_race_dla()
	{
		$sql = "SELECT sum(-DLAH*60-DLAM) as dla ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["dla"] / $this->nb_troll_race_alentour); 
	}

	function get_max_alentour_race_dla()
	{
		$sql = "SELECT nom_troll, max( -DLAH*60-DLAM ) as mdla, DLAH, DLAM ";
		$sql .= $this->get_sql_fin();
		$sql .= $this->get_sql_fin_alentour();
		$sql .= "GROUP BY nom_troll, DLAM, DLAH ";
		$sql .= "ORDER BY mdla DESC";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		$tab['value'] = $row["mdla"]; 
		$tab['nom_troll'] = $row["nom_troll"]; 
		$tab['normal'] = $row["DLAH"]; 
		$tab['bonus'] = $row["DLAM"]; 

		return $tab;	
	}

	function get_moyenne_dla()
	{
		$sql = "SELECT sum( -DLAH*60-DLAM ) as dla";
		$sql .= " FROM "._TABLEVTT_;
		$sql .= " WHERE PVs IS NOT NULL";

		$query_result = my_mysql_query($sql);
		$row = mysql_fetch_array($query_result);

		return intval($row["dla"] / $this->nb_troll); 
	}

}

/*$t = new troll_vtt(49145);
$s = new stats_vtt($t->race_troll, $t->niveau_troll);

echo "NB=".$s->nb_troll."<br>";
echo "---------------- PV max pv <br>";
print_r($s->get_max_race_pv());
echo "<br> moy race ";
print_r($s->get_moyenne_race_pv());
echo"<br> max gen ";
print_r($s->get_max_pv());
echo"<br> moy gen ";
print_r($s->get_moyenne_pv());
echo "<br> moy alen ";
print_r($s->get_moyenne_alentour_race_pv());
echo "<br> max alent ";
print_r($s->get_max_alentour_race_pv());
echo "<br> pv ";
print_r($t->pv);
echo "<br>";

echo "---------------- REG <br> max race ";
print_r($s->get_max_race_reg());
echo "<br> moy race ";
print_r($s->get_moyenne_race_reg());
echo"<br> max gen ";
print_r($s->get_max_reg());
echo"<br> moy gen ";
print_r($s->get_moyenne_reg());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_reg());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_reg());
echo "<br> reg ";
print_r($t->total_reg);
echo "<br>";

echo "---------------- ATT <br> max race ";
print_r($s->get_max_race_att());
echo "<br> moy race ";
print_r($s->get_moyenne_race_att());
echo"<br> max gen ";
print_r($s->get_max_att());
echo"<br> moy gen ";
print_r($s->get_moyenne_att());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_att());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_att());
echo "<br> att ";
print_r($t->total_att);
echo "<br>";

echo "---------------- ESQ <br> max race ";
print_r($s->get_max_race_esq());
echo "<br> moy race ";
print_r($s->get_moyenne_race_esq());
echo "<br> max gen ";
print_r($s->get_max_esq());
echo"<br> moy gen ";
print_r($s->get_moyenne_esq());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_esq());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_esq());
echo "<br> esq ";
print_r($t->total_esq);
echo "<br>";

echo "---------------- DEG <br> max race ";
print_r($s->get_max_race_deg());
echo "<br> moy race ";
print_r($s->get_moyenne_race_deg());
echo "<br> max gen ";
print_r($s->get_max_deg());
echo"<br> moy gen ";
print_r($s->get_moyenne_deg());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_deg());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_deg());
echo "<br> deg ";
print_r($t->total_deg);
echo "<br>";

echo "---------------- ARM <br> max race ";
print_r($s->get_max_race_arm());
echo "<br> moy race ";
print_r($s->get_moyenne_race_arm());
echo "<br> max gen ";
print_r($s->get_max_arm());
echo"<br> moy gen ";
print_r($s->get_moyenne_arm());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_arm());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_arm());
echo "<br> arm ";
print_r($t->total_arm);
echo "<br>";

echo "---------------- KILL <br> max race ";
print_r($s->get_max_race_kill());
echo "<br> moy race ";
print_r($s->get_moyenne_race_kill());
echo "<br> max gen ";
print_r($s->get_max_kill());
echo"<br> moy gen ";
print_r($s->get_moyenne_kill());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_kill());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_kill());
echo "<br> Kill ";
print_r($t->kill);
echo "<br>";

echo "---------------- DEADs <br> min race ";
print_r($s->get_min_race_dead());
echo "<br> moy race ";
print_r($s->get_moyenne_race_dead());
echo "<br> min gen ";
print_r($s->get_min_dead());
echo"<br> moy gen ";
print_r($s->get_moyenne_dead());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_dead());
echo "<br> max alentour race ";
print_r($s->get_min_alentour_race_dead());
echo "<br> DEAD ";
print_r($t->death);
echo "<br>";

echo "---------------- MM <br> max race ";
print_r($s->get_max_race_mm());
echo "<br> moy race ";
print_r($s->get_moyenne_race_mm());
echo "<br> max gen ";
print_r($s->get_max_mm());
echo"<br> moy gen ";
print_r($s->get_moyenne_mm());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_mm());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_mm());
echo "<br> MM ";
print_r($t->total_mm);
echo "<br>";

echo "---------------- RM <br> max race ";
print_r($s->get_max_race_rm());
echo "<br> moy race ";
print_r($s->get_moyenne_race_rm());
echo "<br> max gen ";
print_r($s->get_max_rm());
echo"<br> moy gen ";
print_r($s->get_moyenne_rm());
echo "<br> moy alentour race ";
print_r($s->get_moyenne_alentour_race_rm());
echo "<br> max alentour race ";
print_r($s->get_max_alentour_race_rm());
echo "<br> RM ";
print_r($t->total_rm);
echo "<br>";
*/
?>
