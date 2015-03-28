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

function check1($date)
{
	if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches))
	{
		if(checkdate($matches[2], $matches[3], $matches[1]))
		{
			return true;
		}
		else {return false;}
	}
	else {return false;}
}


$isim = cleanInput(@$_POST['isim']);
$adet = cleanInput(@$_POST['adet']);
$nereye = cleanInput(@$_POST['nereye']);
$cikis_tarih = cleanInput(@$_POST['cikis_tarih']);
$kategori = cleanInput(@$_POST['kategori']);
$aciklama = cleanInput(@$_POST['aciklama']);

if(is_null($isim) || is_null($kategori) || is_null($nereye) || is_null($cikis_tarih) || is_null($adet) || 
		ctype_space($isim) ||
		ctype_space($kategori) ||
		ctype_space($adet) ||
		ctype_space($nereye) ||
		ctype_space($cikis_tarih)) {

	$_SESSION['error']="Formda eksik var";
	header("Location: out.php"); exit;
}

if(check1($cikis_tarih)) {


try {
	
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Çıkış] -> ".$kategori.", ".
									   $isim.", ".
									   $nereye.", ".
									   $adet.", ".
									   $cikis_tarih." [Çıkıldı] "." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 

	
	$STH1 = $DBH->prepare("SELECT adet,id FROM stock WHERE isim = ? AND kategori = ?");
	$STH1->execute(array($isim,$kategori));


	$STH2 = $DBH->prepare("INSERT INTO outlist (isim, adet, nereye, cikis_tarih, kategori, aciklama) values (?, ?, ?, ?, ?, ?)");
	$STH2->execute(array($isim,$adet,$nereye,$cikis_tarih,$kategori,$aciklama));

	$STH3 = $DBH->prepare("UPDATE stock SET adet=? WHERE id= ?");

	while($row = $STH1->fetch()) {  
		$f=$row['adet'];
		$id=$row['id'];
	}

	$adetnew = (($f)-($adet));
	
	$STH3->execute(array($adetnew,$id));

	$STH4 = $DBH->prepare("DELETE FROM stock WHERE adet = 0");
	$STH4->execute();

}

catch(PDOException $e) {
    echo $e->getMessage();
}

$_SESSION['error']="Çıkıldı";
}
else {$_SESSION['error']="Tarih formatı yanlış";
}

header("Location: out.php");

?>