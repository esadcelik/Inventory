<?php 
header('Content-Type: text/html; charset=utf-8');

$kategori=@$_POST['kategori'];

include 'config.php';

if($kategori != "") {
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
	$b = array_filter($b);

   		echo "<option selected></option>";

	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}
}
else {
try {
		$STH = $DBH->prepare("SELECT isim FROM outlist Order by isim ASC");
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
	$b = array_filter($b);

   		echo "<option selected></option>";

	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}
}
?>