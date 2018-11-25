<?php

use Illuminate\Database\Seeder;
use App\Models\MrContentManagement;
use Faker\Factory;
class MrContentManagementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        //perbaiki, masih null
        foreach(range(1,5) as $i) {
        MrContentManagement::create([
            'mcm_id'=> 5511201,
            'mcm_tg_id'=> 5502,
            'mcm_dm_id'=> 55101,
            'mcm_mc_id'=> null,
            'mcm_mm_id'=> 5551001,
            'mcm_mtp_id'=> 5525001,
            'mcm_show'=> 555,
            'mcm_is_parent'=> 1,
            'mcm_parent_id'=> 0,
            'mcm_create_at'=> null,
            'mcm_update_at'=> null
        ]);
        }
    }
}
