<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::truncate();
        $service_types = [
            'Walk kids home from school',
            'Dog-walking services',
            'Clean up cigarette butts on the ground',
            'Babysit during PTA meetings',
            'Foster a shelter animal',
            'Take and donate photos during community events',
            'Donate blood',
            'Contact your reps about local issues',
            'Help kids with their homework',
            'free music lessons',
            'IT help to local adults',
            'patch up clothes and stuffed toys',
            'Helping neighbors with repairs',
            'Deliver groceries and meals ',
            'Pick up medicine',
            'share books',
        ];
        foreach($service_types as $service_type){

            ServiceType::create([
                'name'  => $service_type,
            ]);
        }
    }
}
