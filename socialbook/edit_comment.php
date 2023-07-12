<?php
session_start();
include 'db.php';

if (isset($_GET['id_comment']) && isset($_POST['edited_content'])) {
    $commentId = $_GET['id_comment'];
    $editedContent = $_POST['edited_content'];

    // Vérifier si l'utilisateur a le droit de modifier le commentaire (par exemple, vérifier s'il est l'auteur du commentaire)

    // Mettre à jour le commentaire dans la base de données
    $updateQuery = "UPDATE commentaires SET contenu = '$editedContent' WHERE id = '$commentId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // La modification du commentaire a réussi
      header("Location:index.php");
  } else {
        // La modification du commentaire a échoué
    echo "Erreur lors de la modification du commentaire.";
}
}
?>
