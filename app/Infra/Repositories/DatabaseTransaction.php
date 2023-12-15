<?php

namespace App\Infra\Repositories;

use App\Domain\Repositories\DbTransaction;
use Illuminate\Support\Facades\DB;

class DatabaseTransaction implements DbTransaction 
{
    
    /**
     * Inicia uma transação do banco de dados
     *
     * @return void
     **/
    public static function startTransaction(): void
    {
        DB::beginTransaction();
    }

    /**
     * Realiza o commit da transação ativa
     *
     * @return void
     **/
    public static function commit(): void
    {
        DB::commit();
    }

    /**
     * Realiza o rollback da transação ativa
     *
     * @return void
     **/
    public static function rollback(): void
    {
        DB::rollback();
    }
}
