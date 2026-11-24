<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public const MAX_FAILED_ATTEMPTS = 5;
    public const LOCKOUT_SECONDS     = 60;

    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_active',
        'failed_attempts',
        'locked_until',
    ];

    public function findByEmail(string $email): ?array
    {
        $row = $this->where('email', strtolower(trim($email)))->first();

        return $row ?: null;
    }

    public function isLocked(array $user): bool
    {
        if (empty($user['locked_until'])) {
            return false;
        }

        return strtotime((string) $user['locked_until']) > time();
    }

    public function recordFailedAttempt(array $user): int
    {
        $attempts = ((int) ($user['failed_attempts'] ?? 0)) + 1;
        $update   = ['failed_attempts' => $attempts];

        if ($attempts >= self::MAX_FAILED_ATTEMPTS) {
            $update['locked_until'] = date('Y-m-d H:i:s', time() + self::LOCKOUT_SECONDS);
        }

        $this->update((int) $user['id'], $update);

        return $attempts;
    }

    public function resetFailedAttempts(int $userId): void
    {
        $this->update($userId, [
            'failed_attempts' => 0,
            'locked_until'    => null,
        ]);
    }

    public function getRoleCounts(): array
    {
        $rows = $this->select('role, COUNT(*) AS total')->groupBy('role')->findAll();
        $out  = ['admin' => 0, 'operator' => 0, 'customer' => 0];
        foreach ($rows as $r) {
            $out[$r['role']] = (int) $r['total'];
        }

        return $out;
    }
}
