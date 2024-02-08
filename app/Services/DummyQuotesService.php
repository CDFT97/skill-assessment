<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class DummyQuotesService
{
  use ConsumesExternalServices;

  protected $baseUri;

  public function __construct()
  {
    $this->baseUri = config('services.dummy_json_api.base_uri');
  }

  public function decodeResponse($response)
  {
    return json_decode($response);
  }

  public function getRandomQuotes(int $quantity = 5)
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
      $isJsonRequest = true
    );
  }
}
