<?php
namespace App\Repositories\Interfaces;

interface TransactionManagerInterface
{
    public function start(): void;
    public function stop(): void;
    public function rollBack(): void;
}
