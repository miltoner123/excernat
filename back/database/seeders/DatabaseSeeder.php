<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Categoria;
use App\Models\Producto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Categoria::create([
            'nombre'=>'Jugos',
            'descripcion'=>'Productos en polvo para jugos'
        ]);
        Categoria::create([
            'nombre'=>'Grajeas',
            'descripcion'=>'Productos secos en grano'
        ]);
        Categoria::create([
            'nombre'=>'Escolares',
            'descripcion'=>'Productos secos en conjunto de grajeas'
        ]);
        Producto::create([
            'nombre'=>'Multicereal',
            'descripcion'=>'producto en polvo de 7 cereales',
            'precio'=>35.00,
            'lote'=>'12345678',
            'imagen'=>null,
            'unidad_medida'=>'unidad',
            'fecha_vencimiento'=>Carbon::create(2026,12,15),
            'categoria_id'=>1
        ]);
        // for($i=1;$i<=50;$i++){
        //     Producto::create([
        //         'nombre'=>'Grajeas de colores '.$i,
        //         'descripcion'=>'Grajeas de colores sabor a frutas',
        //         'precio'=>20.00 + $i,
        //         'lote'=>'GRAJ2023'.$i,
        //         'imagen'=>null,
        //         'unidad_medida'=>'unidad',
        //         'fecha_vencimiento'=>Carbon::create(2025,6,30),
        //         'categoria_id'=>rand(1,3)
        //     ]);
        //}

    }
}
