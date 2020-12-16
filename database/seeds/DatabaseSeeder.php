<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'user']);
        Permission::create(['name' => 'customer']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(['admin', 'user', 'customer']);

        // or may be done by chaining
        $roleUser = Role::create(['name' => 'user'])
            ->givePermissionTo('user');

        $roleCustomer = Role::create(['name' => 'customer'])->givePermissionTo('customer');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '123123123',
            'password' => bcrypt('asdfasdf'),
        ]);

        $admin->assignRole($roleAdmin);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'phone' => '123123123',
            'password' => bcrypt('asdfasdf'),
        ]);

        $user->assignRole($roleUser);

        $customer = User::create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'phone' => '123123123',
            'password' => bcrypt('asdfasdf'),
        ]);

        $customer->assignRole($roleCustomer);
    }
}
