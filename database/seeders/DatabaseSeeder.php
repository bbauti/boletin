<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coursesIDs = DB::table('courses')->pluck('id');

        $cantUsuarios = 10;
        $cantSalones = 3;      
        while (--$cantUsuarios >= 0) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => date("Y-m-d H:i:s"),
                'course_id' => fake()->randomElement($coursesIDs),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }

        while ($cantSalones >= 0) {
            DB::table('classrooms')->insert([
                'classroom_name' => 'Salon '.$cantSalones,
            ]);
            $cantSalones--;
        }

        // TODO: Cursos, Profesores, Materias
    }
}
