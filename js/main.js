$(document).ready(function() {
    // Gestionnaire d'événements pour la saisie dans le champ de recherche
    $('#searchInput').on('input', function() {
        // Récupérer la valeur saisie dans le champ de recherche
        var searchTerm = $(this).val().trim();

        // Appeler la fonction de recherche avec le terme de recherche
        searchFilms(searchTerm);
    });

    // Ouvrir la modal lorsque le bouton est cliqué
    $('.film-btn').click(function(){
        var modalId = $(this).closest('.film').find('.modal').attr('id');
        $('#' + modalId).fadeIn(); // Afficher la modal avec un effet de fondu
    });

    // Fermer la modal lorsque l'icône de fermeture est cliquée
    $(document).on('click', '.close', function(){
        $(this).closest('.modal').fadeOut(); // Cacher la modal avec un effet de fond
    });

    // Fermer la modal lorsque le bouton est cliqué à l'intérieur de la modal
    $(document).on('click', '.modal-content .close-btn', function(){
        $(this).closest('.modal').fadeOut(); // Cacher la modal avec un effet de fondu
    });

    // Fermer la modal lorsque l'utilisateur clique en dehors de la modal
    $(document).on('click', function(event){
        if ($(event.target).hasClass('modal')) {
            $(event.target).fadeOut(); // Cacher la modal avec un effet de fondu
        }
    });
});

// Fonction pour rechercher les films
function searchFilms(searchTerm) {
    // Effectuer une requête AJAX pour récupérer les films correspondant au terme de recherche
    $.ajax({
        url: 'includes/search_films.php',
        type: 'GET',
        data: {searchTerm: searchTerm}, // Envoyer le terme de recherche au script PHP
        success: function(response) {
            // Mettre à jour la section des films avec les résultats de la recherche
            $('#film-carousel-container').html(response);
            // Réinitialiser le carrousel après le chargement des résultats de recherche
            $('.carousel-container').carousel();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Fonction pour afficher la modal
function showPopup(popupId) {
    document.getElementById(popupId).style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

// Fonction pour masquer la modal
function hidePopup(popupId) {
    document.getElementById(popupId).style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

