<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($host, $username, $password, $database);


if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login']) && isset($_POST['passwd'])){
	$login = mysqli_real_escape_string($conn, $_POST['login']);
	$passwd =md5(mysqli_real_escape_string($conn, $_POST['passwd']));

	$sql = "SELECT * FROM users WHERE login='$login' AND passwd='$passwd'";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		if ($row['login'] == $login && $row['passwd'] == $passwd) {
			session_start();
			$_SESSION['login'] = $login;
			$_SESSION['rola'] = $rola;
			if ($row['rola'] == 'admin') { 
				header("Location: admin.php"); 
			} else {
				header("Location: main.php"); 
			}
			exit();
		}
	}

	echo "zle dane";

}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/haneenmahd/perfect-scrollbar@master/scrollbar.css">
	<meta charset="utf-8">
	<title>logowanie</title>
    <link rel="stylesheet" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body>
	<div id="box">
	<h2>login</h2>
	<form action="index.php" method="post">
		<label>login:</label><br>
		<input type="text" name="login" required><br><br>
		<label>haslo:</label><br>
		<input type="password" name="passwd" required><br><br>
		<input type="submit" value="Login">
	</form>
	</div>
	<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "panel";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM posts ORDER BY data_utworzenia DESC";
$result = mysqli_query($conn, $sql);

echo "<div id='posts'>";
  while ($row = mysqli_fetch_assoc($result)) { 
echo "<div class='post'>";
echo "<div class='post-header'>";
echo "<div class='post-author'>";
echo $row['autor'];
echo "</div>";
echo "<div class='post-date'>";
echo $row['data_utworzenia'];
echo "</div>";
echo "</div>";
echo "<div class='post-body'>";
echo $row['zawartosc'];
echo "</div>";
echo "</div>";
}
echo "</div>";


mysqli_close($conn);
?>
</body>
</html>