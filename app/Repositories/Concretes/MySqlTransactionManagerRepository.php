<?php

namespace App\Repositories\Concretes;

use App\Repositories\Interfaces\TransactionManagerInterface;
use Illuminate\Support\Facades\DB;

class MySqlTransactionManagerRepository implements TransactionManagerInterface
{
  public function __construct()
  {
  }

  /**
   *
   * @return void
   */
  public function start(): void
  {
    DB::beginTransaction();
  }

  /**
   *
   * @return void
   */
  public function stop(): void
  {
    DB::commit();
  }

  /**
   *
   * @return void
   */
  public function rollBack(): void
  {
    DB::rollBack();
  }

}
