<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    
    
    protected $fillable = [
        'name', 'fields'
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
    
    ];

    protected $casts = [
        'fields' => 'array',
    ];
    
    public $timestamps = true;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/project-types/'.$this->getKey());
    }

    
}
