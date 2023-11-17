<?php

namespace App\Services\Patient;

use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use App\Repositories\AddressRepository;
use App\Repositories\PatientRepository;
use App\Services\Patient\Contracts\PatientServiceContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientService implements PatientServiceContract
{
    public function __construct(
        private PatientRepository $repository,
        private AddressRepository $addressRepository
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
     * @return Patient
     */
    public function create(PatientRequest $request): Patient
    {
        if (!validate_cpf($request->cpf)) {
            throw new \InvalidArgumentException('O número CPF informado é inválido.');
        }

        if (!$this->validateCNS($request->cns)) {
            throw new \InvalidArgumentException('O número CNS informado é inválido.');
        }

        $addressData = $request->input('address');
        $address = $this->addressRepository->create($addressData);

        $requestData = $request->except('address');
        $requestData['address_id'] = $address->id;

        return $this->repository->create($requestData);
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
        $addressData = $request->input('address');
        $address = $this->addressRepository->update($request->address_id, $addressData);

        $requestData = $request->except('address');
        $requestData['address_id'] = $address->id;

        return $this->repository->update($id, $requestData);
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

    private function validateCNS($cns)
    {
        if (in_array($cns[0], ['1', '2'])) {
            return validate_cns($cns);
        }

        return validate_cns_prov($cns);
    }
}
