<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AreaSeeder::class,
            RequisitoSeeder::class,
            LaboratorioSeeder::class,
            PacienteSeeder::class,
            //UserSeeder::class,
            OrdenlabSeeder::class,
            DetalleOrdenLabSeeder::class,
            CupoSeeder::class,
            CalendarioSeeder::class,
            GrupoSeeder::class,
            //DetalleCalendarioSeeder::class,
            PaqueteSeeder::class,
            CasoDeUsoSeeder::class,
            RolSeeder::class,
            MenuSeeder::class,
        ]);
    }
}
