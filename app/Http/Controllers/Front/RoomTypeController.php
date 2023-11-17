<?php

namespace App\Http\Controllers\Front;

use App\Model\RoomType;
use App\Algo\Booking;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RoomTypeController extends FrontController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_types = RoomType::whereHas('images', function ($query){
            $query->where('is_primary', true);
        })->with([
            'images' => function($query){
            $query->where('is_primary', true)->where('status', true);
        },
            'facilities' => function($query){
                $query->where('status', true);
        }
        ])
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();

        //dd($room_types);

        return view('front.room_type.index')->with([
            'room_types' => $room_types
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room_type = RoomType::with([
            'images' => function($clientQuery) {
                $clientQuery->where('status', true);
        },
            'rooms.reviews' => function($clientQuery) {
                $clientQuery->where('approval_status', 'approved');
            }
        ])
            ->where('status', true)
            ->findOrFail($id);


        //dd($room_type->getAggregatedRating());
        return view('front.room_type.profile')
            ->with([
                'room_type' => $room_type,
        ]);
    }

    public function showbook($ids, $arrival_date, $departure_date){

        $room_types = [];
        $idarray = explode(",", $ids);
        $totalPrice = 0;

        foreach($idarray as $id){
            $room_type = RoomType::findOrFail($id);
            $totalPrice+= $room_type->finalPrice;
            array_push($room_types, $room_type);
        }

        return view('front.room_type.book')->with([
            'room_types' => $room_types,
            'totalPrice' => $totalPrice,
            'ids' => $ids,
            'arrival_date' => $arrival_date,
            'departure_date' => $departure_date
        ]);
    }

    public function checkSuiteAvailability(Request $request){

        $arrival_date = $request->input('arrival_date');
        $depareture_date = $request->input('departure_date');
        $room_types = RoomType::where('status', 1)->get();
        $ids = [];
        $available_ids = [];
        foreach ($room_types as $room_type) {
            $booking = new Booking($room_type, $arrival_date, $depareture_date);
            if($booking->suite_available())
                array_push($available_ids, $room_type->id);
            array_push($ids, $room_type->id);
        }
        return response()->json(['available_ids' => $available_ids, 'ids' => $ids]);
    }
}
