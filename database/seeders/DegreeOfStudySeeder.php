<?php

namespace Database\Seeders;

use App\Enums\Application\DegreeOfStudy;
use App\Models\DegreeOfStudy as DegreeOfStudyModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreeOfStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (DegreeOfStudy::cases() as $degreeOfStudy) {
            DegreeOfStudyModel::create(['name' => $degreeOfStudy->value]);
        }
    }
}
