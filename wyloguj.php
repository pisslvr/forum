<?php
    session_start();
    if (isset($_SESSION['logowanie'])){
        unset($_SESSION['logowanie']);
    }
    else{
        header('location: index.php');
        exit();
    }
    session_destroy()
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>wylogowano</h1><br>
<a href="index.php">powrot do logowania</a>
</body>
</html>