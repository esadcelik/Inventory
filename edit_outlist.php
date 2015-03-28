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
<script type="text/javascript" src="edit_outlist_ajax.js"></script>
<script type="text/javascript" src="edit.js"></script>
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
<b>Kayıt</b>
</br></br>

<form action="edit_record.php" method="POST" autocomplete="off">

Kategori
<select class="form-control" id="kategori" name="kategori">
	<option selected></option>

<?php

try {
	$STH = $DBH->prepare("SELECT kategori FROM outlist Order by kategori ASC");  
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
</select>
Kişi
<select class="form-control" id="kisi" name="kisi">
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

foreach($a as $b) {

echo "<option value='".htmlspecialchars($b, ENT_QUOTES)."'>".htmlspecialchars($b, ENT_QUOTES)."</option>";

}

?>

</select>
Adet
<select class="form-control" id="adet" name="adet">
	<option selected></option>
</select>
Tarih
<select class="form-control" id="tarih" name="tarih">
	<option selected></option>
</select>

<input class="btn btn-info btn-sm btn-block" role="button" id="outlist_d" type="submit" name="outlist_d" value="Sil">
<input class="btn btn-info btn-sm btn-block" role="button" id="outlist_e" type="submit" name="outlist_e" value="Düzenle">

</form>
<div id="info">
<?php

if(!empty($_SESSION['info2'])) {
	echo $_SESSION['info2'];
	unset($_SESSION['info2']);
}
?>

</div>
<a href="board.php" class="btn btn-info btn-sm " role="button">Ana Sayfa</a>

<?php

if(!empty($_SESSION['outlist'])) {
	echo $_SESSION['outlist'];
	unset($_SESSION['outlist']);
}
?>

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