<?php

namespace App\Traits;

use App\Repositories\ApiRateLimitRepository;
use GuzzleHttp\Client;

trait ConsumesExternalServices
{

  public function makeRequest(string $method, string $requestUrl, array $queryParams = [], array $formParams = [], array $headers = [], bool $isJsonRequest = false, string $apiUrlToRate)
  {
    if(method_exists($this, 'canMakeRequest')) {
      $canMakeRequest = $this->canMakeRequest();

      if(!$canMakeRequest) {
        return false;
      }
    }

    $client = new Client([
      'base_uri' => $this->baseUri,
    ]);

    if (method_exists($this, 'resolveAuthorization')) {
      $this->resolveAuthorization($queryParams, $formParams, $headers);
    }

    $response = $client->request($method, $requestUrl, [
      $isJsonRequest ? 'json' : 'form_params' => $formParams,
      'headers' => $headers,
      'query' => $queryParams
    ]);

    $response = $response->getBody()->getContents();

    if (method_exists($this, 'decodeResponse')) {
      $response = $this->decodeResponse($response);
    }

    $rateLimitRepository = resolve(ApiRateLimitRepository::class);
    $rateLimitRepository->incrementCounter($apiUrlToRate);
    
    return $response;
  }
}
