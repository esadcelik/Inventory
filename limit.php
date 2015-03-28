<?php 
header('Content-Type: text/html; charset=utf-8');

include 'config.php';

$isim=@$_POST['isim'];

try {

	$STH = $DBH->prepare("SELECT adet FROM stock WHERE isim = ?");
	$STH->execute(array($isim)); 
	
	while($row = $STH->fetch()) {  
		$f=$row['adet'];
	}
	echo htmlspecialchars($f, ENT_QUOTES);
}

catch(PDOException $e) {
    echo $e->getMessage();
}

?>