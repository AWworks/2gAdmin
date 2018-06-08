<?php

use App\Role;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
        $owner->name = 'Admin';
        $owner->display_name = 'Admin_disp'; // optional
        $owner->description = 'Admin_disc'; // optional
        $owner->save();
    }
}
