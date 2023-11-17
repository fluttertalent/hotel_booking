<?php

namespace App\Http\Controllers\Dashboard;

use App\Model\RoomBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RoomBookingController extends DashboardController
{
    /**
     * Display a listing of the resource.
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

        return view('dashboard.booking.room_booking')->with([
            'room_bookings' => $room_bookings
        ]);
    }

    public function cancel($id)
    {
        $room_booking = RoomBooking::findOrFail($id);


        // If the payment is already made
        if($room_booking->payment == true){
            return back()->withErrors('Sorry, you cannot cancel booking which has been already paid. Please, contact hotel staff.');
        }

        // If the user is already checked_in
        if($room_booking->status == "checked_in"){
            return back()->withErrors('Sorry, you cannot cancel booking which is already checked in without staff permission. Please, contact hotel staff.');
        }
        if($room_booking->status == "checked_out"){
            return back()->withErrors('Sorry, you cannot cancel booking which is already checked out without staff permission. Please, contact hotel staff.');
        }
        if($room_booking->status == "cancelled"){
            return back()->withErrors('Sorry, you cannot cancel booking which is already cancelled. Please, contact hotel staff.');
        }

        $room_booking->status = "cancelled";
        $room_booking->save();

        Session::flash('flash_title', 'Success');
        Session::flash('flash_message', 'The room booking has been cancelled successfully.');
        return redirect('dashboard/room/booking');
    }

}
