<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoryVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_vacancy')->insert([
            ["category_id" => 1,"vacancy_id" => 11],
            ["category_id" => 2,"vacancy_id" => 11],
            ["category_id" => 3,"vacancy_id"=> 11],
            ["category_id" => 4,"vacancy_id" => 11],
            ["category_id" => 1,"vacancy_id" => 2],
            ["category_id" => 2,"vacancy_id" => 2],
            ["category_id" => 3,"vacancy_id" => 2],
        ]);
    }
}
