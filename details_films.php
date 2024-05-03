<script type="text/javascript" src="js/main.js"></script> 

<?php
include_once 'config.php';
include_once 'db.php';

session_start();

// Créer une instance de la classe de base de données
$db = new Database();

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

// Vérifier si l'ID du film est passé dans l'URL
if(isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];
    
    // Récupérer les détails du film en fonction de son ID
    $film_details = $db->getFilmDetailsById($id_film);

    // Récupérer les critiques du film en fonction de son ID
    $critiques = $db->getCritiquesByFilmId($id_film);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Film</title>
    <script type="text/javascript" src="js/main.js"></script> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

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
                <button id="add-review-btn" class="glyphicon glyphicon-plus"></button>
                <button class="glyphicon glyphicon-heart" onclick="window.location.href='favoris.php'"></button>
                <button class="glyphicon glyphicon-user" onclick="window.location.href='<?php echo $url; ?>'"></button>
                <button class="glyphicon glyphicon-home" onclick="window.location.href='index.php?user_id=<?php echo $user_id ?>'"></button>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="container">
        <div class="row">
            <!-- Colonne des détails du film -->
            <div class="col-md-6">
                <h1>Détails du Film</h1>
                <?php if($film_details): ?>
                    <h2><?php echo $film_details['NOM']; ?></h2>
                    <img class="film-image" src="<?php echo $film_details['AFFICHE']; ?>" alt="<?php echo $film_details['NOM']; ?>" class="film-image img-responsive">
                    <p>Créateur : <?php echo $film_details['CREATEUR']; ?> <br> Genre : <?php echo $film_details['GENRE']; ?></p>
                <?php else: ?>
                    <p>Aucun détail trouvé pour ce film.</p>
                <?php endif; ?>
            </div>

            <!-- Colonne des critiques -->
            <div class="col-md-6">
                <h2>Critiques</h2>
                <div class="critiques-container">
                    <?php if($critiques): ?>
                        <ul class="critiques-list">
                            <?php foreach($critiques as $critique): ?>
                                <li class="critique">
                                    <?php 
                                    $user_details = $db->getUserDetailsById($critique['ID_USER']);
                                    if ($user_details): ?>
                                        <div class="user-info">
                                            <p>Auteur : <?php echo $user_details['NOM'] . ' ' . $user_details['PRENOM']; ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="critique-info">
                                        <p>Note : <?php echo $critique['NOTE']; ?> / 5 <i class="fas fa-star"></i></p>
                                        <p>Commentaire : <?php echo $critique['COMMENTAIRE']; ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Aucune critique trouvée pour ce film.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

<div id="add-review-modal" class="modal">
    <div class="modal-content">
        <?php if($film_details): ?>
        <img class="film-image" src="<?php echo $film_details['AFFICHE']; ?>" alt="<?php echo $film_details['NOM']; ?>" class="film-image img-responsive">
        <?php endif; ?>
        <form id="review-form" action="add_review.php" method="post">
            <h2>Ajouter une critique</h2>
            <label for="review-rating">Note :</label>
            <input type="number" id="review-rating" name="note" min="1" max="5" required>
            <label for="review-comment">Commentaire :</label>
            <textarea id="review-comment" name="commentaire" rows="4" required></textarea>
            <button type="button" id="submit-review-btn">Soumettre</button>
        </form>
        <span class="close">&times;</span>
    </div>
</div>

</html>

<?php
} else {
    header('Location: index.php');
    exit();
}
?>

<script> 

$(document).ready(function() {
    // Gestionnaire d'événement pour le clic sur le bouton "Ajouter une critique"
    $('#add-review-btn').click(function() {
        // Afficher le formulaire modal
        $('#add-review-modal').fadeIn();
    });

    // Gestionnaire d'événement pour le clic sur la croix de fermeture
    $('.close').click(function() {
        $('#add-review-modal').fadeOut();
    });

    // Gestionnaire d'événement pour le clic en dehors de la modal pour la fermer
    $(window).click(function(event) {
        if (event.target == $('#add-review-modal')[0]) {
            $('#add-review-modal').fadeOut();
        }
    });

    $('#submit-review-btn').click(function() {
        // Récupérer les valeurs du formulaire
        var note = $('#review-rating').val();
        var commentaire = $('#review-comment').val();
        var id_user = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
        var id_film = <?php echo $id_film; ?>;

        $.ajax({
            url: 'add_review.php',
            method: 'POST',
            data: {
                id_film: id_film,
                id_user: id_user,
                note: note,
                commentaire: commentaire
            },
            success: function(response) {
                alert('Votre critique a été ajoutée avec succès !');
                $('#add-review-modal').fadeOut();
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
