<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;
use Laravel\Passport\HasApiTokens;

class AdminUser extends \Brackets\AdminAuth\Models\AdminUser {

    use HasApiTokens;

    protected $withCount = [ 'unreadNotifications' ];

    protected $appends = [ 'is_manager', 'resource_url', 'main_role' ];

    public function getNameAttribute() {
        return $this->getFullNameAttribute();
    }

    public function getMainRoleAttribute() {
        return $this->roles()->first();
    }

    public function getIsManagerAttribute() {
        return $this->hasRole( 'Manager' );
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications() {
        return $this->morphMany( Notification::class, 'notifiable' )->orderBy( 'created_at', 'desc' );
    }

}
