<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Échapper les valeurs pour éviter les injections SQL (optionnel, mais recommandé)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Requête pour vérifier les informations d'identification de l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);

    // Vérifier si la requête a renvoyé un résultat
    if ($result) {
       $row=mysqli_fetch_assoc($result);
       if ($row) {
           if (password_verify($password, $row["mot_de_passe"])) {
               session_start();
               $_SESSION['id']=$row['id'];
               $_SESSION['email']=$row['email'];
               $_SESSION['image']=$row['profile'];
               $_SESSION['nom']=$row['nom'];
               $fichier = $row['nom']." ".$row['email']." ".date("Y-m-d").PHP_EOL;
               file_put_contents("login.txt",$fichier,FILE_APPEND);
               header("location: index.php");
           }
           else{
            session_start();
            $_SESSION['$erreur']= "email ou mot de passe incorrect";
            header("location: login.php");
        }
        
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
    <title>Socialbook Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Socialbook</h1>
        <p>Socialbook helps you connect and share<br> with the people in your life.</p>



    </div>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <header>
        <form method="POST" action="login.php">
            <div class="box">
                <input type="email" name="email" id="email" placeholder="Email address or phone number"><br>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <div class="link">
               <input type="submit" value="Se connecter">
           </div>

           <div class="link1">
            <a href="#">mot de passe oublie?</a>
        </div>

        <div class="link2">
          <a href="register.php">Creer un nouveau compte</a>
      </div>
  </header>
</form>
</body>
</html>
