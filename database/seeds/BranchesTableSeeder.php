<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            'name' => 'Филлиал №1',
            'address' => 'Ленина, 23',
            'image' => 'branches/br1.jpg',
            'img-big' => '/branches/br1-big.jpg',
        ]);

        DB::table('branches')->insert([
            'name' => 'Филлиал №2',
            'address' => 'Пушкина, 56',
            'image' => 'branches/br2.jpg',
            'img-big' => 'branches/br2-big.jpg',
        ]);

        DB::table('branches')->insert([
            'name' => 'Филлиал №3',
            'address' => 'Ожегова, 87',
            'image' => 'branches/br3.jpg',
            'img-big' => 'branches/br3-big.jpg',
        ]);
    }
}
