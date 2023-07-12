
// Sélectionner tous les éléments avec la classe CSS "delete-comment"
const deleteButtons = document.querySelectorAll('.delete-comment');

// Parcourir tous les boutons de suppression
deleteButtons.forEach(button => {
  // Écouter l'événement de clic sur chaque bouton
  button.addEventListener('click', () => {
    // Récupérer l'ID du commentaire à supprimer à partir de l'attribut "data-comment-id"
    const commentId = button.getAttribute('data-comment-id');

    // Envoyer une requête de suppression du commentaire au serveur
    fetch(`delete_comment.php?id_comment=${commentId}`, {
      method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
      // Vérifier si la suppression a réussi
      if (data.success) {
        // Actualiser la page ou effectuer d'autres actions nécessaires
        location.reload();
      } else {
        // Gérer les erreurs ou afficher un message d'erreur
        console.log(data.message);
      }
    })
    .catch(error => {
      // Gérer les erreurs de la requête
      console.log(error);
    });
  });
});
