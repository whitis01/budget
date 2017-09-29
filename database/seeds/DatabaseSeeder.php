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
        $this->call(CategoryEnumTableSeeder::class);
        $this->call(AccountNameEnumTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
    }
}
