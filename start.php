<?php
$servername = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE panel";
if ($conn->query($sql) === TRUE) {
  echo "Utworzono pomyslnie";
  echo "<br>";
} else {
  echo "Blad: " . $conn->error;
  echo "<br>";
}
$q = (
    "USE `panel`;CREATE TABLE `users` (
    `uid` int(11) NOT NULL,
    `login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
    `passwd` varchar(255) COLLATE utf8_polish_ci NOT NULL,
    `rola` varchar(255) COLLATE utf8_polish_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
  
  
  
  INSERT INTO `users` (`uid`, `login`, `passwd`, `rola`) VALUES
  (1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin'),
  (2, 'user', '207023ccb44feb4d7dadca005ce29a64', 'user'),
  (3, 'moderator', 'ad148a3ca8bd0ef3b48c52454c493ec5', 'moderator');
  ALTER TABLE `users`
    ADD PRIMARY KEY (`uid`);
  ALTER TABLE `users`
    MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
  COMMIT;");

if ($conn->multi_query($q) === TRUE) {
    echo "Dodano tabele";
    echo "<br>";
  } else {
    echo "Blad: " . $conn->error;
    echo "<br>";
  }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/haneenmahd/perfect-scrollbar@master/scrollbar.css">
    <meta charset="utf-8">
    <title>logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br>
<a href="index.php">strona glowna</a>
</body>
</html>