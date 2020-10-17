<?php

use Phinx\Seed\AbstractSeed;
use Source\Models\Friend;
use Source\Models\Match;

class MatchSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        function RandomId($num1){
            $num2 = rand(0,15);
            if($num1 == $num2){
                RandomId($num1);
            }
            return $num2;
        }
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $num1 = rand(0, 15);
            $num2 = RandomId($num1);

            $stmt = $this->query('SELECT * FROM friends'); // returns PDOStatement
            $friends = $stmt->fetchAll(); // returns the result as an array

            $user1 = $friends[$num1];
            $user2 = $friends[$num2];

            $stmt = $this->query('SELECT * FROM matches where (winner_id =' . $user1["id"] . ' and loser_id = ' . $user2["id"] . ') or (winner_id = ' . $user2["id"] . ' and loser_id = ' . $user1["id"] . ')'); // returns PDOStatement
            $match = $stmt->fetchAll(); // returns the result as an array


            if (!$match) {

                $remaining_balls = rand(1, 7);

                $data = [
                    'winner_id'      => $user1['id'],
                    'loser_id'      => $user2['id'],
                    'remaining_balls'      => $remaining_balls,
                    'forfeit'       => false,
                    'date'       => date('Y-m-d'),
                    'created_at'       => date('Y-m-d H:i:s'),
                ];

                $this->table('matches')
                    ->insert($data)
                    ->save();

                $points = $user1['points'] + 3 ;
                $this->execute('UPDATE friends set points = ' . $points . ' where id = '. $user1['id']);

                $balls = $user2['balls'] + $remaining_balls;

                $points = $user2['points'] + 1 ;
                $this->execute('UPDATE friends set points = ' . $points . ', balls = ' .$balls. ' where id = '. $user2['id']);

            }
        }

    }
}
