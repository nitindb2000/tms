<?php include'db_connect.php' ?>
$id=$_GET['id'];

$article=$_POST['article'];
$description=$_POST['description'];

mysqli_query($conn,"update `new_article` set article='$article', description='$description' where userid='$id'");
header('location:index.php');
?>
