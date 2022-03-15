<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $password = Hash::make('12345678');
        DB::insert('insert into users (matricula,name,"apellidoPaterno","apellidoMaterno", telefono, email, password,rol) values (?, ?,?,?,?,?,?,?)', ['12345678', 'oswaldo', 'orellana', 'vasquez', '62008498', 'nose@gmail.com', $password, 'A']);

        DB::insert('insert into users (matricula,name,"apellidoPaterno","apellidoMaterno", telefono, email, password,rol) values (?, ?,?,?,?,?,?,?)', ['87654321', 'odalis', 'limachi', 'kasa', '69173963', 'odaliskasa@gmail.com', $password, 'A']);


        DB::insert('insert into users (matricula,name,"apellidoPaterno","apellidoMaterno", telefono, email, password,rol) values (?, ?,?,?,?,?,?,?)', ['14725836', 'brenda', 'ali', 'cuchallo', '87845545', 'brenda@gmail.com', $password, 'A']);
        User::factory()->count(1)->create();
    }
}
