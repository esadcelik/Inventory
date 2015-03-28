<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

if(isset($_SESSION['user'])) {

header("Location: board.php");
exit;
}


?>

<html>
<head>
<meta charset="UTF-8">
<link href="dist/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<body>
<div class="container">
</br></br>
<div class="list-group">

<div class="col-md-4"></div>

<div class="col-md-4">

<form action="loginhandler.php" method="POST" autocomplete="off">

<input class="form-control" placeholder="Kullanıcı İsmi" type="text" id="username" name="username">
<input class="form-control" placeholder="Şifre" type="password" id="password" name="password">

<input class="btn btn-info btn-sm btn-block" role="button" id="sub" type="submit" name="sub" value="Giriş Yap">
</form>
<div>
<?php
if(isset($_SESSION['pass'])) {
	echo $_SESSION['pass'];
	unset($_SESSION['pass']);
}
?>
</div>
</div>
<div class="col-md-4"></div>
</div>
</div>
<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>