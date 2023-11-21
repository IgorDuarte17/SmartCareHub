<?php

namespace App\Http\Controllers;

use App\Http\Requests\CepRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Integrations\Contracts\ViaCepServiceContract;

class CepController extends Controller
{
    public function __construct(
        private ViaCepServiceContract $viaCepService
    ) {}

    /**
     * @param CepRequest $request
     * @return JsonResponse
     */
    public function getCep(CepRequest $request): JsonResponse
    {
        try {
            $cep = $this->viaCepService->getCep($request->cep);

            return response()->json($cep, 200);

        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
