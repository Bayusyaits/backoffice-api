<?php

use Illuminate\Database\Seeder;
use App\Models\MrMedia;

class MrMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MrMedia::insert(
            [
            'mm_id'=>5551001,
            'mm_dm_id'=>55103,
            'mm_name'=>'Application Web',
            'mm_src'=>'/assets/frontend/uploads/casestudies/5511001/icon.png',
            'mm_is_parent'=>1 ,
            'mm_parent_id'=>0,
            'mm_show'=>555,
            'mm_create_at'=>5555,
            'mm_update_at'=>null
            ],
            [
                'mm_id'=>5551002,
                'mm_dm_id'=>55103,
                'mm_name'=>'Application Web',
                'mm_src'=>'/assets/frontend/uploads/casestudies/5511001/icon.png',
                'mm_is_parent'=>1,
                'mm_parent_id'=>0,
                'mm_show'=> 555,
                'mm_create_at'=>5555,
                'mm_update_at'=>null
                ]
    );
    }
}
