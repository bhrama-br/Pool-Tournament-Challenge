<?php


namespace Source\Models;
use CoffeeCode\DataLayer\DataLayer;

class Friend extends DataLayer
{
    public function __construct()
    {
        parent::__construct('friends', ["name", "lastName"]);
    }


}