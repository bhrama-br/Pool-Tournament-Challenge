<?php
namespace Source\Controllers;

use Source\Models\Friend;
use Source\Models\Match;
use League\Plates\Engine;

class Web
{
    /** @var Engine */
    private $view;

    public function __construct($router)
    {
        $this->view = Engine::create(
            dirname(__DIR__, 2) . "/views",
            "php"
        );

        $this->view->addData(["routes" => $router]);
    }

    public function home($data): void
    {
        echo $this->view->render("home",[]);
    }

    public function friend($param): void
    {

        $newFriends = new Friend();
        $friend = $newFriends->findById($param['id']);

        $newMatch = new Match();
        $countWins = $newMatch->find('winner_id = '.$param['id']);

        $countloses = $newMatch->find('loser_id = '.$param['id']);


        $newMatches = new Match();
        $matches = $newMatches->find("winner_id =". $param['id'] . " or loser_id = ". $param['id'])->order('date desc')->fetch(true);
        foreach ($matches as $m) {
            if($m != ''){
                $dataMatch[] = [
                    'id' => $m->id,
                    'winner_id' => $m->winner_id,
                    'loser_id' => $m->loser_id,
                    'winner_name' => $m->winner()->name,
                    'loser_name' => $m->loser()->name,
                    'date' => $m->date,
                    'remaining_balls' => $m->remaining_balls,
                    'forfeit' => $m->forfeit
                ];
            }
        }


        echo $this->view->render("friend",[
            'friend' => $friend,
            'wins' => $countWins->count(),
            'losses' => $countloses->count(),
            'dataMatch' => $dataMatch
        ]);
    }

    public function match($param): void
    {
        $newMatch = new Match();
        $match = $newMatch->findById($param['id']);

        echo $this->view->render("match",[
            'match' => $match
        ]);
    }

    public function matchCreate($params)
    {
        $params = filter_var_array($params, FILTER_SANITIZE_STRING);
        $newMatch = new Match();

        $newMatch->winner_id = $params['win'];
        $newMatch->loser_id = $params['loser'];
        $newMatch->remaining_balls = $params['balls'];
        $newMatch->forfeit = $params['forfeit'];
        $newMatch->date = $params['date'];
        $newMatch->save();


        $newFriends = new Friend();
        $friendWin = $newFriends->findById($params['win']);

        $friendLoser = $newFriends->findById($params['loser']);

        $pointsWin = $friendWin->points + 3;


        $friendWin->points = $pointsWin;
        $friendWin->save();


        $balls = $friendLoser->balls + $params['balls'];

        if(!$params['forfet']){
            $points = $friendLoser->points + 1 ;
        }else{
            $points = $friendLoser->points;
        }

        $friendLoser->points = $points;
        $friendLoser->balls = $balls;
        $friendLoser->save();

        header("Location: ".ROOT);

    }

}