<script type="text/javascript" src="js/main.js"></script> 

<?php
session_start();

if(isset($_POST['ID_USER'], $_POST['ID_FILM'])) {
    // Récupérer les données envoyées via POST
    $id_user = $_POST['ID_USER'];
    $id_film = $_POST['ID_FILM'];

    // Insérer les données dans la table FILM_FAV
    include_once 'config.php';
    include_once 'db.php';

    $db = new Database();
    $success = $db->addToFavorites($id_user, $id_film);

    if($success) {
        echo 'Le film a été ajouté à vos favoris !';
    } else {
        echo 'Erreur lors de l\'ajout du film aux favoris.';
    }
} else {
    echo 'Toutes les données nécessaires n\'ont pas été reçues.';
}
?>
