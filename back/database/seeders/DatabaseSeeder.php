<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;



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
        $permisos=[
            ['name'=>'create_user','resource'=>'user','action'=>'create','detail'=>'Create a new user'],
            ['name'=>'view_user','resource'=>'user','action'=>'view','detail'=>'View user details'],
            ['name'=>'update_user','resource'=>'user','action'=>'update','detail'=>'Update user information'],
            ['name'=>'delete_user','resource'=>'user','action'=>'delete','detail'=>'Delete user'],
        ];
       foreach($permisos as $permiso){
            DB::table('permisos')->insert($permiso);
        }
        $roles=[
            ['nombre'=>'admin','descripcion'=>'Administrador con todos los permisos'],
            ['nombre'=>'editor','descripcion'=>'Usuario con permisos limitados'],
            ['nombre'=>'viewer','descripcion'=>'Usuario invitado con permisos mínimos'],
        ];
        foreach ($roles as $rol){
            DB::table('roles')->insert($rol);
        }
        $rolePermisos=[
            'admin'=>['create_user','view_user','update_user','delete_user'],
            'editor'=>['view_user','update_user'],
            'viewer'=>['view_user'],
        ];
        foreach($rolePermisos as $roles => $permisos){
            $roleId = DB::table('roles')->where('nombre',$roles)->value('id');
            foreach($permisos as $permiso){
                $permisoId = DB::table('permisos')->where('name',$permiso)->value('id');
                DB::table('permiso_role')->insert([
                    'role_id'=>$roleId,
                    'permiso_id'=>$permisoId,
                ]);
            }
        }
        $users = User::all();
        foreach($users as $index=>$user){
            if($index % 3 == 0){
                $roleId = DB::table('rols')->where('nombre','admin')->value('id');
            }elseif($index % 3 == 1){
                $roleId = DB::table('rols')->where('nombre','editor')->value('id');
            }else{
                $roleId = DB::table('rols')->where('nombre','viewer')->value('id');
            }
            DB::table('role_user')->insert([
                'user_id'=>$user->id,
                'role_id'=>$roleId,
            ]);
        }
    }
}
