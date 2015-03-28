<?php
header('Content-Type: text/html; charset=utf-8');

$isim=@$_POST['isim'];

include 'config.php';

	try {
		$STH = $DBH->prepare("SELECT isim FROM specifications WHERE isim = ? Order by isim ASC");  
		$STH->execute(array($isim));	
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['isim']);
		
		}
	$b = array_unique($b);
	
	foreach($b as $c) {
	if(!empty($c)) {
		echo "</br></br></br></br></br></br></br></br></br>";	
		echo htmlspecialchars($c, ENT_QUOTES)."<b> diye bir şey zaten var!</b>";

	}

}
?>