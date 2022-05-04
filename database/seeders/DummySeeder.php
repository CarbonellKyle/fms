<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Laborers Sample Data
        DB::table('laborers')->insert(['name' => 'Gandalf the Grey', 'address' => 'Somewhere at Middle Earth', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Bilbo Baggins', 'address' => 'Shire', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Legolas', 'address' => 'Woodland Realm of Mirkwood', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Thorin Oakenshield', 'address' => 'Lonely Mountain', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Frodo Baggins', 'address' => 'Shire', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Samwise Gamgee', 'address' => 'Shire', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Merry Brandybuck', 'address' => 'Shire', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Pippin Took', 'address' => 'Shire', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Aragorn', 'address' => 'Gondor', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Gimli', 'address' => 'Lonely Mountain', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Boromir', 'address' => 'Gondor', 'user_id' => 1]);
        DB::table('laborers')->insert(['name' => 'Saruman the White', 'address' => 'Orthanc, the tower at the centre of Isengard', 'user_id' => 1]);

        //Seasons
        DB::table('seasons')->insert(['start_date' => now(), 'end_date' => now()]);
        DB::table('seasons')->insert(['start_date' => now(), 'end_date' => now()]);
        DB::table('seasons')->insert(['start_date' => now(), 'end_date' => now()]);
        DB::table('seasons')->insert(['start_date' => now(), 'end_date' => now()]);

        //Labor Wage
        DB::table('labor_wages')->insert(['season_id' => 4, 'laborer_id' => 1, 'wage' => 700, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 4, 'laborer_id' => 3, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 4, 'laborer_id' => 2, 'wage' => 300, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 4, 'laborer_id' => 4, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 3, 'laborer_id' => 1, 'wage' => 700, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 3, 'laborer_id' => 2, 'wage' => 300, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 3, 'laborer_id' => 3, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 3, 'laborer_id' => 4, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 3, 'laborer_id' => 5, 'wage' => 200, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 3, 'laborer_id' => 6, 'wage' => 200, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 1, 'wage' => 700, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 2, 'wage' => 300, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 3, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 4, 'wage' => 600, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 10, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 5, 'wage' => 250, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 6, 'wage' => 250, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 9, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 2, 'laborer_id' => 11, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 1, 'wage' => 700, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 3, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 9, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 10, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 11, 'wage' => 500, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 5, 'wage' => 300, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 6, 'wage' => 300, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 8, 'wage' => 300, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 7, 'wage' => 300, 'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 12, 'wage' => 1000,'date' => now(), 'user_id' => 1]);
        DB::table('labor_wages')->insert(['season_id' => 1, 'laborer_id' => 4, 'wage' => 500, 'date' => now(), 'user_id' => 1]);

        //Material Expenses
        DB::table('material_expenses')->insert(['season_id' => 4, 'name' => 'Atlas Perfect Gro',        'quantity' => 2, 'price_per_unit' => 0,'cost' => 266, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 4, 'name' => 'Amigo Planters UREA',      'quantity' => 1, 'price_per_unit' => 0, 'cost' => 138, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 4, 'name' => 'Brodan',                   'quantity' => 1, 'price_per_unit' => 0, 'cost' => 630, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 3, 'name' => 'Brodan',                   'quantity' => 1, 'price_per_unit' => 0, 'cost' => 630, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 3, 'name' => 'Atlas Perfect Gro',        'quantity' => 3, 'price_per_unit' => 0, 'cost' => 399, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 3, 'name' => 'Rapid Growth Potassium',   'quantity' => 2, 'price_per_unit' => 0, 'cost' => 280, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 3, 'name' => 'Amigo Planters UREA',      'quantity' => 2, 'price_per_unit' => 0, 'cost' => 276, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 2, 'name' => 'Brodan',                   'quantity' => 1, 'price_per_unit' => 0, 'cost' => 630, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 2, 'name' => 'Rapid Growth Potassium',   'quantity' => 3, 'price_per_unit' => 0, 'cost' => 420, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 2, 'name' => 'Atlas Perfect Gro',        'quantity' => 3, 'price_per_unit' => 0, 'cost' => 399, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 2, 'name' => 'Amigo Planters UREA',      'quantity' => 3, 'price_per_unit' => 0, 'cost' => 414, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 1, 'name' => 'Brodan',                   'quantity' => 2, 'price_per_unit' => 0, 'cost' => 1260, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 1, 'name' => 'Atlas Perfect Gro',        'quantity' => 5, 'price_per_unit' => 0, 'cost' => 665, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 1, 'name' => 'Amigo Planter UREA',       'quantity' => 3, 'price_per_unit' => 0, 'cost' => 414, 'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 1, 'name' => 'Rapid Growth Potassium',   'quantity' => 3, 'price_per_unit' => 0, 'cost' => 420,'date' => now(), 'user_id' => 1]);
        DB::table('material_expenses')->insert(['season_id' => 1, 'name' => 'Triple Action Neem Oil',   'quantity' => 1, 'price_per_unit' => 0, 'cost' => 2301, 'date' => now(), 'user_id' => 1]);

        //Yields
        DB::table('yields')->insert(['season_id' => 4, 'quantity' => 1625, 'date' => now(), 'user_id' => 1]);
        DB::table('yields')->insert(['season_id' => 3, 'quantity' => 1700, 'date' => now(), 'user_id' => 1]);
        DB::table('yields')->insert(['season_id' => 2, 'quantity' => 1875, 'date' => now(), 'user_id' => 1]);
        DB::table('yields')->insert(['season_id' => 2, 'quantity' => 375, 'date' => now(), 'user_id' => 1]);
        DB::table('yields')->insert(['season_id' => 1, 'quantity' => 2500, 'date' => now(), 'user_id' => 1]);

        //Revenue
        DB::table('revenues')->insert(['season_id' => 4, 'quantity' => 250, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 4000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 4, 'quantity' => 500, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 8000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 4, 'quantity' => 50, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 800, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 4, 'quantity' => 200, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' =>3200, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 4, 'quantity' => 450, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 7200, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 3, 'quantity' => 500, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 8000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 3, 'quantity' => 500, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 8000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 3, 'quantity' => 400, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 6400, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 3, 'quantity' => 250, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 4000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 2, 'quantity' => 1000, 'kilo_per_unit' => 30, 'price_per_kilo' => 17, 'total_price' => 17000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 2, 'quantity' => 400, 'kilo_per_unit' => 30, 'price_per_kilo' => 17, 'total_price' => 6800, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 2, 'quantity' => 350, 'kilo_per_unit' => 30, 'price_per_kilo' => 17, 'total_price' => 5950, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 2, 'quantity' => 75, 'kilo_per_unit' => 30, 'price_per_kilo' => 17, 'total_price' => 1275, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 2, 'quantity' => 300, 'kilo_per_unit' => 30, 'price_per_kilo' => 17, 'total_price' => 5100, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 2, 'quantity' => 75, 'kilo_per_unit' => 30, 'price_per_kilo' => 17, 'total_price' => 1275, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 1, 'quantity' => 1000, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 16000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 1, 'quantity' => 750, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 12000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 1, 'quantity' => 500, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 8000, 'date' => now(), 'user_id' => 1]);
        DB::table('revenues')->insert(['season_id' => 1, 'quantity' => 200, 'kilo_per_unit' => 30, 'price_per_kilo' => 16, 'total_price' => 3200, 'date' => now(), 'user_id' => 1]);
    }
}
