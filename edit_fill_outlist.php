<?php 

$kategori=@$_POST['kategori'];
$isim=@$_POST['isim'];
$kisi=@$_POST['kisi'];
$adet=@$_POST['adet'];
$tarih=@$_POST['tarih'];

include 'config.php';

if(!empty($kategori) && empty($isim) && empty($kisi) && empty($adet) && empty($tarih)){

	try {
		$STH = $DBH->prepare("SELECT isim FROM outlist WHERE kategori = ? Order by isim ASC");  
		$STH->execute(array($kategori)); 
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['isim']);
		
		}

	$b = array_unique($b);
   		echo "<option selected></option>";

	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}

}
if(!empty($kategori) && !empty($isim) && empty($kisi) && empty($adet) && empty($tarih)) {

	try {
		$STH = $DBH->prepare("SELECT nereye FROM outlist WHERE isim = ? Order by nereye ASC");  
		$STH->execute(array($isim)); 
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['nereye']);
		
		}

	$b = array_unique($b);
   		echo "<option selected></option>";

	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}

}
if(!empty($kategori) && !empty($isim) && !empty($kisi) && empty($adet) && empty($tarih)) {

	try {
		$STH = $DBH->prepare("SELECT adet FROM outlist WHERE isim = ? AND nereye = ? Order by adet ASC");  
		$STH->execute(array($isim,$kisi)); 
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['adet']);
		
		}

	$b = array_unique($b);
   		echo "<option selected></option>";

	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}

}
if(!empty($kategori) && !empty($isim) && !empty($kisi) && !empty($adet) && empty($tarih)) {

	try {
		$STH = $DBH->prepare("SELECT cikis_tarih,id FROM outlist WHERE isim = ? AND nereye = ? AND adet = ? Order by cikis_tarih ASC");  
		$STH->execute(array($isim,$kisi,$adet)); 	
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {
		$b[$row['id']] = $row['cikis_tarih'];
		
		}

   		echo "<option selected></option>";

	foreach($b as $c => $d) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($d, ENT_QUOTES)."</option>";

	}

}
?>