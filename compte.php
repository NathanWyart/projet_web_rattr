<script type="text/javascript" src="js/main.js"></script> 

<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: connexion.php');
    exit();
}

// Inclure le fichier de configuration et la classe pour interagir avec la base de données
include_once 'config.php';
include_once 'db.php';

// Créer une instance de la classe de base de données
$db = new Database();

// Récupérer les informations de l'utilisateur à partir de la session
$user_id = $_SESSION['user_id'];
$user_info = $db->getUserDetailsById($user_id);

// Vérifier si les informations de l'utilisateur ont été trouvées
if (!$user_info) {
    // Rediriger vers la page de connexion si les informations de l'utilisateur ne sont pas disponibles
    header('Location: connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="css/compte.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="/assets/Movie_logo2.png" alt="Logo du site">
            </div>
            <div class="title">
                <h1>MovieStream</h1>
            </div>
            <div class="actions">
                <div class="buttons">
                    <button class="glyphicon glyphicon-log-out" onclick="window.location.href='logout.php'"></button>
                    <button class="glyphicon glyphicon-home" onclick="window.location.href='index.php?user_id=<?php echo $_SESSION['user_id']; ?>'"></button>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="profile">
            <img src="assets/user-profile.png" alt="Photo de profil">
            <h2>Informations du Compte</h2>
            <p>Nom : <?php echo $user_info['NOM']; ?></p>
            <p>Prénom : <?php echo $user_info['PRENOM']; ?></p>
            <p>Identifiant : <?php echo $user_info['USERNAME']; ?></p>
        </div>
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
