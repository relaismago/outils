<?
//require_once("../inc_connect.php3"); // pour test en local (à commenter avant le commit)
include('../top.php');
include('secure_bestiaire.php');
require_once('Libs/inc_affichage.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html> <head>
<title>CdM Parser</title>
</head>

</body> </html>

<div align='center'>
<?
afficheMenuBestiaire('','');
?>
</div>

<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>
<tr class='mh_tdtitre'><td>
<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>
<form action='MaJ/parse_cdm.php' method='post'>

<tr valign='middle' class='mh_tdtitre'>
<td align='center' bgcolor='#F75007'>Analyseur de CDM</td>
</tr>
<tr align='center'>
<td height='35' width='100%' align='center' ><font color='#FFFFFF'>Données MH<br>Faire un copier coller du message BOT du CdM</font></TD>
</tr>

<tr valign='middle' class='mh_tdpage'>
<td width='100%' align='center'>
&nbsp;<br><textarea rows='10' cols='75' name='copiercoller'></textarea><br>&nbsp;
</td>
</tr>

<tr valign='middle' class='mh_tdpage'>
<TD align='center'>
&nbsp;<br><INPUT TYPE='submit' NAME='soumettre' VALUE='On parse le zinzin...' CLASS='mh_form_submit' class='mh_form_submit'><br>&nbsp;
</td>
</tr>

</form>
</table>
</td></tr>

</table>

</body>
</html>
