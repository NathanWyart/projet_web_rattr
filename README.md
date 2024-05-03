# MovieStream

MovieStream est une application web qui permet aux utilisateurs de découvrir, de noter et de critiquer des films. Avec une vaste collection de films dans divers genres, les utilisateurs peuvent explorer et partager leurs opinions sur leurs films préférés.

## Fonctionnalités

- **Authentification des Utilisateurs :** Les utilisateurs peuvent créer des comptes, se connecter et se déconnecter pour accéder à des fonctionnalités personnalisées.
- **Catalogue de Films :** Parcourez un vaste catalogue de films, triés par genre ou popularité.
- **Détails des Films :** Consultez des informations détaillées sur chaque film, y compris le titre, le genre, le créateur et la note moyenne.
- **Ajouter des Critiques :** Les utilisateurs peuvent ajouter des critiques aux films, y compris une note et des commentaires pour partager leurs avis avec les autres.
- **Films Favoris :** Les utilisateurs peuvent marquer des films comme favoris pour suivre leurs films préférés.
- **Design Adaptatif :** L'application est optimisée pour différentes tailles d'écran, garantissant une expérience fluide sur tous les appareils.

## Technologies Utilisées

- HTML, CSS, JavaScript
- PHP (Backend)
- MySQL (Base de Données)
- Bootstrap (Framework Frontend)

## Informations sur le Header

- Fonctionnalité de Recherche
- Bouton de tri (Tri les films en fonction de leur genre)
- Bouton (Coeur) d'accès à votre liste de favoris
- Bouton (User) d'accès au infos du compte si connecté / Sinon redirige vers la page de Connexion / Inscription
- Bouton (Home) de redirection à la page d'acceuil
![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/fcb41d8f-7798-4bf6-8247-5b24892c0663)


## Guide d'Utilisation

### Connexion au Site

Pour accéder au site MovieStream, suivez ces étapes :

### Méthode 1 - Sans Inscription / Connexion

1. Ouvrez votre navigateur web et accédez à l'URL du site.
2. Vous accédez à une première page générale, içi vous pouvez regarder des films et voir les critiques des films.
   
   ![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/26b342fc-ded2-4e00-bef1-c232fbdec1fa)

4. Classement des 5 films les mieux notés :
   
   ![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/b1a1240b-16b4-42b0-b7a9-530a4229bc0c)

5. Enfin, vous avez accès à l'intégralité des films disponibles sur le site :
   
   ![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/81b3328f-6860-4c09-916d-372750a383ed)

   Lorsque vous cliquez sur une affiche de film, vous accédez à des informations supplémentaires sur celui-ci :
   
   ![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/b315a5d7-0366-4e7b-b64d-6e97f24c6cc8)

2 options s'offrent à vous :
- Regarder (Pour regarder un film, il faut être connecté) (A savoir que la lecture de film est fictive)
- Voir les critiques :
  
  ![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/ab0fe2a4-3938-457d-90ce-e0eb3855a2e8)

  
### Méthode 2 - Avec Inscription / Connexion

1. Actuellement 4 users existe dans la BDD (Sinon, il est tout simplement possible de s'inscrire :))

- User 1 :
    - Nom d'Utilisateur : [nathan.wyart@gmail.com]
   - Mot de Passe : [1234]

- User 2 :
   - Nom d'utilisateur : [benoit.olivin@gmail.com]
  - Mot de Passe : [test]

Page de Connexion :

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/03fc0d51-4d7f-453d-9e0e-3ca8cc973408)

Page d'Inscription :

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/32c5ae81-044b-429f-b306-9adb77455771) 

Pour plus de sécurité, le mot de passe est hashé en BDD.

Une fois connecté, vous avez accès à des recommandations personnalisées en fonction du genre de film que vous ajoutés le plus dans votre liste de favoris.

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/252fcae9-ce9d-4292-93c1-9c29d3652f4c)

Après être connecté, vous pouvez maintenant ajouter un film à votre liste de Favoris : (Connexion requise !)

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/f53739e8-44b4-465f-ac13-484432eb3339)

Page de Favoris : (Connexion requise !)

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/9d50b75e-4078-4867-8308-ac70d5464d96)

2 boutons disponibles :
- Bouton (Play) - Regarder le film (fictif)
- Bouton (Trash) - Supprimer de la liste des Favoris :
  
  ![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/32053661-3f06-42bf-9b6e-482c1e4c02ae)


- Système de pagination en cas de liste de Favoris importante.

Page de lecture de film (fictive) : 

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/ae9558ad-0850-479d-b581-4bd55913a082)

Page d'ajout de critique sur un film : (Connexion requise !)

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/06ffb07b-8c59-4145-a0a8-dfb0ade8fefb)

Enfin, la page d'informations du compte (basique) :

![image](https://github.com/NathanWyart/projet_web_rattr/assets/152163910/72ba12c8-3dcb-4263-a5e8-cc8799b7465a)

- Possibilité de se déconnecter grâce au bouton dans le header (Log-Out).


## Crédits

MovieStream a été développé par Wyart Nathan. N'hésitez pas à contribuer au projet en soumettant des rapports de bogues, des demandes de fonctionnalités ou des pull requests.

