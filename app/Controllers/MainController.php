<?php

namespace Netprime\Controllers;
use Netprime\Models\Movie;

class MainController extends CoreController 
{

    /**
     * Méthode qui se charge d'afficher la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $data['backgroundChoosen'] = "assets/images/bg-home.jpg";
        $this->show('home',  $data);
    }

    /**
     * Méthode qui se charge d'afficher la page de résultats de recherche
     *
     * @return void
     */
    public function search()
    {
        // écupérer les données du formulaire avec $_GET ou filter_input
        $idMoviesChosen = $_GET['search'];
        $modelMovie = new Movie();
        $ListMovies = $modelMovie->searchByTitle($idMoviesChosen);

        if (false == $modelMovie) {
			$this->redirect();
		}

        $data = [];
        $data['listFilm'] =  $ListMovies;
        $data['idMoviesChosen'] =  $idMoviesChosen;
        $data['backgroundChoosen'] = "assets/images/bg-home.jpg";
        
        $this->show('result', $data);
    }

}