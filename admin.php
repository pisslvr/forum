<?php
session_start();
if(!isset($_SESSION['login']))
{
    header(('location: index1.php'));
    exit();
}

$host = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM users WHERE login != '".$_SESSION['login']."'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h1>";
    echo "Jesteś zalogowany - ".$_SESSION['login']."<br><br>";
    echo "</h1>";
    echo "<p>";
    echo "Inni użytkownicy:<br>";
    echo "</p>";
    echo "<div class='user-list'>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='user'>";
        echo "<div class='login'>".$row['login']."</div>";
        echo "<div class='role'>".$row['rola']."</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "Brak innych użytkowników.";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/haneenmahd/perfect-scrollbar@master/scrollbar.css">
    <meta charset="utf-8">
    <title>logowanie</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<form action="add.php" method="POST">
	<table id='logins'>
		<tr><td>login<td><input type="text" name="login"></td></tr>
		<tr><td>haslo<td><input type="password" name="passwd" required></td></tr>
		<tr><td>potwierdz haslo<td><input type="password" name="passwd2" required></td></tr>
		<tr><td>rola<td><select name="rola">
			<option value="admin">admin</option>
			<option value="moderator">mod</option>
			<option value="user">user</option>
		</select></td></tr>
		<tr><td colspan="2" style="text-align: center;"><input type="submit" value="dodaj"></td></tr>
	</table>
	</form>
	<form action="post.php" method="post">
		<textarea name="zawartosc" rows="1" cols="10"></textarea>
		<input type="submit" value="Post">
	</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "panel";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$autor = $_SESSION['login'];
$sql = "SELECT * FROM posts WHERE autor ='$autor'ORDER BY data_utworzenia DESC";
$result = mysqli_query($conn, $sql);
echo "<table id='posts'>";
echo "  <thead>";
echo "  </thead>";
echo "  <tbody>";
     while ($row = mysqli_fetch_assoc($result)) { 
		echo "<tr>";
		echo "<td>";
		echo $row['autor'];
		echo "</td>";
		echo "<td>";
		echo $row['zawartosc'];
		echo "</td>";
		echo "<td>";
		echo $row['data_utworzenia'];
		echo "</td>";
		echo " </tr>";
    } 
	echo "  </tbody>";
	echo "</table>";


mysqli_close($conn);
?>

<a href="wyloguj.php">Wyloguj</a>
</body>
</html>