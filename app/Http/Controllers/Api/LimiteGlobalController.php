<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\AtribuirLimiteGlobal;
use App\Domain\Entities\LimiteGlobal as LimiteGlobalEntity;
use App\Http\Controllers\Controller;
use App\Infra\Repositories\EloquentLimiteRepository;
use App\Infra\Repositories\DatabaseTransaction;
use App\Presenters\JsonPresenter;
use Illuminate\Http\Request;
use App\Http\Requests\LimiteGlobalAtribuir;
use Symfony\Component\HttpFoundation\Response;

class LimiteGlobalController extends Controller
{
    public function atribuir(LimiteGlobalAtribuir $request)
    {
        try {
            DatabaseTransaction::startTransaction();

            $limiteRepository = new EloquentLimiteRepository();
            $limiteGlobalEntity = new LimiteGlobalEntity($request->all());
            $atribuirLimiteGlobal = new AtribuirLimiteGlobal($limiteRepository, $limiteGlobalEntity);
            $novoLimite = $atribuirLimiteGlobal->atribuirLimitePorEmpresa();

            DatabaseTransaction::commit();

            return response()->json($novoLimite, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            DatabaseTransaction::rollback();
            
            return response()->json([
                'message' => 'Desculpe, parece que ocorreu um erro ao tentar atribuir o limite',
                'cause' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
