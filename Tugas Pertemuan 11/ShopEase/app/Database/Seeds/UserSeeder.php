<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $now   = date('Y-m-d H:i:s');
        $users = [
            [
                'name'            => 'Abrar Maulana (Admin)',
                'email'           => 'admin@shopease.test',
                'password'        => password_hash('Admin123!', PASSWORD_BCRYPT),
                'phone'           => '081234567890',
                'role'            => 'admin',
                'is_active'       => 1,
                'failed_attempts' => 0,
                'locked_until'    => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => 'Operator Toko ShopEase',
                'email'           => 'operator@shopease.test',
                'password'        => password_hash('Operator123!', PASSWORD_BCRYPT),
                'phone'           => '081298765432',
                'role'            => 'operator',
                'is_active'       => 1,
                'failed_attempts' => 0,
                'locked_until'    => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'name'            => 'Pelanggan Demo',
                'email'           => 'customer@shopease.test',
                'password'        => password_hash('Customer123!', PASSWORD_BCRYPT),
                'phone'           => '085611223344',
                'role'            => 'customer',
                'is_active'       => 1,
                'failed_attempts' => 0,
                'locked_until'    => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ];

        $table = $this->db->table('users');
        foreach ($users as $user) {
            if ($table->where('email', $user['email'])->countAllResults() === 0) {
                $table->insert($user);
            }
        }
    }
}
