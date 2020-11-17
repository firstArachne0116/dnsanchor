<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
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
        return url('/admin/tasks/'.$this->getKey());
    }

    
}
