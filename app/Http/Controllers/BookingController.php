<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerDetailRequest;
use App\Repositories\Contract\boardingHouseRepositoryInterface;
use App\Repositories\Contract\categoryRepositoryInterface;
use App\Repositories\Contract\cityRepositoryInterface;
use App\Repositories\Contract\transactionRepositoryInterface;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private boardingHouseRepositoryInterface $boardingHouseRepository;
    private transactionRepositoryInterface $transactionRepository;

    public function __construct(
        boardingHouseRepositoryInterface $boardingHouseRepository,
        transactionRepositoryInterface $transactionRepository,
    ) {

        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->transactionRepository = $transactionRepository;
    }
    public function checkBooking()
    {
        return view('pages.booking');
    }
    public function booking(Request $req, $slug)
    {
        $this->transactionRepository->saveTransactionDataToSession($req->all());
        // dd($this->transactionRepository->getTransactionDataFromSession());
        return redirect()->route('booking.information', $slug);
    }
    public function getBookingInformation($slug)
    {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        // dd($transaction);
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room']);

        return view('pages.booking.bookingInformation', compact('transaction', 'boardingHouse', 'room'));
    }
    public function saveBookingInformation(StoreCustomerDetailRequest $request, $slug)
    {
        $data = $request->validated();

        $this->transactionRepository->saveTransactionDataToSession($data);

        return redirect()->route('booking.checkout', $slug);
    }

    public function checkout($slug)
    {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        // dd($transaction);
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room']);
        return view('pages.booking.checkout', compact('transaction', 'boardingHouse', 'room'));
    }
    public function storeDB(Request $request)
    {

        $this->transactionRepository->saveTransactionDataToSession($request->all());
        // dd($this->transactionRepository->getTransactionDataFromSession());
        $transaction = $this->transactionRepository->saveTransactionDataToDB($this->transactionRepository->getTransactionDataFromSession());
        dd($transaction);
    }
}
