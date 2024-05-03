<script type="text/javascript" src="js/main.js"></script> 

<?php
// Inclure les fichiers de configuration et de base de données
include_once 'config.php';
include_once 'db.php';

// Créer une instance de la classe de base de données
$db = new Database();

// Vérifier si le terme de recherche a été envoyé depuis la requête GET
if (isset($_GET['searchTerm'])) {
    // Récupérer le terme de recherche depuis la requête GET
    $searchTerm = $_GET['searchTerm'];

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $searchTerm = htmlspecialchars($searchTerm);

    // Effectuer la recherche de films correspondant au terme de recherche dans la base de données
    $films = $db->searchFilms($searchTerm);

    // Afficher les résultats de la recherche
    if ($films) {
        foreach ($films as $film) {
            // Afficher les détails du film
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
    } else {
        // Aucun film trouvé pour le terme de recherche
        echo '<p>Aucun film trouvé pour la recherche : ' . $searchTerm . '</p>';
    }
} else {
    // Le terme de recherche n'a pas été spécifié
    echo '<p>Aucun terme de recherche spécifié.</p>';
}
?>
