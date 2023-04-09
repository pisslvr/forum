<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "panel";


$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
	if (isset($_POST['login']))
	{
		$l   = $_POST['login'];
		$p   = $_POST['passwd'];
		$p2	 = $_POST['passwd2'];
		if($p != $p2) die('<script type="text/javascript">alert("hasla sie nie zgadzaja");location.replace("admin.php")</script>');
        $hp  = md5($p);
		$r   = $_POST['rola'];
		$q2 = "INSERT INTO users(login, passwd, rola) VALUES ('$l', '$hp', '$r')";
		$conn->query($q2);
	}
	header('location:main.php');
?>