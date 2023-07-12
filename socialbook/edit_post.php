<?php
session_start();
include 'db.php';

if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];
    
    // Vérifier si une nouvelle image a été sélectionnée
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        
        // Déplacer le fichier téléchargé vers le dossier des images
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        
        // Mettre à jour le contenu et l'image de la publication dans la base de données
        $sql = "UPDATE publications SET contenu = '$content', image = '$image' WHERE id = '$post_id'";
    } else {
        // Si aucune nouvelle image n'a été sélectionnée, mettre à jour uniquement le contenu de la publication
        $sql = "UPDATE publications SET contenu = '$content' WHERE id = '$post_id'";
    }
    
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        // Rediriger vers la page des publications avec un message de succès
        header("Location: index.php?success=1");
        exit();
    } else {
        // Gérer les erreurs de mise à jour de la publication
        echo "Erreur lors de la mise à jour de la publication : " . mysqli_error($conn);
    }
}
?>
