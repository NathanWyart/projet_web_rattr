<script type="text/javascript" src="js/main.js"></script> 

<?php

// Insérer les données dans la table FILM_FAV
include_once 'config.php';
include_once 'db.php';

session_start();

if(isset($_POST['id_user'], $_POST['id_film'])) {
    // Récupérer les données envoyées via POST
    $id_user = $_POST['id_user'];
    $id_film = $_POST['id_film'];

    $db = new Database();
    $success = $db->removeFilmFromFavorites($id_film, $id_user);

    if($success) {
        echo 'Le film a été retiré de vos favoris avec succès !';
    } else {
        echo 'Erreur lors de la suppression du film des favoris.';
    }
} else {
    echo 'Toutes les données nécessaires n\'ont pas été reçues.';
}
?>
