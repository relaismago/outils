<?
### Debug Mode Développement ####



// Si l'utilisateur veut désactiver le mode DEBUG, il faut passe ?DEV=NON dans l'url
if ((isset($_REQUEST['DEV']) && $_REQUEST['DEV']=="NON") || ($DEV=="FALSE"))
	$DEV=FALSE; 
//Si la variable de DEV est passé en paramêtre à l'url
elseif (isset($_REQUEST['DEV']) && $_REQUEST['DEV']==TRUE)
	$DEV=TRUE;
// Sinon, on regarde si la variable de session est renseignée
elseif (isset($_SESSION['DEV']) && $_SESSION['DEV']==TRUE)
	$DEV=TRUE;
// Si rien est renseigné, on passe dans le mode par défaut :
else
	$DEV=FALSE;

// Variable de sesssion qui peut être utilisé dans les autres scripts
$_SESSION['DEV']=$DEV;

?>
