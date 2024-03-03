<?php 

/* ---------------
-- POINT ENTREE --
----------------*/

// Liaison des Controller pour les routes
use Netprime\Controllers\MainController;
use Netprime\Controllers\MovieAndPeopleController;

require_once '../vendor/autoload.php';

/* ------------
--- ROUTAGE ---
-------------*/

// Création d'un objet router
$router = new AltoRouter();

// On configure AltoRouter pour qu'il ne prenne pas en compte la partie fixe de l'url (le chemin vers notre dossier)
if (array_key_exists('BASE_URI', $_SERVER)) {
	// Alors on définit le basePath d'AltoRouter
	$router->setBasePath($_SERVER['BASE_URI']);
	// ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
} else { // sinon
	// On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
	$_SERVER['BASE_URI'] = '/';
}


// On crée une route pour la page d'accueil avec l'aide de la méthodes map() d'AltoRouter
$router->map(
    'GET',  
    '/',  
    [    
        'controller' => MainController::class,
        'method' => 'home'
    ],
    'home'
);

// On crée une route pour la page de recherche avec l'aide de la méthodes map() d'AltoRouter
$router->map(
    'GET',
    '/results',
    [
        'controller' => MainController::class,
        'method' => 'search'
    ],
    'search'
);

// On crée une route pour la page d'un filme en particulier avec l'aide de la méthodes map() d'AltoRouter
$router->map(
    'GET',
    '/movie/[i:id]',
    [
        'controller' => MovieAndPeopleController::class,
        'method' => 'movieAction'
    ],
    'movie'
);

// On crée une route pour la page d'people (acteur et réalisateur) avec l'aide de la méthodes map() d'AltoRouter
$router->map(
    'GET',
    '/other/[i:id]',
    [
        'controller' => MovieAndPeopleController::class,
        'method' => 'movieOfPeople'
    ],
    'other'
);


/* -------------
--- DISPATCH ---
--------------*/

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();

// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\Netprime\Controllers\ErrorController::err404');

// On injecte dans le constructeur du CoreController
// Le nom de la route demandée
// ET notre instance d'AltoRouter
if(false === $match) {
	$dispatcher->setControllersArguments('', $router);
} else {
	$dispatcher->setControllersArguments($match['name'], $router);
}

// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();