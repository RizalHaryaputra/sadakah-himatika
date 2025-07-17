<?php

namespace Database\Seeders;

use App\Models\Padukuhan;
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
        // 1. Membuat Super Admin (tidak terikat padukuhan)
        $superAdmin = User::create([
            'name'           => 'Super Admin',
            'email'          => 'admin@sadakah.com',
            'password'       => bcrypt('adminsadakah25'),
            'total_poin'     => 0,
            'phone_number'   => '081234567890',
            'address'        => 'Kantor Desa Playen',
            'padukuhan_id'   => null,
            'profile_picture' => 'profile_pictures/profile.png',
        ]);
        $superAdmin->assignRole('Super Admin');

        // --- Ambil data padukuhan untuk referensi ---
        $padukuhanPlayen1 = Padukuhan::where('name', 'Playen I')->first();
        $padukuhanPlayen2 = Padukuhan::where('name', 'Playen II')->first();
        $padukuhanBanaran = Padukuhan::where('name', 'Banaran')->first();
        $padukuhanBogor1 = Padukuhan::where('name', 'Bogor I')->first();
        $padukuhanBogor2 = Padukuhan::where('name', 'Bogor II')->first();
        $padukuhanJatisari = Padukuhan::where('name', 'Jatisari')->first();
        $padukuhanMojosari = Padukuhan::where('name', 'Mojosari')->first();

        // 2. Membuat Operator untuk setiap Padukuhan secara eksplisit
        if ($padukuhanPlayen1) {
            $operatorPlayen1 = User::create([
                'name'           => 'Operator Playen I',
                'email'          => 'operator.playen1@sadakah.com',
                'password'       => bcrypt('operatorplayen1sadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567891',
                'address'        => 'Kantor Padukuhan Playen I',
                'padukuhan_id'   => $padukuhanPlayen1->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ]);
            $operatorPlayen1->assignRole('Operator Padukuhan');
        }

        if ($padukuhanPlayen2) {
            $operatorPlayen2 = User::create([
                'name'           => 'Operator Playen II',
                'email'          => 'operator.playen2@sadakah.com',
                'password'       => bcrypt('operatorplayen2sadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567892',
                'address'        => 'Kantor Padukuhan Playen II',
                'padukuhan_id'   => $padukuhanPlayen2->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ]);
            $operatorPlayen2->assignRole('Operator Padukuhan');
        }

        if ($padukuhanBanaran) {
            $operatorBanaran = User::create([
                'name'           => 'Operator Banaran',
                'email'          => 'operator.banaran@sadakah.com',
                'password'       => bcrypt('operatorbanaransadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567893',
                'address'        => 'Kantor Padukuhan Banaran',
                'padukuhan_id'   => $padukuhanBanaran->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ]);
            $operatorBanaran->assignRole('Operator Padukuhan');
        }

        if ($padukuhanBogor1) {
            $operatorBogor1 = User::create([
                'name'           => 'Operator Bogor I',
                'email'          => 'operator.bogor1@sadakah.com',
                'password'       => bcrypt('operatorbogor1sadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567894',
                'address'        => 'Kantor Padukuhan Bogor I',
                'padukuhan_id'   => $padukuhanBogor1->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ]);
            $operatorBogor1->assignRole('Operator Padukuhan');
        }

        if ($padukuhanBogor2) {
            $operatorBogor2 = User::create([
                'name'           => 'Operator Bogor II',
                'email'          => 'operator.bogor2@sadakah.com',
                'password'       => bcrypt('operatorbogor2sadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567895',
                'address'        => 'Kantor Padukuhan Bogor II',
                'padukuhan_id'   => $padukuhanBogor2->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ]);
            $operatorBogor2->assignRole('Operator Padukuhan');
        }

        if ($padukuhanJatisari) {
            $operatorJatisari = User::create([
                'name'           => 'Operator Jatisari',
                'email'          => 'operator.jatisari@sadakah.com',
                'password'       => bcrypt('operatorjatisarisadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567896',
                'address'        => 'Kantor Padukuhan Jatisari',
                'padukuhan_id'   => $padukuhanJatisari->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ]);
            $operatorJatisari->assignRole('Operator Padukuhan');
        }

        if ($padukuhanMojosari) {
            $operatorMojosari = User::create([
                'name'           => 'Operator Mojosari',
                'email'          => 'operator.mojosari@sadakah.com',
                'password'       => bcrypt('operatormojosarisadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567897',
                'address'        => 'Kantor Padukuhan Mojosari',
                'padukuhan_id'   => $padukuhanMojosari->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ]);
            $operatorMojosari->assignRole('Operator Padukuhan');
        }
        
        // 3. Membuat Nasabah (User biasa)
        if ($padukuhanPlayen1) {
            User::create([
                'name'           => 'Nasabah Playen I',
                'email'          => 'nasabah.playen1@sadakah.com',
                'password'       => bcrypt('nasabahplayen1sadakah25'),
                'total_poin'     => 0,
                'phone_number'   => '081234567898',
                'address'        => 'Rumah Nasabah Playen I',
                'padukuhan_id'   => $padukuhanPlayen1->id,
                'profile_picture' => 'profile_pictures/profile.png',
            ])->assignRole('Nasabah');
        }
    }
}
