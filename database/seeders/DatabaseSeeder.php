<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\FarmOwner;
use App\Models\FarmJob;
use App\Models\FarmJobApplication;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $consumer = User::create([
            'first_name' => 'Test',
            'last_name' => 'Consumer',
            'username' => 'consumer1',
            'email' => 'consumer@example.com',
            'password' => Hash::make('@temp123')
        ]);

        $consumer->assignRole('Consumer');

        $owner = User::create([
            'first_name' => 'Test',
            'last_name' => 'Owner',
            'username' => 'owner1',
            'email' => 'owner@example.com',
            'password' => Hash::make('@temp123')
        ]);

        $owner->assignRole('Farm Owner');

        $laborer = User::create([
            'first_name' => 'Test',
            'last_name' => 'Laborer',
            'username' => 'laborer1',
            'email' => 'laborer@example.com',
            'password' => Hash::make('@temp123')
        ]);

        $laborer->assignRole('Farm Laborer');

        $manager = User::create([
            'first_name' => 'Test',
            'last_name' => 'Manager',
            'username' => 'manager1',
            'email' => 'manager@example.com',
            'password' => Hash::make('@temp123')
        ]);

        $manager->assignRole('Farm Manager');

        $admin = User::create([
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'username' => 'admin1',
            'email' => 'admin@example.com',
            'password' => Hash::make('@temp123')
        ]);

        $admin->assignRole('Admin');

        // $laborers = User::factory(20)
        //     ->create()
        //     ->each(function ($user) {
        //         $user->assignRole('Farm Laborer');
        //     });


        // $farmOwnerUsers = User::factory(10)
        //     ->create()
        //     ->each(function ($user) use ($laborers) {
        //         $user->assignRole('Farm Owner');


        //         $farmOwner = FarmOwner::factory()
        //             ->for($user)
        //             ->create();


        //         FarmJob::factory(3)
        //             ->for($farmOwner)
        //             ->create()
        //             ->each(function ($job) use ($laborers) {

        //                 \App\Models\FarmJobSkill::factory(3)
        //                     ->for($job, 'job')
        //                     ->create();


        //                 $randomLaborers = $laborers->random(5);
        //                 foreach ($randomLaborers as $laborer) {
        //                     FarmJobApplication::factory()
        //                         ->for($job, 'job')
        //                         ->for($laborer, 'applicant')
        //                         ->create();
        //                 }
        //             });

        //         \App\Models\FarmCertification::factory(2)
        //             ->for($farmOwner)
        //             ->create();

        //         \App\Models\FarmFacility::factory(3)
        //             ->for($farmOwner)
        //             ->create();

        //         \App\Models\FarmImage::factory(5)
        //             ->for($farmOwner)
        //             ->create();

        //         \App\Models\FarmProduct::factory(5)
        //             ->for($farmOwner)
        //             ->create();

        //         \App\Models\FarmSchedule::factory(5)
        //             ->for($farmOwner)
        //             ->create();
        //     });
    }
}
