<?php

namespace App\Repositories;

use App\Models\BoardingHouse;
use App\Models\Room;
use App\Models\Transaction;
use App\Repositories\Contract\transactionRepositoryInterface;

class transactionRepository implements transactionRepositoryInterface
{
    public function getTransactionDataFromSession()
    {
        return session()->get('transaction');
    }
    public function saveTransactionDataToSession($data)
    {
        $transaction = session()->get('transaction', []);

        foreach ($data as $key => $value) {
            $transaction[$key] = $value;
        }

        session()->put('transaction', $transaction);
    }
    public function saveTransactionDataToDB($data)
    {
        $room = Room::find($data['room']);
        $boarding = BoardingHouse::find($data['address']);

        $data['room_id'] = $room->id;
        // $data['address'] = $data['address'];
        $data = $this->prepareDataTransaction($data, $room);
        $transaction = Transaction::create($data);
        session()->forget('transaction');
        return $transaction;
    }
    public function prepareDataTransaction($data, $room)
    {
        $data['code'] = Transaction::generateUniqueTrxId();
        $data['payment_status'] = 'not_yet';
        $data['transaction_date'] = now();
        // $room = $data['room'];

        // dd($this->getTransactionDataFromSession());
        $total = $this->calculteTotalAmount($room->price_per_month, $data['duration']);
        $data['total_amount'] = $this->calcultePayment($total, $data['payment_method']);

        return $data;
    }

    public function calculteTotalAmount($price, $duration)
    {
        $subtotal = $price * $duration;
        $tax = $subtotal * 0.11;
        $insurance = $subtotal * 0.1;
        return $subtotal + $tax + $duration;
    }
    public function calcultePayment($total, $paymentMethod)
    {
        return $paymentMethod === 'full_payment' ? $total : $total * 0.3;
    }
}
