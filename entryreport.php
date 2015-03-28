<?php

header('Content-Type: text/html; charset=utf-8');

session_start();

if(!empty($_SESSION['user'])) {

include 'config.php';

?>

<html>
<head>
<meta charset="UTF-8">
<link href="dist/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="report.js"></script>


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
</br>
<div class="list-group">

<div class="col-md-4"></div>

<div class="col-md-4">

<form action="reporthandler.php" method="POST" autocomplete="off">
Kategori
<select class="form-control" id="kategori" name="kategori">
	<option selected></option>
	<option value="tumu">(Tümü)</option>

<?php

try {
	$STH = $DBH->prepare('SELECT kategori FROM entry Order by kategori ASC');  
	$STH->execute();
}
catch(PDOException $e) {
    echo $e->getMessage();  
}

$a= array();

while($row = $STH->fetch()) {

    	array_push($a, $row['kategori']);
		
	}

$a = array_unique($a);

foreach($a as $b) {

echo "<option value='".htmlspecialchars($b, ENT_QUOTES)."'>".htmlspecialchars($b, ENT_QUOTES)."</option>";

}

?>

</select>
İsim
<select class="form-control" id="isim" name="isim">
	<option selected></option>
	<option value="tumu">(Tümü)</option>
<?php

try {
	$STH = $DBH->prepare("SELECT isim FROM entry Order by isim ASC");
	$STH->execute();
}
catch(PDOException $e) {
    echo $e->getMessage();  
}

$a= array();

while($row = $STH->fetch()) {

    	array_push($a, $row['isim']);
		
	}

$a = array_unique($a);

$a = array_filter($a);

foreach($a as $b) {

echo "<option value='".htmlspecialchars($b, ENT_QUOTES)."'>".htmlspecialchars($b, ENT_QUOTES)."</option>";

}

?>

</select>
Nereden
<select class="form-control" id="nereden" name="nereden">
	<option selected></option>
	<option value="tumu">(Tümü)</option>

<?php

try {
	$STH = $DBH->prepare("SELECT nereden FROM entry Order by nereden ASC");
	$STH->execute();
}
catch(PDOException $e) {
    echo $e->getMessage();  
}

$a= array();

while($row = $STH->fetch()) {

    	array_push($a, $row['nereden']);

	}

$a = array_unique($a);

foreach($a as $b) {

echo "<option value='".htmlspecialchars($b, ENT_QUOTES)."'>".htmlspecialchars($b, ENT_QUOTES)."</option>";

}

?>

</select>
</br>
Tarih Aralığı:

<div class="list-group">
<div class="col-md-6">

<input class="form-control" placeholder="Başlangıç" type="text" id="tarih1" name="tarih1" value="">
</div>

<div class="col-md-6">

<input class="form-control" placeholder="Bitiş" type="text" id="tarih2" name="tarih2" value="">
</br>
</div>
</div>

<input class="btn btn-info btn-sm btn-block" role="button" id="sub" type="submit" name="sub" text="Kaydet" value="Raporla">
<input class="btn btn-info btn-sm btn-block" role="button" id="exel" type="submit" name="exel" text="Kaydet" value="Exel Çıktısı">

</form>
<a href="board.php" class="btn btn-info btn-sm " role="button">Ana Sayfa</a>
<div id="info"></div>
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