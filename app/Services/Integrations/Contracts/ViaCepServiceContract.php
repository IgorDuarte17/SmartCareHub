<?php

namespace App\Services\Integrations\Contracts;


interface ViaCepServiceContract
{
    /**
     * Get CEP in ViaCEP Integration.
     *
     * @param string $param
     * @return \Exception|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getCep($param);
}
