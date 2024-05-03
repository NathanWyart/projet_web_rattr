<script type="text/javascript" src="js/main.js"></script> 

<?php
// Inclure les fichiers de configuration et de base de données
include_once 'config.php';
include_once 'db.php';

// Créer une instance de la classe de base de données
$db = new Database();

// Récupérer les catégories distinctes disponibles
$genres = $db->getDistinctGenres();

// Vérifier s'il existe des catégories
if ($genres) {
    foreach ($genres as $genre) {
        // Afficher le titre de la catégorie
        echo '<h2>' . $genre . '</h2>';

        // Récupérer les films de cette catégorie
        $films = $db->getFilmsByGenre($genre);

        // Afficher les films sous forme de liste
        if ($films) {
            echo '<ul>';
            foreach ($films as $film) {
                echo '<div class="film">';
                echo '<button class="film-btn" data-modal-id="modal-' . $film['ID_FILM'] . '">';
                echo '<img src="' . $film['AFFICHE'] . '" alt="' . $film['NOM'] . '">';
                echo '</button>';
        
                echo '<div class="film-details">';
                echo '<p><strong>' . $film['NOM'] . '</strong></p>';
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
                echo '<button class="watch-btn">Regarder</button>';
                echo '<button class="favorite-btn">Ajouter à la liste des favoris</button>';
                echo '<button class="reviews-btn">Voir les critiques</button>';
                echo '</div>';
        
                echo '</div>';
                echo '<span class="close">&times;</span>';
        
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</ul>';
        } else {
            echo '<p>Aucun film trouvé pour cette catégorie.</p>';
        }
    }
} else {
    echo '<p>Aucune catégorie de film trouvée.</p>';
}
?>
