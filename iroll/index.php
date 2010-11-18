<?
require_once ( "../top.php" );
require_once ( "functions_iroll.php" );
?>
<br/>
<table class='mh_tdborder' width='70%' align='center'>
        <tr>
                <td>
                        <table width='100%' cellspacing='0' >
                                <tr class='mh_tdtitre' align='center'>
                                        <td>
                                                <h2>IROLL</h2>
                                        </td>
                                </tr>
                                <tr class='mh_tdtitre' align='center'>
                                        <td>
                                                <h3>L'outil qui fait de l'ombre à notre Liche !</h3>
                                        </td>
                                </tr>
                        </table>
                </td>
        </tr>
</table>
<br/>
<br/>
<table width="80%" class='mh_tdborder' align='center' cellspacing='0'>
        <tr class="mh_tdtitre" align='center'>
                <td class='mh_tdpage'><h2>Faire une nouvelle attribution : </h2></td>
        </tr>
        <tr class="mh_tdtitre" align='center'>
                <td class='mh_tdpage'>
                Eviter les caract&eacute;res sp&eacute;ciaux tel que "\/ pour chaque saisie.
                <form action="attribution.php" method="post" >
                        <label for="attrib">Nom de l'attribution : </label>
                        <input name="attrib" id="attrib" type="text" />
                        <label for="pseudo">Nom du responsable : </label>
                        <input name="pseudo" id="pseudo" type="text" />                 
                        <input type="submit" value="GO !" />
                </form>
                </td>
        </tr>
        <tr class="mh_tdtitre" align='center'>
                <td class='mh_tdpage'><h2>Attributions Effectu&eacute;es : </h2></td>
        </tr>
        <tr align='center'>
                <td class='mh_tdpage'>
                        <?php echo get_attributions();?>
                </td>
        </tr>
</table>
<?
include('../foot.php');
?>
