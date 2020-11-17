<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInvoiceLine extends Model
{


    protected $fillable = [
        'name',
        'description',
        'quantity',
        'unit_cost',
        'unit_price',
        'project_id',
        'category',
    ];

    protected $hidden = [

    ];

    protected $dates = [

    ];

    public $timestamps = true;

    protected $appends = ['resource_url'];

    protected $casts = [
        'unit_price' => 'float',
        'unit_cost' => 'float',
        'quantity' => 'float',
    ];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/projects/' . $this->project_id . '/lines/'.$this->getKey());
    }

    public function project() {
        return $this->belongsTo( Project::class, 'project_id' );
    }

    public function getTotalCostAttribute() {
        $quantity = (float) $this->quantity;
        $unit_price = (float) $this->unit_price;

        return $quantity * $unit_price;
    }


}
