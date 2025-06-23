<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientGroup;
use App\Models\Country;
use App\Models\PaymentTerm;
use App\Models\SalesRep;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'test@example.com',
            'password' => Hash::make('admin221')
        ]);

        $countries = Country::factory()->count(10)->create();
        $groups = ClientGroup::factory()->count(5)->create();
        $terms = PaymentTerm::factory()->count(4)->create();
        $reps = SalesRep::factory()->count(3)->create();

        Client::factory()->count(50)->make()->each(function ($client) use ($countries, $groups, $terms, $reps) {
            $client->country_id = $countries->random()->id;
            $client->client_group_id = $groups->random()->id;
            $client->payment_term_id = $terms->random()->id;
            $client->sales_rep_id = $reps->random()->id;
            $client->save();
        });
    }
}
