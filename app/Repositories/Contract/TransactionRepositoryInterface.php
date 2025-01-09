<?php

namespace App\Repositories\Contract;

interface transactionRepositoryInterface
{
    public function getTransactionDataFromSession();
    public function saveTransactionDataToSession($data);
    public function saveTransactionDataToDB($data);
}
