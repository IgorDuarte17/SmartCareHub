<?php

namespace App\Services\Patient\Contracts;

use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;

interface PatientServiceContract
{
	/**
     * Get all patients.
     *
     * @return Collection|Patient[]
     */
    public function getAll(): Collection;

    /**
     * Get paginated patients.
     *
     * @param int $perPage
     * @param int $page
     * @return Paginator
     */
    public function getAllPaginated(int $perPage, int $page): Paginator;

    /**
     * Find a patient by ID.
     *
     * @param int $id
     * @return Patient|null
     */
    public function find(int $id): ?Patient;

    /**
     * Create a new patient.
     *
     * @param PatientRequest $request
     * @return \Patient
     */
    public function create(PatientRequest $request): Patient;

    /**
     * Update a patient by ID.
     *
     * @param int $id
     * @param PatientRequest $request
     * @return Patient|null
     */
    public function update(int $id, PatientRequest $request): Patient;

    /**
     * Delete a patient by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
