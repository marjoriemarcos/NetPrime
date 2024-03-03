<?php

namespace Netprime\Models;

/***
 * 
 * Model CoreModel qui prend l'ID des models Movie et People
 * 
 */
class CoreModels
{

    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}