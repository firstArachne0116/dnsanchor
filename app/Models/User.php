<?php namespace App\Models;

use App\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends AdminUser {

    const DateFormatOptions = [
        [
            'text' => 'DD/MM/YYYY',
            'value' => 'dd/mm/yyyy',
            'php_value' => 'd/m/y',
        ],
        [
            'text' => 'YYYY/MM/DD',
            'value' => 'yyyy/mm/dd',
            'php_value' => 'y/m/d',
        ],
        [
            'text' => 'Humanized (e.g. 40 days ago, in 20 days)',
            'value' => 'humanized',
            'php_value' => 'humanized',
        ],
    ];

    public function __construct( array $attributes = [] ) {
        parent::__construct( $attributes );

        $this->fillable[] = 'date_format';
    }

}
