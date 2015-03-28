<?php
header('Content-Type: text/html; charset=utf-8');

$kategori=@$_POST['kategori'];

include 'config.php';

	try {
		$STH = $DBH->prepare("SELECT kategori FROM specifications WHERE kategori = ? Order by kategori ASC");  
		$STH->execute(array($kategori));
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

	$b= array();

	while($row = $STH->fetch()) {

   	 	array_push($b, $row['kategori']);
		
		}

	$b = array_unique($b);
   
	foreach($b as $c) {
		echo htmlspecialchars($c, ENT_QUOTES)."<b> diye bir şey zaten var!</b>";

	}

?>