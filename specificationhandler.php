<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

include 'config.php';

function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }



$kategori = cleanInput(@$_POST['kategori']);

$isim= cleanInput(@$_POST['isim']);

if(is_null($isim) || is_null($kategori) || ctype_space($isim) || ctype_space($kategori)) {

	$_SESSION['isim']="Formda eksik var";
	header("Location: specifications.php"); exit;
}

try {

	$STH1 = $DBH->prepare("SELECT isim,kategori FROM specifications");  
	$STH1->execute();   

	while($row = $STH1->fetch()) { 

		if($row['isim'] == $isim || $row['kategori'] == $isim ) {

			$_SESSION['isim']="Kaydedilmedi, <b>".htmlspecialchars($isim, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$STH1 = $DBH->prepare("SELECT person FROM person");  
	$STH1->execute();
	
	while($row = $STH1->fetch()) { 

		if($row['person'] == $isim) {

			$_SESSION['isim']="Kaydedilmedi, <b>".htmlspecialchars($isim, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$kategori.", ".
									   $isim.", "." [Kaydedildi] "." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle);

	
	$STH = $DBH->prepare("INSERT INTO specifications (kategori, isim) values (?, ?)");
	$STH->execute(array($kategori,$isim));

}

catch(PDOException $e) {  
    echo $e->getMessage();
}

$_SESSION['isim']="Kaydedildi";
header("Location: specifications.php");

?>