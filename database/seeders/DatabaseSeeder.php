<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_lengkap'=>'admin',
            'username'=>'admin',
            'password'=>bcrypt('admin'),
            'no_hp'=>'62899887667898',
            'email'=>'admin@admin.com',
            'status'=>'1',
            'photo' => 'user.png'
        ]);
    // User::factory(2)->create();
    }
}
