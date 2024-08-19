<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Material;
use Illuminate\Support\Facades\Hash;

class DefaultMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::create([
            'name' => 'Lapiz',
            'description' => 'Lapiz',
            'quantity' => 1
        ]);
        Material::create([
            'name' => 'Plumas',
            'description' => 'Lapiz',
            'quantity' => 5
        ]);
        //name', 'description', 'quantity 
    }
}
