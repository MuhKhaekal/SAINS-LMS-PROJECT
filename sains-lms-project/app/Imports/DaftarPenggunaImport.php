<?php

namespace App\Imports;

use App\Models\Halaqah;
use App\Models\PivotHalaqahUser;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DaftarPenggunaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $halaqah = Halaqah::where('halaqah_name', $row['halaqah'])->first();
    
        $user = User::create([
            'nama' => $row['nama'],
            'nim' => $row['nim'],
            'password' => bcrypt($row['password'] ?? 'password'),
            'gender' => $row['gender'],
            'role' => $row['role'] ?? 'praktikan',
        ]);
    
        if ($halaqah) {
            PivotHalaqahUser::create([
                'halaqah_id' => $halaqah->id,
                'user_id' => $user->id,
            ]);
        }
    
        return $user;
    }
}

