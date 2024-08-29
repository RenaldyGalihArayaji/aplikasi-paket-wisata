<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        Setting::create([
            'user_id' => 1,
            'name_app' => 'app tour',
            'short_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia dignissimos alias perspiciatis veritatis? Voluptate voluptatem, deleniti libero rerum sapiente fugiat.',
            'logo' => 'logo.png',
            'phone' => '084994839',
            'email' => 'apptour@gmail.com',
            'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'name_hero' => 'welcome to app tour',
            'image_hero' => 'hero.jpg',
            'account_number' => '849849303',
            'account_owner' => 'Mr. R',
            'bank_name' => 'BRI'
        ]);
    }
}
