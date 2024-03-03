<?php

namespace Netprime\Controllers;
use Netprime\Models\Movie;
use Netprime\Models\People;


/***
 * 
 * Controller qui permet de diriger l'user 
 * 
 */
class MovieAndPeopleController extends MainController 
{

    /***
     * 
     * Méthode qui permet de diriger l'user vers recherche des movies dont le titre à été taper dans la barre de recherche
     * 
     * @params : movie id  
     * @return void
     */
    public function movieAction($params)
    {
        $movieId = $params;
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


        if (isset($data['movieChoosen'])) {
            $backgroundChoosen = 'https://image.tmdb.org/t/p/original' . $data['movieChoosen']->getBackground_url();
            } else {
            $backgroundChoosen = null;
            }


        $data['backgroundChoosen'] = $backgroundChoosen;

        $this->show('movie', $data);
    }


    /***
     * 
     * Méthode qui permet de diriger l'user vers recherche des people dans la page moviee
     * 
     * @params : people id  
     * @return : void
     */
    public function movieOfPeople($params)
    {
        $id = $params;

        $modelMovie = new Movie();
        $actorList = $modelMovie->findMovieByPeople($id);
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
        $data['backgroundChoosen'] = "assets/images/bg-home.jpg";

        $this->show('other', $data);
    }


}