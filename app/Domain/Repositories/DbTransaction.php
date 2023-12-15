<?php

namespace App\Domain\Repositories;

interface DbTransaction
{
    public static function startTransaction(): void;

    public static function commit(): void;

    public static function rollback(): void;
}
