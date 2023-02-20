<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\Task;
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
        $this->call(LaratrustSeeder::class);

        Department::factory()->create([
            'name'=>'on hold',
            'description'=>'this departments for user who don\'t have department Or users whose department has been deleted' .'<br>'.

                '<div class="alert alert-danger alert-dismissible mt-5" role="alert">
                    <strong>This department can\'t be deleted!</strong> .
                  </div>',
        ]);

        ###############super admin################

        $super = \App\Models\User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'super_admin@app.com',
             'department_id'=>1,
             'password'=> bcrypt('11111111'),
         ]);
        $super->attachRole('super_admin');
        ###############admin################

         $admin = \App\Models\User::factory()->create([
             'name' => ' Admin',
             'email' => 'admin@app.com',
             'department_id'=>1,
             'password'=> bcrypt('11111111'),
         ]);
        $admin->attachRole('admin');
        ###############manager################
         $manager = \App\Models\User::factory()->create([
             'name' => ' manager',
             'email' => 'manager@app.com',
             'department_id'=>1,
             'password'=> bcrypt('11111111'),
         ]);
        $manager->attachRole('manager');

        ###############user################

        $user = \App\Models\User::factory()->create([
             'name' => ' user',
             'email' => 'user@app.com',
             'department_id'=>1,
             'password'=> bcrypt('11111111'),
         ]);
        $user->attachRole('user');




//
//        Department::factory(10)->create();
//
//        $users =\App\Models\User::factory(20)->create();
//        foreach ($users as $u){
//            $rol = fake()->randomElement(['admin' , 'manager' , 'user']);
//            $u->attachRole($rol);
//        }
//        Task::factory(100)->create();



    }
}
