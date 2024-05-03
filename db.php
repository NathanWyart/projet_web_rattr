<?php

class Database {
    private $pdo;

    public function __construct() {
        // Connexion à la base de données
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    // Méthode pour récupérer tous les films depuis la base de données
    public function getAllFilms() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM film");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des films : " . $e->getMessage();
        }
        return false;
    }
    
    public function getDistinctGenres() {
        try {
            // Préparez la requête SQL pour récupérer les catégories distinctes
            $query = "SELECT DISTINCT GENRE FROM film";
    
            // Exécutez la requête
            $stmt = $this->pdo->query($query);
    
            // Récupérez les résultats sous forme de tableau associatif
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Initialisez un tableau pour stocker les catégories distinctes
            $categories = array();
    
            // Parcourez les résultats et ajoutez chaque catégorie au tableau
            foreach ($result as $row) {
                $categories[] = $row['GENRE'];
            }
    
            // Retournez le tableau de catégories distinctes
            return $categories;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la récupération des catégories : " . $e->getMessage();
        }
        return false;
    }

    public function getFilmsByGenre($genre) {
        try {
            // Préparez la requête SQL pour récupérer les films d'une catégorie spécifique
            $query = "SELECT * FROM film WHERE GENRE = :genre";
    
            // Préparez la requête en utilisant une déclaration préparée pour éviter les injections SQL
            $stmt = $this->pdo->prepare($query);
    
            // Liez la valeur du paramètre ":genre" à la variable $genre
            $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    
            // Exécutez la requête
            $stmt->execute();
    
            // Récupérez les résultats sous forme de tableau associatif
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Retournez les films de la catégorie spécifique
            return $result;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la récupération des films par genre : " . $e->getMessage();
        }
        return false;
    }

    public function searchFilms($searchTerm) {
        try {
            // Préparez la requête SQL pour rechercher des films qui correspondent au terme de recherche
            $query = "SELECT * FROM film WHERE NOM LIKE :searchTerm";
    
            // Préparez la requête en utilisant une déclaration préparée pour éviter les injections SQL
            $stmt = $this->pdo->prepare($query);
    
            // Liez la valeur du paramètre ":searchTerm" à la variable $searchTerm avec des jokers %
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    
            // Exécutez la requête
            $stmt->execute();
    
            // Récupérez les résultats sous forme de tableau associatif
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Retournez les films correspondants à la recherche
            return $result;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la recherche de films : " . $e->getMessage();
        }
        return false;
    }

    public function getFilmDetailsById($id_film) {
        try {
            // Préparez la requête SQL pour récupérer les détails du film en fonction de son ID
            $query = "SELECT * FROM film WHERE ID_FILM = :id_film";
    
            // Préparez la requête en utilisant une déclaration préparée pour éviter les injections SQL
            $stmt = $this->pdo->prepare($query);
    
            // Liez la valeur du paramètre ":id_film" à la variable $id_film
            $stmt->bindParam(':id_film', $id_film, PDO::PARAM_INT);
    
            // Exécutez la requête
            $stmt->execute();
    
            // Récupérez les résultats sous forme de tableau associatif
            $film_details = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Retournez les détails du film
            return $film_details;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la récupération des détails du film : " . $e->getMessage();
        }
        return false;
    }
    
    public function getCritiquesByFilmId($id_film) {
        try {
            // Préparez la requête SQL pour récupérer les critiques en fonction de l'ID du film
            $query = "SELECT * FROM critique WHERE ID_FILM = :id_film";
    
            // Préparez la requête en utilisant une déclaration préparée pour éviter les injections SQL
            $stmt = $this->pdo->prepare($query);
    
            // Liez la valeur du paramètre ":id_film" à la variable $id_film
            $stmt->bindParam(':id_film', $id_film, PDO::PARAM_INT);
    
            // Exécutez la requête
            $stmt->execute();
    
            // Récupérez les résultats sous forme de tableau associatif
            $critiques = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Retournez les critiques associées au film
            return $critiques;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la récupération des critiques : " . $e->getMessage();
        }
        return false;
    }

    public function getUserDetailsById($id_user) {
        try {
            // Préparez la requête SQL pour récupérer les détails de l'utilisateur par son ID
            $query = "SELECT * FROM _user WHERE ID_USER = :id_user";
    
            // Préparez la requête en utilisant une déclaration préparée pour éviter les injections SQL
            $stmt = $this->pdo->prepare($query);
    
            // Liez la valeur du paramètre ":id_user" à la variable $id_user
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    
            // Exécutez la requête
            $stmt->execute();
    
            // Récupérez les résultats sous forme de tableau associatif
            $user_details = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Retournez les détails de l'utilisateur
            return $user_details;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la récupération des détails de l'utilisateur : " . $e->getMessage();
        }
        return false;
    }

    public function insertCritique($id_user, $id_film, $note, $commentaire) {
        try {
            // Préparez la requête SQL pour insérer une nouvelle critique
            $query = "INSERT INTO critique (NOTE, COMMENTAIRE, ID_USER, ID_FILM) VALUES (:note, :commentaire, :id_user, :id_film)";
    
            // Préparez la requête en utilisant une déclaration préparée pour éviter les injections SQL
            $stmt = $this->pdo->prepare($query);
    
            // Liez les valeurs des paramètres à leurs positions dans la requête
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_film', $id_film);
            $stmt->bindParam(':note', $note);
            $stmt->bindParam(':commentaire', $commentaire);
    
            // Exécutez la requête
            $stmt->execute();
    
            // Retournez true si l'insertion s'est bien passée
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur et retournez false
            echo "Erreur lors de l'insertion de la critique : " . $e->getMessage();
            return false;
        }
    }
    
    ######## CONNEXION / INSCRIPTION ########

    public function insertUser($nom, $prenom, $username, $mdp) {
        try {
            // Insérer une ligne dans la table favori_list
            $query = "INSERT INTO favori_list (ID_FAV, ID_USER) VALUES (DEFAULT, DEFAULT)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
    
            // Récupérer l'ID généré pour la nouvelle ligne dans favori_list
            $id_fav = $this->pdo->lastInsertId();
    
            // Insérer l'utilisateur dans la table _user avec l'ID_FAV approprié
            $query = "INSERT INTO _user (NOM, PRENOM, USERNAME, MDP, ID_FAV) VALUES (:nom, :prenom, :username, :mdp, :id_fav)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':mdp', $mdp);
            $stmt->bindParam(':id_fav', $id_fav);
            $stmt->execute();
    
            // Mettre à jour la colonne ID_USER dans la table favori_list avec l'ID de l'utilisateur
            $id_user = $this->pdo->lastInsertId();
            $query = "UPDATE favori_list SET ID_USER = :id_user WHERE ID_FAV = :id_fav";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_fav', $id_fav);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
            return false;
        }
    }    
    
    public function getUserByUsername($username) {
        try {
            $query = "SELECT * FROM _user WHERE USERNAME = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }
    
    public function getTotalFavoriteFilmsCount($user_id) {
        try {
            $query = "SELECT COUNT(*) AS total FROM FILM f INNER JOIN FILM_FAV ff ON f.ID_FILM = ff.ID_FILM INNER JOIN FAVORI_LIST fl ON ff.ID_FAV = fl.ID_FAV WHERE fl.ID_USER = :user_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du nombre total de films favoris : " . $e->getMessage();
            return 0;
        }
    }

    public function getFavoriteFilmsByUserIdWithLimit($user_id, $offset, $limit) {
        try {
            $query = "SELECT f.ID_FILM, f.NOM, f.AFFICHE, f.CREATEUR FROM FILM f INNER JOIN FILM_FAV ff ON f.ID_FILM = ff.ID_FILM INNER JOIN FAVORI_LIST fl ON ff.ID_FAV = fl.ID_FAV WHERE fl.ID_USER = :user_id LIMIT :offset, :limit";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des films favoris avec pagination : " . $e->getMessage();
            return [];
        }
    }
    
    public function addToFavorites($id_user, $id_film) {
        try {
            // Insérez les données dans la table FILM_FAV
            $query = "INSERT INTO film_fav (ID_FILM, ID_FAV) VALUES (:id_film, :id_user)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_film', $id_film);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du film aux favoris : " . $e->getMessage();
            return false;
        }
    }

    // Fonction pour supprimer un film de la liste des favoris
    public function removeFilmFromFavorites($id_film, $id_user) {
        try {
            // Supprimer les données de la table FILM_FAV
            $query = "DELETE FROM film_fav WHERE ID_FILM = :id_film AND ID_FAV = :id_user";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_film', $id_film);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du film des favoris : " . $e->getMessage();
            return false;
        }
    }    

    // Fonction pour obtenir le genre le plus fréquent dans les favoris de l'utilisateur
    public function getMostFrequentGenreInFavorites($user_id) {
        $query = "SELECT genre, COUNT(*) AS genre_count FROM film_fav INNER JOIN film ON film_fav.ID_FILM = film.ID_FILM WHERE ID_FAV = :user_id GROUP BY genre ORDER BY genre_count DESC LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['genre'] : null; // Vérifier si $result est différent de false avant d'accéder à l'index
    }

    // Fonction pour obtenir des recommandations basées sur le genre le plus fréquent dans les favoris de l'utilisateur, en excluant les films déjà ajoutés aux favoris
    public function getGenreBasedRecommendations($user_id) {
        // Obtenir le genre le plus fréquent dans les favoris de l'utilisateur
        $most_frequent_genre = $this->getMostFrequentGenreInFavorites($user_id);

        // Sélectionner des films du même genre à recommander, en excluant ceux déjà ajoutés aux favoris
        $query = "SELECT * FROM film WHERE genre = :genre AND ID_FILM NOT IN (SELECT ID_FILM FROM film_fav WHERE ID_FAV = :user_id) LIMIT 5";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':genre', $most_frequent_genre);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour récupérer les 5 films les mieux notés
    public function getTopRatedFilms($limit) {
        $query = "SELECT f.*, ROUND(AVG(c.NOTE), 1) AS AVG_NOTE 
                  FROM film f 
                  LEFT JOIN critique c ON f.ID_FILM = c.ID_FILM 
                  GROUP BY f.ID_FILM 
                  ORDER BY AVG_NOTE DESC 
                  LIMIT :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>
