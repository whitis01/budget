<?php

use Illuminate\Database\Seeder;

class AccountNameEnumTableSeeder extends Seeder
{
    const NAMES_AND_CATEGORY = [
        ['Bank', 1],
        ['Discover Bank', 1],
        ['Discover Credit', 2],
        ['Chase', 2],
        ['LUFDA', 3],
        ['Luther', 3],
        ['Iowa SL', 3],
        ['Direct', 3],
        ['Citi', 3],
        ['Perkins', 3],
        ['Impala', 4],
        ['Lake Manor', 4],
        ['Fidelity', 5],
        ['Vanguard', 5],
        ['Robinhood', 5],
        ['Best Buy', 2],
        ['Kohls', 2],
        ['Chase - Amazon', 2],
        ['Chase - Slate', 2],
        ['Chase - Freedom', 2],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::NAMES_AND_CATEGORY as $account) {
            DB::table('account_name_enums')->insert([
                'name' => $account[0],
                'category_enum_id' => $account[1]
            ]);
        }
    }
}
