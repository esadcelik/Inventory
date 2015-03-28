<?php
header('Content-Type: text/html; charset=utf-8');

$kisi=@$_POST['kisi'];

include 'config.php';

	try {
		$STH = $DBH->prepare("SELECT person FROM person WHERE person = ? Order by person ASC");  
		$STH->execute(array($kisi));	
		}
	catch(PDOException $e) {
    	echo $e->getMessage();
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['person']);
		
		}

	$b = array_unique($b);
   
	foreach($b as $c) {
		echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";	
		echo htmlspecialchars($c, ENT_QUOTES)."<b> diye bir şey zaten var!</b>";

	}


?>