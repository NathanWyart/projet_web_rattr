<?php
include_once 'config.php';
include_once 'db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['USERNAME'];
    $mdp = $_POST['MDP'];

    $db = new Database();
    $user = $db->getUserByUsername($username);

    if ($user && password_verify($mdp, $user['MDP'])) {
        $_SESSION['user_id'] = $user['ID_USER'];
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/connection.css">
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
            <h2>Connexion</h2>
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="USERNAME" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="MDP" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a></p>
    </div>
</body>

<div id="error-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="error-message" class="error-message"></div>
    </div>
</div>

<footer>
    <ul class="reseaux">
        <li><a href="#"><i class="fab fa-youtube icon"></i></a></li>
        <li><a href="#"><i class="fab fa-facebook-f icon"></i></a></li>
        <li><a href="#"><i class="fab fa-linkedin-in icon"></i></a></li>
        <li><a href="#"><i class="fa-brands fa-x-twitter icon"></i></a></li> 
    </ul>
    <p>Company no: 120813966 <br>©2024 MovieStream, All rights reserved.</p>
</footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script> 
    $(document).ready(function() {
        $('#error-modal .close').click(function() {
            $('#error-modal').fadeOut();
        });

        function showErrorModal(message) {
            $('#error-message').html(message);
            $('#error-modal').fadeIn();
        }

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($username) OR !empty($mdp) && !$user): ?>
            showErrorModal('Nom d\'utilisateur ou mot de passe incorrect.<br>Veuillez réessayer.');
        <?php endif; ?>
    });

    </script>

</html>

