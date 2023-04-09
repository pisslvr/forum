<?php
session_start();

if(!isset($_SESSION['login']))
{
    header(('location: main.php'));
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post_id = $_POST['id'];
  $new_zawartosc = $_POST['zawartosc'];
  
  $query = "UPDATE posts SET zawartosc='$new_zawartosc' WHERE id='$post_id'";
  mysqli_query($conn, $query);
  
  header("Location: main.php"); 
  exit();
} else {
  $post_id = $_GET['id'];
  
  $query = "SELECT * FROM posts WHERE id='$post_id'";
  $result = mysqli_query($conn, $query);
  
  if (mysqli_num_rows($result) == 0) {
    echo "Post not found!";
    exit();
  }
  
  $row = mysqli_fetch_assoc($result);
  
  if ($row['autor'] != $_SESSION['login']) {
    echo "Nie masz pozwoleń!";
    exit();
  }
  
  $zawartosc = $row['zawartosc'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit post</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
  <form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $post_id ?>">
    <textarea name="zawartosc" rows="5" cols="50"><?php echo $zawartosc ?></textarea>
    <br>
    <input type="submit" value="Save">
  </form>
</body>
</html>
