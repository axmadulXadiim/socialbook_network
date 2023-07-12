<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Vérifier si l'utilisateur existe déjà dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $stmt = mysqli_query($conn,$sql);
    if ($stmt){
        $row = mysqli_num_rows($stmt);
        if ($row <= 0) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $filename = $_FILES['image']['name'];
            $filetmp = $_FILES['image']['tmp_name'];
            $path = "images/". $filename;
            if (move_uploaded_file($filetmp, $path)) {
                $sql= "INSERT INTO utilisateurs (nom, email, mot_de_passe, profile) VALUES ('$name','$email','$hash','$filename') ";
                $result = mysqli_query($conn, $sql);
                header("location: login.php");
            }
            
        }
        else {
            session_start();
            $_SESSION['email'] = "ce email existe deja";
            header("location: register.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socialbook Inscription</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Socialbook</h1>
        <p>Socialbook vous aide à vous connecter et à partager<br> avec les personnes de votre vie.</p>
    </div>

    <?php if (isset($_SESSION['email'])) { ?>
        <p><?php echo $_SESSION['email']; ?></p>
    <?php } ?>

    <header>
        <form method="POST" action="register.php" enctype="multipart/form-data">
            <div class="box">
                <input type="text" name="name" id="name" placeholder="Nom complet" required><br>
                <input type="file" name="image" id="image" placeholder="image" required>
                <input type="email" name="email" id="email" placeholder="Adresse e-mail" required><br>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            </div>

            <div class="link">
                <input type="submit" value="S'inscrire">
            </div>
        </form>
    </header>
</body>
</html>
