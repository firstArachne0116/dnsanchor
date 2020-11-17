<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    
    
    protected $fillable = [
        'name',
        'value'
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
    
    ];
    
    
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/settings/'.$this->getKey());
    }

    public function getValueAttribute() {
        if ( ! $this->attributes[ 'value' ] || ! isset( $this->attributes[ 'type' ] ) ) {
            return null;
        }

        switch ( $this->attributes[ 'type' ] ) {
            case 'list':
                return unserialize( $this->attributes[ 'value' ] );

            default:
                return $this->attributes[ 'value' ];
        }
    }

    public function setValueAttribute($value) {
        $this->attributes[ 'value' ] = serialize( $value );
    }

    
}
