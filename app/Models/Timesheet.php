<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    
    
    protected $fillable = [
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
    
    ];
    
    
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/timesheets/'.$this->getKey());
    }

    
}
