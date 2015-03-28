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
<script type="text/javascript" src="edit.js"></script>
<script type="text/javascript" src="edit_entry_ajax.js"></script>
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
<?php

try {
	$STH = $DBH->prepare("SELECT kategori FROM entry Order by kategori ASC"); 
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
echo '	<option selected></option>';
foreach($a as $b) {

echo "<option value='".htmlspecialchars($b, ENT_QUOTES)."'>".htmlspecialchars($b, ENT_QUOTES)."</option>";

}

?>

</select>
İsim
<select class="form-control" id="isim" name="isim"></select>
Kişi
<select class="form-control" id="kisi" name="kisi"></select>
Adet
<select class="form-control" id="adet" name="adet"></select>
Tarih
<select class="form-control" id="tarih" name="tarih"></select>

<input class="btn btn-info btn-sm btn-block" role="button" id="entry_d" type="submit" name="entry_d" value="Sil">
<input class="btn btn-info btn-sm btn-block" role="button" id="entry_e" type="submit" name="entry_e" value="Düzenle">

</form>

<a href="board.php" class="btn btn-info btn-sm " role="button">Ana Sayfa</a>

<?php

if(!empty($_SESSION['entry'])) {
	echo $_SESSION['entry'];
	unset($_SESSION['entry']);
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