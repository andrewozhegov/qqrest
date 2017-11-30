<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Пользователь'
        ]);

        DB::table('roles')->insert([
            'name' => 'Модератор'
        ]);

        DB::table('roles')->insert([
            'name' => 'Сотрудник'
        ]);

        DB::table('roles')->insert([
            'name' => 'Администратор'
        ]);
    }
}
