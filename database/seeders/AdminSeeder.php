<?php

namespace Database\Seeders;

use App\Models\admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        admin::create([
            'name'=>'Super-Admin',
            'email'=>'super@admin.com',
            'mobile'=>'+972591234567',
            'password'=>Hash::make(123456),
        ]);

    }
}
