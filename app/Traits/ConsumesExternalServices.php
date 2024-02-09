<?php

namespace App\Traits;

use App\Repositories\QuoteRepository;
use GuzzleHttp\Client;

trait ConsumesExternalServices
{

  protected $quoteRepository;

  public function __construct(QuoteRepository $quoteRepository)
  {
    $this->quoteRepository = $quoteRepository;
  }

  public function makeRequest(string $method, string $requestUrl, array $queryParams = [], array $formParams = [], array $headers = [], bool $isJsonRequest = false)
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

    return $response;
  }
}
