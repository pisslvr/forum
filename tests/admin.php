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

$user_list = '';
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $user_list .= '<div class="card mb-2">';
        $user_list .= '<div class="card-body bg-dark">';
        $user_list .= '<h5 class="card-title bg-dark">'.$row['login'].'</h5>';
        $user_list .= '<p class="card-text bg-dark">'.$row['rola'].'</p>';
        $user_list .= '</div>';
        $user_list .= '</div>';
    }
} else {
    $user_list = '<p>Brak innych użytkowników.</p>';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>logowanie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/haneenmahd/perfect-scrollbar@master/scrollbar.css">
    <link rel="stylesheet" href="main.css">
</head>
<body class="bg-gradient-dark">
<?php
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
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-dark text-white">';
    echo '<a class="navbar-brand text-white" href="#">FORUM</a>';
    echo '<a href="admin1.php" class="navbar-brand text-white" data-toggle="tooltip" data-placement="bottom">PANEL</a>';
    echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<span class="navbar-toggler-icon"></span>';
    echo '</button>';
    echo '<div class="collapse navbar-collapse" id="navbarNav">';
    echo '<ul class="navbar-nav">';
    echo '<li class="nav-item active">';
    echo '<a class="nav-link text-white" href="#">Jesteś zalogowany - '.$_SESSION['login'].'<span class="sr-only">(current)</span></a>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
    echo '<a href="wyloguj.php" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom">Wyloguj</a>';
    echo '</button>';
    echo '</nav>';
}

mysqli_close($conn);
?>

<div class="container mt-3">
    <form action="post.php" method="post" id='post-box'>
        <div class="form-group">
            <textarea name="zawartosc" rows="2" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
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
    
    $query = "SELECT * FROM posts ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card mb-3 bg-dark text-white">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'.$row['autor'].'</h5>';
            echo '<p class="card-text">'.$row['zawartosc'].'</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Brak postów do wyświetlenia.</p>';
    }
    
    mysqli_close($conn);
    ?>
    <div class="card mt-3 bg-dark text-white">
        <div class="card-body bg-dark text-white">
            <h5 class="card-title bg-dark text-white">Inni użytkownicy:</h5>
            <?php echo $user_list; ?>
        </div>
    </div>
    