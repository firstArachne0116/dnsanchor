<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model {


    protected $fillable = [
        'status',
        'url',
        'username',
        'ip_address',
        'user_agent'
    ];

    protected $hidden = [

    ];

    protected $dates = [

    ];

    public $timestamps = true;

    protected $appends = [ 'resource_url' ];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url( '/admin/access-logs/' . $this->getKey() );
    }


}
