<?php 
header('Content-Type: text/html; charset=utf-8');

$isim=@$_POST['isim'];

include 'config.php';

if($isim != "") {
	try {
		$STH = $DBH->prepare("SELECT nereden FROM entry WHERE isim = ? Order by nereden ASC");
		$STH->execute(array($isim)); 
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['nereden']);
		
		}

	$b = array_unique($b);
	$b = array_filter($b);

   		echo "<option selected></option>";
   		echo "<option value='tumu'>(Tümü)</option>";

	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}
}
else {
try {
		$STH = $DBH->prepare("SELECT nereden FROM entry Order by nereden ASC");
		$STH->execute(); 
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['nereden']);
		
		}

	$b = array_unique($b);
	$b = array_filter($b);

   		echo "<option selected></option>";
   		echo "<option value='tumu'>(Tümü)</option>";

	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}
}
?>