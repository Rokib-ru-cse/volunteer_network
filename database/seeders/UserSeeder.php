<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use App\Models\User;
use App\Models\VolunteerService;
use Illuminate\Database\Seeder;
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
        User::truncate();
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'gender' => 'male',
            'type' => 'admin',
            'location_id' => '1',
            'phone' => '12345678901',
            'password' => Hash::make('11111111'),
        ]);
        $users = [
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'gender' => 'male',
                'type' => 'user',
                'location_id' => '1',
                'phone' => '12345678901',
                'password' => '11111111',
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'gender' => 'male',
                'type' => 'user',
                'location_id' => '2',
                'phone' => '12345678901',
                'password' => '11111111',
            ],
            [
                'name' => 'volunteer1',
                'email' => 'volunteer1@gmail.com',
                'gender' => 'male',
                'type' => 'volunteer',
                'location_id' => '1',
                'phone' => '12345678901',
                'password' => '11111111',
            ],
            [
                'name' => 'volunteer2',
                'email' => 'volunteer2@gmail.com',
                'gender' => 'male',
                'type' => 'volunteer',
                'location_id' => '2',
                'phone' => '12345678901',
                'password' => '11111111',
            ],
        ];
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'gender' => $user['gender'],
                'type' => $user['type'],
                'location_id' => $user['location_id'],
                'phone' => $user['phone'],
                'password' => Hash::make($user['password']),
            ]);
        }
        $users = User::where('type', '=', 'volunteer')->get();
        $service_types = ServiceType::limit(5)->get();
        VolunteerService::truncate();
        foreach ($users as $user) {
            foreach ($service_types as $service_type) {
                $new_volunteer_service_type = new VolunteerService();
                $new_volunteer_service_type->service_type_id = $service_type->id;
                $new_volunteer_service_type->user_id = $user->id;
                $new_volunteer_service_type->save();
            }
        }
    }
}
