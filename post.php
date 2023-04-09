<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "panel";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$zawartosc = $_POST['zawartosc'];
$autor = $_SESSION['login'];
$sql = "INSERT INTO posts (zawartosc, data_utworzenia, autor) VALUES ('$zawartosc', NOW(), '$autor')";
if (mysqli_query($conn, $sql)) {
  if (isset($_SESSION['rola']) && $_SESSION['rola'] == 'admin') {
    header("Location: admin.php");
    exit();
  } else {
    header("Location: main.php");
    exit();
  }
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>