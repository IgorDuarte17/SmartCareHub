<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Services\Contracts\PatientServiceContract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    public function __construct(
        private PatientServiceContract $service
    ) {}

    /**
     * @return PatientResource|Collection
     */
    public function index(): Collection
    {
        $patients = $this->service->getAll()->map(function ($patient) {
            return new PatientResource($patient);
        });

        return $patients;
    }

    /* Exemplo usando paginação
    public function indexPaginated(): Collection
        $perPage = request()->query('per_page', 10);
        $page = request()->query('page', 1);
        $patients = $this->service->getAllPaginated($perPage, $page);
        return new PatientResource($patients);
        GET /api/patient/patients?page=2&per_page=15
    }
    **/

    /**
     * @param int $id
     * @return PatientResource
     */
    public function show(int $id): PatientResource
    {
        $patient = $this->service->find($id);

        return new PatientResource($patient);
    }

    /**
     * @param PatientRequest $request
     * @return PatientResource|JsonResponse
     */
    public function store(PatientRequest $request): PatientResource|JsonResponse
    {
        try {
            $patient = $this->service->create($request);

            return new PatientResource($patient);
        } catch (ValidationException $e) {
         $errors = $e->validator->errors()->toArray();

         return response()->json(['message' => 'Erro de validação', 'errors' => $errors], 422);

        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * @param int $id
     * @param PatientRequest $request
     * @return PatientResource
     */
    public function update(int $id, PatientRequest $request): PatientResource
    {
        $patient = $this->service->update($id, $request);

        return new PatientResource($patient);
    }

    /**
     * @param int $int
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $patient = $this->service->delete($id);

        if (!$patient) {
            return response()->json(['message' => 'Paciente não encontrado.'], 404);
        }

        return response()->json(['message' => 'Paciente excluído com sucesso.']);
    }
}
