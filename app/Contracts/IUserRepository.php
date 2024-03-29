<?php

namespace App\Contracts;

use App\Models\User;

interface IUserRepository
{

    public function getByTelegramId(int $telegramId): ?User;

    public function getByEmail(string $email): ?User;
}