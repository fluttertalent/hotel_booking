<?php

namespace App\Http\Controllers\Admin;

use App\Model\RoomBooking;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoomBookingController extends AdminController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
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

        // var_dump($room_bookings);
        // print($room_bookings->count());
        // die();
        
        return view('admin.room_booking.view')
            ->with('room_bookings', $room_bookings);
    }

    public function edit($id)
    {
        $room_booking = DB::select("
            SELECT room_bookings.*, GROUP_CONCAT(room_types.name SEPARATOR ', ') as room_type_names
            FROM room_bookings
            LEFT JOIN room_types ON FIND_IN_SET(room_types.id, room_bookings.room_type_ids) <> 0
            LEFT JOIN users ON users.id = room_bookings.user_id
            WHERE room_bookings.id = :id
            GROUP BY room_bookings.id, room_bookings.user_id, room_bookings.arrival_date, room_bookings.departure_date, room_bookings.suite_cost, room_bookings.status,
            room_bookings.payment, room_bookings.created_at, room_bookings.updated_at, room_bookings.room_type_ids, users.first_name, users.last_name, users.email
        ", ['id' => $id]);

      
        return view('admin.room_booking.edit')->with('room_booking', $room_booking[0]);
    }

    public function update(Request $request, $id)
    {
        $room_booking = RoomBooking::findOrFail($id);

        $rules = [
            'status' => 'in:pending,checked_in,checked_out,cancelled',
            'payment' => 'boolean'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $room_booking->status = $request->input('status');
        $room_booking->payment = $request->input('payment');
        $room_booking->save();

        Session::flash('flash_title', 'Success');
        Session::flash('flash_message', 'The Room Booking has been updated successfully.');
        return redirect('/admin/room_booking');
    }

}
