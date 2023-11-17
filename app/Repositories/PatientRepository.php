<?php

namespace App\Repositories;

use App\Models\Patient;

class PatientRepository
{
    public function __construct(
        private Patient $model
    ) {}

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllPaginated($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $patient = $this->find($id);

        if ($patient) {
            $patient->update($data);
            return $patient;
        }

        return null;
    }

    public function delete($id)
    {
        $patient = $this->find($id);

        if ($patient) {
            $patient->delete();
            return true;
        }

        return false;
    }
}
