
# NetPrime +

NetPrime + est une future plateforme de VOD (Video On Demand) qui permettra de visionner des films en streaming. Elle se veut innovante et simple d'utilisation.
Elle s'axe autour d'un champ de recherche hyper puissant qui permettra à nos clients de trouver facilement les films qu'ils souhaitent visionner.

Le projet est fait en MVC.

# Stack utilisées  

PHP, MYSQL, CSS avec Bootsrap et HTML.

## Installation

1. Installer les dépendances avec `composer install`
2. Importer la base de données `docs/database.sql`
3. Créer le fichier `app/config.ini` à partir du fichier `app/config.ini.dist` et le compléter avec les informations de connexion à la base de données
4. Installer `https://packagist.org/packages/benoclock/alto-dispatcher`


## Models

Création des deux models afin de récupérer les données de la base de données.

- `Movie` : qui permettra de récupérer les informations d'un film
- `People` : qui permettra de récupérer les informations d'une personne

## Controlleurs

Création des deux controllers : 

- `MainController` = qui permettra d'afficher la page home et la page de recher des film via un mot
- `MovieAndPeopleController` = qui permet de d'afficher les pages d'un movie choisi par l'user ou d'un composer, Director ou Actor.
