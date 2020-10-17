<?php


use Phinx\Seed\AbstractSeed;

class FriendSeeder extends AbstractSeed
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
        $faker = Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 16; $i++) {
            $data[] = [
                'name'      => $faker->firstName,
                'lastName'      => $faker->lastName,
                'points'      => 0,
                'created_at'       => date('Y-m-d H:i:s'),
            ];
        }

        $this->table('friends')
            ->insert($data)
            ->save();
    }
}
