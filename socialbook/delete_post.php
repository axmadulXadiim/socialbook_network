<?php
session_start();
include 'db.php';

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $user_id = $_SESSION['id'];

    // Vérifier si l'utilisateur est l'auteur de la publication
    $checkQuery = "SELECT auteur_id FROM publications WHERE id = '$post_id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        $row = mysqli_fetch_assoc($checkResult);
        $author_id = $row['auteur_id'];

        if ($author_id == $user_id) {
            // Désactiver les contraintes de clé étrangère
            mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 0');

            // Supprimer les commentaires liés à la publication
            $deleteCommentsQuery = "DELETE FROM commentaires WHERE publication_id = '$post_id'";
            mysqli_query($conn, $deleteCommentsQuery);

            // Supprimer les likes liés à la publication
            $deleteLikesQuery = "DELETE FROM likes WHERE publication_id = '$post_id'";
            mysqli_query($conn, $deleteLikesQuery);

            // Supprimer la publication
            $deleteQuery = "DELETE FROM publications WHERE id = '$post_id'";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            // Réactiver les contraintes de clé étrangère
            mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 1');

            if ($deleteResult) {
                // Suppression réussie, rediriger vers la page principale
                header("Location: index.php");
                exit();
            } else {
                // Gérer les erreurs de suppression
                echo "Erreur lors de la suppression de la publication.";
            }
        } else {
            // L'utilisateur n'est pas autorisé à supprimer cette publication
            echo "Vous n'êtes pas autorisé à supprimer cette publication.";
        }
    } else {
        // Publication introuvable
        echo "Publication introuvable.";
    }
} else {
    // Paramètre manquant dans l'URL
    echo "Paramètre manquant dans l'URL.";
}
?>
