<?php

namespace Database\Seeders\geri;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorReferente extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actor_referentes')->insert(['vinculo'=>'Ninguno','modalidad'=>'','actor_id'=>1]);
    }
}
