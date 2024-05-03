<script type="text/javascript" src="js/main.js"></script> 

<?php
include_once 'config.php';
include_once 'db.php';

session_start();

// Vérifier si toutes les données nécessaires ont été reçues
if(isset($_POST['id_user'], $_POST['id_film'], $_POST['note'], $_POST['commentaire'])) {
    // Récupérer les données envoyées via POST
    $id_user = $_POST['id_user'];
    $id_film = $_POST['id_film'];
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];

    // Insérer les données dans la base de données
    $db = new Database();
    $success = $db->insertCritique($id_user, $id_film, $note, $commentaire);

    if ($success) {
        echo 'Votre critique a été ajoutée avec succès !';
    } else {
        echo 'Une erreur s\'est produite lors de l\'ajout de votre critique.';
    }
} else {
    echo 'Toutes les données nécessaires n\'ont pas été reçues.';
}
?>

