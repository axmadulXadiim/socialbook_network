<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $commentId = $_GET['id'];
    $userId = $_SESSION['id'];

    // Vérifier si l'utilisateur a le droit de supprimer le commentaire (par exemple, vérifier s'il est l'auteur du commentaire)

    // Supprimer le commentaire de la base de données
    $deleteQuery = "DELETE FROM commentaires WHERE id = '$commentId' AND auteur_id = '$userId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // La suppression du commentaire a réussi
        echo "Commentaire supprimé avec succès.";
    } else {
        // La suppression du commentaire a échoué
        echo "Erreur lors de la suppression du commentaire.";
    }
}
?>
