<?PHP

if (md5($_REQUEST['pass']) != '1583227674a477848b06c40803ccdc69')
  die("Acc�s refus�");

$link=mysql_connect("localhost","bestiairerm","kkwet");
if($link) $db=mysql_selectdb("bestiairerm",$link);
else die("Echec de connection � la BD");

$sql="SELECT Monstre FROM `monstres`";
$query=mysql_query($sql);
if(mysql_num_rows($query)==0){
  die("echec de r�cup�ration des donn�es<br>");
}
while($m=mysql_fetch_array($query)){
  $sql="SELECT Monstre From `cdms` WHERE `Monstre`=\"".$m['Monstre']."\";";
  $querycdm=mysql_query($sql);
  if(mysql_num_rows($querycdm)==0){ // le monstre a �t� supprim� de la cdm
    $sql="DELETE FROM `monstres` WHERE `Monstre` = \"".$m['Monstre']."\" LIMIT 1;";
    if(!mysql_query($sql)){
      die("echec de la suppression de ".$m['Monstre']."<br>");
    }
    else{
      print($m['Monstre']." supprim�<br>");
    }
  }
}

    
?>
