<?php

namespace Netprime\Controllers;
use Netprime\Controllers\CoreController;
use Netprime\Models\Movie;
use Netprime\Models\People;
use Netprime\Models\CoreModels;

class MainController extends CoreController 
{

    /**
     * Méthode qui se charge d'afficher la page d'accueil
     *
     * @return void
     */
    public function homeAction()
    {
        $data = [];
        $data['movieChoosen'] = " ";
        $this->show('home');
    }

    /**
     * Méthode qui se charge d'afficher la page de résultats de recherche
     *
     * @return void
     */
    public function searchAction()
    {
        // écupérer les données du formulaire avec $_GET ou filter_input
        $idFilmChosen = $_GET['search'];
        $modelMovie = new Movie();
        $ListMovies = $modelMovie->searchByTitle($idFilmChosen);

        if (false == $modelMovie) {
			$this->redirect();
		}

        $data = [];
        $data['listFilm'] =  $ListMovies;
        $data['idFilmChosen'] =  $idFilmChosen;
        
        $this->show('result', $data);
    }

    public function movieAction($params)
    {
        $movieId = $params['id'];
        $modelMovie = new Movie();
        $movieChoosen = $modelMovie->searchById($movieId);
        $idDirector = $movieChoosen->getDirector_id();
        $idComposer = $movieChoosen->getComposer_id();

        if (false == $modelMovie) {
			$this->redirect();
		}

        $modelPeople = new People();
        $directorChoosen = $modelPeople->findPeopleById($idDirector);
        $composerChoosen = $modelPeople->findPeopleById($idComposer);
       
        $actorChoosen = $modelPeople->findPeopleByMovie($movieId);

        $data = [];
        $data['movieChoosen'] = $movieChoosen;
        $data['directorChoosen'] = $directorChoosen;
        $data['composerChoosen'] = $composerChoosen;
        $data['actorChoosen'] = $actorChoosen;

        $this->show('movie', $data);
    }

    public function movieActor($params)
    {
        $id = $params['id'];

        $modelMovie = new Movie();
        $actorList = $modelMovie->findMovieByActor($id);
        $director = $modelMovie->moviesDirected($id);
        $composor = $modelMovie->moviesComposed($id);

        if (false == $modelMovie) {
			$this->redirect();
		}

        $modelPeople = new People();
        $actorChoosen = $modelPeople->findPeopleById($id);
        

        $data = [];
        $data['listFilmByActor'] = $actorList;
        $data['actorChoosen'] = $actorChoosen;
        $data['director'] = $director;
        $data['composor'] = $composor;

        $this->show('other', $data);
    }




}