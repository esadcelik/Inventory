<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

if(!empty($_SESSION['user'])) {

include 'config.php';

$tarih1=@$_POST['tarih1'];
$tarih2=@$_POST['tarih2'];

$kategori=@$_POST['kategori'];
$isim=@$_POST['isim'];
$nereden=@$_POST['nereden'];

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

if($_POST['exel']) {

if(($tarih1 == "" && $tarih2 == "") || (check1($tarih1) && check1($tarih2))) {

	if($kategori != "" && $isim == "" && $nereden == "") {
		if($kategori == "tumu") {

  				$filename = "website_data.xls";
  				
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

  				try {

 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM entry WHERE giris_tarih >= ? AND giris_tarih <= ? Order by kategori ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM entry");
 					$STH->execute();
 					}
				}  

				catch(PDOException $e) {
				    echo $e->getMessage();
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['kategori']);}

				$a = array_unique($a);
				

				foreach($a as $b) {
				
					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
 					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? Order by isim ASC");
 					$STH2->execute(array($b));
 					}

				
					$f=array($b => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Nereden" => "", 
					"Giriş Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

					while($row = $STH2->fetch()) {  

					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereden'],
					"Giriş Tarihi" => $row['giris_tarih'],
					"Açıklama" => $row['aciklama']);
  				
  				
					echo implode("\t", array_values($g)) . "\r\n";
					}		
				}
				exit;
		
		}
		else {
		
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

		
		
		try {  
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? Order by isim ASC");
 			$STH->execute(array($kategori));
 			}
	
		}  

		catch(PDOException $e) {  
    		echo $e->getMessage();  
		}
					$f=array($kategori => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Nereden" => "", 
					"Giriş Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

			while($row = $STH->fetch()) {
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereden'],
					"Giriş Tarihi" => $row['giris_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
			}
			exit;
	}
	}
	elseif($isim != "" && $kategori == "" && $nereden == "") {
			if($isim == "tumu") {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

				try {
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM entry WHERE giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM entry");
  					$STH->execute();
 					}
	
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['isim']);}

				$a = array_unique($a);

				foreach($a as $b) {

					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE isim = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by kategori ASC");
 					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE isim = ? Order by kategori ASC");
 					$STH2->execute(array($b));

 					}
					$f=array($b => "",	
					"Kategori" => "", 
					"Adet" =>"" , 
					"Nereden" => "", 
					"Giriş Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

				while($row = $STH2->fetch()) {  
		
					$g=array($b => " ",	
					"Kategori" => $row['kategori'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereden'],
					"Giriş Tarihi" => $row['giris_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";

					}
					
				}
				exit;
		}
		else {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

	try {  
	
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM entry WHERE isim = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by kategori ASC");
			$STH->execute(array($isim,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM entry WHERE isim = ? Order by kategori ASC");
			$STH->execute(array($isim));
 			}

	}  

	catch(PDOException $e) {  
    	echo $e->getMessage();  
	}
					$f=array($isim => "",	
					"Kategori" => "", 
					"Adet" =>"" , 
					"Nereden" => "", 
					"Giriş Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

	while($row = $STH->fetch()) {

					$g=array($isim => " ",	
					"Kategori" => $row['kategori'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereden'],
					"Giriş Tarihi" => $row['giris_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
		}
		exit;
	}
	}
	elseif($nereden != "" && $isim == "" && $kategori == "") {
			if($nereden == "tumu") {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

				try {  
				
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM entry WHERE giris_tarih >= ? AND giris_tarih <= ? Order by nereden ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM entry");}
 					$STH->execute();
 
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['nereden']);}

				$a = array_unique($a);

				foreach($a as $b) {

					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? Order by isim ASC");
  					$STH2->execute(array($b));
 					}
					$f=array($b => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Kategori" => "", 
					"Giriş Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";


				while($row = $STH2->fetch()) {  
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Kategori" => $row['kategori'],
					"Giriş Tarihi" => $row['giris_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
	
					}
					
				}
				exit;
		}
		else {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

	try {  
	
		if(check1($tarih1) && check1($tarih2)) {
		$STH = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
		$STH->execute(array($nereden,$tarih1,$tarih2));
		}
 		else {
 		$STH = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? Order by isim ASC");
 		$STH->execute(array($nereden));
 		}

	}

	catch(PDOException $e) {
    	echo $e->getMessage();
	}
					$f=array($nereden => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Kategori" => "", 
					"Giriş Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";


	while($row = $STH->fetch()) {

					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Kategori" => $row['kategori'],
					"Giriş Tarihi" => $row['giris_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
	}
	exit;
	}
	
}
	elseif($kategori != "" && $isim != "" && $nereden != "") {
	$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

		
		
		try {  
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND isim = ? AND nereden = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$isim,$nereden,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND isim = ? AND nereden = ? Order by isim ASC");
 			$STH->execute(array($kategori,$isim,$nereden));
 			}
	
		}  

		catch(PDOException $e) {  
    		echo $e->getMessage();  
		}
					$f=array($kategori => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Nereden" => "", 
					"Giriş Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

			while($row = $STH->fetch()) {
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereden'],
					"Giriş Tarihi" => $row['giris_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
			}
			exit;
	}
	else {echo "Error010";}
}

else {
echo "Error";
}

}



?>

<html>
<head>
<meta charset="UTF-8">
    <link href="dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="jquery.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="col-xs-8">
<table class="table table-striped">

<?php





if(($tarih1 == "" && $tarih2 == "") || (check1($tarih1) && check1($tarih2))) {

	if($kategori != "" && $isim == "" && $nereden == "") {
		if($kategori == "tumu") {

				try {

 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM entry WHERE giris_tarih >= ? AND giris_tarih <= ? Order by kategori ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM entry Order by kategori ASC");
 					$STH->execute();
 					}
				}

				catch(PDOException $e) {
				    echo $e->getMessage();
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['kategori']);}

				$a = array_unique($a);
				foreach($a as $b) {

					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
 					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? Order by isim ASC");
 					$STH2->execute(array($b));
 					}
					
					echo "<th>".htmlspecialchars($b, ENT_QUOTES)."</th>";
					echo "<th>İsim</th>";
					echo "<th>Adet</th>";
					echo "<th>Nereden</th>";
					echo "<th>Giriş Tarihi</th>";
					echo "<th>Açıklama</th>";

				while($row = $STH2->fetch()) {  
		
						echo "<tr>";
						echo "<div>";
						echo "<td></td>";
    					echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['nereden'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['giris_tarih'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES)."</td>";
						echo "</div>";
						echo "</tr>";

					}
				}
		
		}
		else {
		try {
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? Order by isim ASC");
 			$STH->execute(array($kategori));
 			}
	
		}  

		catch(PDOException $e) {
    		echo $e->getMessage();  
		}

		echo "<th>".htmlspecialchars($kategori, ENT_QUOTES)."</th>";
		echo "<th>İsim</th>";
		echo "<th>Adet</th>";
		echo "<th>Nereden</th>";
		echo "<th>Giriş Tarihi</th>";
		echo "<th>Açıklama</th>";

		while($row = $STH->fetch()) {
	
				echo "<tr>";
				echo "<div>";
				echo "<td></td>";
    			echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
				echo "<td>".htmlspecialchars($row['adet'] , ENT_QUOTES)."</td>";
				echo "<td>".htmlspecialchars($row['nereden'], ENT_QUOTES)."</td>";
				echo "<td>".htmlspecialchars($row['giris_tarih'], ENT_QUOTES)."</td>";
				echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES)."</td>";
				echo "</div>";
				echo "</tr>";}
			}
	}
	elseif($isim != "" && $kategori == "" && $nereden == "") {
			if($isim == "tumu") {
	
				try {
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM entry WHERE giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM entry Order by isim ASC");
  					$STH->execute();
 					}
	
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['isim']);}

				$a = array_unique($a);

				foreach($a as $b) {

					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE isim = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by kategori ASC");
 					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE isim = ? Order by kategori ASC");
 					$STH2->execute(array($b));

 					}

					echo "<th>".htmlspecialchars($b, ENT_QUOTES). "</th>";
					echo "<th>Kategori</th>";
					echo "<th>Adet</th>";
					echo "<th>Nereden</th>";
					echo "<th>Giriş Tarihi</th>";
					echo "<th>Açıklama</th>";

				while($row = $STH2->fetch()) {  
		
						echo "<tr>";
						echo "<div>";
						echo "<td></td>";
    					echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['nereden'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['giris_tarih'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES)."</td>";
						echo "</div>";
						echo "</tr>";

					}
				}
		}
		else {
	try {  
	
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM entry WHERE isim = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by kategori ASC");
			$STH->execute(array($isim,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM entry WHERE isim = ? Order by kategori ASC");
			$STH->execute(array($isim));
 			}

	}  

	catch(PDOException $e) {  
    	echo $e->getMessage();  
	}

	echo "<th>".htmlspecialchars($isim, ENT_QUOTES). "</th>";
	echo "<th>Kategori</th>";
	echo "<th>Adet</th>";
	echo "<th>Nereden</th>";
	echo "<th>Giriş Tarihi</th>";
	echo "<th>Açıklama</th>";

	while($row = $STH->fetch()) {

			echo "<tr>";
			echo "<div>";
			echo "<td></td>";
    		echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['nereden'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['giris_tarih'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES)."</td>";
			echo "</div>";
			echo "</tr>";}
		}
	}
	elseif($nereden != "" && $isim == "" && $kategori == "") {
			if($nereden == "tumu") {

				try {  
				
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM entry WHERE giris_tarih >= ? AND giris_tarih <= ? Order by nereden ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM entry Order by nereden ASC");}
 					$STH->execute();
 
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['nereden']);}

				$a = array_unique($a);

				foreach($a as $b) {

					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? Order by isim ASC");
  					$STH2->execute(array($b));
 					}

					echo "<th>".htmlspecialchars($b, ENT_QUOTES)."</th>";
					echo "<th>İsim</th>";
					echo "<th>Adet</th>";
					echo "<th>Kategori</th>";
					echo "<th>Giriş Tarihi</th>";
					echo "<th>Açıklama</th>";

				while($row = $STH2->fetch()) {
		
						echo "<tr>";
						echo "<div>";
						echo "<td></td>";
    					echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['giris_tarih'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES)."</td>";
						echo "</div>";
						echo "</tr>";

					}
				}
		}
		else {
	try {  
	
		if(check1($tarih1) && check1($tarih2)) {
		$STH = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
		$STH->execute(array($nereden,$tarih1,$tarih2));
		}
 		else {
 		$STH = $DBH->prepare("SELECT * FROM entry WHERE nereden = ? Order by isim ASC");
 		$STH->execute(array($nereden));
 		}

	}

	catch(PDOException $e) {
    	echo $e->getMessage();
	}

	echo "<th>".htmlspecialchars($nereden, ENT_QUOTES)."</th>";
	echo "<th>İsim</th>";
	echo "<th>Adet</th>";
	echo "<th>Kategori</th>";
	echo "<th>Giriş Tarihi</th>";
	echo "<th>Açıklama</th>";

	while($row = $STH->fetch()) {

			echo "<tr>";
			echo "<div>";
			echo "<td></td>";
    		echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['giris_tarih'], ENT_QUOTES)."</td>";
			echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES)."</td>";
			echo "</div>";
			echo "</tr>";}

	}
	}
	elseif($kategori != "" && $isim != "" && $nereden != "") {
	try {
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND isim = ? AND nereden = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$isim,$nereden,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM entry WHERE kategori = ? AND isim = ? AND nereden = ? Order by isim ASC");
 			$STH->execute(array($kategori,$isim,$nereden));
 			}
	
		}  

		catch(PDOException $e) {
    		echo $e->getMessage();  
		}

		echo "<th>".htmlspecialchars($kategori, ENT_QUOTES)."</th>";
		echo "<th>İsim</th>";
		echo "<th>Adet</th>";
		echo "<th>Nereden</th>";
		echo "<th>Giriş Tarihi</th>";
		echo "<th>Açıklama</th>";

		while($row = $STH->fetch()) {
	
				echo "<tr>";
				echo "<div>";
				echo "<td></td>";
    			echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES) . "</td>";
				echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES) . "</td>";
				echo "<td>".htmlspecialchars($row['nereden'], ENT_QUOTES) . "</td>";
				echo "<td>".htmlspecialchars($row['giris_tarih'], ENT_QUOTES) . "</td>";
				echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES) . "</td>";
				echo "</div>";
				echo "</tr>";}
			}
	
	else {echo "Error0";}
}

else {
echo "Error";
}

?>

</table>
</div>
<a href="board.php" class="btn btn-info btn-sm " role="button">Ana Sayfa</a>
</div>
</body>
</html>
<?php

}
else {

header("Location: index.php");
exit;


}
?>