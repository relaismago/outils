<?
### Debug Mode D�veloppement ####



// Si l'utilisateur veut d�sactiver le mode DEBUG, il faut passe ?DEV=NON dans l'url
if ((isset($_REQUEST['DEV']) && $_REQUEST['DEV']=="NON") || ($DEV=="FALSE"))
	$DEV=FALSE; 
//Si la variable de DEV est pass� en param�tre � l'url
elseif (isset($_REQUEST['DEV']) && $_REQUEST['DEV']==TRUE)
	$DEV=TRUE;
// Sinon, on regarde si la variable de session est renseign�e
elseif (isset($_SESSION['DEV']) && $_SESSION['DEV']==TRUE)
	$DEV=TRUE;
// Si rien est renseign�, on passe dans le mode par d�faut :
else
	$DEV=FALSE;

// Variable de sesssion qui peut �tre utilis� dans les autres scripts
$_SESSION['DEV']=$DEV;

?>
