<? require_once('../functions_auth.php'); ?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html> <head>
<title>CdM Parser</title>
</head>
</body> 
<html>

<script language='JavaScript'>
<?
if (userIsGuilde())
	echo "document.location.href='cdm_parser.php';";
else
	echo "document.location.href='bestiaire.php';";

?>
</script>

</html>
