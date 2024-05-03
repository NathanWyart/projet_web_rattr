<?php

// Inclure les fichiers de configuration et de base de données
include_once 'config.php';
include_once 'db.php';

session_start();

// Initialisation de la variable $user_id
$user_id = null;

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Si l'utilisateur est connecté, l'URL pointera vers compte.php avec son ID_USER
    $url = 'compte.php';
    $user_id = $_SESSION['user_id'];
} else {
    // Sinon, l'URL pointera vers la page de connexion
    $url = 'connexion.php';
}

$isLoggedIn = isset($_SESSION['user_id']);

$db = new Database();

$genre_based_recommendations = $db->getGenreBasedRecommendations($user_id);

$top_rated_films = $db->getTopRatedFilms(5); // Supposons que la méthode getTopRatedFilms() récupère les 5 films les mieux notés

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieStream</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/main.js"></script> 
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
            <div class="search">
                <input type="text" id="searchInput" placeholder="Rechercher...">
            </div>
            <div class="buttons">
                <button id="toggle-category" class="glyphicon glyphicon-list"></button>
                <button class="glyphicon glyphicon-heart" onclick="window.location.href='favoris.php'"></button>
                <button class="glyphicon glyphicon-user" onclick="window.location.href='<?php echo $url; ?>'"></button>
                <button class="glyphicon glyphicon-home" onclick="window.location.href='<?php echo isset($user_id) ? 'index.php?user_id=' . $user_id : 'index.php'; ?>'"></button>
            </div>
        </div>
    </div>
</header>

<!-- Carrousel de Films Populaires -->
<section id="affiche">
    <!-- <h2>A l'affiche</h2> -->
</section>

<!-- <style>
        .recommendations-container {
            text-align: center; /* Pour centrer les éléments horizontalement */
            font-size: 1.5rem;
        }

        .recommendation-item {
            display: inline-block; /* Afficher les éléments en ligne */
            margin: 1.5rem; /* Ajouter un espace entre les éléments */
        }

        .recommendation-item h3 {
            font-size: 2rem;
        }

        .recommendation-item img, .film-item img {
            width: 150px; /* Définir la largeur des images */
            height: auto; /* Laisser la hauteur automatique pour maintenir les proportions */
        }

        .recommendation h1 {
            font-size: 3rem;
            text-align: center; 
            margin-top: 6rem;
            margin-bottom: 6rem;
        }

        .recommendation h2 {
            font-size: 3rem;
            margin-top: 3rem;
            margin-left: 3rem;
        }

        .view-details-btn {
            background-color: black;
            border-style: none;
        }

        .separator {
            width: 100%;
            height: 2px; /* Hauteur de la séparation */
            background-color: #6b36e2; /* Couleur de la séparation */
            margin: 20px 0; /* Espacement autour de la séparation */
        }
</style> -->

<div class="recommendation">
    <h1>Le Meilleur Site de Streaming Gratuit ! <br>Vous pourrez regarder les films les plus populaires en haute qualité !</h2>
</div>

<?php if ($isLoggedIn): ?>
        <div class="separator"></div>
        <div class="center">
            <h1>Recommandations basées sur vos favoris</h1>
        </div>
<?php endif; ?>

<div class="recommendations-container">
    <?php foreach($genre_based_recommendations as $recommendation): ?>
        <div class="recommendation-item">
            <!-- Bouton qui ouvre la modal -->
            <button class="view-details-btn" data-film-id="<?php echo $recommendation['ID_FILM']; ?>">
                <img src="<?php echo $recommendation['AFFICHE']; ?>" alt="<?php echo $recommendation['NOM']; ?>">
            </button>
            <div class="recommendation-details">
                <p><strong><?php echo $recommendation['NOM']; ?></strong></p>
                <p><?php echo $recommendation['GENRE']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="separator"></div>

    <div class="center">
        <h1>Top 5 des films du moment !</h1>
    </div>

    <div class="separator"></div>

    <?php if(!empty($top_rated_films)): ?>
    <div class="top-rated-container">
        <?php $ranking = 1; ?>
        <?php foreach ($top_rated_films as $film): ?>
            <div class="film-card">
                <p class="ranking"><?php echo $ranking; ?></p> <!-- Ajouter le rang de classement ici -->
                <!-- Bouton pour ouvrir la modale -->
                <button class="film-btn" data-film-id="<?php echo $film['ID_FILM']; ?>">
                    <img src="<?php echo $film['AFFICHE']; ?>" alt="<?php echo $film['NOM']; ?>">
                </button>
                <div class="film-infos">
                    <h2><?php echo $film['NOM']; ?></h2>
                    <p>Genre : <?php echo $film['GENRE']; ?></p>
                    <p>Avis : <?php echo $film['AVG_NOTE']; ?> <i class="fas fa-star"></i></p> <!-- Ajouter une étoile pour la note -->
                </div>
            </div>
            <?php $ranking++; ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun film n'a été trouvé.</p>
<?php endif; ?>

</div>

    <!-- Modals pour afficher les détails des recommandations -->
    <?php foreach($genre_based_recommendations as $recommendation): ?>
        <div id="modal-<?php echo $recommendation['ID_FILM']; ?>" class="modal">
            <div class="modal-content">
                <div class="modal-left">
                    <img src="<?php echo $recommendation['AFFICHE']; ?>" alt="<?php echo $recommendation['NOM']; ?>">
                </div>
                <div class="modal-right">
                    <h2><?php echo $recommendation['NOM']; ?></h2>
                    <p><strong>Genre : </strong><?php echo $recommendation['GENRE']; ?></p>
                    <p><strong>Résumé : </strong><?php echo $recommendation['RESUME']; ?></p>
                    <p><strong>Réalisateur : </strong><?php echo $recommendation['CREATEUR']; ?></p>
                    <p><strong>Date de sortie : </strong><?php echo $recommendation['DATE_SORTIE']; ?></p>
                    <div class="modal-buttons">
                        <!-- Bouton pour regarder le film -->
                        <button class="watch-btn" onclick="window.location.href='video.php?id_film=<?php echo $recommendation['ID_FILM']; ?>'">Regarder</button>
                        <!-- Bouton pour ajouter aux favoris -->
                        <button class="favorite-btn" data-film-id="<?php echo $recommendation['ID_FILM']; ?>">Ajouter à la liste des favoris</button>
                        <!-- Bouton pour voir les critiques -->
                        <button class="reviews-btn" data-film-id="<?php echo $recommendation['ID_FILM']; ?>" onclick="window.location.href='details_films.php?id_film=<?php echo $recommendation['ID_FILM']; ?>'.php\'">Voir les critiques</button>
                    </div>
                </div>
                <span class="close">&times;</span>
            </div>
        </div>
    <?php endforeach; ?>

<!-- Carrousel de Films -->
<section id="film-carousel">
    <div class="separator"></div>
    <div class="center">
        <h1>Tous les films</h2>
    </div>
    <div class="separator"></div>

    <div id="film-carousel-container" class="carousel-container">
        <!-- Les films sont chargés ici -->
    </div>
</section>

<footer>
    <ul class="reseaux">
        <li><a href="#"><i class="fab fa-youtube icon"></i></a></li>
        <li><a href="#"><i class="fab fa-facebook-f icon"></i></a></li>
        <li><a href="#"><i class="fab fa-linkedin-in icon"></i></a></li>
        <li><a href="#"><i class="fa-brands fa-x-twitter icon"></i></a></li> 
    </ul>
    <p>Company no: 120813966 <br>©2024 MovieStream, All rights reserved.</p>
</footer>


<!-- Script AJAX -->
<script>
    $(document).ready(function(){
    var displayAllFilms = true; // Variable de commutation pour suivre l'état de l'affichage des films

    // Fonction pour charger les films en fonction de l'état de commutation
    function loadFilms() {
        var url = displayAllFilms ? 'get_films.php' : 'get_categorie_film.php';
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#film-carousel-container').html(response);
                // $('.carousel-container').carousel();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Chargement initial des films
    loadFilms();

    // Gestionnaire d'événements pour le clic sur le bouton "Trier les films par catégories"
    $('#toggle-category').click(function() {
        displayAllFilms = !displayAllFilms; // Inverser l'état de commutation
        loadFilms(); // Charger les films en fonction de l'état de commutation
    });
});

// <!-- Scripts jQuery pour gérer les modals et les actions -->

    $(document).ready(function() {
        // Gestionnaire d'événements pour afficher la modal lorsqu'un bouton est cliqué
        $('.view-details-btn').click(function() {
            var filmId = $(this).data('film-id');
            $('#modal-' + filmId).fadeIn();
        });

        // Gestionnaire d'événements pour fermer la modal lorsqu'on clique sur le bouton de fermeture
        $('.close').click(function() {
            $(this).closest('.modal').fadeOut();
        });

        // Gestionnaire d'événements pour ajouter un film aux favoris
        $('.favorite-btn').click(function() {
            var filmId = $(this).data('film-id');

        });
    });


</script>

<script>
    $(document).ready(function() {
        // Gestionnaire d'événements pour ouvrir la modale lorsqu'un bouton est cliqué
        $('.film-btn').click(function() {
            // Récupérer l'identifiant unique du film à partir de l'attribut data
            var filmId = $(this).data('film-id');
            // Afficher la modale correspondante
            $('#modal-' + filmId).fadeIn();
        });

        // Gestionnaire d'événements pour fermer la modale lorsqu'on clique sur le bouton de fermeture
        $('.close').click(function() {
            $(this).closest('.modal').fadeOut();
        });
    });
</script>
</body>
</html>


