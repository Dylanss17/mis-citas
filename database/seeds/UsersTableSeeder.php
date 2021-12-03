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
        // 1
    	User::create([
    		'name' => 'Dylan Briceno',
	        'email' => 'admin@gmail.com',
	        'password' => bcrypt('admin123'),
	        'role' => 'admin'
    	]);

        // 2
        User::create([
            'name' => 'Paciente Test',
            'email' => 'paciente@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'patient'
        ]);

        // 3
        User::create([
            'name' => 'Médico Test',
            'email' => 'doctor@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'doctor'
        ]);

        factory(User::class, 50)->states('patient')->create();
    }
}
