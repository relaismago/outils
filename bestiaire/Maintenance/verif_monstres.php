<?PHP

if (md5($_REQUEST['pass']) != '1583227674a477848b06c40803ccdc69')
  die("Acc�s refus�");

$link=mysql_connect("localhost","bestiairerm","kkwet");
if($link) $db=mysql_selectdb("bestiairerm",$link);
else die("Echec de connection � la BD");

$sql="SELECT Monstre FROM `cdms`";
$query=mysql_query($sql);
if(mysql_num_rows($query)==0){
  die("echec de r�cup�ration des donn�es<br>");
}
while($m=mysql_fetch_array($query)){
  $sql="SELECT Monstre From `monstres` WHERE `Monstre`=\"".$m['Monstre']."\";";
  $querym=mysql_query($sql);
  if(mysql_num_rows($querym)==0){
    print($m['Monstre']." manquant<br>");
    $sql="SELECT Nom,Race FROM `kmonstres` WHERE `Nom`=\"".$m['Monstre']."\";";
    $queryk=mysql_query($sql);
    if((mysql_num_rows($queryk)==0)){
      die($m['Monstre']." inconnu dans kmonstres !<br>");
    }
    else{
      $km=mysql_fetch_array($queryk);
      $text="(".trim($km['Race']).",".trim($km['Nom']).")";
      $sql="INSERT INTO monstres(Race,Monstre) VALUES(\"".trim($km['Race'])."\",\"".trim($km['Nom'])."\");";
      if(!mysql_query($sql)){
	die("l'insertion de $text a �chou�<br>");
      }
      else{
	print($text." ins�r�<br>");
      }
    }
  }
}
print("v�rification termin�e<br>");

?>
