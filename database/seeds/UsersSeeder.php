<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array users
        $users = array(
            array(
                'name' => 'Administrator',
                'surname' => 'System',
                'email' => 'fashionova@test.local',
                'password' => 'prova1234',
                'roles' => array(
                    'Administrator'
                )
            )
        );

        foreach ($users as $user) {
            $newUser = User::create([
                'name' => ucfirst($user['name']),
                'surname' => ucfirst($user['surname']),
                'email' => strtolower($user['email']),
                'password' => Hash::make($user['password'])
            ]);

            // assegno ruoli
            foreach ($user['roles'] as $role) {
                $newUser->assignRole($role);
            }
        }
    }
}