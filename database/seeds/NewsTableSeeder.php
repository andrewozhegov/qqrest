<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            'title' => 'Ресторан QQ ждет своих клиентов!',
            'image' => '/news/nw1.jpg',
            'text' => 'The biggest problem most people face in learning a new language is their own fear. They worry that they won’t say things correctly or that they will look stupid so they don’t talk at all. Don’t do this. The fastest way to learn anything is to do it – again and again until you get it right. Like anything, learning English requires practice. Don’t let a little fear stop you from getting what you want.',
        ]);

        DB::table('news')->insert([
            'title' => 'Тестовая новость!',
            'image' => '/news/nw2.jpg',
            'text' => 'Most people face in learning a new language is their own fear. The fastest way to learn anything is to do it – again and again until you get it right. Like anything, learning English requires practice. Don’t let a little fear stop you from getting what you want.',
        ]);
    }
}
