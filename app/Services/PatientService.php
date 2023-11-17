<?php

namespace App\Services;

use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use App\Repositories\PatientRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;
use App\Services\Contracts\PatientServiceContract;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientService implements PatientServiceContract
{
    public function __construct(
        private PatientRepository $repository
    ) {}

    /**
     * Get all patients.
     *
     * @return Collection|Patient[]
     */
	public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * Get paginated patients.
     *
     * @param int $perPage
     * @param int $page
     * @return Paginator
     */
    public function getAllPaginated(int $perPage, int $page): Paginator
    {
        $patients = $this->repository->getAll();

        $currentPageItems = $patients->slice(($page - 1) * $perPage, $perPage)->all();

        return new LengthAwarePaginator(
            $currentPageItems,
            count($patients),
            $perPage,
            $page
        );
    }

     /**
     * Find a patient by ID.
     *
     * @param int $id
     * @return Patient|null
     */
    public function find(int $id): Patient
    {
        return $this->repository->find($id);
    }

    /**
     * Create a new patient.
     *
     * @param PatientRequest $request
     * @return \Patient
     */
    public function create(PatientRequest $request): Patient
    {
        return $this->repository->create($request->all());
    }

    /**
     * Update a patient by ID.
     *
     * @param int $id
     * @param PatientRequest $request
     * @return Patient|null
     */
    public function update(int $id, PatientRequest $request): Patient
    {
        return $this->repository->update($id, $request->all());
    }

    /**
     * Delete a patient by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
