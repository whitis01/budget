<?php

use Illuminate\Database\Seeder;

class CategoryEnumTableSeeder extends Seeder
{
    const NAMES = [
        'Bank',
        'Revolving',
        'Unsecured',
        'Secured',
        'Investments'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::NAMES as $name) {
            DB::table('category_enums')->insert([
                'name' => $name
            ]);
        }
    }
}
