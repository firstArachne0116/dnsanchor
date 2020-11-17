<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    protected $fillable = [
        "name",
        "guard_name",
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    ];
    
    protected $appends = ['resource_url', 'permission_ids'];

    protected $with = [ 'permissions' ];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/roles/'.$this->getKey());
    }

    public function getPermissionIdsAttribute() {
        $permissions = $this->permissions;

        if ( $permissions ) {
            return $permissions->map( function( $item ) {
                return $item->id;
            });
        }

        return [];
    }
}
