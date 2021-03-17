<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::all();
        $tenants->each(function ($tenant) {
            $tenant->contact()->save(Contact::factory()->make());
        });
    }
}
