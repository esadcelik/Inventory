<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

if(!empty($_SESSION['user'])) {

include 'config.php';

if($_POST['entry_d']) {

	$id = @$_POST['tarih'];

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
									   $row['giris_tarih']." [Silindi] "."] -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 
	}

	try {

		$STH = $DBH->prepare("DELETE FROM entry WHERE id = ?");
		$STH->execute(array($id));

	}
		catch(PDOException $e) {  
    	echo $e->getMessage();
	}
$_SESSION['entry']="Silindi";
header("Location: edit_entry.php"); exit();

}
if($_POST['stock_d']) {

	$id = @$_POST['adet'];

	$date = date_default_timezone_set("Asia/Istanbul");
	$date = date('Y-m-d');

	$STH = $DBH->prepare("SELECT * FROM stock WHERE id = ?"); 
	$STH->execute(array($id));

	while($row = $STH->fetch()) {
		$file = "log.txt"; 
		$handle = fopen($file, 'a');
		$data = "[".$_SESSION['user']."][Envanter] -> ".$row['kategori'].", ".
									   $row['isim'].", ".
									   $row['adet']." [Silindi] "."] -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 
	}

	try {

		$STH = $DBH->prepare("DELETE FROM stock WHERE id = ?");
		$STH->execute(array($id));

	}
		catch(PDOException $e) {  
    	echo $e->getMessage();
	}
$_SESSION['stock']="Silindi";
header("Location: edit_inventory.php"); exit();

}
if($_POST['outlist_d']) {

	$id = @$_POST['tarih'];

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
									   $row['cikis_tarih']." [Silindi] "."] -> [".$date."]"."\n"; 
		fwrite($handle, $data);
		fclose($handle); 
	}

	try {

		$STH = $DBH->prepare("DELETE FROM outlist WHERE id = ?");
		$STH->execute(array($id));

	}
		catch(PDOException $e) {  
    	echo $e->getMessage();
	}

$_SESSION['outlist']="Silindi";
header("Location: edit_outlist.php"); exit();

}
?>

<html>
<head>
<meta charset="UTF-8">
<link href="dist/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="edit_record.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=""><?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES);?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right"><li><a href="logout.php">Çıkış Yap</a></li></ul>
    </div>
  </div>
</nav>
<div class="container">
<div class="list-group">

<div class="col-md-4"></div>
<div class="col-md-4">
</br>
</br></br>

<form action="edit_record_handler.php" method="POST" autocomplete="off">

<?php




if($_POST['entry_e']) {

	$id = @$_POST['tarih'];

	try {
		$STH = $DBH->prepare("SELECT * FROM entry WHERE id = ?");  
		$STH->execute(array($id));
		while($row = $STH->fetch()) {
		
			$kategori = @$row['kategori'];
			$isim = @$row['isim'];
			$adet = @$row['adet'];
			$nereden = @$row['nereden'];

			
			
				$STH1 = $DBH->prepare("SELECT kategori FROM specifications");  
				$STH1->execute(); 	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['kategori']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($kategori));
				echo '<select class="form-control" id="kategori" name="kategori">
				<option value="'.htmlspecialchars($kategori, ENT_QUOTES).'" selected>'.htmlspecialchars($kategori, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}
			echo '</select>';
			
				$STH1 = $DBH->prepare("SELECT isim FROM specifications WHERE kategori = ?");  
				$STH1->execute(array($kategori));	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['isim']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($isim));
				echo '<select class="form-control" id="isim" name="isim">
				<option value="'.htmlspecialchars($isim, ENT_QUOTES).'" selected>'.htmlspecialchars($isim, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}

			
			
			echo '</select>';

				$STH1 = $DBH->prepare("SELECT person FROM person");  
				$STH1->execute();
				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['person']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($nereden));
				echo '<select class="form-control" id="nereden" name="nereden">
				<option value="'.htmlspecialchars($nereden, ENT_QUOTES).'" selected>'.htmlspecialchars($nereden, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}
			echo '</select>';
			echo '<input class="form-control1" type="text" id="adet" name="adet" value="'.htmlspecialchars($adet, ENT_QUOTES).'">';
			
				$STH1 = $DBH->prepare("SELECT giris_tarih FROM entry WHERE id = ?");  
				$STH1->execute(array($id)); 	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
			echo '<input class="form-control" type="text" id="tarih" name="tarih" value="'.htmlspecialchars($row2['giris_tarih'], ENT_QUOTES).'">';
		
					}

			echo '<input class="hidden" id="id" name="id" value="'.htmlspecialchars($id, ENT_QUOTES).'">';

			echo '<input class="btn btn-info btn-sm btn-block" role="button" id="entry" type="submit" name="entry" value="Değiştir">';

		
		
		}

		
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}




}
if($_POST['stock_e']) {

	$id = @$_POST['adet'];

	try {
		$STH = $DBH->prepare("SELECT * FROM stock WHERE id = ?");  
		$STH->execute(array($id));	

		while($row = $STH->fetch()) {
		
			$kategori = @$row['kategori'];
			$isim = @$row['isim'];

				$STH1 = $DBH->prepare("SELECT kategori FROM specifications");  
				$STH1->execute(); 	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['kategori']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($kategori));
				echo '<select class="form-control" id="kategori" name="kategori">
				<option value="'.htmlspecialchars($kategori, ENT_QUOTES).'" selected>'.htmlspecialchars($kategori, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}
			echo '</select>';
			
				$STH1 = $DBH->prepare("SELECT isim FROM specifications WHERE kategori = ?");  
				$STH1->execute(array($kategori));	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['isim']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($isim));
				echo '<select class="form-control" id="isim" name="isim">
				<option value="'.htmlspecialchars($isim, ENT_QUOTES).'" selected>'.htmlspecialchars($isim, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}

			
			
			
				$STH1 = $DBH->prepare("SELECT adet FROM stock WHERE id = ?");  
				$STH1->execute(array($id));

				$b= array();

				while($row2 = $STH1->fetch()) {
	
			echo '<input class="form-control1" type="text" id="adet" name="adet" value="'.htmlspecialchars($row2['adet'], ENT_QUOTES).'">';
		
					}

			echo '<input class="hidden" id="id" name="id" value="'.htmlspecialchars($id, ENT_QUOTES).'">';
			echo '<input class="btn btn-info btn-sm btn-block" role="button" id="stock" type="submit" name="stock" value="Değiştir">';

		
		
		}

		
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

}
if($_POST['outlist_e']) {

	$id = @$_POST['tarih'];

	try {
		$STH = $DBH->prepare("SELECT * FROM outlist WHERE id = ?");  
		$STH->execute(array($id));

		while($row = $STH->fetch()) {
		
			$kategori = @$row['kategori'];
			$isim = @$row['isim'];
			$adet = @$row['adet'];
			$nereye = @$row['nereye'];

			echo $nereye;
				$STH1 = $DBH->prepare("SELECT kategori FROM specifications");  
				$STH1->execute();
 	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['kategori']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($kategori));
				echo '<select class="form-control" id="kategori" name="kategori">
				<option value="'.htmlspecialchars($kategori, ENT_QUOTES).'" selected>'.htmlspecialchars($kategori, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}
			echo '</select>';
				$STH1 = $DBH->prepare("SELECT isim FROM specifications WHERE kategori = ?");  
				$STH1->execute(array($kategori));	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['isim']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($isim));
				echo '<select class="form-control" id="isim" name="isim">
				<option value="'.htmlspecialchars($isim, ENT_QUOTES).'" selected>'.htmlspecialchars($isim, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}

			echo '</select>';

				$STH1 = $DBH->prepare("SELECT person FROM person");  
				$STH1->execute(); 	

				$b= array();

				while($row2 = $STH1->fetch()) {
	
  				  	array_push($b, $row2['person']);
		
					}

				$b = array_unique($b);
				$b = array_diff($b, array($nereye));
				echo '<select class="form-control" id="nereye" name="nereye">
				<option value="'.htmlspecialchars($nereye, ENT_QUOTES).'" selected>'.htmlspecialchars($nereye, ENT_QUOTES).'</option>';
				
				foreach($b as $c) {
	
					echo "<option value='".htmlspecialchars($c, ENT_QUOTES)."'>".htmlspecialchars($c, ENT_QUOTES)."</option>";
			
				}
			echo '</select>';

			echo '<input class="form-control1" type="text" id="adet" name="adet" value="'.htmlspecialchars($adet, ENT_QUOTES).'">';
			
				$STH1 = $DBH->prepare("SELECT cikis_tarih FROM outlist WHERE id = ?");  
				$STH1->execute(array($id));

				$b= array();

				while($row2 = $STH1->fetch()) {
	
			echo '<input class="form-control" type="text" id="tarih" name="tarih" value="'.htmlspecialchars($row2['cikis_tarih'], ENT_QUOTES).'">';

					}

			echo '<input class="hidden" id="id" name="id" value="'.htmlspecialchars($id, ENT_QUOTES).'">';			
			echo '<input class="btn btn-info btn-sm btn-block" role="button" id="outlist" type="submit" name="outlist" value="Değiştir">';

		}

		
		}
	catch(PDOException $e) {
    	echo $e->getMessage();  
		}

}

?>
</form>
<a href="board.php" class="btn btn-info btn-sm " role="button">Ana Sayfa</a>

</div>
<div class="col-md-4"></div>


</div>
</div>
<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php

}
else {

header("Location: index.php");
exit;


}
?>