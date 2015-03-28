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

$kategori = cleanInput(@$_POST['kategori2']);
$isim = cleanInput(@$_POST['isim2']);
$kisi = cleanInput(@$_POST['kisi2']);
$var = $kategori.$isim.$kisi;
$var = cleanInput($var);

if(is_null($var) || ctype_space($var)) {

	$_SESSION['info1']="Formda eksik var";
	header("Location: specifications.php"); exit;
}

if($_POST['sub0']) {

	try {

		$date = date_default_timezone_set("Asia/Istanbul");
		$date = date('Y-m-d');

		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$var.
														" [Bağlantılı Tüm Kayıtlar Silindi] -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle);

		$STH = $DBH->prepare("DELETE FROM specifications WHERE isim = ? OR kategori = ?");
		$STH->execute(array($var,$var));
		$STH = $DBH->prepare("DELETE FROM entry WHERE isim = ? OR kategori = ?");
		$STH->execute(array($var,$var));
		$STH = $DBH->prepare("DELETE FROM outlist WHERE isim = ? OR kategori = ?");
		$STH->execute(array($var,$var));
		$STH = $DBH->prepare("DELETE FROM stock WHERE isim = ? OR kategori = ?");
		$STH->execute(array($var,$var));
		$STH = $DBH->prepare("DELETE FROM person WHERE person = ?");
		$STH->execute(array($var));
	}
		catch(PDOException $e) {  
    	echo $e->getMessage();
	}
	$_SESSION['info1']="Bağlantılı tüm kayıtlar ve tanımlamalar silindi";

}
elseif($_POST['sub1']) {

try {

		$date = date_default_timezone_set("Asia/Istanbul");
		$date = date('Y-m-d');

		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$var.
														" [Silindi] -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle);

		$STH = $DBH->prepare("DELETE FROM specifications WHERE isim = ? OR kategori = ?");
		$STH->execute(array($var,$var));
		$STH = $DBH->prepare("DELETE FROM person WHERE person = ?");
		$STH->execute(array($var));

	}
		catch(PDOException $e) {  
    	echo $e->getMessage();
	}
	$_SESSION['info1']="Tanımlama silindi";

}
elseif($_POST['sub2']) {
	if($kategori != "") {header("Location: edit_spec.php?kategori=".$kategori);exit();}
	elseif($isim != "") {header("Location: edit_spec.php?isim=".$isim);exit();}
	elseif($kisi != "") {header("Location: edit_spec.php?kisi=".$kisi);exit();}
	else {echo "Error";}

}
else {echo "Error";}

header("Location: specifications.php");

?>