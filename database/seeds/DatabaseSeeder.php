<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    
        $user = User::where('email', 'admin@gmail.com')->first();

        if (!$user) {
            $admin = new \App\User;

            $admin->name = "admin";
            $admin->email = "admin@gmail.com";
            $admin->password = bcrypt("admin123");
            $admin->is_admin = true;
            $admin->save();
        }
    }
}
