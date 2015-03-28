<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

if(!empty($_SESSION['user'])) {

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

<div class="">
<div class="list-group">

<div class="col-md-4">
<a href="save.php" class="btn list-group-item" role="button">Kayıt Gir</a>
<a href="entryreport.php" class="btn list-group-item" role="button">Giriş Rapor</a>
<a href="edit_entry.php" class="btn list-group-item" role="button">Düzenle</a>

</div>

<div class="col-md-4">
<a href="specifications.php" class="btn list-group-item" role="button">Tanımlamalar</a>
<a href="inventoryreport.php" class="btn list-group-item" role="button">Envanter Rapor</a>
<a href="edit_inventory.php" class="btn list-group-item" role="button">Düzenle</a>

</div>

<div class="col-md-4">
<a href="out.php" class="btn list-group-item" role="button">Kayıt Çık</a>
<a href="sentreport.php" class="btn list-group-item" role="button">Çıkış Rapor</a>
<a href="edit_outlist.php" class="btn list-group-item" role="button">Düzenle</a>

</div>
</div>
</div>
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