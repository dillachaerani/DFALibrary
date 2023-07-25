<?php

namespace Database\Seeders;

use App\Repositories\Permission\PermissionInterface;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $userRepo;
    private $roleRepo;
    private $permissionRepo;
    private $faker;
    public function __construct(UserInterface $userRepo, RoleInterface $roleRepo, PermissionInterface $permissionRepo, Faker $faker)
    {
        $this->userRepo       = $userRepo;
        $this->roleRepo       = $roleRepo;
        $this->permissionRepo = $permissionRepo;
        $this->faker          = $faker;
    }
    public function run()
    {
        // roles
        $roles = $this->roleRepo->get();
        foreach ($roles as  $role) {
            $role->syncPermissions([]);
        }
        // permissions
        $module  = "accounts";
        $actions = ['index', 'update'];
        $roles   = $this->roleRepo->get();
        foreach ($actions as $action) {
            $permission = "$module.$action";
            $this->permissionRepo->updateOrCreate(['name' => $permission], ['name' => $permission]);
            $this->command->info("Permission " . $permission . " has created");
            // add permsission
            foreach ($roles as $role) {
                $role->givePermissionTo($permission);
                $this->command->info("Set permission $permission to " . $role->name);
            }
            $this->command->info("-------------------------------------------------------");
        }

        $module  = "app";
        $actions = ['update'];
        $roles   = $this->roleRepo->get(['name' => ['developer', 'superadmin']]);
        foreach ($actions as $action) {
            $permission = "$module.$action";
            $this->permissionRepo->updateOrCreate(['name' => $permission], ['name' => $permission]);
            $this->command->info("Permission " . $permission . " has created");
            // add permsission
            foreach ($roles as $role) {
                $role->givePermissionTo($permission);
                $this->command->info("Set permission $permission to " . $role->name);
            }
            $this->command->info("-------------------------------------------------------");
        }

        $module  = "roles";
        $actions = ['index', 'create', 'update', 'delete', 'restore'];
        $roles   = $this->roleRepo->get(['name' => ['developer']]);
        foreach ($actions as $action) {
            $permission = "$module.$action";
            $this->permissionRepo->updateOrCreate(['name' => $permission], ['name' => $permission]);
            $this->command->info("Permission " . $permission . " has created");
            // add permsission
            foreach ($roles as $role) {
                $role->givePermissionTo($permission);
                $this->command->info("Set permission $permission to " . $role->name);
            }
            $this->command->info("-------------------------------------------------------");
        }

        $module  = "permissions";
        $actions = ['index', 'create', 'update', 'delete', 'restore'];
        $roles   = $this->roleRepo->get(['name' => ['developer']]);
        foreach ($actions as $action) {
            $permission = "$module.$action";
            $this->permissionRepo->updateOrCreate(['name' => $permission], ['name' => $permission]);
            $this->command->info("Permission " . $permission . " has created");
            // add permsission
            foreach ($roles as $role) {
                $role->givePermissionTo($permission);
                $this->command->info("Set permission $permission to " . $role->name);
            }
            $this->command->info("-------------------------------------------------------");
        }

        $module  = "users";
        $actions = ['index', 'create', 'update', 'delete', 'restore', 'verification', 'unverification', 'activate', 'unactivate'];
        $roles   = $this->roleRepo->get(['name' => ['developer', 'superadmin']]);
        foreach ($actions as $action) {
            $permission = "$module.$action";
            $this->permissionRepo->updateOrCreate(['name' => $permission], ['name' => $permission]);
            $this->command->info("Permission " . $permission . " has created");
            // add permsission
            foreach ($roles as $role) {
                $role->givePermissionTo($permission);
                $this->command->info("Set permission $permission to " . $role->name);
            }
            $this->command->info("-------------------------------------------------------");
        }
    }
}
