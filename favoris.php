<script type="text/javascript" src="js/main.js"></script> 

<?php
// Inclure les fichiers de configuration et de base de données
include_once 'config.php';
include_once 'db.php';

session_start();

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Nombre de films à afficher par page
$filmsParPage = 5;

// Créer une instance de la classe de base de données
$db = new Database();

// Récupérer le nombre total de films en favoris de l'utilisateur
$totalFilms = $db->getTotalFavoriteFilmsCount($user_id);

// Calculer le nombre total de pages
$totalPages = ceil($totalFilms / $filmsParPage);

// Récupérer le numéro de page actuel (par défaut: 1)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculer l'offset pour la requête SQL
$offset = ($page - 1) * $filmsParPage;

// Récupérer les films pour la page actuelle
$favorite_films = $db->getFavoriteFilmsByUserIdWithLimit($user_id, $offset, $filmsParPage);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/favoris.css">
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
                <button class="glyphicon glyphicon-home" onclick="window.location.href='index.php?user_id=<?php echo $_SESSION['user_id']; ?>'"></button>
            </div>
        </div>
    </div>
</header>

<h1>Mes Favoris</h1>

<?php if(!empty($favorite_films)): ?>
    <div class="favoris-container">
        <?php foreach($favorite_films as $film): ?>
            <div class="favoris-item">
                <img src="<?php echo $film['AFFICHE']; ?>" alt="<?php echo $film['NOM']; ?>">
                <div class="button-container">
                    <div class="buttons">
                        <button class="glyphicon glyphicon-play" onclick="window.location.href='video.php?id_film=<?php echo $film['ID_FILM']; ?>'"></button>
                        <button class="glyphicon glyphicon-trash remove-from-favorites-btn" data-film-id="<?php echo $film['ID_FILM']; ?>"></button>
                    </div>
                </div>
                <h3><?php echo $film['NOM']; ?></h3>
                <p>Réalisateur: <?php echo $film['CREATEUR']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Affichage des liens de pagination -->
    <div class="pagination-container">
        <?php if($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>" class="pagination-btn">Précédent</a>
        <?php endif; ?>

        <span>Page <?php echo $page; ?> / <?php echo $totalPages; ?></span>

        <?php if($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>" class="pagination-btn">Suivant</a>
        <?php endif; ?>
    </div>
    <?php else: ?>
        <p>Aucun film n'a été ajouté aux favoris.</p>
    <?php endif; ?>

<footer>
    <ul class="reseaux">
        <li><a href="#"><i class="fab fa-youtube icon"></i></a></li>
        <li><a href="#"><i class="fab fa-facebook-f icon"></i></a></li>
        <li><a href="#"><i class="fab fa-linkedin-in icon"></i></a></li>
        <li><a href="#"><i class="fa-brands fa-x-twitter icon"></i></a></li> 
    </ul>
    <p>Company no: 120813966 <br>©2024 MovieStream, All rights reserved.</p>
</footer>

<script>
$(document).ready(function() {

    function watchFilm(filmId) {
        window.location.href = 'details_films.php?id_film=' + filmId;
    }

    $('.remove-from-favorites-btn').click(function() {
        var filmId = $(this).data('film-id');
        var userId = <?php echo $_SESSION['user_id'] ?>;
        $.ajax({
            url: 'remove_from_favorites.php',
            method: 'POST',
            data: {
                id_user: userId,
                id_film: filmId
            },
            success: function(response) {
                alert('Le film a été retiré de vos favoris avec succès !');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Erreur lors de la suppression du film des favoris : ' + xhr.responseText);
            }
        });
    });
});
</script>

</body>
</html>
