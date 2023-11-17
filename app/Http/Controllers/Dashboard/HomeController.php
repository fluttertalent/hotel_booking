<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Model\RoomBooking;
use App\Model\EventBooking;
use App\Model\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends DashboardController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_bookings = DB::select("
            SELECT room_bookings.*, GROUP_CONCAT(room_types.name SEPARATOR ', ') as room_type_names, users.first_name as firstName, users.last_name as lastName, users.email as email
            FROM room_bookings
            LEFT JOIN room_types ON FIND_IN_SET(room_types.id, room_bookings.room_type_ids) <> 0
            LEFT JOIN users ON users.id = room_bookings.user_id
            GROUP BY room_bookings.id, room_bookings.user_id, room_bookings.arrival_date, room_bookings.departure_date, room_bookings.suite_cost, room_bookings.status,
            room_bookings.payment, room_bookings.created_at, room_bookings.updated_at, room_bookings.room_type_ids, users.first_name, users.last_name, users.email
        ");

        $total_room_bookings =  RoomBooking::where('user_id', Auth::user()->id)->count();
        $event_bookings = EventBooking::where('user_id', Auth::user()->id)
            ->limit(5)
            ->orderBy('created_at', 'asc')
            ->get();
        $total_event_bookings =  EventBooking::where('user_id', Auth::user()->id)->count();

        $total_pending_payments = RoomBooking::where('user_id', Auth::user()->id)->where('payment', 0)->count()
                                + EventBooking::where('user_id', Auth::user()->id)->where('payment', 0)->count();


        $room_booking_with_reviews =  RoomBooking::whereHas('review', function ($query) {
            $query->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->limit('5');
        })->get();

        return view('dashboard.home')->with([
            'room_bookings' => $room_bookings,
            'total_room_bookings' => $total_room_bookings,
            'event_bookings' => $event_bookings,
            'total_event_bookings' => $total_event_bookings,
            'total_pending_payments' => $total_pending_payments,
            'room_booking_with_reviews' => $room_booking_with_reviews,
        ]);
    }
}
