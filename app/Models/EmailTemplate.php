<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{


    protected $fillable = [
        "name",
        "header",
        "body",
        "footer",
        "published_at",
    ];

    protected $hidden = [

    ];

    protected $dates = [
        "published_at",
        "created_at",
        "updated_at",
    ];



    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/email-templates/'.$this->getKey());
    }


}
