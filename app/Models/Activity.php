<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends \Spatie\Activitylog\Models\Activity
{
    protected $with = [ 'causer', 'subject' ];
}
