<?php
session_start();
include 'db.php';

if (isset($_POST['comment']) && isset($_GET['id_post'])) {
	$content = $_POST['content'];
	$post_id = $_GET['id_post'];
	$user_id = $_SESSION['id'];
	$sql = "INSERT INTO commentaires(contenu, auteur_id, publication_id) VALUES ('$content', $user_id, $post_id )";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		header("Location: index.php?id_post=$post_id");
		exit();
	}
}
?>


