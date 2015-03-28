<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

if(!empty($_SESSION['user'])) {

include 'config.php';

$kategori = @$_POST['kategori'];
$isim = @$_POST['isim'];

if($_POST['exel']) {

if($kategori != "" && $isim == "") {
		if($kategori == "tumu") {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");
		
				try {

					$STH = $DBH->prepare("SELECT kategori,isim FROM stock Order by kategori ASC");
					$STH->execute();
				}  

				catch(PDOException $e) {
				    echo $e->getMessage();
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['kategori']);}

				$a = array_unique($a);
				$a = array_filter($a);

				foreach($a as $b) {

					$STH2 = $DBH->prepare("SELECT * FROM stock WHERE kategori = ? Order by isim ASC");
					$STH2->execute(array($b));
					if($STH2->rowCount()==0){continue;}
					$f=array($b => "",	
					"İsim" => "", 
					"Adet" =>"" );
					
					echo implode("\t", array_keys($f)) . "\r\n";

				while($row = $STH2->fetch()) {  
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet']);
  				
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
 			
			$STH = $DBH->prepare("SELECT * FROM stock WHERE kategori = ? Order by isim ASC");  
			$STH->execute(array($kategori));	
		}  

		catch(PDOException $e) {  
    		echo $e->getMessage();  
		}

					$f=array($kategori => "",	
					"İsim" => "", 
					"Adet" =>"" );
					
					echo implode("\t", array_keys($f)) . "\r\n";

		while($row = $STH->fetch()) {  
		
					$g=array($kategori => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet']);
  				
					echo implode("\t", array_values($g)) . "\r\n";

	}
exit;
				}
	}
elseif($isim != "" && $kategori == "") {
			if($isim == "tumu") {
  				$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

				try {
 					
					$STH = $DBH->prepare("SELECT kategori,isim FROM stock Order by isim ASC");  
					$STH->execute();
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['isim']);}

				$a = array_unique($a);
				$a = array_filter($a);

				foreach($a as $b) {

					$STH2 = $DBH->prepare("SELECT * FROM stock WHERE isim = ? Order by kategori ASC"); 
					$STH2->execute(array($b)); 

					if($STH2->rowCount()==0){continue;}

					$f=array($b => "",	
					"Kategori" => "", 
					"Adet" =>"" );
					
					echo implode("\t", array_keys($f)) . "\r\n";

				while($row = $STH2->fetch()) {  
		
					$g=array($b => " ",	
					"Kategori" => $row['kategori'], 
					"Adet" => $row['adet']);
  				
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
		
		$STH = $DBH->prepare("SELECT * FROM stock WHERE isim = ? Order by kategori ASC");  
		$STH->execute(array($isim));
	}  

	catch(PDOException $e) {  
    	echo $e->getMessage();  
	}

					$f=array($isim => "",	
					"Kategori" => "", 
					"Adet" =>"" );
					
					echo implode("\t", array_keys($f)) . "\r\n";

	while($row = $STH->fetch()) {  
		
					$g=array($isim => " ",	
					"Kategori" => $row['kategori'], 
					"Adet" => $row['adet']);
  				
					echo implode("\t", array_values($g)) . "\r\n";

	}
	
	exit;
	
	}
	}
		elseif($kategori != "" && $isim != "") {
	$filename = "website_data.xls";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Type: text/plain");

		
		
		try {  
			
 			$STH = $DBH->prepare("SELECT * FROM stock WHERE kategori = ? AND isim = ? Order by isim ASC");
 			$STH->execute(array($kategori,$isim));
 			
	
		}  

		catch(PDOException $e) {  
    		echo $e->getMessage();  
		}
					$f=array($kategori => "",	
					"İsim" => "", 
					"Adet" =>"" );
					
					echo implode("\t", array_keys($f)) . "\r\n";

			while($row = $STH->fetch()) {
					$g=array($b => " ",	
					"İsim" => $row['isim'], 
					"Adet" => $row['adet']);
  
					echo implode("\t", array_values($g)) . "\r\n";
			}
			exit;

	}
	else {echo "Error";}
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

if($kategori != "" && $isim == "") {
		if($kategori == "tumu") {
		
				try {

					$STH = $DBH->prepare("SELECT kategori,isim FROM stock Order by kategori ASC");
					$STH->execute();
				}  

				catch(PDOException $e) {
				    echo $e->getMessage();
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['kategori']);}

				$a = array_unique($a);
				$a = array_filter($a);

				foreach($a as $b) {

					$STH2 = $DBH->prepare("SELECT * FROM stock WHERE kategori = ? Order by isim ASC");
					$STH2->execute(array($b));

					if($STH2->rowCount()==0){continue;}
					echo "<th>".htmlspecialchars($b, ENT_QUOTES). "</th>";
					echo "<th>İsim</th>";
					echo "<th>Adet</th>";

				while($row = $STH2->fetch()) {  
		
		echo "<tr>";
		echo "<div>";
		echo "<td></td>";
    	echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
		echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
		echo "</div>";
		echo "</tr>";

	}

				}
		}
		else {
		try {  
 			
			$STH = $DBH->prepare("SELECT * FROM stock WHERE kategori = ? Order by isim ASC");  
			$STH->execute(array($kategori));	
		}  

		catch(PDOException $e) {  
    		echo $e->getMessage();  
		}

		echo "<th>".htmlspecialchars($kategori, ENT_QUOTES). "</th>";
		echo "<th>İsim</th>";
		echo "<th>Adet</th>";

		while($row = $STH->fetch()) {  
		
		echo "<tr>";
		echo "<div>";
		echo "<td></td>";
    	echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
		echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
		echo "</div>";
		echo "</tr>";

	}

				}
	}
elseif($isim != "" && $kategori == "") {
			if($isim == "tumu") {
	
				try {
 					
					$STH = $DBH->prepare("SELECT kategori,isim FROM stock Order by isim ASC");  
					$STH->execute();
				}  

				catch(PDOException $e) {  
				    echo $e->getMessage();  
				}

				$a= array();

				while($row = $STH->fetch()) {array_push($a, $row['isim']);}

				$a = array_unique($a);
				$a = array_filter($a);

				foreach($a as $b) {

					$STH2 = $DBH->prepare("SELECT * FROM stock WHERE isim = ? Order by kategori ASC"); 
					$STH2->execute(array($b)); 

					if($STH2->rowCount()==0){continue;}
					echo "<th>".htmlspecialchars($b, ENT_QUOTES)."</th>";
					echo "<th>Kategori</th>";
					echo "<th>Adet</th>";

				while($row = $STH2->fetch()) {  
		
		echo "<tr>";
		echo "<div>";
		echo "<td></td>";
    	echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES)."</td>";
		echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
		echo "</div>";
		echo "</tr>";

	}
				}
		}
		else {
	try {  
		
		$STH = $DBH->prepare("SELECT * FROM stock WHERE isim = ? Order by kategori ASC");  
		$STH->execute(array($isim));
	}  

	catch(PDOException $e) {  
    	echo $e->getMessage();  
	}

	echo "<th>".htmlspecialchars($isim, ENT_QUOTES)."</th>";
	echo "<th>Kategori</th>";
	echo "<th>Adet</th>";

	while($row = $STH->fetch()) {  
		
		echo "<tr>";
		echo "<div>";
		echo "<td></td>";
    	echo "<td>".htmlspecialchars($row['kategori'], ENT_QUOTES)."</td>";
		echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
		echo "</div>";
		echo "</tr>";

	}
	}
	}
	elseif($kategori != "" && $isim != "") {
	try {
			
 			$STH = $DBH->prepare("SELECT * FROM stock WHERE kategori = ? AND isim = ? Order by isim ASC");
 			$STH->execute(array($kategori,$isim));
 
	
		}  

		catch(PDOException $e) {
    		echo $e->getMessage();  
		}

		echo "<th>".htmlspecialchars($kategori, ENT_QUOTES)."</th>";
		echo "<th>İsim</th>";
		echo "<th>Adet</th>";

		while($row = $STH->fetch()) {
	
				echo "<tr>";
				echo "<div>";
				echo "<td></td>";
    			echo "<td>".htmlspecialchars($row['isim'], ENT_QUOTES)."</td>";
				echo "<td>".htmlspecialchars($row['adet'], ENT_QUOTES)."</td>";
				echo "</div>";
				echo "</tr>";}
			}
	else {echo "Error";}

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