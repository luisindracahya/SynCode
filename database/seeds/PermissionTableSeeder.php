<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = collect(['create','update','delete','view']);
        $permissions->each(function($item){
            Permission::create([
                'name'=>$item
            ]);
        });
    }
}
