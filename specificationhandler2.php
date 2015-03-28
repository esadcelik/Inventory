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


$kisi = cleanInput(@$_POST['kisi']);

if(is_null($kisi) || ctype_space($kisi)) {

	$_SESSION['kisi']="Formda eksik var";
	header("Location: specifications.php"); exit;
}

try {
	
	$STH1 = $DBH->prepare("SELECT person FROM person");  
	$STH1->execute(); 

	while($row = $STH1->fetch()) { 

		if($row['person'] == $kisi) {

			$_SESSION['kisi']="Kaydedilmedi, <b>".htmlspecialchars($kisi, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$STH1 = $DBH->prepare("SELECT isim,kategori FROM specifications");  
	$STH1->execute(); 

	while($row = $STH1->fetch()) { 

		if($row['isim'] == $kisi || $row['kategori'] == $kisi ) {

			$_SESSION['kisi']="Kaydedilmedi, <b>".htmlspecialchars($kisi, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}

	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$kisi." [Kaydedildi] "." -> [".$date."]"."\n"; 
		
		fwrite($handle, $data);
		fclose($handle);

	$STH = $DBH->prepare("INSERT INTO person (person) values (?)");
	$STH->execute(array($kisi));

}

catch(PDOException $e) {  
    echo $e->getMessage();
}
$_SESSION['kisi']="Kaydedildi";
header("Location: specifications.php");

?>