<?php

namespace App\Services;

use App\Repositories\ApiRateLimitRepository;
use App\Traits\ConsumesExternalServices;

class DummyQuotesService
{
  use ConsumesExternalServices;

  protected $baseUri;
  protected $apiRateLimitRepository;

  public function __construct(ApiRateLimitRepository $apiRateLimitRepository)
  {
    $this->baseUri = config('services.dummy_json_api.base_uri');
    $this->URL = $this->baseUri."/quotes";
    $this->apiRateLimitRepository = $apiRateLimitRepository;
  }

  public function decodeResponse($response)
  {
    return json_decode($response);
  }

  public function getRandomQuotes(int $quantity)
  {
    return $this->makeRequest(
      'GET',
      "/quotes",
      [
        "limit" => $quantity,
        "skip" => rand(1, 1400)
      ],
      [],
      [],
      $isJsonRequest = true,
      $apiUrlToRate = $this->URL
    );
  }

  public function canMakeRequest()
  {
    return $this->apiRateLimitRepository->limitHasBeenReached($this->URL);
  }
}
