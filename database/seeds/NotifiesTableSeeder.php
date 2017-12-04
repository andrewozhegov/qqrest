<?php

use Illuminate\Database\Seeder;

class NotifiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifies')->insert([
            'page' => 'reviews',
            'count' => 0
        ]);

        DB::table('notifies')->insert([
            'page' => 'orders',
            'count' => 0
        ]);

        DB::table('notifies')->insert([
            'page' => 'reservations',
            'count' => 0
        ]);

        DB::table('notifies')->insert([
            'page' => 'events',
            'count' => 0
        ]);
    }
}
