<?php
header("Content-type: text/html; charset=iso-8859-1");
function maj(){
	$liste = file_get_contents('ftp://ftp.mountyhall.com/Public_Trolls.txt');
	if($liste!==false){
		$file = fopen('Public_Trolls.txt','w+');
		if(fwrite($file,$liste)===false)
			return false;
		fclose($file);
		return true;
	}
	else
		return false;
}
function find($num,$boucle=0){
	if(file_exists("Public_Trolls.txt")){
		$fichier = file_get_contents("Public_Trolls.txt");
		$deb = ($num==1) ? '^' : '\n';
		preg_match('/'.$deb.$num.';(.+);/U',$fichier,$out);
		if(!isset($out[1])){
			if($boucle==0){
				maj();
				find($num,1);
			}
			else
				return '####';
		}
		else
			return $out[1];
	}
	else{
		maj();
		find($num,1);
	}
}
if(isset($_POST['num_troll']))
	echo find($_POST['num_troll']);
?>