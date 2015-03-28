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
<script type="text/javascript" src="list.js"></script>
<script type="text/javascript" src="list1.js"></script>
<script type="text/javascript" src="list2.js"></script>
<script type="text/javascript" src="control000.js"></script>
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
<div class="col-md-2"></div>
<div class="col-md-4">
<div>
<b>Tanımlama</b>
</br></br>
Kategori Tanımla
<form action="specificationhandler1.php" method="POST" autocomplete="off">
<input class="form-control" placeholder="Kategori" type="text" id="kategori1" name="kategori1">
<input class="btn btn-info btn-sm btn-block" id="klm0" type="submit" name="sub" value="Kaydet">
</form>
<?php
if(!empty($_SESSION['kategori0'])) {
	echo $_SESSION['kategori0'];
	unset($_SESSION['kategori0']);
}
?>
</div>
</br></br>

İsim Tanımla
<div>
<form action="specificationhandler.php" method="POST" autocomplete="off">
<select class="form-control2" id="kategori" name="kategori">
	<option selected></option>

	<?php

try {
	$STH = $DBH->prepare("SELECT kategori FROM specifications Order by kategori ASC");  
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
<input class="form-control" placeholder="İsim" type="text" id="isim" name="isim">
<input class="btn btn-info btn-sm btn-block" id="klm1" type="submit" name="Kaydet" value="Kaydet">
</form>
<?php
if(!empty($_SESSION['isim'])) {
	echo $_SESSION['isim'];
	unset($_SESSION['isim']);
}
?>
</div>
</br></br>


<div>
Kişi/Yer Tanımla
<form action="specificationhandler2.php" method="POST" autocomplete="off">
<input class="form-control" placeholder="Kişi" type="text" id="kisi" name="kisi">
<input class="btn btn-info btn-sm btn-block" id="klm2" type="submit" name="sub" value="Kaydet">
</form>
<?php
if(!empty($_SESSION['kisi'])) {
	echo $_SESSION['kisi'];
	unset($_SESSION['kisi']);
}
?>
</div>
<a href="board.php" class="btn btn-info btn-sm " role="button">Ana Sayfa</a>
</div>
<div class="col-md-4">
<b>Düzenle</b>
</br></br>



<form action="edithandler.php" method="POST" autocomplete="off">
Kategori
<select class="form-control" id="kategori2" name="kategori2">
	<option selected></option>

<?php

try {
	$STH = $DBH->prepare("SELECT kategori FROM specifications Order by kategori ASC");
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
</br>
İsim
<select class="form-control" id="isim2" name="isim2">
	<option selected></option>
<?php

try {
	$STH = $DBH->prepare("SELECT isim FROM specifications Order by isim ASC");
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
</br>
Kişi/Yer
<select class="form-control" id="kisi2" name="kisi2">
	<option selected></option>

<?php

try {
	$STH = $DBH->prepare("SELECT person FROM person Order by person ASC");  
	$STH->execute(); 
}
catch(PDOException $e) {
    echo $e->getMessage();  
}

$a= array();

while($row = $STH->fetch()) {

    	array_push($a, $row['person']);
		
	}

$a = array_unique($a);
$a = array_filter($a);

foreach($a as $b) {

echo "<option value='".htmlspecialchars($b, ENT_QUOTES)."'>".htmlspecialchars($b, ENT_QUOTES)."</option>";

}

?>

</select>
</br>

<input class="btn btn-info btn-sm btn-block" role="button" id="sub0" type="submit" name="sub0" value="Bağlantılı Tüm Kayıtları Sil">
<input class="btn btn-info btn-sm btn-block" role="button" id="sub1" type="submit" name="sub1" value="Sadece Tanımlamalardan Sil">
<input class="btn btn-info btn-sm btn-block" role="button" id="sub2" type="submit" name="sub2" value="Düzenle">

</form>

<div id="info">
<?php

if(!empty($_SESSION['info1'])) {
	echo $_SESSION['info1'];
	unset($_SESSION['info1']);
}
?>

</div>
</div>
</div>
<div class="col-md-2" id="list"></div>

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