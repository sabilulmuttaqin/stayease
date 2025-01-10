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
        $data['address'] = $data['address'];
        $data = $this->prepareDataTransaction($data, $room);
        $transaction = Transaction::create($data);
        session()->forget('transaction');
        return $transaction;
    }

    public function getDataTransactionByCode($code)
    {
        return Transaction::where('code', $code)->first();
    }


    public function prepareDataTransaction($data, $room)
    {
        $data['code'] = Transaction::generateUniqueTrxId();
        $data['payment_status'] = 'pending';
        $data['transaction_date'] = now();

        $total = $this->calculteTotalAmount($room->price_per_month, $data['duration']);
        $data['total_amount'] = $this->calcultePayment($total, $data['payment_method']);

        return $data;
    }

    public function calculteTotalAmount($price, $duration)
    {
        $subtotal = $price * $duration;
        $tax = $subtotal * 0.11;
        $insurance = $subtotal * 0.1;
        return $subtotal + $tax + $insurance;
    }
    public function calcultePayment($total, $paymentMethod)
    {
        return $paymentMethod === 'full_payment' ? $total : $total * 0.3;
    }

    public function getBookingTransactionByCodeEmailPhone($code, $email, $phone_number)
    {
        return Transaction::where('code', $code)->where('email', $email)->where('phone_number', $phone_number)->first();
    }
}
