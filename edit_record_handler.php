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

if(!check1($_POST['tarih']) && !$_POST['stock']) {
	if($_POST['entry']) {$_SESSION['entry']="Tarih Hatalı";header("Location: edit_entry.php"); exit();}
		
	if($_POST['outlist']) {$_SESSION['outlist']="Tarih Hatalı";header("Location: edit_outlist.php"); exit();}
}

$id=cleanInput(@$_POST['id']);

if($_POST['entry']) {
	
	$kategori = cleanInput($_POST['kategori']);
	$isim = cleanInput($_POST['isim']);
	$nereden = cleanInput($_POST['nereden']);
	$adet = cleanInput($_POST['adet']);
	$tarih = cleanInput($_POST['tarih']);
	
	if(is_null($isim) || is_null($kategori) || is_null($nereden) || is_null($tarih) || is_null($adet) || 
		ctype_space($isim) ||
		ctype_space($kategori) ||
		ctype_space($adet) ||
		ctype_space($nereden) ||
		ctype_space($tarih)) {

	$_SESSION['entry']="Formda eksik var";
	header("Location: edit_entry.php"); exit;
}
	
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	$STH = $DBH->prepare("SELECT * FROM entry WHERE id = ?"); 
	$STH->execute(array($id));
	
	while($row = $STH->fetch()) {
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Giriş] -> ".$row['kategori'].", ".
									   $row['isim'].", ".
									   $row['nereden'].", ".
									   $row['adet'].", ".
									   $row['giris_tarih']." [Değiştirildi] "."]-> ".$kategori.", ".
									   										  $isim.", ".
									   										  $nereden.", ".
									   										  $adet.", ".
									   										  $tarih." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 
	}
	
	$STH = $DBH->prepare("UPDATE entry SET kategori = ?,
											isim = ?,
											adet = ?,
											nereden = ?,
											giris_tarih = ? WHERE id = ?");
	$STH->execute(array($kategori,$isim,$adet,$nereden,$tarih,$id));
	$_SESSION['entry']="Değiştirildi";
	
	
	header("Location: edit_entry.php"); exit();
	
}
elseif($_POST['stock']) {
	
	$kategori = cleanInput($_POST['kategori']);
	$isim = cleanInput($_POST['isim']);
	$adet = cleanInput($_POST['adet']);
	
	if(is_null($isim) || is_null($kategori) || is_null($adet) || 
		ctype_space($isim) ||
		ctype_space($kategori) ||
		ctype_space($adet)) {

	$_SESSION['stock']="Formda eksik var";
	header("Location: edit_inventory.php"); exit;
}
	
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	$STH = $DBH->prepare("SELECT * FROM stock WHERE id = ?"); 
	$STH->execute(array($id));
	
	while($row = $STH->fetch()) {
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Envanter] -> ".$row['kategori'].", ".
									   $row['isim'].", ".
									   $row['adet']." [Değiştirildi] "."]-> ".$kategori.", ".
									   										  $isim.", ".
									   										  $adet." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 
	}
	
	$STH = $DBH->prepare("UPDATE stock SET kategori = ?,
											isim = ?,
											adet = ?
											WHERE id = ?");
	$STH->execute(array($kategori,$isim,$adet,$id));
	$_SESSION['stock']="Değiştirildi";
	header("Location: edit_inventory.php"); exit();
	
}
elseif($_POST['outlist']) {
	
	$kategori = cleanInput(@$_POST['kategori']);
	$isim = cleanInput(@$_POST['isim']);
	$nereye = cleanInput(@$_POST['nereye']);
	$adet = cleanInput(@$_POST['adet']);
	$tarih = cleanInput(@$_POST['tarih']);
	
	if(is_null($isim) || is_null($kategori) || is_null($nereye) || is_null($tarih) || is_null($adet) || 
		ctype_space($isim) ||
		ctype_space($kategori) ||
		ctype_space($adet) ||
		ctype_space($nereye) ||
		ctype_space($tarih)) {

	$_SESSION['outlist']="Formda eksik var";
	header("Location: edit_outlist.php"); exit;
}
	
	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');
	
	$STH = $DBH->prepare("SELECT * FROM outlist WHERE id = ?"); 
	$STH->execute(array($id));
	
	while($row = $STH->fetch()) {
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Çıkış] -> ".$row['kategori'].", ".
									   $row['isim'].", ".
									   $row['nereye'].", ".
									   $row['adet'].", ".
									   $row['cikis_tarih']." [Değiştirildi] "."]-> ".$kategori.", ".
									   										  $isim.", ".
									   										  $nereye.", ".
									   										  $adet.", ".
									   										  $tarih." -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 
	}

	$STH = $DBH->prepare("UPDATE outlist SET kategori = ?,
											isim = ?,
											adet = ?,
											nereye = ?,
											cikis_tarih = ? WHERE id = ?");
	$STH->execute(array($kategori,$isim,$adet,$nereye,$tarih,$id));
	$_SESSION['outlist']="Değiştirildi";
	header("Location: edit_outlist.php"); exit();

}
else {echo "Error0";}

header("Location: board.php");

?>