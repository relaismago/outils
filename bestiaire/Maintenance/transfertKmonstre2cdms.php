<?PHP

if (md5($_REQUEST['pass']) != '1583227674a477848b06c40803ccdc69')
  die("Accès refusé");

$link=mysql_connect("localhost","bestiairerm","kkwet");
if($link) $db=mysql_selectdb("bestiairerm",$link);
else die("Echec de connection à la BD");

$sql="SELECT Nom,Race,Famille,Niv,PV,ATT,ESQ,DEG,REG,ARM,VUE,Pouvoir,Descript,Date,Source FROM `kmonstres`";
$query=mysql_query($sql);
if(mysql_num_rows($query)==0){
  die("echec de récupération des données<br>");
}
while($km=mysql_fetch_array($query)){
  $kdate=$km['Date'];
  $jour=substr($kdate,0,2);
  $mois=substr($kdate,strpos($kdate,'/')+1,2);
  $annee=substr($kdate,strrpos($kdate,'/')+1,4);
  print("kdate=$kdate ; annee=$annee ; mois=$mois ; jour=$jour<br>");
  $date=$annee."/".$mois."/".$jour;
  $descript=trim(substr($km['Descript'],0,strpos($km['Descript'],"<br>")));
  
  $text=trim($km['Nom']).",".trim($km['Race']).",".trim($km['Famille']).",".$km['Niv'].",".$km['PV'].",".$km['ATT'].",".$km['ESQ'].",".$km['DEG'].",".$km['REG'].",".$km['ARM'].",".$km['VUE'].",".trim($km['Pouvoir']).",".$descript.",".$date.",".$km['Source'];

  if( ($km['Niv']=="?") || ($km['PV']=="?") || ($km['ATT']=="?") || ($km['ESQ']=="?") || ($km['DEG']=="?") || ($km['REG']=="?") || ($km['ARM']=="?") || ($km['VUE']=="?") ){
    print("DELETE ".$text."<br>");
  }
  else{
    if(trim($km['Famille'])==''){
      $sql="SELECT Famille FROM `races` WHERE `Race`=\"".trim($km['Race'])."\";";
      $queryfam=mysql_query($sql);
      if(mysql_num_rows($query)==0){
	die("echec de récupération de la famille<br>");
      }
      else{
	$ret=mysql_fetch_array($queryfam);
	$km['Famille']=$ret['Famille'];
      }
    }
    $sql="INSERT INTO cdms(Monstre,Race,Famille,Niv,PdV,ATT,ESQ,Degat,Regen,Armure,Vue,CapSpe,Affecte,date,source) VALUES(\"".trim($km['Nom'])."\",\"".trim($km['Race'])."\",\"".trim($km['Famille'])."\",'".$km['Niv']."','".$km['PV']."','".$km['ATT']."','".$km['ESQ']."','".$km['DEG']."','".$km['REG']."','".$km['ARM']."','".$km['VUE']."','".trim($km['Pouvoir'])."','".$descript."','".$date."','".$km['Source']."');";
    if(!mysql_query($sql)){
      die("l'insertion de $text a échoué<br>$sql<br>");
    }
    else{
      print($text."<br>");
    }
  }
}


?>
