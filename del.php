<?php
session_start();
if(!isset($_SESSION['login']))
{
    header(('location: admin.php'));
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

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $query = "DELETE FROM users WHERE login='".$login."'";
    mysqli_query($conn, $query);
}

mysqli_close($conn);

header('Location: admin.php');
exit();
?>