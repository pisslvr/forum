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
    echo "<div id='box'>";
	echo "<h1>";
    echo "Jesteś zalogowany - ".$_SESSION['login']."<br><br>";
    echo "</h1>";
   	echo "<div class='user-list'>";
	echo "<div class='info'>";
    echo "Inni użytkownicy:<br>"."</div>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='user'>";
        echo "<div class='login'>".$row['login']."</div>";
        echo "<div class='role'>".$row['rola']."</div>";
        echo "</div>";
    }
    echo "</div>";
	echo "</div>";
} else {
    echo "Brak innych użytkowników.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>logowanie</title>
    <link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/haneenmahd/perfect-scrollbar@master/scrollbar.css">

</head>
<body>
    <form action="post.php" method="post" id='post-box'>
        <textarea name="zawartosc" rows="2" cols="183"></textarea>
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
echo "<div class='post-edit'>";
echo "<a href=edit.php?id=$row[id]>edycja</a>";
echo "</div>";
echo "</div>";
}
echo "</div>";
mysqli_close($conn);
?>

<a href="wyloguj.php" id="logout">Wyloguj</a>
</body>
</html>
