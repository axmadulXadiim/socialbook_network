<?php 
session_start();
include 'db.php';

function countTableById($id, $conn)
{
    $query = "SELECT COUNT(*) FROM likes WHERE publication_id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_row($result);
        return $row[0];
    } else {
        return 0;
    }
}


function countCommentsById($id, $conn)
{
    $query = "SELECT COUNT(*) FROM commentaires WHERE publication_id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_row($result);
        return $row[0];
    } else {
        return 0;
    }
}

function checkLike($conn, $id_post, $id_user)
{

    $query = "SELECT id FROM likes WHERE utilisateur_id = '$id_user' AND publication_id = '$id_post'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_num_rows($result);
        if ($row >= 1) {
            return true;
        }
        return false;
    }
}
if(isset($_GET['user_id'])){

    $user_id = $_GET['user_id'];

    $sql = "SELECT u.nom, u.profile, p.image, p.contenu, p.id FROM publications p INNER JOIN utilisateurs u ON p.auteur_id=u.id where u.id = $user_id ORDER BY p.id DESC";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Erreur de requête : " . mysqli_error($conn);
    }



}
if (isset($_GET['id_post'])) {
    $id_post = $_GET['id_post'];
    $id_user = $_SESSION['id'];
    $query = "SELECT * FROM likes WHERE publication_id = '$id_post' AND utilisateur_id = '$id_user'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_num_rows($result);
        if ($row <= 0) {
            $req = "INSERT INTO likes (publication_id, utilisateur_id) VALUES ('$id_post', '$id_user')";
            $result = mysqli_query($conn, $req);
            header("Location: index.php");
            exit(); // Ajout de l'instruction exit() pour arrêter l'exécution après la redirection
        } else {
            $del = "DELETE FROM likes WHERE publication_id = '$id_post' AND utilisateur_id = '$id_user'";
            $result = mysqli_query($conn, $del);
            header("Location: index.php");
            exit(); // Ajout de l'instruction exit() pour arrêter l'exécution après la redirection
        }
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-b7vH38N/fUaZ6GgfGsg8IaZUI4lAr1k+zAR7qy3BSbjs4Pr4h82z0M+dTLp1V7UuRc8QzfuGObl4KHTJ9Eziig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Profle - Socialbook</title>
    <script src="https://kit.fontawesome.com/ef7e2b893b.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar">
        <div class="nav-left"><img class="logo" src="images/logo.png" alt="">
            <ul class="navlogo">
                <li><img src="images/notification.png"></li>
                <li><img src="images/inbox.png"></li>
                <li><img src="images/video.png"></li>
            </ul>
        </div>
        <div class="nav-right">
            <div class="search-box">
                <img src="images/search.png" alt="">
                <input type="text" placeholder="Search">
            </div>
            <div class="profile-image online" onclick="UserSettingToggle()">
                <img src="images/profile-pic.png" alt="">
            </div>

        </div>
        <div class="user-settings">
            <div class="profile-darkButton">
                <div class="user-profile">
                    <img src="images/profile-pic.png" alt="">
                    <div>
                        <p> Alex Carry</p>
                        <a href="#">See your profile</a>
                    </div>
                </div>
                <div id="dark-button" onclick="darkModeON()">
                    <span></span>
                </div>
            </div>
            <hr>
            <div class="user-profile">
                <img src="images/feedback.png" alt="">
                <div>
                    <p> Give Feedback</p>
                    <a href="#">Help us to improve</a>
                </div>
            </div>
            <hr>
            <div class="settings-links">
                <img src="images/setting.png" alt="" class="settings-icon">
                <a href="#">Settings & Privary <img src="images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="images/help.png" alt="" class="settings-icon">
                <a href="#">Help & Support <img src="images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="images/Display.png" alt="" class="settings-icon">
                <a href="#">Display & Accessibility <img src="images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="images/logout.png" alt="" class="settings-icon">
                <a href="#">Logout <img src="images/arrow.png" alt=""></a>
            </div>

        </div>
    </nav>

    <!-- profile-page-------------------------- -->


    <div class="profile-container">
        <img src="images/cover.png" class="coverImage" alt="">
        <div class="dashboard">
            <div class="left-dashboard">
                <img src="images/<?php echo $_SESSION['image'] ?>" class="dashboard-img" alt="">

                <div class="left-dashboard-info">
                    <h3>Jack Nichoson</h3>
                    <p>120 Friends - 20 mutuals</p>
                    <div class="mutual-friend-images">
                        <img src="images/member-1.png" alt="">
                        <img src="images/member-2.png" alt="">
                        <img src="images/member-3.png" alt="">
                        <img src="images/member-5.png" alt="">
                    </div>
                </div>
            </div>
            <div class="right-dashboard-info">
                <div class="right-dashboard-info-top">

                    <button type="button"><i class="fas fa-user-plus"></i> Friends</button>
                    <button type="button"><i class="far fa-envelope"></i> messages</button>
                </div>
                <div class="right-div-single-logo"> <a href="#"> <i class="fas fa-ellipsis-h"></i></a></div>
            </div>
        </div>


        <div class="container content-profile-container">
            <div class="left-sidebar profile-left-sidebar">
                <div class="left-profile-sidebar-top">
                    <div class="intro-bio">
                        <h4>intro</h4>
                        <p>Belive in yourself and you do unbelievable things <i class="far fa-smile-beam"></i></p>
                        <hr>
                    </div>
                    <div class="background-details">
                        <a href="#"><i class="fas fa-briefcase"></i>
                            <p>Freelancer on Fiverr</p>
                        </a>
                        <a href="#"><i class="fas fa-graduation-cap"></i>
                            <p>Studied bsc at Choumuhoni Collage</p>
                        </a>
                        <a href="#"><i class="fas fa-user-graduate"></i>
                            <p>Went to Technical School & Collage</p>
                        </a>
                        <a href="#"><i class="fas fa-home"></i>
                            <p>Lives in Noakhali, Chittagong</p>
                        </a>
                        <a href="#"><i class="fas fa-map-marker-alt"></i>
                            <p>From Chittagong, Bangladesh</p>
                        </a>
                    </div>
                </div>

                <div class="left-profile-sidebar-top gallery">
                    <div class="heading-link profile-heading-link">
                        <h4>Photos</h4>
                        <a href="">All Photos</a>
                    </div>

                    <div class="gallery-photos">
                        <div class="gallery-photos-rowFirst">
                            <img src="images/photo1.png" alt="">
                            <img src="images/photo2.png" alt="">
                            <img src="images/photo3.png" alt="">
                            
                            <img src="images/photo4.png" alt="">
                            <img src="images/photo5.png" alt="">
                            <img src="images/photo6.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="left-profile-sidebar-top gallery">
                    <div class="heading-link profile-heading-link">
                        <h4>Friends</h4>
                        <a href="">All Friends</a>
                    </div>

                    <div class="gallery-photos">
                        <div class="gallery-photos-rowFirst">
                            <div class="first-friend">
                                <img src="images/member-1.png" alt="">
                                <p>Nathan M</p>
                            </div>
                            <div class="second-friend">
                                <img src="images/member-2.png" alt="">
                                <p>Joseph N</p>
                            </div>
                            <div class="third-friend">
                                <img src="images/member-3.png" alt="">
                                <p>Blondie K</p>
                            </div>
                            <div class="forth-friend">
                                <img src="images/member-4.png" alt="">
                                <p>Jonathon J</p>
                            </div>
                            <div class="fifth-friend">
                                <img src="images/member-5.png" alt="">
                                <p>Mark K</p>
                            </div>
                            <div class="sixth-friend">
                                <img src="images/member-6.png" alt="">
                                <p>Emilia M</p>
                            </div>
                            <div class="seventh-friend">
                                <img src="images/member-7.png" alt="">
                                <p>Max P</p>
                            </div>
                            <div class="eighth-friend">
                                <img src="images/member-8.png" alt="">
                                <p>Layla M</p>
                            </div>
                            <div class="ninth-friend">
                                <img src="images/member-9.png" alt="">
                                <p>Edward M</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- main-content------- -->

            <div class="content-area profile-content-area">
                <div class="write-post-container">
                    <div class="user-profile">
                        <img src="images/profile-pic.png" alt="">
                        <div>
                            <p> Alex Carry</p>
                            <small>Public <i class="fas fa-caret-down"></i></small>
                        </div>
                    </div>

                    <div class="post-upload-textarea">
                        <textarea name="" placeholder="What's on your mind, Alex?" id="" cols="30" rows="3"></textarea>
                        <div class="add-post-links">
                            <a href="#"><img src="images/live-video.png" alt="">Live Video</a>
                            <a href="#" id="openModalLink" data-bs-toggle="modal" data-bs-target="#publicationModal"><img src="images/photo.png" alt="">Photo/Video</a>
                            <a href="post.php"><img src="images/feeling.png" alt="">Feeling Activity</a>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="publicationModal" tabindex="-1" aria-labelledby="publicationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div style="z-index:200;" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="publicationModalLabel">Add Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="post.php" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="imageInput" class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" id="imageInput" aria-describedby="imageHelp">
                                        <div id="imageHelp" class="form-text"></div>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="content" placeholder="Leave a comment here" id="contentTextarea"></textarea>
                                        <label for="contentTextarea">Commentaire</label>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="post" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>



                <?php while ($row = mysqli_fetch_assoc($result)) : ?>

                  <!-- Modal de modification de la publication -->
                  <div class="modal fade" id="editPostModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editPostModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPostModalLabel<?php echo $row['id']; ?>">Modifier la publication</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulaire de modification de la publication -->
                                <form method="POST" action="edit_post.php" enctype="multipart/form-data">
                                    <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                                    <div class="mb-3">
                                        <label for="contentTextarea<?php echo $row['id']; ?>" class="form-label">Contenu</label>
                                        <textarea class="form-control" name="content" id="contentTextarea<?php echo $row['id']; ?>" rows="3"><?php echo $row['contenu']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="imageInput<?php echo $row['id']; ?>" class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" id="imageInput<?php echo $row['id']; ?>">
                                    </div>
                                    <button type="submit" name="edit_post" class="btn btn-primary">Enregistrer les modifications</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de confirmation de suppression -->
                <div class="modal fade" id="deletePostModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deletePostModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePostModalLabel<?php echo $row['id']; ?>">Confirmation de suppression</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer cette publication ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a href="delete_post.php?post_id=<?php echo $row['id']; ?>" class="btn btn-danger">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="status-field-container write-post-container">
                    <div class="user-profile-box">
                        <div class="user-profile">
                            <img src="images/<?php echo $row["profile"] ?>" alt="">
                            <div>
                                <p> <?php echo $row["nom"]  ?></p>
                                <small>August 13 1999, 09.18 pm</small>
                            </div>
                        </div>
                        <div>
                            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                        </div>
                    </div>
                    <div class="status-field">
                        <p><?php echo $row["contenu"] ?> </p>
                        <img src="images/<?php echo $row["image"] ?>" alt="">
                    </div>
                    <div class="post-reaction">
                        <div class="activity-icons">
                            <div>
                                <?php if (!checkLike($conn, $row['id'], $_SESSION['id'])) :  ?>
                                    <a href="index.php?id_post=<?php echo $row["id"]; ?>"><img src="images/like.png" alt=""></a>
                                <?php else : ?>
                                    <a href="index.php?id_post=<?php echo $row["id"]; ?>"><img src="images/like-blue.png" alt=""></a>
                                <?php endif ?>
                                <?php echo countTableById($row['id'], $conn); ?>
                            </div>
                            <div>
                                <a href="index.php?id_post=<?php echo $row["id"]; ?>"><img src="images/comments.png" alt=""></a>
                                <?php echo countCommentsById($row['id'], $conn); ?>
                            </div>
                            <div><img src="images/share.png" alt="">35</div>
                        </div>
                        <div class="post-profile-picture">
                            <img src="images/<?php echo $row["profile"] ?>" alt="">
                            <div class="dropdown">
                                <i class="fas fa-caret-down" id="dropdownMenuButton<?php echo $row['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $row['id']; ?>">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editPostModal<?php echo $row['id']; ?>">Modifier</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deletePostModal<?php echo $row['id']; ?>">Supprimer</a></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="comment-form">
                    <form method="POST" action="commentaire.php?id_post=<?php echo $row['id'] ?>">
                        <div class="d-flex">
                            <div class="form-floating">
                                <textarea class="form-control" style="width: 450px" name="content" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Comments</label>
                            </div>
                            <button type="submit" name="comment" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="comments-section">

                </div>
                <!-- Modal des commentaires -->
                <div class="modal fade" id="commentsModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="commentsModalLabel<?php echo $row['id']; ?>" aria-hidden="true">

                 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentsModalLabel<?php echo $row['id']; ?>">Comments</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                         <div class="comments-section">
                            <?php
                            $commentsQuery = "SELECT * FROM commentaires WHERE publication_id = '{$row['id']}'";
                            $commentsResult = mysqli_query($conn, $commentsQuery);

                            if (mysqli_num_rows($commentsResult) > 0) {
                                while ($comment = mysqli_fetch_assoc($commentsResult)) {
                                    $authorQuery = "SELECT nom, profile FROM utilisateurs WHERE id = '{$comment['auteur_id']}'";
                                    $authorResult = mysqli_query($conn, $authorQuery);
                                    $author = mysqli_fetch_assoc($authorResult);
                                    ?>
                                    <div class="comment">
                                        <div class="comment-author">
                                            <img src="images/<?php echo $author['profile']; ?>" alt="<?php echo $author['nom']; ?>">
                                            <p><?php echo $author['nom']; ?></p>
                                        </div>
                                        <p class="comment-content"><?php echo $comment['contenu']; ?></p>
                                        <?php if ($comment['auteur_id'] == $_SESSION['id']) : ?>
                                            <!-- Bouton Modifier -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCommentModal<?php echo $comment['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <?php if ($comment['auteur_id'] == $_SESSION['id']) : ?>
                                                <!-- Icône de suppression -->
                                                <i class="fas fa-trash delete-comment" data-comment-id="<?php echo $comment['id']; ?>"></i>
                                            <?php endif; ?>


                                            <!-- Modal de modification du commentaire -->
                                            <div class="modal fade" id="editCommentModal<?php echo $comment['id']; ?>" tabindex="-1" aria-labelledby="editCommentModalLabel<?php echo $comment['id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCommentModalLabel<?php echo $comment['id']; ?>">Modifier le commentaire</h5>
                                                            <i class="fas fa-times" style="cursor: pointer;" data-bs-dismiss="modal"></i>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form method="POST" action="edit_comment.php?id_comment=<?php echo $comment['id']; ?>">
                                                                <div class="mb-3">
                                                                    <label for="editedContentInput<?php echo $comment['id']; ?>" class="form-label">Contenu</label>
                                                                    <textarea class="form-control" name="edited_content" id="editedContentInput<?php echo $comment['id']; ?>" aria-describedby="editedContentHelp<?php echo $comment['id']; ?>"><?php echo $comment['contenu']; ?></textarea>
                                                                    <div id="editedContentHelp<?php echo $comment['id']; ?>" class="form-text"></div>
                                                                </div>
                                                                <button type="submit" name="edit_comment" class="btn btn-primary">Modifier</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>Aucun commentaire pour le moment.</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn-LoadMore" onclick="openModal(<?php echo $row['id']; ?>)" data-backdrop="false">View All Comments</button>
    <?php endwhile ?>


    <button type="button" class="btn-LoadMore" onclick="LoadMoreToggle()">Load More</button>
</div>
</div>
</div>
<footer id="footer">
    <p>&copy; Copyright 2021 - Socialbook All Rights Reserved</p>
</footer>

<script src="function.js"></script>
<script>
    var openModalLink = document.getElementById("openModalLink");
    var modal = new bootstrap.Modal(document.getElementById("publicationModal"));

    openModalLink.addEventListener("click", function(event) {
        event.preventDefault();
        modal.show();
    });

    var closeModalButton = document.querySelector(".btn-close");
    closeModalButton.addEventListener("click", function() {
        modal.hide();
    });

    var closeModalOverlay = document.querySelector(".modal");
    closeModalOverlay.addEventListener("click", function(event) {
        if (event.target === closeModalOverlay) {
            modal.hide();
        }
    });

    var modal = new bootstrap.Modal(document.getElementById("publicationModal"), {
      backdrop: false
  });


    // Code JavaScript pour la suppression du commentaire
    document.addEventListener('DOMContentLoaded', function() {
        const deleteIcons = document.querySelectorAll('.delete-comment');

        deleteIcons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                const commentId = this.getAttribute('data-comment-id');
                const confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce commentaire ?");

                if (confirmation) {
                    // Envoyez une requête AJAX ou redirigez vers une page de suppression du commentaire
                    // en utilisant l'identifiant du commentaire (commentId)
                    // Exemple de requête AJAX avec Fetch API :
                    fetch('delete_comment.php?id=' + commentId, {
                        method: 'POST',
                        // Ajoutez des en-têtes supplémentaires si nécessaire (par exemple, jeton CSRF)
                    })
                    .then(function(response) {
                        if (response.ok) {
                            // Le commentaire a été supprimé avec succès
                            // Rafraîchissez la modal des commentaires pour afficher les commentaires mis à jour
                            location.reload();
                        } else {
                            // Gérez les erreurs lors de la suppression du commentaire
                            console.error('Erreur lors de la suppression du commentaire.');
                        }
                    })
                    .catch(function(error) {
                        console.error('Erreur lors de la suppression du commentaire:', error);
                    });
                }
            });
        });
    });





</script>

<script>
    function openModal(id) {
        var modal = new bootstrap.Modal(document.getElementById("commentsModal" + id));
        modal.show();
        var modal = new bootstrap.Modal(document.getElementById("commentsModal"), {
          backdrop: false
      });
    }
</script>
<script>
    function editPost(postId, image, content) {
        document.getElementById('editPostIdInput').value = postId;
        document.getElementById('editImageInput').value = image;
        document.getElementById('editContentInput').value = content;
        document.getElementById('editPostModal').modal('show');
    }
</script>

<!-- Script pour la suppression de publication -->
<script>
    function deletePost(postId) {
        document.getElementById('deletePostIdInput').value = postId;
        document.getElementById('deletePostModal').modal('show');
    }
</script>
<script src="delete_comment.js"></script>
</body>

</html>