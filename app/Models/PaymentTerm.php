<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTerm extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name",
        "value",
        "default",
    ];

    protected $hidden = [

    ];

    protected $dates = [
        "deleted_at",
        "created_at",
        "updated_at",

    ];

    public $timestamps = true;

    protected $appends = [ 'resource_url' ];
    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/payment-terms/'.$this->getKey());
    }

    
}
