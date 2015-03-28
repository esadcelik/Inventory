<?php

session_start();

			$date = date_default_timezone_set("Asia/Istanbul");
			$date = date('Y-m-d H:i:s');
		

			$file = "user_log.txt"; 
			$handle = fopen($file, 'a');
			$data = "[".$_SESSION['user']."] [".$date."]-> Çıkış Yapıldı"."\n"; 
			fwrite($handle, $data);
			fclose($handle);

unset($_SESSION['user']);

header("Location: index.php");

exit;

?>