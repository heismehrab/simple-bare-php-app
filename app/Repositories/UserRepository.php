<?php

namespace App\Repositories;

use App\Kernel\Database\Mysql;

/**
 * A repository for users table.
 */
class UserRepository implements GeneralRepositoryInterface
{

    /**
     * Runs a raw query.
     *
     * @param string $query
     * @param array $bindings
     *
     * @return mixed
     */
    public function rawQuery(string $query, array $bindings = []): mixed
    {
        return Mysql::query($query, $bindings);
    }

    /**
     * @param string $email
     *
     * @return int
     */
    public function createUser(string $email): int
    {
        $query = <<<HERE
            INSERT INTO users (email) values (?)
        HERE;

        // Creates user.
        $this->rawQuery($query, [$email]);

        $query = <<<HERE
            SELECT MAX(id) as last_id FROM users
        HERE;


        /** @var \mysqli_result $result */
        $result = $this->rawQuery($query);

        return $result->fetch_array()['last_id'];
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkUser(int $userId): bool
    {
        $query = <<<HERE
            SELECT id FROM users WHERE id = ?
        HERE;

        /** @var \mysqli_result $result */
        $result = $this->rawQuery($query, [$userId]);
        
        return ! $result->fetch_array() == null;
    }
}