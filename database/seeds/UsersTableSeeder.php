<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $senha  = Hash::make('1234');
        User::create([
            'name' => 'Administrador',
            'email'=>'administrador@adm.com',
            'password'=>$senha
        ]);
    }
}
