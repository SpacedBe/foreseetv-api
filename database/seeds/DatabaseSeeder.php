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
        DB::table('users')->insert([
            'name' => 'simon',
            'email' => 'simon@spaced.be',
            'password' => bcrypt('bpae695n'),
        ]);

        DB::table('users')->insert([
            'name' => 'fredje',
            'email' => 'fred@foresee.tv',
            'password' => bcrypt('bpae695n'),
        ]);

        DB::table('users')->insert([
            'name' => 'remi',
            'email' => 'remi@foresee.tv',
            'password' => bcrypt('bpae695n'),
        ]);

        DB::table('collections')->insert([
            'name' => 'main'
        ]);
    }
}
