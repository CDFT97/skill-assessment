<?php

namespace App\Repositories;

use App\Models\Quote;

class QuoteRepository extends BaseRepository
{
  public function __construct(Quote $model)
  {
    parent::__construct($model);
  }

  public function getByUserId(int $user_id)
  {
    return $this->model->where('user_id', $user_id)->get();
  }

  public function getIdListByUserId(int $user_id)
  {
    return $this->getByUserId($user_id)->pluck('external_id')->toArray();
  }
}
