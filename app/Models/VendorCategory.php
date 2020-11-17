<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    
    
    protected $fillable = [
        'name',
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
    
    ];
    
    
    public $timestamps = true;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/vendor-categories/'.$this->getKey());
    }

    
}
