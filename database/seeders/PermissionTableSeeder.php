<?php

namespace Database\Seeders;

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

        $permissions = [
            'dashboard-graph',
            'organization-list',
            'organization-create',
            'organization-edit',
            'organization-delete',
            'survey-list',
            'survey-create',
            'survey-edit',
            'survey-calendar',
            'survey-delete',
            'item-list',
            'item-create',
            'item-edit',
            'item-delete',
            'result-list',
            'result-create',
            'result-edit',
            'result-download',
            'result-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'configuration-edit',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);

        }

    }

}