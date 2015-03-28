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
$isim = cleanInput(@$_POST['isim']);
$kisi = cleanInput(@$_POST['kisi']);

$kategori1 = cleanInput(@$_SESSION['kategori']);
$isim1 = cleanInput(@$_SESSION['isim']);
$kisi1 = cleanInput(@$_SESSION['kisi']);



if($_POST['sub']) {
	if(!empty($kategori)) {
	
	if(is_null($kategori) || ctype_space($kategori)) {

	$_SESSION['info1']="Formda eksik var";
	header("Location: specifications.php"); exit;
	}
	
	$STH1 = $DBH->prepare("SELECT kategori,isim FROM specifications");  
	$STH1->execute();

	while($row = $STH1->fetch()) { 

		if($row['kategori'] == $kategori || $row['isim'] == $kategori) {

			$_SESSION['info1']="Kaydedilmedi, <b>".htmlspecialchars($kategori, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$STH1 = $DBH->prepare("SELECT person FROM person");  
	$STH1->execute();

	while($row = $STH1->fetch()) { 

		if($row['person'] == $kategori) {

			$_SESSION['info1']="Kaydedilmedi, <b>".htmlspecialchars($kategori, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$kategori1.", ".
														" [Düzenlendi] ".$kategori." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle);


	$STH = $DBH->prepare("UPDATE entry SET kategori = ? WHERE kategori = ?");
	$STH->execute(array($kategori,$kategori1));

	$STH = $DBH->prepare("UPDATE stock SET kategori = ? WHERE kategori = ?");
	$STH->execute(array($kategori,$kategori1));

	$STH = $DBH->prepare("UPDATE outlist SET kategori = ? WHERE kategori = ?");
	$STH->execute(array($kategori,$kategori1));
	
	$STH = $DBH->prepare("UPDATE specifications SET kategori = ? WHERE kategori = ?");
	$STH->execute(array($kategori,$kategori1));
	
	}
	elseif(!empty($isim)) {
	
	if(is_null($isim) || ctype_space($isim)) {

			$_SESSION['info1']="Formda eksik var";
			header("Location: specifications.php"); exit;
	}
	
	
		$STH1 = $DBH->prepare("SELECT isim,kategori FROM specifications");  
		$STH1->execute(); 

	while($row = $STH1->fetch()) { 

		if($row['isim'] == $isim || $row['kategori'] == $isim ) {

			$_SESSION['info1']="Kaydedilmedi, <b>".htmlspecialchars($isim, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$STH1 = $DBH->prepare("SELECT person FROM person");  
	$STH1->execute();

	while($row = $STH1->fetch()) { 

		if($row['info1'] == $isim) {

			$_SESSION['info1']="Kaydedilmedi, <b>".htmlspecialchars($isim, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}

	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$isim1.", ".
														" [Düzenlendi] ".$isim." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle);

	$STH = $DBH->prepare("UPDATE entry SET isim = ? WHERE isim = ?");
	$STH->execute(array($isim,$isim1));

	$STH = $DBH->prepare("UPDATE stock SET isim = ? WHERE isim = ?");
	$STH->execute(array($isim,$isim1));

	$STH = $DBH->prepare("UPDATE outlist SET isim = ? WHERE isim = ?");
	$STH->execute(array($isim,$isim1));
	
	$STH = $DBH->prepare("UPDATE specifications SET isim = ? WHERE isim = ?");
	$STH->execute(array($isim,$isim1));
	
	
	}
	elseif(!empty($kisi)) {
	
	if(is_null($kisi) || ctype_space($kisi)) {

			$_SESSION['info1']="Formda eksik var";
			header("Location: specifications.php"); exit;
	}
	
	$STH1 = $DBH->prepare("SELECT person FROM person");  
	$STH1->execute();

	while($row = $STH1->fetch()) { 

		if($row['person'] == $kisi) {

			$_SESSION['info1']="Kaydedilmedi, <b>".htmlspecialchars($kisi, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$STH1 = $DBH->prepare("SELECT isim,kategori FROM specifications");  
	$STH1->execute();

	while($row = $STH1->fetch()) { 

		if($row['isim'] == $kisi || $row['kategori'] == $kisi ) {

			$_SESSION['info1']="Kaydedilmedi, <b>".htmlspecialchars($kisi, ENT_QUOTES)."</b> mevcut";
			header("Location: specifications.php");
			exit();
		}

	}
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');

		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Tanımlama] -> ".$kisi1.", ".
														" [Düzenlendi] ".$kisi." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle);

	$STH = $DBH->prepare("UPDATE entry SET nereden = ? WHERE nereden = ?");
	$STH->execute(array($kisi,$kisi1));

	$STH = $DBH->prepare("UPDATE outlist SET nereye = ? WHERE nereye = ?");
	$STH->execute(array($kisi,$kisi1));
	
	$STH = $DBH->prepare("UPDATE person SET person = ? WHERE person = ?");
	$STH->execute(array($kisi,$kisi1));

	}
	else {echo "Error";}

}
else {echo "Error0";}

unset($_SESSION['kategori']);
unset($_SESSION['isim']);
unset($_SESSION['kisi']);

$_SESSION['info1']="Değiştirildi";
header("Location: specifications.php");

?>