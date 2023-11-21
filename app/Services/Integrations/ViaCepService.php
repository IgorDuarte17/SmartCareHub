<?php

namespace App\Services\Integrations;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Services\Integrations\Contracts\ViaCepServiceContract;

class ViaCepService implements ViaCepServiceContract
{
    /**
     * @var Client
     */
    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->apiUrl = $this->getApiUrl();
    }

     /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    protected function getApiUrl()
    {
        return config('viacep.api_url');
    }

    /**
     * Get CEP in ViaCEP Integration.
     *
     * @param string $param
     * @return \Exception|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getCep($param)
    {
        $cacheKey = "viacep:{$param}";

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = $this->request('GET', $param);

            Cache::put($cacheKey, $response, now()->addMinutes(config('viacep.cache_duration')));

            return $response;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param $method
     * @param string $param
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    protected function request($method, string $param)
    {
        try {
            $response = json_decode($this->httpClient->request($method, "{$this->apiUrl}/$param/json/", [
                'headers' => [
                    'accept' => 'application/json'
                ],
            ])->getBody()->getContents());

            \Log::info('viacep.get.cep', [
                'param' => $param,
                'response' => $response
            ]);

            return $response;

        } catch (\Exception $exception) {

            throw $exception;
        }
    }
}
