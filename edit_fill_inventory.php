<?php 
header('Content-Type: text/html; charset=utf-8');

$kategori=@$_POST['kategori'];
$isim=@$_POST['isim'];
$adet=@$_POST['adet'];

include 'config.php';

if(!empty($kategori) && empty($isim) && empty($adet)){

	try {
		$STH = $DBH->prepare("SELECT isim FROM stock WHERE kategori = ? Order by isim ASC");  
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
if(!empty($kategori) && !empty($isim) && empty($adet)) {

	try {
		$STH = $DBH->prepare("SELECT adet,id FROM stock WHERE isim = ? Order by adet ASC");  
		$STH->execute(array($isim)); 	
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {
	
		$b[$row['id']] = $row['adet'];
		
		}

		echo "<option selected></option>";

	foreach($b as $c => $d) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($d, ENT_QUOTES)."</option>";

	}

}

?>