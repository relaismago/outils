<?
include_once('../top.php');
include_once('../secure.php');
include_once('anat_functions.php');
include_once('anat_functions_db.php');

initAnatomique();

function initAnatomique()
{
	afficherMenuAnatomique();

	if ($_REQUEST["id_troll"] == "new")
		afficherPropositionAnatomique();
	elseif ($_REQUEST["id_troll"] == "newdb")
		enregistreAnatomique();
	elseif (is_numeric($_REQUEST["id_troll"]))
		afficherFicheTrollAnatomique($_REQUEST["id_troll"]);
	else //($_REQUEST["id_troll"] == "list")
		afficherListeTrollAnatomique();
	
}

function afficherMenuAnatomique()
{
	?>
  <table class='mh_tdborder' width='60%' align='center'>
    <tr>
      <td>
      <table width='100%' cellspacing='0'>
        <tr class='mh_tdtitre' align="center">
        <td>
				<h1>Trolliaire</h1>
				<a href='/anatomique/anatomique.php?id_troll=new'>[nouvelle analyse]</a>
				<a href='/anatomique/anatomique.php?id_troll=lise'>[Liste des trolls analysés]</a>
        </td>
      </tr>
      </table>
      </tr>
    </td>
  </table><br>

	<?
}

?>
