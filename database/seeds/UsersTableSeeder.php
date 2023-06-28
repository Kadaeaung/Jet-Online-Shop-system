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
        //

      $admin =  User::create([
        	'name' => 'Kadae',
        	'profile' => 'images/user/admin.png',
        	'email' => 'kadae@gmail.com',
        	'password' =>Hash::make('kadaeaung123'),
        	'phone' =>'09393939393',
        	'address' => 'Yangon'

        ]);
      $admin->assignRole('admin');
      $customer =   User::create([
        	'name' => 'Chaw',
        	'profile' => 'images/user/customer.jpeg',
        	'email' => 'chaw@gmail.com',
        	'password' =>Hash::make('chawaung123'),
        	'phone' =>'09292929292',
        	'address' => 'Yangon'

        ]);
      $customer->assignRole('customer');
      
    }
}
