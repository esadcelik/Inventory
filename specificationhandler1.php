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


$kategori = cleanInput(@$_POST['kategori1']);

$isim="";

if(is_null($kategori) || ctype_space($kategori)) {

	$_SESSION['kategori0']="Formda eksik var";
	header("Location: specifications.php"); exit;
}

try {
	
	$STH1 = $DBH->prepare("SELECT kategori,isim FROM specifications");  
	$STH1->execute();
	
	while($row = $STH1->fetch()) { 

		if($row['kategori'] == $kategori || $row['isim'] == $kategori) {

			$_SESSION['kategori0']="Kaydedilmedi, <b>".htmlspecialchars($kategori, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$STH1 = $DBH->prepare("SELECT person FROM person");  
	$STH1->execute(); 

	while($row = $STH1->fetch()) { 

		if($row['person'] == $kategori) {

			$_SESSION['kategori0']="Kaydedilmedi, <b>".htmlspecialchars($kategori, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}

	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$kategori.", ".
														" [Kaydedildi] "." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle);

	$STH = $DBH->prepare("INSERT INTO specifications (kategori, isim) values (?, ?)");
	$STH->execute(array($kategori,$isim));

}

catch(PDOException $e) {  
    echo $e->getMessage();
}

$_SESSION['kategori0']="Kaydedildi";
header("Location: specifications.php");

?>