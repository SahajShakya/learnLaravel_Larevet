<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();
        $user = User::factory()->create([
            'name'=>'John Doe',
            'email' => 'john@john.com'
        ]);
         Listing::factory(5)->create([
             'user_id'=>$user->id
         ]);


//         Listing::create([
//             'title' => 'Random title',
//             'tags' => 'Random Tags',
//             'company' => 'Random Company',
//             'location' => 'Random Locations',
//             'email' => 'email@email.com',
//             'website' => 'random.com',
//             'description' => 'random descriptions'
//         ]);
//        Listing::create([
//            'title' => 'Random title2',
//            'tags' => 'Random Tags2',
//            'company' => 'Random Company2',
//            'location' => 'Random Locations2',
//            'email' => 'email2@email.com',
//            'website' => 'random2.com',
//            'description' => 'random descriptions 2'
//        ]);

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
    }
}
