<?php


namespace Source\Controllers;

use Source\Models\Friend;
use Source\Models\Match;
use League\Plates\Engine;

class Api
{
    public function friends()
    {
        $newFriends = new Friend();
        $friends = $newFriends->find()->order("name desc")->fetch(true);
        foreach ($friends as $f){
            if($f != ''){
                $data[] = [
                    'id' => $f->id,
                    'name' => $f->name,
                    'lastName' => $f->lastName,
                    'points' => $f->points,
                    'balls' => $f->balls,
                ];
            }
        }
        echo json_encode($data);
    }

    public function matchLoser($params){
        $newMatches = new Match();
        $matchesWin = $newMatches->find("winner_id = ". $params['id'])->fetch(true);
        $matchesLoser = $newMatches->find("loser_id =". $params['id'])->fetch(true);

        $id_match[] = $params['id'];
        foreach ($matchesWin as $m) {
            if ($m != '') {
                $id_match[] = $m->loser_id;
            }
        }
        foreach ($matchesLoser as $mL) {
            if ($mL != '') {
                $id_match[] = $mL->winner_id;
            }
        }

        $newFriends = new Friend();
        if($id_match){
            $friends = $newFriends->find("id not in (". implode(",", $id_match) . ')')->order("name desc")->fetch(true);
        }else{
            $friends = $newFriends->find()->order("name desc")->fetch(true);
        }

        foreach ($friends as $f){
            if($f != ''){
                $data[] = [
                    'id' => $f->id,
                    'name' => $f->name,
                    'lastName' => $f->lastName,
                    'points' => $f->points,
                    'balls' => $f->balls,
                ];
            }
        }
        echo json_encode($data);
    }

    public function ranking()
    {
        $friends = new Friend();
        $ranking = $friends->find()->order("points desc")->fetch(true);
        foreach ($ranking as $r){
            if($r != ''){
                $data[] = [
                    'id' => $r->id,
                    'name' => $r->name,
                    'points' => $r->points,
                    'balls' => $r->balls,
                ];
            }
        }
        echo json_encode($data);
    }

    public function matches($params){
        $id_win = $params['id_friend_win'];

        $newMatches = new Match();
        if(!$id_win){
            $matches = $newMatches->find()->order('date desc')->fetch(true);
        }else{
            $matches = $newMatches->find("winner_id =". $id_win . " or loser_id = ". $id_win)->order('date desc')->fetch(true);
        }

        foreach ($matches as $m) {
            if($m != ''){
                $data[] = [
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
        echo json_encode($data);
    }

}