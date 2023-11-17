<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'room_bookings';

    protected $fillable = ['arrival_date', 'departure_date', 'suite_cost', 'status', 'payment', 'room_type_ids', 'user_id'];

    /**
     * Get the gallery that owns the image.
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
   

    public function review()
    {
        return $this->hasOne('App\Model\Review');
    }
}
