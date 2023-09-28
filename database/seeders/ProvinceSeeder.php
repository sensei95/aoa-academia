<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            "bas-uele",
            "equateur",
            [
                "name" => "haut-katanga",
                "cities" => [
                    "lubumbashi",
                    "likasi"
                ],
                "territories" => [
                    ["ins_code" => "7020","name" => "Kipushi"],
                    ["ins_code" => "7021","name" => "sakania"],
                    ["ins_code" => "7020","name" => "kasenga"],
                    ["ins_code" => "7020","name" => "mitwaba"],
                    ["ins_code" => "7020","name" => "pweto"],
                    ["ins_code" => "7020","name" => "kambove"],
                ]
            ]
            ,
            "haut-lomami",
            "haut-uele",
            "ituri",
            "kasai",
            "kasai central",
            "kasai oriental",
            [
                "name" => "kinshasa",
                "districts" => [
                    [
                        "name" => "funa",
                        "communes" => [
                            "bandalungwa",
                            "bumbu",
                            "kalamu",
                            "kasa-Vubu",
                            "makala",
                            "ngiri-ngiri",
                            "selembao"
                        ]
                    ],
                    [
                        "name" => "lukunga",
                        "communes" => [
                            "barumbu",
                            "Gombe",
                            "Kinshasa",
                            "Kintambo",
                            "Lingwala",
                            "Ngaliema"
                        ]
                    
                    ],
                    [
                        "name" => "mont-amba",
                        "communes" => [
                            "Kisenso",
                            "Lemba",
                            "Limete",
                            "Matete",
                            "Ngaba",
                            "Mont-Ngafula"
                        ]
                    ],
                    [
                        "name" => "tshangu",
                        "communes" => [
                            "Kimbanseke",
                            "Maluku",
                            "Masina",
                            "Ndjili",
                            "Nsele"
                        ]
                    ]
                ]
            ],
            "kongo-central",
            "kwango",
            "kwilu",
            "lomami",
            "lualaba",
            "mai-ndombe",
            "maniema",
            "mongala",
            "nord-kivu",
            "nord-ubangi",
            "sankuru",
            "sud-kivu",
            "sud-ubangi",
            "tanganyika",
            "tshopo",
            "tshuapa"
        ];

        foreach($provinces as $province) {

            $provinceName = is_array($province) ? $province['name'] : $province;
           
            $provinceModel = Province::create(['name' => $provinceName]);

            if(is_array($province) && !empty($province['cities'])) {
                foreach($province['cities'] as $city) {
                    $provinceModel->cities()->create([
                        'name' => $city
                    ]);
                }
            }

            if(is_array($province) && !empty($province['territories'])) {
                foreach($province['territories'] as $territory) {
                    $provinceModel->territories()->create([
                        'ins_code' => $territory['ins_code'],
                        'name' => $territory['name']
                    ]);
                }
            }

            if(is_array($province) && !empty($province['districts'])) {
                foreach($province['districts'] as $district) {

                    $districtModel = $provinceModel->districts()->create([
                        'name' => $district['name']
                    ]);

                    foreach($district['communes'] as $commune) {
                        $provinceModel->communes()->create([
                            'name' => $commune,
                            'district_id' => $districtModel->id
                        ]);
                    }

                }
            }
            
        }
    }
}
