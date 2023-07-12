<?php
session_start();

include 'db.php';

if(isset($_POST['post'])){
 $filename = $_FILES['image']['name'];
 $filetmp = $_FILES['image']['tmp_name'];
 $path = "images/". $filename;
 $content = $_POST['content'];
 $auteur = $_SESSION['id'];
 if (move_uploaded_file($filetmp, $path)) {
    $sql= "INSERT INTO publications(contenu, image,auteur_id) VALUES ('$content','$filename',$auteur) ";
    $result = mysqli_query($conn, $sql);
    header("location: index.php");
}
}

?>

