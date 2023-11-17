<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    public function __construct(
        private Address $model
    ) {}

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $address = $this->model->find($id);

        if ($address) {
            $address->update($data);
            return $address;
        }

        return null;
    }
}
