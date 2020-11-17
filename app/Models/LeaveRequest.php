<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model {


    protected $fillable = [
        'user_id',
        'approved_by',
        'requested_dates',
        'pto',
        'purpose',
        'period',
        'approved_at',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'requested_dates' => 'array'
    ];

    protected $dates = [
        'created_at',
        'approved_at',
        'updated_at'
    ];


    public $timestamps = true;

    protected $appends = [ 'resource_url', 'requested_at' ];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url( '/admin/leave-requests/' . $this->getKey() );
    }

    public function getRequestedAtAttribute() {
        return $this->created_at->getTimestamp();
    }


}
