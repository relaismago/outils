<?
session_start();

include_once ("inc_connect.php3");
include_once ("functions_auth.php");
include_once ("functions.php3");

//$auto = false;
$auto = $_REQUEST['auto'];

if ($auto != "") {
	if (md5($auto) == MD5_PASS_EXTERNE) {
		if ($_REQUEST['state'] == "")
			die('ERREUR STATE');

	} else {
		die('Acces Refuse - seq_ref');
	}
}

if ( userIsGuilde() || ($auto) || userIsGroupSpec() ) {

	$state = $_REQUEST['state'];
	$maj_troll_id=$_REQUEST['maj_troll_id'];
	$maj_x_troll=$_REQUEST['maj_x_troll'];
	$maj_y_troll=$_REQUEST['maj_y_troll'];
	$maj_z_troll=$_REQUEST['maj_z_troll'];

	if (!$auto) {
		initSequenceRefresh($state);
	}

	suiteSequenceRefresh($auto,$state,$maj_troll_id,$maj_x_troll,$maj_y_troll,$maj_z_troll);
} else {
  die("Accès refusé");
}

function initSequenceRefresh($state)
{
	?>
	<head>
	<link rel='stylesheet' href='/css/MH_Style_Play.css' type='text/css'>
	<link rel='stylesheet' href='/css/feuille2.css' type='text/css'>
	<link rel='stylesheet' href='/css/vue.css' type='text/css'>
	</head>
	<body  onload="goNextSequence()">
		<br><br><br>
    <table class='mh_tdborder' width='70%' align='center'>
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdtitre' align="center">
            <td>
              <h2>Mise à jour de vue en cours</h2>
						<h2><font color=red><b>Ne fermez pas votre navigateur</b></font></h2>
            </td>
          </tr>
        </table>
      </td></tr>
     <tr class='mh_tdpage'><td>

    <table width="100%" border="0" cellpadding="3" cellspacing="3">
			<tr>
				<td align='center'>

	<?

  $rouge = "<b><font color=red>En cours</font></b> ";
  $vert = "<b><font color=gree>Fait</font></b>  ";

  $trolls = $rouge;
  $monstres = $rouge;
  $tresors = $rouge;
  $lieux = $rouge;

  if ($state >= 11)
    $trolls = $vert;
  if ($state >= 21)
    $monstres = $vert;
  if ($state >= 31)
    $tresors = $vert;
  if ($state >= 41)
    $lieux = $vert;

  echo "Trolls mis à jour $trolls <br>";
  echo "Monstres mis à jour $monstres<br>";
  echo "Trésors mis à jour $tresors<br>";
  echo "Lieux mis à jour $lieux<br>";

	if ($state != 51) {
		echo "Champignons et Troll mis à jour $rouge<br>";

		?>
			</td></tr>
			</table>
			</td></tr>
			</table>
		<?
	}
	
}

function suiteSequenceRefresh($auto,$state,$maj_troll_id,$maj_x_troll="",$maj_y_troll="",$maj_z_troll="")
{

  $vert = "<b><font color=gree>Fait</font></b>  ";

	if ($state == 51) {
		global $db_vue_rm;

		$tab = maj_vue_refresh($auto,$state,$maj_troll_id);
		
		$maj_x_troll = $tab[maj_x_troll];
		$maj_y_troll = $tab[maj_y_troll];
		$maj_z_troll = $tab[maj_z_troll];
		
		/* on délock le refresh pour le troll */
		$sql = "UPDATE trolls SET ";
		$sql .= " lock_refresh_troll='non' ";
		$sql .= " WHERE id_troll=$maj_troll_id";
		mysql_query($sql,$db_vue_rm);	
		
		$lien = "cockpit.php?id_troll=$maj_troll_id";//&centrer=1&cX=";
		//$lien .= "$maj_x_troll&cY=$maj_y_troll&cZ=$maj_z_troll";

		@unlink("vues/$maj_troll_id");
		@unlink("vues/vue_tmp.$maj_troll_id.txt");

		if (!$auto) {
			echo "Champignons et Troll mis à jour $vert<br><br>";
			echo "<b>La base de données a été mise à jour avec la vue du troll $maj_troll_id.</b>";
		
			echo "<br><h2><a href='$lien'>Cliquez ici pour aller à la vue2d ou attendez 2 secondes</h2></a>";
			?>
				</td></tr>
				</table>
				</td></tr>
				</table>
			<?

			$_SESSION['viewVue'] = "on";
			?>
		  <script language='JavaScript'>
			function goNextSequence() {
				setTimeout("goNextSequence2()",2000);
			}
			function goNextSequence2() {
				document.location.href='<? echo $lien ?>'
			}
			</script>
			<?
		} else {
			echo "FIN REFRESH AUTO";
		}

		@mysql_close($db_vue_rm);
	
	} elseif ($state != '') {
		maj_vue_refresh($auto,$state,$maj_troll_id);
	}
}
?>
