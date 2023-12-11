<?php

namespace Database\Seeders;
use App\Models\UserTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UserTypes::create(["type"=>'Admin',"type"=>'Owner',"type"=>'customer']);

    }
}
