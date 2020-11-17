<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorNote extends Model
{
    
    
    protected $fillable = [
        'name', 'default', 'note'
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
    
    ];
    
    
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/vendor-notes/'.$this->getKey());
    }

    
}
