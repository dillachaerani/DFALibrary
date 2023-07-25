<?php

namespace Database\Seeders;


use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $userRepo;
    private $roleRepo;
    private $faker;
    public function __construct(UserInterface $userRepo, RoleInterface $roleRepo, Faker $faker)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->faker    = $faker;
    }
    public function run()
    {
        $roles = [
            ['name' => 'developer'],
            ['name' => 'superadmin'],
            ['name' => 'administrator'],
            ['name' => 'member'],
        ];
        foreach ($roles as $role) {
            $this->roleRepo->updateOrCreate($role, $role);
            $this->command->info("Role " . $role['name'] . " has created");
        }
        $this->command->info("-------------------------------------------------------");
    }
}
