<?php

namespace Netprime\Models;
use  Netprime\Models\CoreModels;
use Netprime\Utils\Database;
use \PDO;


/***
 * 
 * Model Movie de la base de donnée "Movie"
 * 
 */
class Movie extends CoreModels
{
    private $release_date;
    private $title;
    private $synopsis;
    private $rating;
    private $poster_url;
    private $background_url;
    private $director_id;
    private $composer_id;
    

    
    /***
     * 
     * Methode qui va chercher un filme par un mot
     * 
     * @param title qui est rentré par user 
     */
    public function searchByTitle($title) 
    {
        $pdo = Database::getPDO();
        $sql = "SELECT movies.* 
                FROM movies 
                WHERE title LIKE '%" . $title . "%'";
		$pdoStatement = $pdo->query($sql);

        if ($pdoStatement) {
            $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
            return $result;
        } else {
            return $result = []; 
        }
    }


    /***
     * 
     * Methode qui va chercher un filme par son ID
     * 
     * @param id qui est l'id du film choisi par l'user 
     */
    public function searchById($id)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT movies.* 
                FROM movies 
                WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }


    /***
     * 
     * Methode qui va chercher tous les films par un "movie"
     * 
     * @param id qui est l'id du film choisi par l'user 
     */
    public function findMovieByPeople($id)
    {
    $pdo = Database::getPDO();

    $sql = 'SELECT movies.* 
            FROM movies 
            INNER JOIN movie_actors 
            ON movie_id = movies.id
            INNER JOIN people 
            ON actor_id = people.id
            WHERE people.id = :id';

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute(['id' => $id]);

        
        if ($pdoStatement) {
            $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
            return $result;
        } else {
            return $result = []; 
        }
    }

    /***
     * 
     * Methode qui va chercher les réalisateur d'un film
     * 
     * @param id qui est l'id de realisateur dans la table BBD "movie" 
     * @return mixed
     */
    public function moviesDirected($id)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT movies.* 
                FROM movies 
                INNER JOIN people 
                ON director_id = people.id
                WHERE people.id = :id';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute(['id' => $id]);

        if ($pdoStatement) {
            $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
            return $result;
        } else {
            return $result = []; 
        }
    }

    /***
     * 
     * Methode qui va chercher les composeur d'un film
     * 
     * @param id qui est l'id de composer dans la table BBD "movie" 
     * @return mixed
     */
    public function moviesComposed($id)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT movies.* 
            FROM movies 
            INNER JOIN people 
            ON composer_id = people.id
            WHERE people.id = :id';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute(['id' => $id]);
       
        if ($pdoStatement) {
            $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
            return $result;
        } else {
            return $result = []; 
        }
    }


    public function getRelease_date()
    {
        return $this->release_date;
    }

    public function setRelease_date($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }


    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    public function getPoster_url()
    {
        return $this->poster_url;
    }

    public function setPoster_url($poster_url)
    {
        $this->poster_url = $poster_url;

        return $this;
    }

    public function getBackground_url()
    {
        return $this->background_url;
    }

    public function setBackground_url($background_url)
    {
        $this->background_url = $background_url;

        return $this;
    }

    public function getDirector_id()
    {
        return $this->director_id;
    }

    public function setDirector_id($director_id)
    {
        $this->director_id = $director_id;

        return $this;
    }

    public function getComposer_id()
    {
        return $this->composer_id;
    }

    public function setComposer_id($composer_id)
    {
        $this->composer_id = $composer_id;

        return $this;
    }
}