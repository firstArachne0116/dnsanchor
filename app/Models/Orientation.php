<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orientation extends Model
{
    
    
    protected $fillable = [
        'name',
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
    
    ];
    
    
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/orientations/'.$this->getKey());
    }

    
}
