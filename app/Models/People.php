<?php

namespace Netprime\Models;
use  Netprime\Models\CoreModels;
use Netprime\Utils\Database;
use \PDO;

class People extends CoreModels
{

    private $name;
    private $picture_url;


    public function findPeopleById($id)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT people.* FROM people WHERE id = :id';
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindParam(':id', $id, PDO::PARAM_INT);

        $pdoStatement->execute();
        $result = $pdoStatement->fetchObject(self::class);

		return $result;
    }

    public function findPeopleByMovie($id)
    {
        $pdo = Database::getPDO();

		$sql = 'SELECT people.* 
                FROM people 
                INNER JOIN movie_actors 
                ON actor_id = people.id
                INNER JOIN movies 
                ON movie_id = movies.id
                WHERE movies.id = ' . $id . '
                ORDER BY CASE WHEN picture_url IS NULL THEN 1 ELSE 0 END, picture_url';
		$pdoStatement = $pdo->query($sql);

		$result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

		return $result;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture_url()
    {
        return $this->picture_url;
    }

     public function setPicture_url($picture_url)
    {
        $this->picture_url = $picture_url;

        return $this;
    }
}