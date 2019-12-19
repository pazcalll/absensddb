
<?php
	$host	 = "127.0.0.1";
	$user	 = "root";
	$pass	 = "";
	$dabname = "absensddb";
	
	$foldername="absensddb";
	$conn = mysqli_connect( $host, $user, $pass) or die('Could not connect to mysql server.' );
	mysqli_select_db($conn, $dabname) or die('Could not select database.');
	$baseurl="http://localhost/myapp/".$foldername."/";
	
	$nama_usaha="SD DITOTRUNAN 01";
	$nama_aplikasi="APLIKASI ABSENSI BERBASIS WEB";
	$path_web=$_SERVER['DOCUMENT_ROOT']."/".$foldername."/";
	$label_footer="Copyright &copy; XXX ".date("Y");
?>