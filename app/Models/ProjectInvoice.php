<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInvoice extends Model
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
        return url('/admin/project-invoices/'.$this->getKey());
    }

    
}
