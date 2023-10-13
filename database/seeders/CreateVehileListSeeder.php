<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleList;
use Illuminate\Support\Facades\Hash;

class CreateVehileListSeeder extends Seeder
{
    public function run(): void
    {
        $vehicleLists = [
            [
                'name'          => 'Inova',
                'number_vechile'=> 'N723KL',
                'fuel'          => 80,
                'status'        => 'ready',
                'created_by'    => 1,
                'updated_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Avanza',
                'number_vechile'=> 'B212AZ',
                'fuel'          => 50,
                'status'        => 'notReady',
                'created_by'    => 1,
                'updated_by'    => 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($vehicleLists as $key => $data) {
            VehicleList::create($data);
        }
    }
}