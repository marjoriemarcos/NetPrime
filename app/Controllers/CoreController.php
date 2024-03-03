<?php

namespace Netprime\Controllers;
use AltoRouter;

// Cette classe sert de base aux autres controllers. Tous les controllers de ce projet étendent cette classe afin d'hériter de ses méthodes/propriétés.
class CoreController 
{

    /**
	 * Instance d'AltRouter
	 *
	 * @var AltoRouter
	 */
	private AltoRouter $router;

    public function __construct($routeName, $altoRouter)
	{
		$this->router = $altoRouter;
	}

    /**
     * Fonction qui se charge d'afficher une page donnée
     *
     * @param string $viewName Nom du template de page à afficher
     * @param array $viewData Tableau contenant les différentes informations qu'on veut passer à notre vue
     * @return void
     */
    // Pour sécuriser encore plus notre code, on peut obliger les paramètres à avoir un certain type. Ici, en écrivant "array" devant $viewData, on oblige le 2ème paramètre à etre un tableau.
    public function show($viewName, array $viewData = [])
    {
		// On globalise $router car on ne sait pas faire mieux pour l'instant
		$router = $this->router;

		// Comme $viewData est déclarée comme paramètre de la méthode show()
		// les vues y ont accès
		// ici une valeur dont on a besoin sur TOUTES les vues
		// donc on la définit dans show()
		$viewData['currentPage'] = $viewName;

		// définir l'url absolue pour nos assets
		$viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
		// définir l'url absolue pour la racine du site
		// /!\ != racine projet, ici on parle du répertoire public/
		$viewData['baseUri'] = $_SERVER['BASE_URI'];
		// On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
		// La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
		extract($viewData);
		// => la variable $currentPage existe désormais, et sa valeur est $viewName
		// => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
		// => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
		// => il en va de même pour chaque élément du tableau

		// $viewData est disponible dans chaque fichier de vue
		require_once __DIR__ . '/../views/header.tpl.php';
		require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
		require_once __DIR__ . '/../views/footer.tpl.php';
    }
    protected function redirect() {
		header('Location: ' . $this->router->generate('error-404'));
		exit();
	}
    
}