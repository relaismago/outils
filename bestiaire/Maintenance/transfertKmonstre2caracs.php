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
  $bestcdm=array("Niv"=>'?',"ATTDLA"=>'?',"DLA"=>'?',"RM"=>'?');
  $date="";
  $text="PROBLEME";
  $monstre=$m['Monstre'];
  print("-----------------------------$monstre------------------------------------<br>");
  $sql="SELECT Nom,Niv,ATTDLA,DLA,RM,MM,Date,Source FROM `kmonstres` WHERE `Nom`=\"".$monstre."\" ORDER BY `date` DESC;";
  $queryk=mysql_query($sql);
  if(mysql_num_rows($queryk)==0){ // on essaie avec un espace devant
    $sql="SELECT Nom,Niv,ATTDLA,DLA,RM,MM,Date,Source FROM `kmonstres` WHERE `Nom`=\" ".$monstre."\" ORDER BY `date` DESC;";
    $queryk=mysql_query($sql);
  }
  while($km=mysql_fetch_array($queryk)){ // tant qu'il y a des cdms pour ce
					 // monstre
    if($date==""){
      $kdate=$km['Date'];
      $jour=substr($kdate,0,2);
      $mois=substr($kdate,strpos($kdate,'/')+1,2);
      $annee=substr($kdate,strrpos($kdate,'/')+1,4);
      // print("kdate=$kdate ; annee=$annee ; mois=$mois ; jour=$jour<br>");
      $date=$annee."/".$mois."/".$jour;
      // print($date."<br>");
    }
    $text=trim($km['Nom']).",".$km['Niv'].",".$km['ATTDLA'].",".$km['DLA'].",".$km['RM'].",".$date.",".$km['Source'];
    print($text."<br>");
    if(strlen($km['Niv'])<=2){ // ce n'est pas un interval
      //print($km['Niv']." pas un interval car strlen=".strlen($km['Niv'])."<br>");
      if($bestcdm['Niv']=='?') $bestcdm['Niv']=$km['Niv']; // si pas encore affecté
    }
    if(strlen($km['ATTDLA'])<=2){ // ce n'est pas un interval
      if($bestcdm['ATTDLA']=='?') $bestcdm['ATTDLA']=$km['ATTDLA'];
    }
    if(strlen($km['DLA'])<=2){ // ce n'est pas un interval
      if($bestcdm['DLA']=='?') $bestcdm['DLA']=$km['DLA'];
    }
    if($km['RM']!=""){ // y en une !
      if($bestcdm['RM']=='?') $bestcdm['RM']=$km['RM'];
    }
  }
  // on a recup les dernière valeurs renseignées, on peut les rentrer
  $textcarac=$bestcdm['Niv'].",".$bestcdm['ATTDLA'].",".$bestcdm['DLA'].",".$bestcdm['RM'].",".$date;
  print("-->".$textcarac."<br>");
  if(substr($textcarac=="?,?,?,?,",0,8)){
    print("--> pas d'insertion, aucune donnée<br>");
  }
  else{
    $sql="INSERT INTO caracs(Monstre,Niv,ATTDLA,DurDLA,RM,date,source) VALUES(\"".$monstre."\",'".$bestcdm['Niv']."','".$bestcdm['ATTDLA']."','".$bestcdm['DLA']."','".$bestcdm['RM']."','".$date."','Relais & Mago');";
    if(!mysql_query($sql)){
      die("l'insertion de $text a échoué<br>$sql<br>");
    }
    else{
      print("-->inséré<br>");
    }
  }
}

?>
