<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Template extends Model
{


    protected $fillable = [
        'user_id',
        'public',
        'key',
        'name',
        'content',
    ];

    protected $hidden = [

    ];

    protected $dates = [

    ];


    public $timestamps = true;

    protected $appends = ['resource_url'];

    public static function boot() {
        parent::boot();

        $isAuthed = false;

        if ( Auth::check() ) {
            $isAuthed = true;
        }

        static::creating( function ( $template ) use ( $isAuthed ) {
            if ( $isAuthed ) {
                $template->user_id = Auth::user()->id;
            }

            $template->key = str_slug( $template->name );
        } );
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/templates/'.$this->getKey());
    }


}
