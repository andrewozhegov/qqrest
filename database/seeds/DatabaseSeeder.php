<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(RolesTableSeeder::class);
        //$this->call(NewsTableSeeder::class);
        //$this->call(BranchesTableSeeder::class);
        $this->call(NotifiesTableSeeder::class);
    }
}
