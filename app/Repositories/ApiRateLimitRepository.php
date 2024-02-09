<?php

namespace App\Repositories;

use App\Models\ApiRateLimit;

class ApiRateLimitRepository extends BaseRepository
{
  public function __construct(ApiRateLimit $model)
  {
    parent::__construct($model);
  }

  public function incrementCounter(string $apiUrl)
  {
    $rateLimit = $this->getByApiUrl($apiUrl);
    $rateLimit->count = $rateLimit->count + 1;
    return $rateLimit->save();
  }

  public function resetCounter(string $apiUrl)
  {
    $rateLimit = $this->getByApiUrl($apiUrl);
    $rateLimit->count = 0;
    return $rateLimit->save();
  }

  public function getByApiUrl(string $apiUrl)
  {
    return $this->model->where("api_url", $apiUrl)->first();
  }

  public function limitHasBeenReached(string $apiUrl): bool
  {
    $rateLimit = $this->getByApiUrl($apiUrl);
    return $rateLimit->count >= $rateLimit->limit_per_minute ? false : true;
  }
}
