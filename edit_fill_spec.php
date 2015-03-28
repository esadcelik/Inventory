<?php 
header('Content-Type: text/html; charset=utf-8');

$kategori=@$_POST['kategori'];

include 'config.php';

	try {
		$STH = $DBH->prepare("SELECT isim FROM specifications WHERE kategori = ? Order by isim ASC");  
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
	#$b = array_diff($b, array($kategori));
	foreach($b as $c) {
	
		echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";

	}

?>