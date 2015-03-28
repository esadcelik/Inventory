<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

include 'config.php';

$username = @$_POST['username'];
$password = @$_POST['password'];

try {

	$STH = $DBH->prepare("SELECT username, password FROM users WHERE username = ?");
	$STH->execute(array($username));

	$resultdata = $STH->fetch();

	if (($resultdata[username] == $username) && ($resultdata[password] == $password)) {
		header("Location: board.php");
		$_SESSION['user'] = @$username;
		
			$date = date_default_timezone_set("Asia/Istanbul");
			$date = date('Y-m-d H:i:s');
		

			$file = "user_log.txt"; 
			$handle = fopen($file, 'a');
			$data = "[".$_SESSION['user']."] [".$date."]-> Giriş Yaptı"."\n"; 
			fwrite($handle, $data);
			fclose($handle);
		exit;

	}
	else {
		$_SESSION['pass']="Kullanıcı adı veya şifre yanlış, tekrar deneyin";
		header("Location: index.php" );
		exit;
	}

}  

catch(PDOException $e) {  
    echo $e->getMessage();  
}

?>