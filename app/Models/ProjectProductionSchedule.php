<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectProductionSchedule extends Model
{


    protected $fillable = [
        'files_in',
        'proofs_ozalids_out',
        'proof_ozalid_approval',
        'printed_sheets_out',
        'printed_sheets_approval',
        'advanced_cps_out',
        'advanced_cps_approval',
        'ex_factory',
        'bulk_loading',
        'vessel_etd',
        'vessel_eta',
        'door_delivery_eta',
        'notes'
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
