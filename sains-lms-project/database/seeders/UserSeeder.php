<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['nama' => 'Admin', 'nim' => 'admin', 'password' => 'password', 'gender' => 'L', 'role' => 'admin'],
            ['nama' => 'Asisten 1', 'nim' => 'asisten1', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Asisten 2', 'nim' => 'asisten2', 'password' => 'password', 'gender' => 'P', 'role' => 'asisten'],
            ['nama' => 'Asisten 3', 'nim' => 'asisten3', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Asisten 4', 'nim' => 'asisten4', 'password' => 'password', 'gender' => 'P', 'role' => 'asisten'],
            ['nama' => 'Asisten 5', 'nim' => 'asisten5', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Asisten 6', 'nim' => 'asisten6', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Asisten 7', 'nim' => 'asisten7', 'password' => 'password', 'gender' => 'P', 'role' => 'asisten'],
            ['nama' => 'Asisten 8', 'nim' => 'asisten8', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Asisten 9', 'nim' => 'asisten9', 'password' => 'password', 'gender' => 'P', 'role' => 'asisten'],
            ['nama' => 'Asisten 10', 'nim' => 'asisten10', 'password' => 'password', 'gender' => 'P', 'role' => 'asisten'],
            ['nama' => 'Asisten 11', 'nim' => 'asisten11', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Asisten 12', 'nim' => 'asisten12', 'password' => 'password', 'gender' => 'P', 'role' => 'asisten'],
            ['nama' => 'Asisten 13', 'nim' => 'asisten13', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Asisten 14', 'nim' => 'asisten14', 'password' => 'password', 'gender' => 'P', 'role' => 'asisten'],
            ['nama' => 'Asisten 15', 'nim' => 'asisten15', 'password' => 'password', 'gender' => 'L', 'role' => 'asisten'],
            ['nama' => 'Praktikan 1', 'nim' => 'praktikan1', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 2', 'nim' => 'praktikan2', 'password' => 'password', 'gender' => 'P', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 3', 'nim' => 'praktikan3', 'password' => 'password', 'gender' => 'P', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 4', 'nim' => 'praktikan4', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 5', 'nim' => 'praktikan5', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 6', 'nim' => 'praktikan6', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 7', 'nim' => 'praktikan7', 'password' => 'password', 'gender' => 'p', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 8', 'nim' => 'praktikan8', 'password' => 'password', 'gender' => 'p', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 9', 'nim' => 'praktikan9', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 10', 'nim' => 'praktikan10', 'password' => 'password', 'gender' => 'p', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 11', 'nim' => 'praktikan11', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 12', 'nim' => 'praktikan12', 'password' => 'password', 'gender' => 'p', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 13', 'nim' => 'praktikan13', 'password' => 'password', 'gender' => 'p', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 14', 'nim' => 'praktikan14', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
            ['nama' => 'Praktikan 15', 'nim' => 'praktikan15', 'password' => 'password', 'gender' => 'L', 'role' => 'praktikan'],
        ];

        foreach ($users as $user) {
            User::create([
                'nama' => $user['nama'],
                'nim' => $user['nim'],
                'password' => bcrypt($user['password']),
                'gender' => $user['gender'],
                'role' => $user['role'],
            ]);
        }
    }
}
