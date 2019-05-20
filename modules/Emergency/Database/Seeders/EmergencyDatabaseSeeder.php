<?php

namespace Modules\Emergency\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EmergencyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->call(SeedTasksEmergencyTableSeeder::class);
        $this->call(ConceptExpenditureSeederTableSeeder::class);
    }
}