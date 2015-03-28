<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

if(!empty($_SESSION['user'])) {

include 'config.php';

$tarih1 = @$_POST['tarih1'];
$tarih2 = @$_POST['tarih2'];

$kategori = @$_POST['kategori'];
$isim = @$_POST['isim'];
$nereye = @$_POST['nereye'];

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

	if($kategori != "" && $isim == "" && $nereye == "") {
		if($kategori == "tumu") {

  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

  				try {

 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM outlist WHERE cikis_tarih >= ? AND cikis_tarih <= ? Order by kategori ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM outlist Order by isim ASC");
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
					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? Order by isim ASC");
 					$STH2->execute(array($b));
 					}

				
					$f=array($b => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Nereden" => "", 
					"Çıkış Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

					while($row = $STH2->fetch()) {  

					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereye'],
					"Çıkış Tarihi" => $row['cikis_tarih'],
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
			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? Order by isim ASC");
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
					"Çıkış Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

			while($row = $STH->fetch()) {
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereye'],
					"Çıkış Tarihi" => $row['cikis_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
			}
			exit;
	}
	}
	elseif($isim != "" && $kategori == "" && $nereye == "") {
			if($isim == "tumu") {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

				try {
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM outlist WHERE cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM outlist");
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
					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by kategori ASC");
					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? Order by kategori ASC");
 					$STH2->execute(array($b));
 					}
					$f=array($b => "",	
					"Kategori" => "", 
					"Adet" =>"" , 
					"Nereden" => "", 
					"Çıkış Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

				while($row = $STH2->fetch()) {  
		
					$g=array($b => " ",	
					"Kategori" => $row['kategori'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereye'],
					"Çıkış Tarihi" => $row['cikis_tarih'],
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
			$STH = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by kategori ASC");
			$STH->execute(array($isim,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? Order by kategori ASC");
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
					"Çıkış Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

	while($row = $STH->fetch()) {

					$g=array($isim => " ",	
					"Kategori" => $row['kategori'], 
					"Adet" => $row['adet'], 
					"Nereden" => $row['nereye'],
					"Çıkış Tarihi" => $row['cikis_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
		}
		exit;
	}
	}
	elseif($nereye != "" && $isim == "" && $kategori == "") {
			if($nereye == "tumu") {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

				try {  
				
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM outlist WHERE cikis_tarih >= ? AND cikis_tarih <= ? Order by nereye ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM outlist");
 					$STH->execute();
 					}
	
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['nereye']);}

				$a = array_unique($a);

				foreach($a as $b) {
					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
 					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? Order by isim ASC");
 					$STH2->execute(array($b));
 					}
					$f=array($b => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Kategori" => "", 
					"Çıkış Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";


				while($row = $STH2->fetch()) {  
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Kategori" => $row['kategori'],
					"Çıkış Tarihi" => $row['cikis_tarih'],
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
		$STH = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
		$STH->execute(array($nereye,$tarih1,$tarih2));
		}
 		else {
 		$STH = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? Order by isim ASC");
 		$STH->execute(array($nereye));
 		}

	}

	catch(PDOException $e) {
    	echo $e->getMessage();
	}
					$f=array($nereye => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Kategori" => "", 
					"Çıkış Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";


	while($row = $STH->fetch()) {

					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Kategori" => $row['kategori'],
					"Çıkış Tarihi" => $row['cikis_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
	}
	exit;
	}
	}
	elseif($kategori != "" && $isim != "" && $nereye != "") {
	$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

		
		
		try {  
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND isim = ? AND nereye = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$isim,$nereye,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND isim = ? AND nereye = ? Order by isim ASC");
 			$STH->execute(array($kategori,$isim,$nereye));
 			}
	
		}  

		catch(PDOException $e) {  
    		echo $e->getMessage();  
		}
					$f=array($kategori => "",	
					"İsim" => "", 
					"Adet" =>"" , 
					"Nereye" => "", 
					"Çıkış Tarihi" =>"",
					"Açıklama" =>"");
					
					echo implode("\t", array_keys($f)) . "\r\n";

			while($row = $STH->fetch()) {
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet'], 
					"Nereye" => $row['nereye'],
					"Çıkış Tarihi" => $row['cikis_tarih'],
					"Açıklama" => $row['aciklama']);
  
					echo implode("\t", array_values($g)) . "\r\n";
			}
			exit;
	
	
	
	
	}
	else {echo "Error0";}
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

	if($kategori != "" && $isim == "" && $nereye == "") {
		if($kategori == "tumu") {
		
				try {

 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM outlist WHERE cikis_tarih >= ? AND cikis_tarih <= ? Order by kategori ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM outlist");
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
					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? Order by isim ASC");
 					$STH2->execute(array($b));
 					}

					echo "<th>".htmlspecialchars($b, ENT_QUOTES). "</th>";
					echo "<th>İsim</th>";
					echo "<th>Adet</th>";
					echo "<th>Nereye</th>";
					echo "<th>Çıkış Tarihi</th>";
					echo "<th>Açıklama</th>";

				while($row = $STH2->fetch()) {  
		
						echo "<tr>";
						echo "<div>";
						echo "<td></td>";
    					echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['nereye'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['cikis_tarih'], ENT_QUOTES)."</td>";
						echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES)."</td>";
						echo "</div>";
						echo "</tr>";

					}
				}
		}
		else {
		try {  
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? Order by isim ASC");
 			$STH->execute(array($kategori));
 			}
	
		}  

		catch(PDOException $e) {  
    		echo $e->getMessage();  
		}

		echo "<th>".htmlspecialchars($kategori, ENT_QUOTES). "</th>";
		echo "<th>İsim</th>";
		echo "<th>Adet</th>";
		echo "<th>Nereye</th>";
		echo "<th>Çıkış Tarihi</th>";
		echo "<th>Açıklama</th>";

		while($row = $STH->fetch()) {
	
				echo "<tr>";
				echo "<div>";
				echo "<td></td>";
    			echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['nereye'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['cikis_tarih'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES). "</td>";
				echo "</div>";
				echo "</tr>";}
			}
	}
	elseif($isim != "" && $kategori == "" && $nereye == "") {
			if($isim == "tumu") {
	
				try {
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM outlist WHERE cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM outlist Order by isim ASC");
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
					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by kategori ASC");
					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? Order by kategori ASC");
 					$STH2->execute(array($b));
 					}

					echo "<th>".htmlspecialchars($b, ENT_QUOTES). "</th>";
					echo "<th>Kategori</th>";
					echo "<th>Adet</th>";
					echo "<th>Nereye</th>";
					echo "<th>Çıkış Tarihi</th>";
					echo "<th>Açıklama</th>";

				while($row = $STH2->fetch()) {  
		
						echo "<tr>";
						echo "<div>";
						echo "<td></td>";
    					echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['nereye'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['cikis_tarih'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES). "</td>";
						echo "</div>";
						echo "</tr>";

					}
				}
		}
		else {
	try {  
	
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by kategori ASC");
			$STH->execute(array($isim,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM outlist WHERE isim = ? Order by kategori ASC");
 			$STH->execute(array($isim));
 			}

	}  

	catch(PDOException $e) {  
    	echo $e->getMessage();  
	}

	echo "<th>".htmlspecialchars($isim, ENT_QUOTES). "</th>";
	echo "<th>Kategori</th>";
	echo "<th>Adet</th>";
	echo "<th>Nereye</th>";
	echo "<th>Çıkış Tarihi</th>";
	echo "<th>Açıklama</th>";

	while($row = $STH->fetch()) {

			echo "<tr>";
			echo "<div>";
			echo "<td></td>";
    		echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['nereye'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['cikis_tarih'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES). "</td>";
			echo "</div>";
			echo "</tr>";}
		}
	}
	elseif($nereye != "" && $isim == "" && $kategori == "") {
			if($nereye == "tumu") {

				try {  
				
 					if(check1($tarih1) && check1($tarih2)) {
 					$STH = $DBH->prepare("SELECT * FROM outlist WHERE cikis_tarih >= ? AND cikis_tarih <= ? Order by nereye ASC");
 					$STH->execute(array($tarih1,$tarih2));
 					}
 					else {
 					$STH = $DBH->prepare("SELECT * FROM outlist Order by nereye ASC");
 					$STH->execute();
 					}
	
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['nereye']);}

				$a = array_unique($a);

				foreach($a as $b) {

					if(check1($tarih1) && check1($tarih2)) {
					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
 					$STH2->execute(array($b,$tarih1,$tarih2));
					}
 					else {
 					$STH2 = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? Order by isim ASC");
 					$STH2->execute(array($b));
 					}

					echo "<th>".htmlspecialchars($b, ENT_QUOTES) ."</th>";
					echo "<th>İsim</th>";
					echo "<th>Adet</th>";
					echo "<th>Kategori</th>";
					echo "<th>Çıkış Tarihi</th>";
					echo "<th>Açıklama</th>";

				while($row = $STH2->fetch()) {  
		
						echo "<tr>";
						echo "<div>";
						echo "<td></td>";
    					echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['cikis_tarih'], ENT_QUOTES). "</td>";
						echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES). "</td>";
						echo "</div>";
						echo "</tr>";

					}
				}
		}
		else {
	try {  
	
		if(check1($tarih1) && check1($tarih2)) {
		$STH = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? AND cikis_tarih >= ? AND cikis_tarih <= ? Order by isim ASC");
		$STH->execute(array($nereye,$tarih1,$tarih2));
		}
 		else {
 		$STH = $DBH->prepare("SELECT * FROM outlist WHERE nereye = ? Order by isim ASC");
 		$STH->execute(array($nereye));
 		}

	}

	catch(PDOException $e) {
    	echo $e->getMessage();
	}

	echo "<th>".htmlspecialchars($nereye, ENT_QUOTES)."</th>";
	echo "<th>İsim</th>";
	echo "<th>Adet</th>";
	echo "<th>Kategori</th>";
	echo "<th>Çıkış Tarihi</th>";
	echo "<th>Açıklama</th>";

	while($row = $STH->fetch()) {

			echo "<tr>";
			echo "<div>";
			echo "<td></td>";
    		echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['cikis_tarih'], ENT_QUOTES). "</td>";
			echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES). "</td>";
			echo "</div>";
			echo "</tr>";}

	}
	}
	elseif($kategori != "" && $isim != "" && $nereye != "") {
	try {
			if(check1($tarih1) && check1($tarih2)) {
			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND isim = ? AND nereye = ? AND giris_tarih >= ? AND giris_tarih <= ? Order by isim ASC");
			$STH->execute(array($kategori,$isim,$nereye,$tarih1,$tarih2));
			}
 			else {
 			$STH = $DBH->prepare("SELECT * FROM outlist WHERE kategori = ? AND isim = ? AND nereye = ? Order by isim ASC");
 			$STH->execute(array($kategori,$isim,$nereye));
 			}
	
		}  

		catch(PDOException $e) {
    		echo $e->getMessage();  
		}

		echo "<th>".htmlspecialchars($kategori, ENT_QUOTES)."</th>";
		echo "<th>İsim</th>";
		echo "<th>Adet</th>";
		echo "<th>Nereye</th>";
		echo "<th>Çıkış Tarihi</th>";
		echo "<th>Açıklama</th>";

		while($row = $STH->fetch()) {
	
				echo "<tr>";
				echo "<div>";
				echo "<td></td>";
    			echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['nereye'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['cikis_tarih'], ENT_QUOTES). "</td>";
				echo "<td>".htmlspecialchars($row['aciklama'], ENT_QUOTES). "</td>";
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