<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderInvoiceLine extends Model
{


    protected $fillable = [
        'name',
        'description',
        'quantity',
        'unit_cost',
        'unit_price',
        'purchase_order_id',
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
        return url('/admin/purchase-orders/' . $this->purchase_order_id . '/lines/'.$this->getKey());
    }

    public function purchase_order() {
        return $this->belongsTo( PurchaseOrder::class, 'purchase_order_id' );
    }

    public function getTotalCostAttribute() {
        $quantity = (float) $this->quantity;
        $unit_price = (float) $this->unit_price;

        return $quantity * $unit_price;
    }


}
