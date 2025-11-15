<?php

namespace App\Imports;

use App\Models\Halaqah;
use App\Models\PivotHalaqahUser;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DaftarPenggunaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $halaqah = Halaqah::where('halaqah_name', $row['nama_halaqah'])->first();
    
        $user = User::create([
            'nama' => $row['nama'],
            'nim' => $row['nim'],
            'password' => bcrypt($row['password'] ?? '123456'),
            'gender' => $row['gender'],
            'role' => $row['role'] ?? 'praktikan',
            'halaqah_id' => $halaqah ? $halaqah->id : null,
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
