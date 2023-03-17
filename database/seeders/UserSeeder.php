<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\PersonalAccessToken;
use File;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = file_get_contents(database_path("data/electronic-catalog.json"));
        $data = json_decode($json,true);

        foreach($data['users'] as $userdata){

                User::Create($userdata);

        }

    }
}
