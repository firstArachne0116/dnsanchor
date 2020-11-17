<?php namespace App\Models;

use Bkwld\Cloner\Cloneable;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Media;
use function App\Helpers\has_approved_template_type;

class PurchaseOrder extends Model
{
    use LogsActivity, Cloneable, SoftDeletes;

    /**
     * @var array
     */
    protected $cloneable_relations = [
        'lines',
        'sales_persons'
    ];

    protected $fillable = [
        "base_po_id",
        "project_id",
        'client_id',
        'sales_representative_id',
        'contact_id',
        'title',
        'quantity',
        'trim_size',
        'extent',
        'orientation',
        'fields',
        'finishing_information',
        'packaging_information',
        'origination',
        'information_requests',
        'materials_in_at',
        'fields',
        'fob_at',
        'delivery_at',
        'vendor_notes',
        'vendor_id',
        'vendor_payment_term_id',
        'customer_shipping_to',
        'approved_manager_id',
        'approved_at',
        'base_project_id',
        'status',
        'template_type',
        'additional_comments',
        'payment_term_id',
        'remittance_id',
        'user_id',
    ];

    protected $hidden = [

    ];

    protected static $logAttributes = [
        'client_id',
        'sales_representative_id',
        'contact_id',
        'title',
        'quantity',
        'trim_size',
        'extent',
        'orientation',
        'fields',
        'finishing_information',
        'packaging_information',
        'origination',
        'information_requests',
        'materials_in_at',
        'fields',
        'fob_at',
        'delivery_at',
        'vendor_notes',
        'vendor_id',
        'vendor_payment_term_id',
        'customer_shipping_to',
        'approved_manager_id',
        'approved_at',
        'status',
        'template_type',
        'additional_comments',
        'payment_term_id',
        'remittance_id',
        'jcp_fields',
        'fcq_signed_at',
        'project_stage_checklist',
        'aa_template',
        'reference',
        'user_id',
    ];

    protected $dates = [
        "fob_at",
        "materials_in_at",
        "delivery_at",
        "approved_at",
        "created_at",
        "updated_at",

    ];

    /**
     * @var array
     */
    protected static $recordEvents = [ 'deleted', 'updated', 'created' ];

    /**
     * @var string
     */
    protected static $logName = 'system';

    /**
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $casts = [
        'fields'                  => 'array',
        'invoice_lines_inc_po'    => 'array',
    ];

    public $timestamps = true;


    /**
     * @var array
     */
    protected $with = [ 'client', 'sales_persons' ];

    protected $appends = ['resource_url', 'total_profit', 'true_percentage_profit', 'total_cost', 'total_price_to_client',];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/purchase-orders/'.$this->getKey());
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sales_persons() {
        return $this->belongsToMany( \App\Models\AdminUser::class, 'project_salespersons', 'project_id', 'salesperson_id' );
    }

    /**
     * Relationships
     */

    public function client() {
        return $this->belongsTo( Contact::class, 'client_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requester() {
        return $this->belongsTo( AdminUser::class, 'approval_requested_by' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function lines() {
        return $this->hasMany( PurchaseOrderInvoiceLine::class, 'purchase_order_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contributors() {
        return $this->activities()->select( [ 'causer_id' ] )->groupBy( 'causer_id' )->whereNotNull( 'causer_id' );
    }

    /**
     * @return mixed
     */
    public function linesGroupedByCategory() {
        return $this->lines->groupBy( function ( $item ) {
            return $item->category;
        } );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany( Project::class, 'base_po_id', 'id' )->withoutGlobalScope( 'published' );
    }

    public function project() {
        return $this->belongsTo( Project::class, 'project_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_term() {
        return $this->belongsTo( PaymentTerm::class, 'payment_term_id' );
    }

    public function vendor() {
        return $this->belongsTo( Vendor::class, 'vendor_id' );
    }

    /**
     * @return array
     */
    public function toArray() {
        $array = parent::toArray(); // TODO: Change the autogenerated stub

        $array[ 'types' ]                = [];
        $array[ 'type' ]                 = collect( $this->fields )->keys()->toArray();

        return $array;
    }


    public function getTotalCostAttribute() {
        $cost = 0.00;

        foreach ( $this->lines as $line ) {
            $cost += $line->unit_cost * $line->quantity;
        }

        return $cost;
    }

    public function getTotalPriceToClientAttribute() {
        $price = 0.00;

        foreach ( $this->lines as $line ) {
            $price += $line->unit_price * $line->quantity;
        }

        return $price;
    }

    public function getTotalProfitAttribute() {
        $cost  = $this->getTotalCostAttribute();
        $price = $this->getTotalPriceToClientAttribute();

        return $price - $cost;
    }

    public function getTruePercentageProfitAttribute() {
        $cost   = $this->getTotalCostAttribute();
        $profit = $this->getTotalProfitAttribute();

        if ( $cost === 0.00 ) {
            return 0;
        }

        return ( $profit / $cost ) * 100;
    }

    /**
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent( string $eventName ) : string {
        return "This project has been {$eventName}.";
    }

    public function getTitleAttribute( $value ) {
        if ( $value ) {
            return $value;
        }

        return 'Untitled Misc PO';
    }

    public function getMaterialsInAtAttribute( $value ) {
        if ( $value ) {
            return Carbon::parse( $value )->getTimestamp();
        }

        return null;
    }

    public function getDeliveryAtAttribute( $value ) {
        if ( $value ) {
            return Carbon::parse( $value )->getTimestamp();
        }

        return null;
    }

    public function getFobAtAttribute( $value ) {
        if ( $value ) {
            return Carbon::parse( $value )->getTimestamp();
        }

        return null;
    }

    public function getCreatedAtAttribute( $value ) {
        if ( $value ) {
            return Carbon::parse( $value )->getTimestamp();
        }

        return null;
    }

    public function getUpdatedAtAttribute( $value ) {
        if ( $value ) {
            return Carbon::parse( $value )->getTimestamp();
        }

        return null;
    }

//    public function getClientAttribute($value) {
//        if ( $value ) {
//            return $value;
//        }
//
//        return [];
//    }

    /* ************************ SCOPES ************************* */

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeApproved( $query ) {
        return $query->whereNotNull( 'approved_at' )
                     ->whereStatus( 'OFFICIAL_VERSION' );
    }

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeUnapproved( $query ) {
        return $query->whereNull( 'approved_at' );
    }

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeRejected( $query ) {
        return $query->where( 'status', '=', 'REJECTED' );
    }

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeDrafts( $query ) {
        return $query->whereNotNull( 'base_po_id' )->withoutGlobalScope( 'published' );
    }

    /**
     * Another method name for "approved".
     *
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeOfficial( $query ) {
        return $this->scopeApproved( $query );
    }

    /**
     * Another method name for "unapproved".
     *
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeUnofficial( $query ) {
        return $this->scopeUnapproved( $query );
    }

    /**
     * Get the latest version of the requested type.
     * This is also the same as limiting by 1 and pulling
     * in descending order.
     *
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeLatestVersion( $query ) {
        return $query->limit( 1 )
                     ->orderByDesc( 'approved_at' );
    }

    /**
     * @param $query Builder
     * @param $type  string
     *
     * @return mixed Builder
     */
    public function scopeWhereType( $query, $type ) {
        if ( null === $type ) {
            return $query;
        }

        return $query->where( 'template_type', '=', $type );
    }

    /**
     * @param $query  Builder
     * @param $status string
     *
     * @return mixed Builder
     */
    public function scopeWhereStatus( $query, $status ) {
        return $query->where( 'status', '=', $status );
    }

    /**
     * @param $query  Builder
     * @param $status array
     *
     * @return mixed Builder
     */
    public function scopeWhereStatusIn( $query, $status ) {
        return $query->whereIn( 'status', $status );
    }

    /**
     * @param $query  Builder
     * @param $status string
     *
     * @return mixed Builder
     */
    public function scopeWhereNotStatus( $query, $status ) {
        return $query->where( 'status', '!=', $status );
    }


}
