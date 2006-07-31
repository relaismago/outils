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
  $sql="SELECT Nom,Pouvoir2,Descript2,Duree2,Auto2,Zone2,Date,Source FROM `kmonstres` WHERE `Nom`=\"".$monstre."\" ORDER BY `date` DESC;";
  $queryk=mysql_query($sql);
  if(mysql_num_rows($queryk)==0){ // on essaie avec un espace devant
    $sql="SELECT Nom,Pouvoir2,Descript2,Duree2,Auto2,Zone2,Date,Source FROM `kmonstres` WHERE `Nom`=\" ".$monstre."\" ORDER BY `date` DESC;";
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
    $text=trim($km['Nom']).",".$km['Pouvoir2'].",".$km['Descript2'].",".$km['Duree2'].",".$km['Auto2'].",".$km['Zone2'].",".$date.",".$km['Source'];
    print($text."<br>");
    if(($km['Pouvoir2']!="")&&($km['Pouvoir2']!="Aucun")&&($km['Pouvoir2']!="?")){ // il y en a un !
      if($bestcdm['Pouvoir']=='?'){
	if(strlen($km['Pouvoir2'])>strlen($bestcdm['Pouvoir'])) $bestcdm['Pouvoir']=$km['Pouvoir2'];
      }
    }
    if($km['Descript2']!=""){ // il y en a une !
      if($bestcdm['Descript']=='?'){
	$km['Descript2']=substr($km['Descript2'],0,strpos($km['Descript2'],'<br>'));
	if(strlen($km['Descript2'])>strlen($bestcdm['Descript'])) $bestcdm['Descript']=$km['Descript2'];
      }
    }
    if(($km['Duree2']!="")&&($km['Duree2']!="0")&&($km['Duree2']!="?")){ // y en une !
      if($bestcdm['Duree']=='?') $bestcdm['Duree']=$km['Duree2'];
    }
    if(($km['Auto2']!="")&&($km['Auto2']!="Aucun")&&($km['Auto2']!="?")){ // y en une !
      if($km['Auto2']=="Auto") $km['Auto2']="Oui";
      if($km['Auto2']=="Normal") $km['Auto2']="Non";      
      if($bestcdm['Auto']=='?') $bestcdm['Auto']=$km['Auto2'];
    }
    if(($km['Zone2']!="")&&($km['Zone2']!="Aucun")&&($km['Zone2']!="?")){ // y en une !
      if($km['Zone2']=="Zone") $km['Zone']="Oui";
      if($km['Zone2']=="Normal") $km['Zone']="Non";
      if($bestcdm['Zone']=='?') $bestcdm['Zone']=$km['Zone2'];
    }
  }
  // on a recup les dernière valeurs renseignées, on peut les rentrer
  $textcarac=$bestcdm['Pouvoir'].",".$bestcdm['Descript'].",".$bestcdm['Duree'].",".$bestcdm['Auto'].",".$bestcdm['Zone'].",".$date;
  print("-->".$textcarac."<br>");
  if($textcarac=="?,?,?,?,?,$date"){
    print("--> PAS d'INSERTION, aucune donnée<br>");
  }
  else{
    $sql="INSERT INTO derniersouffle(Monstre,Pouvoir,Descript,Duree,Auto,Zone,date,source) VALUES(\"".$monstre."\",'".$bestcdm['Pouvoir']."','".$bestcdm['Descript']."','".$bestcdm['Duree']."','".$bestcdm['Auto']."','".$bestcdm['Zone']."','".$date."','Relais & Mago');";
    if(!mysql_query($sql)){
      die("l'insertion de $text a échoué<br>$sql<br>");
    }
    else{
      print("-->inséré<br>");
    }
  }
}



?>
