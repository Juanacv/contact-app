<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //$this->call(CompaniesTableSeeder::class, ContactsTableSeeder::class,);
        //Company::factory()->count(10)->create();
        //Contact::factory()->count(50)->create();
        Company::factory()->hasContacts(5)->count(10)->create();
    }
}
