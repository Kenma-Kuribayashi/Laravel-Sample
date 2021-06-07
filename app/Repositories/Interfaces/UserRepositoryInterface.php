<?php
namespace App\Repositories\Interfaces;

use App\Eloquent\User;


interface UserRepositoryInterface
{
    /**
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function store(string $name, string $email, string $password): User;

    /**
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
