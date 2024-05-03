<?php
include_once 'config.php';
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['NOM'];
    $prenom = $_POST['PRENOM'];
    $username = $_POST['USERNAME'];
    $mdp = password_hash($_POST['MDP'], PASSWORD_DEFAULT);

    $db = new Database();
    $success = $db->insertUser($nom, $prenom, $username, $mdp);

    if ($success) {
        // Rediriger l'utilisateur vers la page de connexion
        header('Location: connexion.php');
        exit();
    } else {
        // Afficher un message d'erreur
        echo "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<header>
    <div class="header-container">
        <div class="logo">
            <img src="/assets/Movie_logo2.png" alt="Logo du site">
        </div>
        <div class="title">
            <h1>MovieStream</h1>
        </div>
        <div class="actions">
            <div class="search">
            </div>
            <div class="buttons">
                <button class="glyphicon glyphicon-home" onclick="window.location.href='index.php'"></button>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="container">
        <form method="post">
            <h2>Inscription</h2>
            <div class="input-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="NOM" required>
            </div>
            <div class="input-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="PRENOM" required>
            </div>
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="USERNAME" required>
            </div>
            <div class="input-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="MDP" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a></p>
    </div>
</body>

<footer>
    <ul class="reseaux">
        <li><a href="#"><i class="fab fa-youtube icon"></i></a></li>
        <li><a href="#"><i class="fab fa-facebook-f icon"></i></a></li>
        <li><a href="#"><i class="fab fa-linkedin-in icon"></i></a></li>
        <li><a href="#"><i class="fa-brands fa-x-twitter icon"></i></a></li> 
    </ul>
    <p>Company no: 120813966 <br>©2024 MovieStream, All rights reserved.</p>
</footer>

</html>


