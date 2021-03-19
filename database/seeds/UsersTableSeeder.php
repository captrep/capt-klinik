<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt(12345678),
            'email' => 'admin@captrep.dev',
            'jabatan' => 'Pemilik Klinik',
            'role' => 'admin',
        ]);
    }
}
