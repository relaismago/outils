<?PHP

if (md5($_REQUEST['pass']) != '1583227674a477848b06c40803ccdc69')
  die("Accès refusé");

$link=mysql_connect("localhost","bestiairerm","kkwet");
if($link) $db=mysql_selectdb("bestiairerm",$link);
else die("Echec de connection à la BD");

//
$sql="SELECT Monstre FROM `monstres`";
$query=mysql_query($sql);
if(mysql_num_rows($query)==0){
  die("echec de récupération des données<br>");
}


while($m=mysql_fetch_array($query)){
  $bestcdm=array("Niv"=>'?',"MM"=>'?',"Pouvoir"=>'?',"Descript"=>'?',"Duree"=>'?',"Auto"=>'?',"Zone"=>'?');
  $date="";
  $text="PROBLEME";
  $monstre=$m['Monstre'];
  print("---------------------------- $monstre -----------------------------------<br>");
  $sql="SELECT Nom,MM,Pouvoir,Descript,Duree,Auto,Zone,Date,Source FROM `kmonstres` WHERE `Nom`=\"".$monstre."\" ORDER BY `date` DESC;";
  $queryk=mysql_query($sql);
  if(mysql_num_rows($queryk)==0){ // on essaie avec un espace devant
    $sql="SELECT Nom,MM,Pouvoir,Descript,Duree,Auto,Zone,Date,Source FROM `kmonstres` WHERE `Nom`=\" ".$monstre."\" ORDER BY `date` DESC;";
    $queryk=mysql_query($sql);
  }
  
  while($km=mysql_fetch_array($queryk)){ // tant qu'il y a des cdms pour ce
					 // monstre
    if($date==""){
      $kdate=$km['Date'];
      $jour=substr($kdate,0,2);
      $mois=substr($kdate,strpos($kdate,'/')+1,2);
      $annee=substr($kdate,strrpos($kdate,'/')+1,4);
      //   print("kdate=$kdate ; annee=$annee ; mois=$mois ; jour=$jour<br>");
      $date=$annee."/".$mois."/".$jour;
      print($date."<br>");
    }
    $text=trim($km['Nom']).",".$km['MM'].",".$km['Pouvoir'].",".$km['Descript'].",".$km['Duree'].",".$km['Auto'].",".$km['Zone'].",".$date.",".$km['Source'];
    print($text."<br>");
    if(($km['Pouvoir']!="")&&($km['Pouvoir']!="Aucun")&&($km['Pouvoir']!='?')){ // il y en a un !
      if($bestcdm['Pouvoir']=='?'){
	if(strlen($km['Pouvoir'])>strlen($bestcdm['Pouvoir'])) $bestcdm['Pouvoir']=$km['Pouvoir'];
      }
    }
    if($km['Descript']!=""){ // il y en a une !
      if($bestcdm['Descript']=='?'){
	$km['Descript']=substr($km['Descript'],0,strpos($km['Descript'],'<br>'));
	if(strlen($km['Descript'])>strlen($bestcdm['Descript'])) $bestcdm['Descript']=$km['Descript'];
      }
    }
    if(($km['MM']!="")&&($km['MM']!='0')&&($km['MM']!='?')){ // y en une !
      if($bestcdm['MM']=='?') $bestcdm['MM']=$km['MM'];
    }
    if(($km['Duree']!="")&&($km['Duree']!='0')&&($km['Duree']!='?')){ // y en une !
      if($bestcdm['Duree']=='?') $bestcdm['Duree']=$km['Duree'];
    }
    if(($km['Auto']!="")&&($km['Auto']!="Aucun")&&($km['Auto']!="?")){ // y en une !
      if($km['Auto']=="Auto") $km['Auto']="Oui";
      if($km['Auto']=="Normal") $km['Auto']="Non";      
      if($bestcdm['Auto']=='?') $bestcdm['Auto']=$km['Auto'];
    }
    if(($km['Zone']!="")&&($km['Zone']!="Aucun")&&($km['Zone']!="?")){ // y en une !
      if($km['Zone']=="Zone") $km['Zone']="Oui";
      if($km['Zone']=="Normal") $km['Zone']="Non";
      if($bestcdm['Zone']=='?') $bestcdm['Zone']=$km['Zone'];
    }
  }
  // on a recup les dernière valeurs renseignées, on peut les rentrer
  $textcarac=$bestcdm['Pouvoir'].",".$bestcdm['Descript'].",".$bestcdm['MM'].",".$bestcdm['Duree'].",".$bestcdm['Auto'].",".$bestcdm['Zone'].",".$date;
  print("-->".$textcarac."<br>");
  if($textcarac=="?,?,?,?,?,?,$date"){
    print("--> PAS d'INSERTION, aucune donnée<br>");
  }
  else{
    $sql="INSERT INTO pouvoirs(Monstre,Pouvoir,Descript,MM,Duree,Auto,Zone,date,source) VALUES(\"".$monstre."\",'".$bestcdm['Pouvoir']."','".$bestcdm['Descript']."','".$bestcdm['MM']."','".$bestcdm['Duree']."','".$bestcdm['Auto']."','".$bestcdm['Zone']."','".$date."','Relais & Mago');";
    if(!mysql_query($sql)){
      die("l'insertion de $text a échoué<br>$sql<br>");
    }
    else{
      print("-->inséré<br>");
    }
  }
}



?>
