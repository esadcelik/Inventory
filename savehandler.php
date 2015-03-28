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


$isim = cleanInput(@$_POST['isim']);
$adet = cleanInput(@$_POST['adet']);
$nereden = cleanInput(@$_POST['nereden']);
$giris_tarih = cleanInput(@$_POST['giris_tarih']);
$kategori = cleanInput(@$_POST['kategori']);
$aciklama = cleanInput(@$_POST['aciklama']);

if(is_null($isim) || is_null($kategori) || is_null($nereden) || is_null($giris_tarih) || is_null($adet) || 
		ctype_space($isim) ||
		ctype_space($kategori) ||
		ctype_space($adet) ||
		ctype_space($nereden) ||
		ctype_space($giris_tarih)) {

	$_SESSION['error']="Formda eksik var";
	header("Location: save.php"); exit;
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

if(check1($giris_tarih)) {

try {
	
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Giriş] -> ".$kategori.", ".
									   $isim.", ".
									   $nereden.", ".
									   $adet.", ".
									   $giris_tarih." [Kaydedildi] "." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 

	
	
	$STH = $DBH->prepare("INSERT INTO entry (isim, adet, nereden, giris_tarih, kategori, aciklama) values (?, ?, ?, ?, ?, ?)");
	$STH->execute(array($isim,$adet,$nereden,$giris_tarih,$kategori,$aciklama));

	$STH2 = $DBH->prepare("SELECT adet,id FROM stock WHERE isim = ? AND kategori = ?");
	$STH2->execute(array($isim,$kategori));

	if($STH2->rowCount() == 0) {
	
		$STH1 = $DBH->prepare("INSERT INTO stock (isim, adet, kategori) values (?, ?, ?)");
		$STH1->execute(array($isim,$adet,$kategori));
	}
	else {

		$STH3 = $DBH->prepare("UPDATE stock SET adet= ? WHERE id= ?");
		while($row = $STH2->fetch()) {  
			$f=$row['adet'];
			$id=$row['id'];
		}
		
		$adetnew = (($f)+($adet));

		$STH3->execute(array($adetnew,$id));
		}

}

catch(PDOException $e) {  
    echo $e->getMessage();
}

$_SESSION['error']="Kaydedildi";
}
else {$_SESSION['error']="Tarih formatı yanlış";
}


header("Location: save.php");

?>