<?php

include_once 'config.php';
include_once 'db.php';

session_start();
if(!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$db = new Database();

// Vérifier si l'ID du film est passé dans l'URL
if(isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];
    
    // Récupérer les détails du film en fonction de son ID
    $film_details = $db->getFilmDetailsById($id_film);
}

// Assurez-vous que vous avez récupéré les détails du film de la base de données
if ($film_details) {
    $film_name = $film_details['NOM'];
    $film_creator = $film_details['CREATEUR'];
    $film_image = $film_details['AFFICHE'];
    $film_video_path = 'assets/VIDEO/generique.mp4'; // Chemin local vers le fichier vidéo mp4
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script></head>

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
                <button class="glyphicon glyphicon-home" onclick="window.location.href='index.php?user_id=<?php echo $_SESSION['user_id']; ?>'"></button>
            </div>
        </div>
    </div>
</header>

<body>
    <?php
    // Inclure les fichiers de configuration et de base de données
    include_once 'config.php';
    include_once 'db.php';

    // Vérifier si l'ID du film est passé en paramètre dans l'URL
    if(isset($_GET['id_film'])) {
        $film_id = $_GET['id_film'];
        // Appeler la fonction pour récupérer les détails du film depuis la base de données
        $film_details = $db->getFilmDetailsById($film_id);
        if($film_details) {
            // Afficher les détails du film
            echo "<div class='film-details'>";
            echo "<h2>{$film_details['NOM']}</h2>";
            echo "<p>Créateur: {$film_details['CREATEUR']}</p>";
            echo "</div>";
            // Afficher le lecteur vidéo
            echo "<div class='video-player'>";
            echo "<video controls>";
            echo "<source src='$film_video_path' type='video/mp4'>";
            echo "Votre navigateur ne prend pas en charge la lecture de vidéos HTML5.";
            echo "</video>";
            echo "</div>";
        } else {
            echo "<p>Aucun détail trouvé pour ce film.</p>";
        }
    } else {
        echo "<p>Paramètre film_id manquant dans l'URL.</p>";
    }
    ?>

    <style>
        /* .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        } */

        .film-details {
            margin-top: 3rem;
            margin-bottom: 2rem;
        }

        video {
            margin-left: 28%;
            width: 44.5%;
            height: auto;
        }
    </style>
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

