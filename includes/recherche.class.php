<?

class recherche
{

	/**
	 * Affiche la texbox d'input
	 */
	function get_html_input() {
		$text = "";
		
		//$text .= "<form name='recherche'>";
		$text .= "<table class='mh_tdborder'><tr class='mh_tdtitre'><td>";
		//$text .= "<input type='textbox' size='25' onChange='get_recherche();' id='recherche_val'>";
		$text .= "<input type='text' size='25' id='livesearch' name='q' onkeypress='liveSearchStart();' onChange='get_recherche();'>";
		$text .= "<input type='hidden' id='recherche_page' value='".$_SERVER['REQUEST_URI']."'>";
		$text .= '<div id="LSResult" style="display: none;"><div id="LSShadow"></div></div>';
		$text .= "</td>";
		$text .= "<td>";
		//$text .= "<input type='submit' class='mh_form_submit' value=\">\"> ";
		
		$info = "<b>Exemples de recherche</b><br>";
		$info .= "<br><b>Affichage de la vue :</b><br>";
		$info .= "<i>vue:</i>  => affiche la vue de votre troll<br>";
		$info .= "<i>vue:".$_SESSION['AuthTroll']."</i> => affiche la vue du troll ".$_SESSION['AuthTroll']."<br>";
		$info .= "<i>vue:".$_SESSION['AuthNomTroll']."</i> => affiche la vue du troll ".$_SESSION['AuthNomTroll']."<br>";
		$info .= "Vue centr&eacute;e sur la position x=50, y=-33, z=-32 :<br>";
		$info .= "<i>vue:50 ,-33, -32 </i> => affiche la vue2d centr&eacute;e<br>";
		$info .= "<i>vue:50 ,-33, -32, 6 </i> => affiche la vue2d centr&eacute;e, taille de vue : 6<br>";

		$info .= "<br><b>Fiche RG :</b><br>";
		$info .= "<i>rg:</i>  => affiche la fiche de votre troll<br>";
		$info .= "<i>rg:".$_SESSION['AuthTroll']."</i> => affiche la fiche du troll ".$_SESSION['AuthTroll']."<br>";
		$info .= "<i>rg:".$_SESSION['AuthNomTroll']."</i> => affiche la fiche du troll ".$_SESSION['AuthNomTroll']."<br>";

		$info .= "<br><b>GGC :</b><br>";
		$info .= "<i>ggc:</i>  => affiche votre groupe de chasse<br>";

		$info .= "<br><b>Recherche de troll :</b><br>";
		$info .= "<i>troll:".$_SESSION['AuthTroll']." </i><br>";
		$info .= "<i>troll:".$_SESSION['AuthNomTroll']." </i><br>";
		$info .= " &Agrave partir de la position x=50, y=-33, z=-32 : <br>";
		$info .= "<i>troll:".$_SESSION['AuthTroll'].",50 ,-33, -32 </i> => Recherche du troll ".$_SESSION['AuthTroll']."<br>";
		$info .= "<i>troll:".$_SESSION['AuthNomTroll'].",50 ,-33, -32 </i> => Recherche du troll ".$_SESSION['AuthNomTroll']."<br>";
		$info .= "<i>troll:diplo=alliee </i> => Recherche les trolls alli&eacute;s<br>";
		$info .= "<i>troll:diplo=amie </i> => Recherche les trolls amis<br>";
		$info .= "<i>troll:diplo=tk </i> => Recherche les trolls tk<br>";
		$info .= "<i>troll:diplo=wanted </i> => Recherche les trolls wanted<br>";
		$info .= "<i>Pour les diplomaties de guilde : diploguilde au lieu de diplo<br>";


		$info .= "<br><b>Recherche de monstres :</b><br>";
		$info .= "<i>monstre:nom du monstre</i><br>";
		$info .= "<i>monstre:nom du monstre, race=nom race, famille=nom famille</i><br>";
		$info .= "<i>monstre:nom du monstre, race=nom race, famille=nom famille, niveau=12</i><br>";
		$info .= "<i>monstre:race=nom race, famille=nom famille,  niveau=9, 50, -33, -32</i><br>";
		$info .= "<i>Exemple : monstre:arai,race=Arai</i><br>";

		$info .= "<br><b>Recherche de Champignons:</b><br>";
		$info .= "<i>champi:nom du champi</i><br>";
		$info .= "Recherche de tous les champignons non vus (=anciens):<br>";
		$info .= "<i>champi:nom du champi, vue:non</i><br>";
		$info .= "Recherche de tous les champignons vus / non vus:<br>";
		$info .= "<i>champi:nom du champi, vue:</i><br>";
		$info .= "Recherche avec une position de d&eacute;part:<br>";
		$info .= "<i>champi:nom du champi, 50, -33, -32</i> <br>";
		$info .= "Recherche de tous les champignons les plus proches et vus:<br>";
		$info .= "<i>champi:</i><br>";

		$info .= "<br><b>Recherche de Lieu:</b><br>";
		$info .= "<i>lieu:nom du lieu</i><br>";
		$info .= "<i>lieu:nom du lieu, 50, -33, -32</i><br>";

		$info .= "<br><b>Recherche des trolls d'une guilde:</b><br>";
		$info .= "<i>guilde:nom de la guilde</i><br>";

		$text .= affiche_popup("Recherche", "black", $info,"",true, false);

		$text .= "</td>";
		$text .= "</tr></table>";
//		$text .= "</form>";

		return $text;
	}

	function display_result_html() {
		echo $this->html_search;	
	}

	function recherche($val="",$page="") {
		
		$this->page = $page;

		if ($val == "")
			return;
		
		$this->troll = new troll($_SESSION['AuthTroll']);
			
		$s = split(":",$val);
		$key = $s[0];
		$val = $s[1];

		switch($key) {
			case "vue" :
				$this->recherche_vue($val);
				break;
			case "rg" :
				$this->recherche_rg($val);
				break;
			case "ggc" :
				echo "Recherche de ce type en cours de developpement";
				break;
			case "troll" :
				$this->recherche_troll($val);
				break;
			case "monstre" :
				$this->recherche_monstre($val);
				break;
			case "champi" :
				$this->recherche_champi($val);
				break;
			case "lieu" :
				$this->recherche_lieu($val);
				break;
			case "guilde" :
				echo "Recherche de ce type en cours de developpement";
				break;
		}
	}

	function recherche_vue($val) {
		$s = split(",",$val);

		if (is_numeric($val)) {
			$id_troll = $val;
		} elseif (count($s) == 3 || count($s) ==4) {

			if ($s[3] == "")
				$taille = 3;
			else
				$taille = $s[3];

			if (!preg_match("/cockpit.php/",$this->page))
				echo "redirect:/cockpit.php?cX=".$s[0]."&cY=".$s[1]."&cZ=".$s[2]."&taille_vue=".$taille;
			else
				echo "get_map_center:$s[0]:$s[1]:$s[2]:$taille";

			return;
		} else {
			$nom_troll = $val;
		}

		$x_troll = $this->troll->get_x_troll();
		$y_troll = $this->troll->get_y_troll();
		$z_troll = $this->troll->get_z_troll();

		$lesTrolls = selectDbRechercheTrolls($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll,
		                                     $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																			 	$x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde);
		if (count($lesTrolls) == 1) {
			if (!preg_match("/cockpit.php/",$this->page)) {
				echo "redirect:/cockpit.php?id_troll=".$lesTrolls[1][id_troll];
			} else {
				echo "get_map_id_troll:".$lesTrolls[1][id_troll];
			}
		} else {
			afficherRechercheTrollsResultat($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll,
                                      $is_tk_troll, $is_wanted_troll, $is_venge_troll,
                                      $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde, $lesTrolls);
		}
	}


	function recherche_rg($val) {
		$s = split(",",$val);

		$x_troll = $this->troll->get_x_troll();
		$y_troll = $this->troll->get_y_troll();
		$z_troll = $this->troll->get_z_troll();

		if (is_numeric($s[0]))
			$id_troll = $s[0];
		else
			$nom_troll = $s[0];
	
		if (count($s) == 4) {
			$x_troll = $s[1];
			$y_troll = $s[2];
			$z_troll = $s[3];
		}

		$lesTrolls = selectDbRechercheTrolls($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll,
		                                     $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																			 	$x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde);
		if (count($lesTrolls) == 1) {
			echo "redirect:/engine_view.php?troll=".$lesTrolls[1][id_troll];
		} else {
			afficherRechercheTrollsResultat($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll,
                                      $is_tk_troll, $is_wanted_troll, $is_venge_troll,
                                      $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde, $lesTrolls);
		}
	}


	function recherche_troll($val) {
		$s = split(",",$val);

		$x_troll = $this->troll->get_x_troll();
		$y_troll = $this->troll->get_y_troll();
		$z_troll = $this->troll->get_z_troll();

		$t = split("=",$s[0]);
		if (is_numeric($s[0]))
			$id_troll = $s[0];
		else if ($t[0] == "diplo")
		{
			$statut_troll = $t[1];
			if ($statut_troll=="wanted")
			{
				$statut_troll='';
				$is_wanted_troll="oui";
			}
		} else if ($t[0] == "diploguilde") {
			$statut_guilde = $t[1];		
		} else
			$nom_troll = $s[0];
	
		if (count($s) == 4) {
			$x_troll = $s[1];
			$y_troll = $s[2];
			$z_troll = $s[3];
		}

		$lesTrolls = selectDbRechercheTrolls($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll,
		                                     $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																			 	$x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde);
		/*if (count($lesTrolls) == 1) {
			if (!preg_match("/cockpit.php/",$this->page)) {
				echo "redirect:/cockpit.php?id_troll=".$lesTrolls[1][id_troll];
			} else {
				echo "get_map_id_troll:".$lesTrolls[1][id_troll];
			}
		} else {*/
			afficherRechercheTrollsResultat($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll,
                                      $is_tk_troll, $is_wanted_troll, $is_venge_troll,
                                      $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde, $lesTrolls);
		//}
	}

	function recherche_monstre($val) {
		$s = split(",",$val);

		$x_monstre = $this->troll->get_x_troll();
		$y_monstre = $this->troll->get_y_troll();
		$z_monstre = $this->troll->get_z_troll();


		for ($i=0; $i<=count($s); $i++) {
			
			if (preg_match("/race=/",$s[$i])) {
				$r = split("=",$s[$i]); // $r[1] => nom de la race
				$race = $r[1];			
			}	elseif (preg_match("/famille=/",$s[$i])) {
				$r = split("=",$s[$i]); // $r[1] => nom de la famille
				$famille = $r[1];			
			}	elseif (preg_match("/niveau=/",$s[$i])) {
				$r = split("=",$s[$i]); // $r[1] => niveau
				$niveau = $r[1];			
			} else {
				if ($i==0) $nom_monstre = $s[0];
			}

			if (is_numeric($s[$i])) {
				$x_monstre = $s[$i];
				$y_monstre = $s[$i+1];
				$z_monstre = $s[$i+2];
				$limite = $s[$i+3];
				break;
			}
		}

		$lesMonstres = selectDbRechercheMonstres($id_monstre, $nom_monstre, $x_monstre, $y_monstre, $z_monstre, $limite, $race, $famille, $niveau);
		
		afficherRechercheMonstresResultat($id_monstre, $nom_monstre, $x_monstre, $y_monstre, $z_monstre, $limite, $race, $famille, $niveau, $lesMonstres);
	}

	function recherche_champi($val) {
		$s = split(",",$val);

		$x_champi = $this->troll->get_x_troll();
		$y_champi = $this->troll->get_y_troll();
		$z_champi = $this->troll->get_z_troll();
		

		for ($i=0; $i<=count($s); $i++) {
			
			if (preg_match("/vue=/",$s[$i])) { // vue : oui, non
				$r = split("=",$s[$i]); // $r[1] 
				$is_seen_champi = $r[1];			
			} else {
				if (!is_numeric($s[0]) && $i==0) { // nom du champi
					$nom_champi = $s[0];
				} elseif (is_numeric($s[$i])) { // position
					$x_champi = $s[$i];
					$y_champi = $s[$i+1];
					$z_champi = $s[$i+2];
					break;	
				}
			}
		}
		if ($is_seen_champi == "")
			$is_seen_champi = "oui";

		$lesChampignons = selectDbRechercheChampignons($id_champi, $nom_champi, $x_champi, $y_champi, $z_champi,
			                                                 $limite, $is_seen_champi);

		afficherRechercheChampignonsResultat($id_champi, $nom_champi, $x_champi, $y_champi, $z_champi,
                                          $limite, $is_seen_champi, $lesChampignons);
	}


	function recherche_lieu($val) {
		$s = split(",",$val);

		$x_lieu = $this->troll->get_x_troll();
		$y_lieu = $this->troll->get_y_troll();
		$z_lieu = $this->troll->get_z_troll();
		
		if (!is_numeric($s[0]))
			$nom_lieu = $s[0];
	
		if (count($s) == 4) {
			$x_lieu = $s[1];
			$y_lieu = $s[2];
			$z_lieu = $s[3];
		}

		$lesLieux = selectDbLieux($id_lieu,$nom_lieu,$x_lieu,$y_lieu,$z_lieu,$limite);
		afficherRechercheLieuxResultat($id_lieu, $nom_lieu, $x_lieu, $y_lieu, $z_lieu,$limite, $lesLieux);
	}

}

?>
