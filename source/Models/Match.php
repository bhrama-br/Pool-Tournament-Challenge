<?php


namespace Source\Models;
use CoffeeCode\DataLayer\DataLayer;

class Match extends DataLayer
{
    public function __construct()
    {
        parent::__construct('matches', ["winner_id", "loser_id"]);
    }

    public function winner()
    {
        $friends = new Friend();
        $friend = $friends->findById($this->winner_id);

        return $friend;
    }

    public function loser()
    {
        $friends = new Friend();
        $friend = $friends->findById($this->loser_id);

        return $friend;
    }
}