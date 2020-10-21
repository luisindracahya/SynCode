<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = collect(['admin','user']);
        $roles->each(function($item){
            Role::create([
                'name'=>$item
            ]);
        });

        $roleAdmin = Role::find(1);
        $roleUser = Role::find(2);

        $roleAdmin->givePermissionTo(['create','update','delete','view']);
        $roleUser->givePermissionTo(['view']);
    }
}
