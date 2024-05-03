<script type="text/javascript" src="js/main.js"></script> 

<?php

session_start();

// Inclure le fichier de configuration et la classe pour interagir avec la base de données
include_once 'config.php';
include_once 'db.php';

// Créer une instance de la classe de base de données
$db = new Database();

// Récupérer tous les films depuis la base de données
$films = $db->getAllFilms();

// Afficher les films sous forme de carrousel
if ($films) {
    foreach ($films as $film) {
        echo '<div class="film">';
        echo '<button class="film-btn">';
        echo '<img src="' . $film['AFFICHE'] . '" alt="' . $film['NOM'] . '">';
        echo '</button>';

        echo '<div class="film-details">';
        echo '<p><strong>' . $film['NOM'] . '</strong></p>';
        echo '<p>' . $film['GENRE'] . '</p>';
        echo '</div>';

        echo '<div id="modal-' . $film['ID_FILM'] . '" class="modal">';
        echo '<div class="modal-content">';
        echo '<div class="modal-left">';
        echo '<img src="' . $film['AFFICHE'] . '" alt="' . $film['NOM'] . '">';
        echo '</div>';
        echo '<div class="modal-right">';
        echo '<h2>' . $film['NOM'] . '</h2>';
        echo '<p><strong>Genre : </strong>' . $film['GENRE'] . '</p>';
        echo '<p><strong>Résumé : </strong>' . $film['RESUME'] . '</p>';
        echo '<p><strong>Réalisateur : </strong>' . $film['CREATEUR'] . '</p>';
        echo '<p><strong>Date de sortie : </strong>' . $film['DATE_SORTIE'] . '</p>';

        echo '<div class="modal-buttons">';
        // Vérifier si l'utilisateur est connecté
        $isLoggedIn = isset($_SESSION['user_id']);

        // Afficher les boutons sans vérifier la session
        echo '<button class="watch-btn" onclick="window.location.href=\'video.php?id_film=' . $film['ID_FILM'] . '\'">Regarder</button>';

        // Afficher le bouton "Ajouter à la liste des favoris" si l'utilisateur est connecté
        if ($isLoggedIn) {
            echo '<button class="favorite-btn" data-film-id="' . $film['ID_FILM'] . '">Ajouter à la liste des favoris</button>';
        }

        // Afficher le bouton "Voir les critiques"
        echo '<button class="reviews-btn" data-film-id="' . $film['ID_FILM'] . '" onclick="window.location.href=\'details_films.php?id_film=' . $film['ID_FILM'] . '.php\'">Voir les critiques</button>';

        echo '</div>';

        echo '</div>';
        echo '<span class="close">&times;</span>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Aucun film trouvé.</p>';
}
?>

<script> 

$(document).ready(function() {
    // Gestionnaire d'événements pour le clic sur le bouton "Voir les critiques"
    $(document).on('click', '.reviews-btn', function(){
        // Récupérer l'ID du film à partir de l'attribut de données
        var filmId = $(this).data('film-id');
        
        // Rediriger l'utilisateur vers la page des critiques avec l'ID du film
        window.location.href = 'details_films.php?id_film=' + filmId;
    });

    // Gestionnaire d'événement pour le clic sur le bouton "Ajouter à la liste des favoris"
    $('.favorite-btn').click(function() {
        // Récupérer l'ID du film à partir de l'attribut data
        var filmId = $(this).data('film-id');

        // Vérifier si la clé "user_id" est définie dans $_SESSION
        if (typeof <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?> !== 'undefined') {
            // Récupérer l'ID de l'utilisateur connecté
            var userId = <?php echo $_SESSION['user_id']; ?>;

            // Envoyer une requête AJAX à add_to_favorites.php
            $.ajax({
                url: 'add_to_favorites.php',
                method: 'POST',
                data: {
                    ID_USER: userId,
                    ID_FILM: filmId
                },
                success: function(response) {
                    // Afficher une alerte ou un message de succès
                    alert('Le film a été ajouté à vos favoris !');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Afficher une alerte ou un message d'erreur en cas d'échec
                    alert('Erreur lors de l\'ajout du film aux favoris : ' + xhr.responseText);
                }
            });
        } else {
            // L'utilisateur n'est pas connecté, affichez un message d'erreur
            alert('Vous devez être connecté pour ajouter des films à vos favoris.');
            // Rediriger l'utilisateur vers la page de connexion
            window.location.href = 'connexion.php';
        }
    });
});

</script>
