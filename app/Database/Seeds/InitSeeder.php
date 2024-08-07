<?php

namespace App\Database\Seeds;

use App\Models\Cfhens\DiseaseModel;
use App\Models\Cfhens\RuleModel;
use App\Models\Cfhens\SymptomModel;
use App\Models\PenggunaModel;
use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        $path = APPPATH . 'Database/Seeds/json/';
        PenggunaModel::create([
            'username' => 'admin',
            'name' => 'Admin',
        ])->setEmailIdentity([
            'email' => 'admin@gmail.com',
            'password' => "password",
        ])->addGroup('admin')->activate();

        foreach (array_chunk(json_decode(file_get_contents($path . 'diseases.json'), true), 1000) as $t) {
            DiseaseModel::upsert($t, ['id'], [
                "code",
                "name",
            ], );
        }
        foreach (array_chunk(json_decode(file_get_contents($path . 'symptoms.json'), true), 1000) as $t) {
            SymptomModel::upsert($t, ['id'], [
                "code",
                "name",
            ], );
        }
        foreach (array_chunk(json_decode(file_get_contents($path . 'rules.json'), true), 1000) as $t) {
            RuleModel::upsert($t, ['id'], [
                'code',
                'symptom_id',
                'disease_id',
            ], );
        }
    }
}
