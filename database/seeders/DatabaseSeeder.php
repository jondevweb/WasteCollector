<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            TransporteurSeeder::class,
            EntrepriseSeeder::class,
            AdministrateurSeeder::class,
            ClientSeeder::class,
            DocumentTypeSeeder::class,
            CollectePointSeeder::class,
            CollecteSeeder::class,
            DechetSeeder::class,
            PassageSeeder::class,
            DocumentClientSeeder::class,
            ExutoireSeeder::class,
            CollecteDechetLineSeeder::class,
        ]);
    }
}
