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
                                                <h3>L'outil qui fait de l'ombre � notre Liche !</h3>
                                        </td>
                                </tr>
                        </table>
                </td>
        </tr>
</table>
<br/>
<br/>
<table class='mh_tdborder' width='70%' align='center' cellspacing='0'>
                <?php
                        if ( isset($_POST['hidden']))
                                echo get_result($_POST['hidden']);      
                ?>
        <tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>
                <a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>
        </tr>
</table>
<?
include('../foot.php');
?>
