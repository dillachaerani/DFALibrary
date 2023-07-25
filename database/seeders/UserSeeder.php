<?php

namespace Database\Seeders;


use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
        $users = [
            [
                'name'              => 'Developer',
                'username'          => 'developer',
                'email'             => 'developer@' . config('app.base_domain'),
                'password'          => '12345678',
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Superadmin',
                'username'          => 'superadmin',
                'email'             => 'superadmin@' . config('app.base_domain'),
                'password'          => '12345678',
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Administrator',
                'username'          => 'administrator',
                'email'             => 'administrator@' . config('app.base_domain'),
                'password'          => '12345678',
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Dummy Member',
                'username'          => 'member',
                'email'             => 'member@' . config('app.base_domain'),
                'password'          => '12345678',
                'email_verified_at' => now(),
            ],
        ];
        foreach ($users as $user) {
            $this->userRepo->updateOrCreate(['username' => $user['username']], $user);
            $this->command->info("User " . $user['username'] . " has created");
        }
        $this->command->info("-------------------------------------------------------");

        // set role developer
        $developerRole = $this->roleRepo->find('name', 'developer');
        if ($developerRole) {
            $username = ['developer'];
            $users = $this->userRepo->get(['username' => $username]);
            foreach ($users as $user) {
                $user->assignRole($developerRole);
                $this->command->info("Set role developer to " . $user['username']);
                $this->command->info("-------------------------------------------------------");
            }
        }
        // set role superadmin
        $superadminRole = $this->roleRepo->find('name', 'superadmin');
        if ($superadminRole) {
            $username = ['superadmin'];
            $users = $this->userRepo->get(['username' => $username]);
            foreach ($users as $user) {
                $user->assignRole($superadminRole);
                $this->command->info("Set role superadmin to " . $user['username']);
                $this->command->info("-------------------------------------------------------");
            }
        }
        // set role administrator
        $administratorRole = $this->roleRepo->find('name', 'administrator');
        if ($administratorRole) {
            $username = ['administrator'];
            $users = $this->userRepo->get(['username' => $username]);
            foreach ($users as $user) {
                $user->assignRole($administratorRole);
                $this->command->info("Set role administrator to " . $user['username']);
                $this->command->info("-------------------------------------------------------");
            }
        }
        // set role member
        $memberRole = $this->roleRepo->find('name', 'member');
        if ($memberRole) {
            $username = ['member'];
            $users = $this->userRepo->get(['username' => $username]);
            foreach ($users as $user) {
                $user->assignRole($memberRole);
                $this->command->info("Set role member to " . $user['username']);
                $this->command->info("-------------------------------------------------------");
            }
        }
    }
}
