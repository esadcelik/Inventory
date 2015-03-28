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
<script type="text/javascript" src="spec.js"></script>
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

<form action="edit_spec_handler.php" method="POST" autocomplete="off">

<?php

if(!empty($_GET['kategori'])) {

	$kategori = @$_GET['kategori'];

	echo '<input class="form-control" type="text" id="kategori" name="kategori" value="'.htmlspecialchars($kategori, ENT_QUOTES).'">';
	echo '<input class="btn btn-info btn-sm btn-block" role="button" id="sub0" type="submit" name="sub" value="Değiştir">';

}
elseif(!empty($_GET['isim'])) {

	$isim = @$_GET['isim'];

	echo '<input class="form-control" type="text" id="isim" name="isim" value="'.htmlspecialchars($isim, ENT_QUOTES).'">';
	echo '<input class="btn btn-info btn-sm btn-block" role="button" id="sub1" type="submit" name="sub" value="Değiştir">';

}
elseif(!empty($_GET['kisi'])) {

	$kisi = @$_GET['kisi'];

	echo '<input class="form-control" type="text" id="kisi" name="kisi" value="'.htmlspecialchars($kisi, ENT_QUOTES).'">';
	echo '<input class="btn btn-info btn-sm btn-block" role="button" id="sub2" type="submit" name="sub" value="Değiştir">';

}
else {echo "Error000";}

$_SESSION['kategori'] = @$_GET['kategori'];
$_SESSION['isim'] = @$_GET['isim'];
$_SESSION['kisi'] = @$_GET['kisi'];


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