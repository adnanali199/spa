<?php

namespace Database\Seeders;
use App\Models\Pole;
use App\Models\Pool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Poles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pool::create([
            "pool_name"=>"Mercedes Club",
            "short_name"=>"MC Club",
            "owner_id"=>1,
            "image"=>"",
            "features"=>"",
            "rules"=>"",
            "price"=>100,
            "start_time"=>"",
            "end_time"=>"",
            "status"=>"1",

        ],
        [
            "pool_name"=>"Luxury Spanish Club",
            "short_name"=>"LS Club",
            "owner_id"=>1,
            "image"=>"",
            "features"=>"",
            "rules"=>"",
            "price"=>130,
            "start_time"=>"",
            "end_time"=>"",
            "status"=>"1",

        ],
        [
            "pool_name"=>"Turkish SPA Club",
            "short_name"=>"T.SPA Club",
            "owner_id"=>1,
            "image"=>"",
            "features"=>"",
            "rules"=>"",
            "price"=>78,
            "start_time"=>"",
            "end_time"=>"",
            "status"=>"1",

        ]
    );

    }
}
