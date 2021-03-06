<?php 

// Pas d'authentification sur cette page, elle est accessible publiquement
session_start();

global $objetsProches,$maxPA,$DEV;

include_once ("functions_dev.php");
include_once ("functions_image.php");
include_once ("top.php");

$state = 0;

$fichvue = @fopen("vues/vue_tmp.$_REQUEST[id_troll].txt", "r");

// Si le fichier n'est pas trouv�, on stop
if (!$fichvue) {
    
?>
<br/>
<br/>
<br/>
<br/>
<table class='mh_tdborder' align='center'>
    <tr class='mh_tdpage'>
        <td>
            <h1>
                <span color='red'>
                    Veuillez rafraichir votre vue : <a href='public.php'>cliquez ici</a>
                </span>
                <br/>
                </td>
            </tr>
            </table>
            <?php 
	            die(" ");
	            }	      
				$_SESSION['laby'] = 0;
	            while ($line = fgets($fichvue, 1024)) {
	                # Pour chaque ligne du fichier de vue :
	                $line = trim($line);
	                if ($line == "[haut]") {
	                    $state = 1;
	                } elseif (preg_match("/^Murs/", $line)) {
	                	$_SESSION['laby'] = 1;
	                    $state = 10;
	                } elseif (preg_match("/^[-] 	TR�LLS/", $line)) {
	                    $state = 20;
	                } elseif (preg_match("/^MONSTRES ERRANTS/", $line)) {
	                    $state = 30;
	                } elseif (preg_match("/^TR.SORS/", $line)) {
	                    $state = 40;
	                } elseif (preg_match("/^LIEUX PARTICULIERS/", $line)) {
	                    $state = 50;
	                } elseif (preg_match("/^CHAMPIGNONS/", $line)) {
	                    $state = 60;
	                } elseif (preg_match("/^MA VUE/", $line)) {
	                    $state = 70;
	                } elseif (preg_match("/^\[Contact : dm@mountyhall.com\] - \[Heure Serveur/", $line) ) {
	                    $state = 2;
	                }
	                
	                switch ($state) {
	                    case 0: # Init
	                        break;
	                    case 1: # Point mort
	                        break;
	                    case 2: # Sauvegarde
	                        // On sauve
	                        $fcache = fopen("vues/".$_REQUEST["id_troll"], "w");
	                        $ip = getenv("REMOTE_ADDR");
	                        fputs($fcache, "#COPYPASTE $ip\n");
	                        fputs($fcache, "#DEBUT LABY\n");
	                        if ($labs)
	                            foreach ($labs_fichier as $objet) {    
	                            	fputs($fcache, "$objet[type];$objet[x];$objet[y];$objet[z];\n");                       
	                            }
	                        // Puis on rajoute le troll lui m�me
	                        
	                        fputs($fcache, "#FIN LABY\n");
	                        fputs($fcache, "#DEBUT TROLLS\n");
	                        if ($trolls)
	                            foreach ($trolls_fichier as $objet) {
	                                // Si c'est pas le troll concern�
	                                if ($objet["id"] != - 1) {
	                                    $is_malade = ( empty($objet["malade"])) ? "-" : $objet["malade"];
	                                    fputs($fcache, "$objet[id];$objet[x];$objet[y];$objet[z];$is_malade\n");
	                                }
	                            }
	                        // Puis on rajoute le troll lui m�me
	                        
	                        fputs($fcache, "#FIN TROLLS\n");
	                        fputs($fcache, "#DEBUT MONSTRES\n");
	                        if ($streums)
	                            foreach ($streums_fichier as $objet) {
	                                fputs($fcache, "$objet[id];$objet[nom];$objet[x];$objet[y];$objet[z]\n");
	                            }
	                        fputs($fcache, "#FIN MONSTRES\n");
	                        fputs($fcache, "#DEBUT TRESORS\n");
	                        if ($came)
	                            foreach ($came_fichier as $objet) {
	                                fputs($fcache, "$objet[id];$objet[nom];$objet[x];$objet[y];$objet[z]\n");
	                            }
	                        fputs($fcache, "#FIN TRESORS\n");
	                        fputs($fcache, "#DEBUT LIEUX\n");
	                        if ($lieux)
	                            foreach ($lieux_fichier as $objet) {
	                                fputs($fcache, "$objet[id];$objet[nom];$objet[x];$objet[y];$objet[z]\n");
	                            }
	                        fputs($fcache, "#FIN LIEUX\n");
	                        fputs($fcache, "#DEBUT CHAMPIGNONS\n");
	                        if ($champi)
	                            foreach ($champi_fichier as $i=>$objet)
	                            	fputs($fcache, "$objet[id];$objet[nom];$objet[x];$objet[y];$objet[z]\n");
	                        fputs($fcache, "#FIN CHAMPIGNONS\n");
	                        fputs($fcache, "#DEBUT ORIGINE\n$nCasesVue;$X;$Y;$Z\n#FIN ORIGINE\n");
	                        fclose($fcache);
	                        
	                        $state = 3;
	                        break;
	                    case 10: # Labyrinthe
	                        if (preg_match("/\d+[ \t]+([^\t]+)[ \t]+([-\d]+)[ \t]+([-\d]+)[ \t]+([-\d]+)/", $line, $parts)) {                     
	                            list($tmp, $lab["type"], $lab["x"], $lab["y"], $lab["z"]) = $parts;                    
	                            $lab["distance_pa"] = calcPA($lab["x"], $lab["y"], $lab["z"], $X, $Y, $Z);
	                            $labs[$lab["x"] + 100][$lab["y"] + 100][] = $lab;
	                            $labs_fichier[] = $lab;
	                        }
	                        break;    
	                    
	                    case 20: # Trolls
	                        if (preg_match("/\d+[ \t]+(\d+)[ \t]+([^\t]+)[ \t]+(\d+)[ \t]+([^\t]+)[ \t]+([^\t]+)?[ \t]+([-\d]+)[ \t]+([-\d]+)[ \t]+([-\d]+)/", $line, $parts)) {
	                            $troll["invisible"] = "";
	                            $troll["malade"] = "";
	   				                         
	                            list($tmp, $troll["id"], $troll["nom"], $troll["level"], $troll["race"], $troll["guilde"], $troll["x"], $troll["y"], $troll["z"]) = $parts;
	                            
	                            // On regarde si le troll est malade ou non
	                            if (preg_match("/(\[M\])$/", $troll["nom"], $parts2))
	                                $troll["malade"] = "malade";
	                                
	                            $troll["distance_pa"] = calcPA($troll["x"], $troll["y"], $troll["z"], $X, $Y, $Z);
	                            $trolls[$troll["x"] + 100][$troll["y"] + 100][] = $troll;
	                            $trolls_fichier[] = $troll;
	                        }
	                        break;
	                    case 30: # Monstres
	                        if (preg_match("/\d+[ \t]+(\d+)[ \t]+([^\t]+)[ \t]+([-\d]+)[ \t]+([-\d]+)[ \t]+([-\d]+)/", $line, $parts)) {
	                            list($tmp, $objet["id"], $objet["nom"], $objet["x"], $objet["y"], $objet["z"]) = $parts;
	                            $objet["distance_pa"] = calcPA($objet["x"], $objet["y"], $objet["z"], $X, $Y, $Z);
	                            $streums[$objet["x"] + 100][$objet["y"] + 100][] = $objet;
	                            $streums_fichier[] = $objet;
	                        }
	                        break;
	                    case 40: # Tresors
	                        if (preg_match("/\d+[ \t]+(\d+)[ \t]+([^\t]+)[ \t]+([-\d]+)[ \t]+([-\d]+)[ \t]+([-\d]+)/", $line, $parts)) {
	                            list($tmp, $objet["id"], $objet["nom"], $objet["x"], $objet["y"], $objet["z"]) = $parts;
	                            $objet["distance_pa"] = calcPA($objet["x"], $objet["y"], $objet["z"], $X, $Y, $Z);
	                            $came[$objet["x"] + 100][$objet["y"] + 100][] = $objet;
	                            $came_fichier[] = $objet;
	                        }
	                        break;
	                    case 50: # Lieux
	                        if (preg_match("/\d+[ \t]+(\d+)[ \t]+([^\t]+)[ \t]+([-\d]+)[ \t]+([-\d]+)[ \t]+([-\d]+)/", $line, $parts)) {
	                            list($tmp, $objet["id"], $objet["nom"], $objet["x"], $objet["y"], $objet["z"]) = $parts;
	                            $objet["distance_pa"] = calcPA($objet["x"], $objet["y"], $objet["z"], $X, $Y, $Z);
	                            $lieux[$objet["x"] + 100][$objet["y"] + 100][] = $objet;
	                            $lieux_fichier[] = $objet;
	                        }
	                        break;
	                    case 60: # Champi
	                        if (preg_match("/\d+[ \t]+(\d+)[ \t]+([^\t]+)[ \t]+([-\d]+)[ \t]+([-\d]+)[ \t]+([-\d]+)/", $line, $parts)) {
	                            list($tmp, $objet["id"], $objet["nom"], $objet["x"], $objet["y"], $objet["z"]) = $parts;
	                            $champi[$objet["x"] + 100][$objet["y"] + 100][] = $objet;
	                            $champi_fichier[] = $objet;
	                        }
	                        break;
	                    case 70: # Position
	                	    if (preg_match("/Ma Position Actuelle est : X = (.+), Y = (.+), N = (.+) \[Le Labyrinthe (.+)\]/", $line, $parts)) { # Position du troll
	                            $X = $parts[1];
	                            $Y = $parts[2];
	                            $Z = $parts[3];
	                            $troll = array("x"=>$X, "y"=>$Y, "z"=>$Z, "nom"=>"moi", "id"=> - 1, "invisible"=>"invisible", "race"=>"troll", "niveau"=>0);
	                            $trolls[$X + 100][$Y + 100][] = $troll;
	                            $trolls_fichier[] = $troll;
	                        }
	                        elseif (preg_match("/Ma Position Actuelle est : X = (.+), Y = (.+), N = (.+)/", $line, $parts)) { # Position du troll
	                            $X = $parts[1];
	                            $Y = $parts[2];
	                            $Z = $parts[3];
	                            $troll = array("x"=>$X, "y"=>$Y, "z"=>$Z, "nom"=>"moi", "id"=> - 1, "invisible"=>"invisible", "race"=>"troll", "niveau"=>0);
	                            $trolls[$X + 100][$Y + 100][] = $troll;
	                            $trolls_fichier[] = $troll;
	                        }
	                        //L'affichage est limit� � 3 cases horizontalement et 2 verticalement
	                        if (preg_match("/affichage est limit� � (.+) cases horizontalement et (.+) verticalement/", $line, $parts)) { # Vue
	                            if (($parts[1] != $parts[2] * 2) && ($parts[1] + 1 != $parts[2] * 2)) {
	                                die(" Le nombre de cases vues horizontalement doit �tre le double du nombre de cases vues verticalement (-1 si n&eacute;cessaire)."."<br /> Ajustez vos limites et recommencez.");
	                            }
	                            $nCasesVue = $parts[1];
	                            // On sauvegarde la position du troll
	                            $Xmoi = $X;
	                            $Ymoi = $Y;
	                            $Zmoi = $Z;
	                            if ($DEV)
	                                echo "DEBUG parse_vue.php Vue: $nCasesVue X=$X, Y=$Y Z=$Z \n";
	                        }
	                        break;
	                }
	            }
	            
	            // si l'on est authentifi�, donc un RM, on met � jour la bdd
	            if (userIsGuilde() || userIsGroupSpec()) {
	                // Parse du fichier et mise � jour de la base de donn�es
	                parseFile2($_REQUEST["id_troll"], false, $Xmoi, $Ymoi, $Zmoi, $nCasesVue, false);
	                
	            } else { // Si l'on est pas authentifi�, on affiche la vue telle quelle
                
            ?>
            <table class='mh_tdborder' width='60%' align="center">
                <tr>
                    <td>
                        <table width='100%' cellspacing='0'>
                            <tr class='mh_tdtitre' align="center">
                                <td>
                                    <img src='/images/titre-vue.gif'>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php 
	            $tab["t_trolls"] = $trolls;
	            $tab["t_monstres"] = $streums;
	            $tab["t_lieux"] = $lieux;
	            $tab["t_tresors"] = $came;
	            $tab["t_champignons"] = $champi;
	            
	            $tab["taille_vue"] = (is_numeric($_REQUEST["taille_vue_publique"])) ? $_REQUEST["taille_vue_publique"] : $nCasesVue;
	            
	            $tab["max_pa"] = (is_numeric($_REQUEST["max_pa_publique"])) ? $_REQUEST["max_pa_publique"] : 50;
	            
	            $tab["x_position"] = $Xmoi;
	            $tab["y_position"] = $Ymoi;
	            $tab["z_position"] = $Zmoi;
	            
	            afficher_vue2d($tab);
	            include ('foot.php');
	            
	            $erreur = unlink("vues/".$_REQUEST["id_troll"]);
	            $erreur = unlink("vues/vue_tmp.".$_REQUEST["id_troll"].".txt");
	            
	            }
            ?>
